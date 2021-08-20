<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\AmilFormRequest;
use App\Models\Amil;

class AmilController extends Controller
{
    public function index()
    {
        return Amil::notSuperAdmin()->get()->toJson();
    }

    public function store(AmilFormRequest $request)
    {
        $data = $request->validated();

        $amil = Amil::create($data);
        $amil->native_password = $data['password'];

        event(new Registered($amil));

        return response()->json(['status' => 200, 'message' => 'Akun amil berhasil ditambahkan']);
    }

    public function destroy(Amil $amil)
    {
        $amil->delete();

        return response()->json(['status' => 200, 'message' => 'Akun amil berhasil dihapus']);
    }

    public function block(Amil $amil)
    {
        $amil->update(['status' => false]);

        return response()->json(['status' => 200, 'message' => 'Akun amil berhasil diblock']);
    }

    public function unblock(Amil $amil)
    {
        $amil->update(['status' => true]);

        return response()->json(['status' => 200, 'message' => 'Akun amil berhasil diunblock']);
    }
}
