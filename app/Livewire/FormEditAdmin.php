<?php

namespace App\Livewire;

use App\RoleType;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;

class FormEditAdmin extends Component
{
    public User $user;

    #[Validate('required', message: 'Email harus diisi')]
    #[Validate('email:', message: 'Format email tidak valid')]
    public string $email;

    #[Validate('required', message: 'Nama harus diisi')]
    public string $name;

    #[Validate('required', message: 'Role harus diisi')]
    public string $role;

    public array $roles;

    public function mount($user)
    {
        $this->email = $user->email;
        $this->name = $user->name;

        $this->role = $user->roles->first()->name;

        $pre_roles = collect(RoleType::cases());

        $this->roles = $pre_roles->filter(function ($value, $key) {
            return $value != RoleType::USER;
        })->toArray();
    }

    public function render()
    {
        return view('livewire.form-edit-admin');
    }

    public function save()
    {
        $validated = $this->validate();

        $user = User::find($this->user->id);
        $user->name = $validated['name'];
        $user->save();

        $user->syncRoles($validated['role']);

        session()->flash('success', 'Admin berhasil diperbarui');
        $this->reset(['name', 'email', 'role']);
        $this->redirect(route('manage-admin'));
    }
}
