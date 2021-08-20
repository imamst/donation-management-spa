<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordFormRequest;
use Auth;
use App\Models\Amil;

class AccountPasswordController extends Controller
{
    public function update(UpdatePasswordFormRequest $request)
    {
        Auth::user()->update($request->validated());

        return response()->json(['status' => 200, 'message' => 'Password berhasil diubah']);
    }
}
