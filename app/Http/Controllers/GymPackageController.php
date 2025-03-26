<?php

namespace App\Http\Controllers;

use App\Models\GymPackage;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGymPackageRequest;
use App\Http\Requests\UpdateGymPackageRequest;

class GymPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Manage Admin';
        $keyword = $request->keyword ?? null;

        $gym_packages = GymPackage::where(function ($query) use ($keyword) {
            $query
                ->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('price', 'like', '%' . $keyword . '%');
        })
            ->paginate(5)
            ->withQueryString();

        return view('pages.manage_paket.main', compact('title', 'keyword', 'gym_packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Paket';
        return view('pages.manage_paket.form', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGymPackageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GymPackage $gymPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GymPackage $gym_package)
    {
        $title = 'Edit Paket';
        return view('pages.manage_paket.form_edit', compact('title', 'gym_package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGymPackageRequest $request, GymPackage $gymPackage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GymPackage $gym_package)
    {
        $gym_package->delete();
        return redirect()->route('manage-paket')->with('success', 'Gym Paket berhasil dihapus');
    }
}
