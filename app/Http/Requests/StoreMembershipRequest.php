<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\MobilePrefixRule;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreMembershipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email:rfc,dns', 'unique:'.User::class],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'min:8'],
            'name' => ['required', 'min:3'],
            'gym_package_id' => ['required', 'exists:gym_packages,id'],
            'gender' => ['required'],
            'member_type' => ['required'],
            'no_whatsapp' => ['required', 'min:10', new MobilePrefixRule],
            'kartu_identitas_file' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sama',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi',
            'password_confirmation.min' => 'Konfirmasi password minimal 8 karakter',
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama minimal 3 karakter',
            'gym_package_id.required' => 'Paket wajib dipilih',
            'gym_package_id.exists' => 'Paket tidak ditemukan',
            'gender.required' => 'Jenis kelamin wajib dipilih',
            'member_type.required' => 'Jenis member wajib dipilih',
            'no_whatsapp.required' => 'No Whatsapp wajib diisi',
            'no_whatsapp.min' => 'No Whatsapp minimal 10 karakter',
            'kartu_identitas_file.required' => 'Kartu Identitas wajib diisi',
            'kartu_identitas_file.image' => 'Kartu Identitas hanya dapat berupa gambar',
            'kartu_identitas_file.mimes' => 'Kartu Identitas hanya dapat berupa gambar',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->sometimes('kartu_identitas_file', ['required', 'image', 'mimes:jpeg,png,jpg,gif'], function ($input) {
            return $input->member_type === 'penghuni';
        });
    }
}
