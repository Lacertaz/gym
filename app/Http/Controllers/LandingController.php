<?php

namespace App\Http\Controllers;

use Exception;
use App\RoleType;
use App\Models\User;
use App\Models\InfoGym;
use App\Models\Carousel;
use App\MembershipStatus;
use App\Models\GymPackage;
use App\Models\Membership;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\LogMembership;
use App\LogMembershipStatusType;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Validation\ValidationException;

class LandingController extends Controller
{
    public function index()
    {
        $info_gym = InfoGym::first();
        $carousels = Carousel::all();

        return view('home', compact('info_gym', 'carousels'));
    }

    public function store(RegistrationRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->validated()['name'],
                'email' => $request->validated()['email'],
                'password' => Hash::make($request->validated()['password']),
            ])->assignRole(RoleType::USER->value);

            $new_no_wa = $this->sanitizeNoWhatsapp($request->validated()['no_whatsapp']);

            $kartu_identitas_file = null;

            if ($request->validated()['member_type'] == 'penghuni') {
                $kartu_identitas_file = Storage::disk('public')->put('kartu_identitas', $request->file('kartu_identitas_file'));
            }

            $membership_number_data = $this->generateMembershipNumber();

            $membership_number = $membership_number_data['membership_number'];
            $sequence_number = $membership_number_data['sequence_number'];

            $memberships = Membership::create([
                'user_id' => $user->id,
                'membership_number' => $membership_number,
                'gender' => $request->validated()['gender'],
                'member_type' => $request->validated()['member_type'],
                'join_date' => now(),
                'expired_date' => now(),
                'no_whatsapp' => $new_no_wa,
                'kartu_identitas_file' => $kartu_identitas_file,
                'status' => MembershipStatus::NEW ->value,
                'sequence_number' => $sequence_number,
            ]);

            $gym_package = GymPackage::find($request->validated()['gym_package_id']);

            LogMembership::create([
                'membership_id' => $memberships->id,
                'gym_package_id' => $request->validated()['gym_package_id'],
                'gym_package_name' => $gym_package->name,
                'price' => $gym_package->price,
                'duration' => $gym_package->duration,
                'member_type' => $request->validated()['member_type'],
                'start_date' => null,
                'end_date' => null,
                'status' => LogMembershipStatusType::UNPAID->value,
            ]);

            DB::commit();

            return response()->json(['success' => 'Pendaftaran berhasil'], 200);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        } catch (ValidationException $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function success()
    {
        return view('registration_success');
    }

    public function gym_package(Request $request)
    {
        if (! $request->member_type) {
            return response()->json([]);
        }

        $gym_packages = GymPackage::where('member_type', $request->member_type)->get();

        return response()->json($gym_packages);
    }

    protected function sanitizeNoWhatsapp($no_whatsapp)
    {
        $no_whatsapp = preg_replace('/[^0-9]/', '', $no_whatsapp);

        if (Str::startsWith($no_whatsapp, '+62')) {
            $no_whatsapp = '0'.Str::substr($no_whatsapp, 3);
        }

        if (Str::startsWith($no_whatsapp, '62')) {
            $no_whatsapp = '0'.Str::substr($no_whatsapp, 2);
        }

        if (Str::startsWith($no_whatsapp, '08+62')) {
            $no_whatsapp = '0'.Str::substr($no_whatsapp, 5);
        }

        if (Str::startsWith($no_whatsapp, '0862')) {
            $no_whatsapp = '0'.Str::substr($no_whatsapp, 4);
        }

        if (Str::startsWith($no_whatsapp, '0862')) {
            $no_whatsapp = '0'.Str::substr($no_whatsapp, 4);
        }

        return $no_whatsapp;
    }

    protected function generateMembershipNumber()
    {
        $last_membership = Membership::orderBy('sequence_number', 'desc')->first();

        $sequence_number = $last_membership ? $last_membership->sequence_number + 1 : 1;

        // format RSF00001
        $membership_number = 'RSF'.str_pad($sequence_number, 5, '0', STR_PAD_LEFT);

        return [
            'membership_number' => $membership_number,
            'sequence_number' => $sequence_number
        ];
    }
}
