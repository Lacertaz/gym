<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ManageAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Manage Admin';
        $keyword = $request->keyword ?? null;

        $admins = User::where(function ($query) use ($keyword) {
            $query
                ->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%');
        })
            ->whereHas('roles', function ($query) {
                $query->where('name', '!=', 'user');
            })
            ->paginate(5)
            ->withQueryString();

        return view('pages.manage_admin.main', compact('title', 'keyword', 'admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Admin';
        return view('pages.manage_admin.form', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $title = 'Edit Admin';
        return view('pages.manage_admin.form_edit', compact('title', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('manage-admin')->with('success', 'Admin berhasil dihapus');
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
