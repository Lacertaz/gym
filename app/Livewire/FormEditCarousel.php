<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Carousel;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class FormEditCarousel extends Component
{
    use WithFileUploads;

    public $carousel;

    #[Validate('required', message: 'Nama Paket harus diisi')]
    public string $name;

    #[Validate('nullable')]
    #[Validate('image', message: 'Gambar harus berupa gambar')]
    #[Validate('max:5120', message: 'Gambar harus kurang dari 5MB')]
    #[Validate('mimes:jpg,jpeg,png', message: 'Gambar harus berupa jpg, jpeg, atau png')]
    public $image;

    public function mount(Carousel $carousel)
    {
        $this->name = $carousel->name;
    }

    public function render()
    {
        return view('livewire.form-edit-carousel');
    }

    public function save()
    {
        $validated = $this->validate();

        // proses upload
        if ($this->image) {
            $image_name = $this->image->storePublicly('carousel', 'public');
        }

        $carouselnya = Carousel::find($this->carousel->id);
        $carouselnya->name = $validated['name'];
        if ($this->image) {
            $carouselnya->image = $image_name;
        }
        $carouselnya->save();

        session()->flash('success', 'Carousel berhasil diupdate');
        $this->reset(['name', 'image']);
        $this->redirect(route('manage-carousel'));
    }
}
