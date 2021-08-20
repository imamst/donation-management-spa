<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use App\Http\Requests\RekeningFormRequest;

class RekeningController extends Controller
{

    public function index()
    {
        $title = 'Rekening';
        $rekenings = Rekening::select('id','nama','keterangan')->get();

        return view('pages.rekening.index', compact('rekenings', 'title'));
    }

    public function create()
    {
        return view('pages.rekening.create', ['title' => 'Tambah Rekening']);
    }

    public function store(RekeningFormRequest $request)
    {
        Rekening::create($request->validated());

        return redirect()->route('rekening.index')->with('status', 'Rekening berhasil ditambahkan');
    }

    public function edit(Rekening $rekening)
    {
        $title = 'Ubah Rekening';

        return view('pages.rekening.edit', compact('rekening', 'title'));
    }

    public function update(RekeningFormRequest $request, Rekening $rekening)
    {
        $rekening->update($request->validated());

        return redirect()->route('rekening.index')->with('status', 'Rekening berhasil diperbarui');
    }

    public function destroy(Rekening $rekening)
    {
        $rekening->delete();

        return redirect()->route('rekening.index')->with('status', 'Rekening berhasil dihapus');
    }
}
