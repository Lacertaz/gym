<?php

namespace App\Livewire;

use App\MemberType;
use Livewire\Component;
use App\Models\GymPackage;
use Livewire\Attributes\Validate;

class FormEditPaket extends Component
{
    public GymPackage $gym_package;

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

    public function mount($gym_package)
    {
        $this->gym_package = $gym_package;
        $this->name = $gym_package->name;
        $this->price = $gym_package->price;
        $this->duration = $gym_package->duration;
        $this->member_type = $gym_package->member_type->value;
        $this->member_type_lists = MemberType::cases();
    }

    public function render()
    {
        return view('livewire.form-edit-paket');
    }

    public function save()
    {
        $validated = $this->validate();

        $gym = GymPackage::find($this->gym_package->id);
        $gym->name = $validated['name'];
        $gym->price = $validated['price'];
        $gym->duration = $validated['duration'];
        $gym->member_type = $validated['member_type'];
        $gym->save();

        session()->flash('success', 'Gym Paket berhasil diperbarui');
        $this->reset(['name', 'price', 'duration', 'member_type']);
        $this->redirect(route('manage-paket'));
    }
}
