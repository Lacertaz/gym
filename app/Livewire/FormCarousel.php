<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Carousel;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class FormCarousel extends Component
{
    use WithFileUploads;

    #[Validate('required', message: 'Nama Paket harus diisi')]
    public string $name;

    #[Validate('required', message: 'Gambar harus diisi')]
    #[Validate('image', message: 'Gambar harus berupa gambar')]
    #[Validate('max:5120', message: 'Gambar harus kurang dari 5MB')]
    #[Validate('mimes:jpg,jpeg,png', message: 'Gambar harus berupa jpg, jpeg, atau png')]
    public $image;

    public function render()
    {

        return view('livewire.form-carousel');
    }

    public function save()
    {
        $validated = $this->validate();

        // proses upload
        $image_name = $this->image->storePublicly('carousel', 'public');

        Carousel::create([
            'name' => $validated['name'],
            'image' => $image_name,
        ]);

        session()->flash('success', 'Carousel berhasil ditambahkan');
        $this->reset(['name', 'image']);
        $this->redirect(route('manage-carousel'));
    }
}
