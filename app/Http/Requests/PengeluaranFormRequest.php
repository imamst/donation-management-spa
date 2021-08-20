<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengeluaranFormRequest extends FormRequest
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
            'tgl_keluar' => ['required', 'date'],
            'nama_penerima' => ['required'],
            'id_jenis_pengeluaran' => ['required'],
            'nominal' => ['required', 'string'],
            'no_kwitansi' => ['required', 'string', 'max:25'],
            'keterangan' => ['sometimes', 'nullable', 'string']
        ];
    }

    public function messages()
    {
        return [
            'tgl_keluar.required' => 'Tanggal donasi wajib diisi',
            'tgl_keluar.date' => 'Tanggal donasi wajib berisi tanggal',
            'nama_penerima.required' => 'Nama penerima wajib diisi',
            'id_jenis_pengeluaran.required' => 'Jenis pengeluaran wajib dipilih',
            'nominal.required' => 'Nominal donasi wajib diisi',
            'no_kwitansi.required' => 'Nomor kwitansi wajib diisi',
            'no_kwitansi.max' => 'Nomor kwitansi tidak boleh lebih dari :max karakter'
        ];
    }
}
