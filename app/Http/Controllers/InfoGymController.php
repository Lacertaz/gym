<?php

namespace App\Http\Controllers;

use Tiptap\Editor;
use App\Models\InfoGym;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInfoGymRequest;
use App\Http\Requests\UpdateInfoGymRequest;

class InfoGymController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Info Gym';

        $description = InfoGym::find(1)->description;

        return view('pages.info_gym.form', compact('title', 'description'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInfoGymRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(InfoGym $infoGym)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InfoGym $infoGym)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $info_gym = InfoGym::find(1);
        $info_gym->description = $request->description;
        $info_gym->save();

        return redirect()->route('info-gym')->with('success', 'Info Gym berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InfoGym $infoGym)
    {
        //
    }
}
