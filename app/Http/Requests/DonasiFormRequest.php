<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\MinimumDonation;

class DonasiFormRequest extends FormRequest
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
            'tgl_donasi' => ['required', 'date'],
            'id_donatur' => ['required'],
            'id_jenis_donasi' => ['required'],
            'metode_donasi' => ['required', 'string'],
            'nama_bank' => Rule::requiredIf($this->input('metode_donasi') == 'Overbook'),
            'id_rekening' => Rule::requiredIf($this->input('metode_donasi') == 'Overbook'),
            'nominal' => ['required', 'string', new MinimumDonation($this->input('id_jenis_donasi'))],
            'no_kwitansi' => ['required', 'string', 'max:25'],
            'keterangan' => ['sometimes', 'nullable', 'string']
        ];
    }

    public function messages()
    {
        return [
            'tgl_donasi.required' => 'Tanggal donasi wajib diisi',
            'tgl_donasi.date' => 'Tanggal donasi wajib berisi tanggal',
            'id_donatur.required' => 'Donatur wajib dipilih',
            'id_jenis_donasi.required' => 'Jenis donasi wajib dipilih',
            'metode_donasi.required' => 'Metode donasi wajib diisi',
            'nama_bank.required' => 'Nama bank wajib diisi',
            'id_rekening.required' => 'Rekening wajib dipilih',
            'nominal.required' => 'Nominal donasi wajib diisi',
            'no_kwitansi.required' => 'Nomor kwitansi wajib diisi',
            'no_kwitansi.max' => 'Nomor kwitansi tidak boleh lebih dari :max karakter'
        ];
    }
}
