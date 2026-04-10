<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->user();
        $isGoogleUser = !is_null($user->google_id);

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'gender' => ['nullable', 'in:male,female'],
            'address' => ['nullable', 'string', 'max:1000'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'hapus_avatar' => ['nullable', 'in:0,1'],
        ];

        // Hanya validasi email jika bukan user Google
        if (!$isGoogleUser) {
            $rules['email'] = [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id_users, 'id_users'),
            ];
        }

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name' => 'Nama Lengkap',
            'email' => 'Alamat Email',
            'phone' => 'Nomor HP',
            'gender' => 'Jenis Kelamin',
            'address' => 'Alamat',
            'avatar' => 'Foto Profil',
            'hapus_avatar' => 'Hapus Foto',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh akun lain.',
            'phone.regex' => 'Format nomor telepon tidak valid. Gunakan angka, spasi, atau tanda - + ( )',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',
            'gender.in' => 'Jenis kelamin tidak valid.',
            'address.max' => 'Alamat maksimal 1000 karakter.',
            'avatar.image' => 'File harus berupa gambar.',
            'avatar.mimes' => 'Format gambar harus JPEG, JPG, atau PNG.',
            'avatar.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Jika user dari Google, hapus email dari request
        if ($this->user()->google_id && $this->has('email')) {
            $this->request->remove('email');
        }
    }
}
