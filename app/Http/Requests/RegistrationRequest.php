<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
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
            'no_whatsapp' => ['required', 'min:10'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal %s karakter',
            'password.confirmed' => 'Password tidak sama',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi',
            'password_confirmation.min' => 'Konfirmasi password minimal %s karakter',
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama minimal %s karakter',
            'gym_package_id.required' => 'Paket wajib dipilih',
            'gym_package_id.exists' => 'Paket tidak ditemukan',
            'gender.required' => 'Jenis kelamin wajib dipilih',
            'member_type.required' => 'Jenis member wajib dipilih',
            'no_whatsapp.required' => 'No Whatsapp wajib diisi',
            'no_whatsapp.min' => 'No Whatsapp minimal %s karakter',
        ];
    }
}
