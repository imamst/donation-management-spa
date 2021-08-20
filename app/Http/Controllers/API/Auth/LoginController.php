<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use Auth;
use App\Models\Monitoring;

class LoginController extends Controller
{
    public function login(LoginFormRequest $request)
    {
        $request->authenticate();

        $amil = Auth::user();

        Monitoring::updateLoginAndLogoutTime($amil);

        return response()->json(['status' => 200, 'user' => $amil]);
    }

    public function logout()
    {
        Monitoring::updateLogoutTime(Auth::user());

        Auth::logout();
    }
}
