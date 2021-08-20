<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Amil;

class LoginFormRequest extends FormRequest
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
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak sesuai',
            'password.required' => 'Password wajib diisi'
        ];
    }

    public function authenticate()
    {
        $amil = Amil::whereEmail($this->input('email'))->first();

        if($amil && ($amil->status == "Non-Aktif")) {

            throw ValidationException::withMessages([
                'email' => 'Akun email Anda telah diblokir',
            ]);
        }

        if (! Auth::attempt($this->only('email', 'password'), $this->filled('remember'))) {

            throw ValidationException::withMessages([
                'email' => 'Email/Password salah',
            ]);
        }
    }
}
