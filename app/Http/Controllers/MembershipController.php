<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreMembershipRequest;
use App\Http\Requests\UpdateMembershipRequest;
use Illuminate\Support\Facades\Validator;

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
                $query->where('name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('email', 'like', '%' . $request->keyword . '%')
                    ->orWhere('no_whatsapp', 'like', '%' . $request->keyword . '%');
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
        return view('pages.membership.form', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMembershipRequest $request)
    {
        //
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
        if (!$user) {
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
}
