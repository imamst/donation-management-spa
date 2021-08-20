<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonaturFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
            'address' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'email' => ['sometimes', 'nullable', 'email', 'max:50'],
            'phone' => ['sometimes', 'nullable', 'string', 'max:50'],
            'pekerjaan' => ['sometimes', 'nullable', 'string', 'max:50']
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama tidak boleh lebih dari :max karakter',
            'address.required' => 'Alamat wajib diisi',
            'gender.required' => 'Jenis kelamin wajib diisi',
            'email.email' => 'Format email tidak sesuai',
            'email.max' => 'Email tidak boleh lebih dari :max karakter',
            'phone.max' => 'No. HP tidak boleh lebih dari :max karakter',
            'pekerjaan.max' => 'Pekerjaan tidak boleh lebih dari :max karakter'
        ];
    }
}
