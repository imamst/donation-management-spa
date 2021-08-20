<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordFormRequest;
use Auth;
use App\Models\Amil;

class AccountPasswordController extends Controller
{
    public function edit()
    {
        return view('account.password.edit', [
                        'title' => 'Ubah Password'
                    ]);
    }

    public function update(UpdatePasswordFormRequest $request)
    {
        Auth::user()->update(['password' => $request->input('password')]);

        return redirect()->route('account.password.edit')->with('status', 'Password berhasil diubah');
    }
}
