<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PegawaiController extends Controller
{
    /**
     * Menampilkan daftar pegawai.
     */
    public function index()
    {
        $pegawais = Pegawai::orderByDesc('id')->paginate(10);

        return view('pegawai.index', compact('pegawais'));
    }

    /**
     * Menampilkan form tambah pegawai.
     */
    public function create()
    {
        return view('pegawai.create');
    }

    /**
     * Menyimpan pegawai baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fingerprint_id' => [
                'required',
                'integer',
                'min:1',
                'unique:pegawais,fingerprint_id',
            ],
            'nama' => [
                'required',
                'string',
                'max:255',
            ],
        ], [
            'fingerprint_id.required' => 'Fingerprint ID wajib diisi.',
            'fingerprint_id.integer' => 'Fingerprint ID harus berupa angka.',
            'fingerprint_id.min' => 'Fingerprint ID minimal bernilai 1.',
            'fingerprint_id.unique' => 'Fingerprint ID tersebut sudah digunakan.',
            'nama.required' => 'Nama pegawai wajib diisi.',
            'nama.string' => 'Nama pegawai harus berupa teks.',
            'nama.max' => 'Nama pegawai maksimal 255 karakter.',
        ]);

        Pegawai::create($validated);

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail pegawai.
     */
    public function show(Pegawai $pegawai)
    {
        return view('pegawai.show', compact('pegawai'));
    }

    /**
     * Menampilkan form edit pegawai.
     */
    public function edit(Pegawai $pegawai)
    {
        return view('pegawai.edit', compact('pegawai'));
    }

    /**
     * Memperbarui data pegawai.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $validated = $request->validate([
            'fingerprint_id' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('pegawais', 'fingerprint_id')
                    ->ignore($pegawai->id),
            ],
            'nama' => [
                'required',
                'string',
                'max:255',
            ],
        ], [
            'fingerprint_id.required' => 'Fingerprint ID wajib diisi.',
            'fingerprint_id.integer' => 'Fingerprint ID harus berupa angka.',
            'fingerprint_id.min' => 'Fingerprint ID minimal bernilai 1.',
            'fingerprint_id.unique' => 'Fingerprint ID tersebut sudah digunakan oleh pegawai lain.',
            'nama.required' => 'Nama pegawai wajib diisi.',
            'nama.string' => 'Nama pegawai harus berupa teks.',
            'nama.max' => 'Nama pegawai maksimal 255 karakter.',
        ]);

        $pegawai->update($validated);

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil diperbarui.');
    }

    /**
     * Menghapus pegawai.
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil dihapus.');
    }
}