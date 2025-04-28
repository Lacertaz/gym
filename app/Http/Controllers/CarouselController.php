<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCarouselRequest;
use App\Http\Requests\UpdateCarouselRequest;
use Exception;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Manage Carousel';
        $keyword = $request->keyword ?? null;

        $carousels = Carousel::where(function ($query) use ($keyword) {
            $query
                ->where('name', 'like', '%' . $keyword . '%');
        })
            ->paginate(5)
            ->withQueryString();

        return view('pages.manage_carousel.main', compact('title', 'keyword', 'carousels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Carousel';
        return view('pages.manage_carousel.form', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarouselRequest $request)
    {
        try {
            $file_name = Storage::disk('public')->put('carousel', $request->file('image'));

            Carousel::create([
                'name' => $request->name,
                'image' => $file_name,
            ]);

            return redirect()->route('manage-carousel')->with('success', 'Carousel berhasil ditambahkan');
        }catch(Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Carousel $carousel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carousel $carousel)
    {
        $title = 'Edit Carousel';
        return view('pages.manage_carousel.form_edit', compact('title', 'carousel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarouselRequest $request, Carousel $carousel)
    {
        try {
            $carousel->name = $request->name;

            if ($request->file('image')) {
                $file_name = Storage::disk('public')->put('carousel', $request->file('image'));
                $carousel->image = $file_name;
            }
            $carousel->save();

            return redirect()->route('manage-carousel')->with('success', 'Carousel berhasil diubah');
        }catch(Exception $e)  {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carousel $carousel)
    {
        $carousel->delete();
        return redirect()->route('manage-carousel')->with('success', 'Carousel berhasil dihapus');
    }
}
