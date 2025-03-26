<?php

namespace App\Livewire;

use App\MemberType;
use App\Models\GymPackage;
use Livewire\Component;
use Livewire\Attributes\Validate;

class FormPaket extends Component
{
    #[Validate('required', message: 'Nama Paket harus diisi')]
    public string $name;

    #[Validate('required', message: 'Harga Paket harus diisi')]
    #[Validate('numeric', message: 'Harga Paket harus berupa angka')]
    public string $price;

    #[Validate('required', message: 'Durasi harus diisi')]
    #[Validate('in:1,3,6,9,12,24', message: 'Durasi tidak valid')]
    public string $duration;

    #[Validate('required', message: 'Tipe Paket harus diisi')]
    public string $member_type;

    public array $duration_lists = [1, 3, 6, 9, 12, 24];

    public array $member_type_lists;

    public function mount()
    {
        $this->member_type_lists = MemberType::cases();
    }

    public function render()
    {
        return view('livewire.form-paket');
    }

    public function save()
    {
        $validated = $this->validate();

        $user = GymPackage::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'duration' => $validated['duration'],
            'member_type' => $validated['member_type'],
        ]);

        session()->flash('success', 'Gym Paket berhasil ditambahkan');
        $this->reset(['name', 'price', 'duration', 'member_type']);
        $this->redirect(route('manage-paket'));
    }
}
