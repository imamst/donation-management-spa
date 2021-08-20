<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use App\Http\Requests\AmilFormRequest;
use App\Models\Amil;

class AmilController extends Controller
{
    
    public function index()
    {
        $title = 'Kelola Amil';
        $amils = Amil::where('role','<>',4)->select('id','nama','role','status','email')->get();

        return view('pages.amil.index', compact('amils', 'title'));
    }

    public function create()
    {
        $title = 'Buat Akun Amil';

        return view('pages.amil.create', compact('title'));
    }

    public function store(AmilFormRequest $request)
    {
        $data = $request->validated();

        $amil = Amil::create($data);
        $amil->native_password = $data['password'];

        event(new Registered($amil));

        return redirect()->route('amil.index')->with('status', 'Akun amil berhasil ditambahkan');
    }

    public function destroy(Amil $amil)
    {
        $amil->delete();

        return redirect()->route('amil.index')->with('status', 'Akun amil berhasil dihapus');
    }

    public function block(Amil $amil)
    {
        $amil->update(['status' => false]);

        return redirect()->route('amil.index')->with('status', 'Akun amil berhasil diblock');
    }

    public function unblock(Amil $amil)
    {
        $amil->update(['status' => true]);

        return redirect()->route('amil.index')->with('status', 'Akun amil berhasil diunblock');
    }
}
