<?php

namespace App\Livewire;

use App\RoleType;
use App\GenderType;
use App\MemberType;
use App\Models\User;
use Livewire\Component;
use App\Models\Membership;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;

class MembershipForm extends Component
{
    #[Validate('required', message: 'Nama member harus diisi')]
    public string $name;

    #[Validate('required', message: 'Jenis kelamin harus dipilih')]
    public string $gender;

    #[Validate('required', message: 'Tipe member harus dipilih')]
    public string $member_type;

    #[Validate('required', message: 'Tanggal join harus diisi')]
    public string $join_date;

    #[Validate('required', message: 'Nomor WhatsApp harus diisi')]
    public string $no_whatsapp;

    #[Validate('required', message: 'Email harus diisi')]
    #[Validate('email:rfc,dns', message: 'Email harus valid')]
    public string $email;

    #[Validate('required_if:membership,null', message: 'Password harus diisi')]
    #[Validate('min:8', message: 'Password harus memiliki minimal 8 karakter')]
    #[Validate('confirmed', message: 'Password tidak sama')]
    public string $password;

    #[Validate('required_if:membership,null', message: 'Konfirmasi password harus diisi')]
    #[Validate('min:8', message: 'Konfirmasi password harus memiliki minimal 8 karakter')]
    public string $password_confirmation;

    #[Validate('required', message: 'Status harus dipilih')]
    public string $status;

    public function mount()
    {
        $this->name = '';
        $this->gender = GenderType::MALE->value;
        $this->member_type = MemberType::PENGHUNI->value;
        $this->join_date = now()->format('Y-m-d');
        $this->no_whatsapp = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->status = 'active';
    }

    public function save()
    {
        $validated = $this->validate();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ])
            ->assignRole(RoleType::USER->value);

        Membership::create([
            'user_id' => $user->id,
            'gender' => $validated['gender'],
            'member_type' => $validated['member_type'],
            'join_date' => $validated['join_date'],
            'expired_date' => $validated['join_date'],
            'no_whatsapp' => $validated['no_whatsapp'],
            'status' => $validated['status'],
        ]);

        session()->flash('success', 'Member berhasil ditambahkan');
        $this->redirect(route('membership'));
    }


    public function render()
    {
        return view('livewire.membership-form');
    }
}
