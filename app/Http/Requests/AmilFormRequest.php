<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AmilFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', \App\Models\Amil::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'unique:amil','max:50'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'max:50'],
            'role' => ['required', Rule::in(['1', '2', '3'])],
            'status' => ['required', 'boolean']
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama tidak boleh lebih dari :max karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak sesuai',
            'email.unique' => 'Email telah digunakan',
            'email.max' => 'Email tidak boleh lebih dari :max karakter',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal :min karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password.max' => 'Password tidak boleh lebih dari :max karakter',
            'role.required' => 'Role wajib dipilih salah satu',
            'status.required' => 'Status wajib dipilih'
        ];
    }
}
