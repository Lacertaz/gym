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

class FormEditMember extends Component
{
    public ?Membership $membership;

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

    #[Validate('required', message: 'Status harus dipilih')]
    public string $status;

    public function mount($membership)
    {
        $this->membership = $membership;
        $this->name = $membership->user->name ?? '';
        $this->gender = $membership->gender->value ?? GenderType::MALE->value;
        $this->member_type = $membership->member_type->value ?? MemberType::PENGHUNI->value;
        $this->join_date = $membership->join_date->format('Y-m-d') ?? now()->format('Y-m-d');
        $this->no_whatsapp = $membership->no_whatsapp ?? '';
        $this->email = $membership->user->email ?? '';
        $this->status = $membership->getRawOriginal('status');
    }

    public function save()
    {
        $validated = $this->validate();

        $this->membership->update([
            'gender' => $validated['gender'],
            'member_type' => $validated['member_type'],
            'join_date' => $validated['join_date'],
            'no_whatsapp' => $validated['no_whatsapp'],
            'status' => $validated['status'],
        ]);

        $user_id = $this->membership->user_id;
        User::find($user_id)->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        session()->flash('success', 'Member berhasil diubah');
        $this->redirect(route('membership'));
    }


    public function render()
    {
        return view('livewire.form-edit-member');
    }
}
