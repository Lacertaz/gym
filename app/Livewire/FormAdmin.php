<?php

namespace App\Livewire;

use App\RoleType;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;

class FormAdmin extends Component
{
    #[Validate('required', message: 'Email harus diisi')]
    #[Validate('email:', message: 'Format email tidak valid')]
    public string $email;

    #[Validate('required', message: 'Password harus diisi')]
    #[Validate('min:8', message: 'Password harus minimal 8 karakter')]
    #[Validate('confirmed', message: 'Password tidak sama')]
    public string $password;

    #[Validate('required', message: 'Password confirmation harus diisi')]
    public string $password_confirmation;

    #[Validate('required', message: 'Nama harus diisi')]
    public string $name;

    #[Validate('required', message: 'Role harus diisi')]
    public string $role;

    public array $roles;

    public function mount()
    {
        $this->role = RoleType::ADMIN->value;

        $pre_roles = collect(RoleType::cases());

        $this->roles = $pre_roles->filter(function ($value, $key) {
            return $value != RoleType::USER;
        })->toArray();
    }

    public function render()
    {
        return view('livewire.form-admin');
    }

    public function save()
    {
        $validated = $this->validate();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ])
            ->assignRole($validated['role']);

        session()->flash('success', 'Admin berhasil ditambahkan');
        $this->reset(['name', 'email', 'password', 'password_confirmation', 'role']);
        $this->redirect(route('manage-admin'));
    }
}
