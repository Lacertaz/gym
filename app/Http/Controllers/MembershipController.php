<?php

namespace App\Http\Controllers;

use Exception;
use App\RoleType;
use App\Models\User;
use App\MembershipStatus;
use App\Models\GymPackage;
use App\Models\Membership;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\LogMembership;
use App\LogMembershipStatusType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreMembershipRequest;
use App\Http\Requests\UpdateMembershipRequest;
use Illuminate\Validation\ValidationException;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Membership';
        $keyword = $request->keyword ?? null;

        $memberships = Membership::with('user')
            ->orderBy('status', 'desc')
            ->orderBy('expired_date', 'desc')
            ->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->keyword.'%')
                    ->orWhere('email', 'like', '%'.$request->keyword.'%')
                    ->orWhere('no_whatsapp', 'like', '%'.$request->keyword.'%')
                    ->orWhere('membership_number', 'like', '%'.$request->keyword.'%');
            })
            ->paginate(5)
            ->withQueryString();

        return view('pages.membership.main', compact('title', 'keyword', 'memberships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Member';

        $gym_packages = GymPackage::where('member_type', 'penghuni')->get();

        return view('pages.membership.form', compact('title', 'gym_packages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMembershipRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ])->assignRole(RoleType::USER->value);

            $new_no_wa = $this->sanitizeNoWhatsapp($request->no_whatsapp);

            $kartu_identitas_file = null;

            if ($request->member_type == 'penghuni') {
                $kartu_identitas_file = Storage::disk('public')->put('kartu_identitas', $request->file('kartu_identitas_file'));
            }

            $membership_number_data = $this->generateMembershipNumber();

            $membership_number = $membership_number_data['membership_number'];
            $sequence_number = $membership_number_data['sequence_number'];

            $memberships = Membership::create([
                'user_id' => $user->id,
                'membership_number' => $membership_number,
                'gender' => $request->gender,
                'member_type' => $request->member_type,
                'join_date' => now(),
                'expired_date' => now(),
                'no_whatsapp' => $new_no_wa,
                'kartu_identitas_file' => $kartu_identitas_file,
                'status' => MembershipStatus::NEW ->value,
                'sequence_number' => $sequence_number,
            ]);

            $gym_package = GymPackage::find($request->gym_package_id);

            LogMembership::create([
                'membership_id' => $memberships->id,
                'gym_package_id' => $request->gym_package_id,
                'gym_package_name' => $gym_package->name,
                'price' => $gym_package->price,
                'duration' => $gym_package->duration,
                'member_type' => $request->member_type,
                'start_date' => null,
                'end_date' => null,
                'status' => LogMembershipStatusType::UNPAID->value,
            ]);

            DB::commit();

            return response()->json(['message' => 'Pendaftaran berhasil'], 200);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 422);
        } catch (ValidationException $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Membership $membership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membership $membership)
    {
        $title = 'Edit Member';
        return view('pages.membership.form_edit', compact('title', 'membership'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMembershipRequest $request, Membership $membership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Membership $membership)
    {
        $membership->user->delete();
        $membership->delete();
        return redirect()->route('membership')->with('success', 'Member berhasil dihapus');
    }

    public function reset_password(Request $request, $id)
    {
        $user = User::find($id);
        if (! $user) {
            return response()->json(['error' => 'User tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'password' => ['required', 'min:8', 'confirmed'],
        ], [
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password harus memiliki minimal 8 karakter',
            'password.confirmed' => 'Password tidak sama',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['success' => 'Password berhasil direset'], 200);
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
