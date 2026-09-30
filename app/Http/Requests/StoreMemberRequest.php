<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:100',
            'nim' => 'required|string|max:10',
            'email' => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:100',
            'alamat' => 'required|string|max:200',
            'status' => 'required|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'nama wajib diisi',
            'nama.max' =>'nama maksimal 100 karakter',
            'nim.required' => 'nim wajib diisi',
            'nim.max' => 'nim tidak boleh lebih dari 10 karakter',
            'email.required' => 'email wajib diisi',
            'alamat.required' => 'alamat wajib diisi',
            'status.required' => 'status wajib diisi',
        ];
    }
}
