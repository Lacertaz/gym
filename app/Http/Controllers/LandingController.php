<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\LogMembershipStatusType;
use App\MembershipStatus;
use App\Models\Carousel;
use App\Models\GymPackage;
use App\Models\InfoGym;
use App\Models\LogMembership;
use App\Models\Membership;
use App\Models\User;
use App\RoleType;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

            $memberships = Membership::create([
                'user_id' => $user->id,
                'gender' => $request->validated()['gender'],
                'member_type' => $request->validated()['member_type'],
                'join_date' => now(),
                'expired_date' => now(),
                'no_whatsapp' => $request->validated()['no_whatsapp'],
                'status' => MembershipStatus::NEW->value,
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
}
