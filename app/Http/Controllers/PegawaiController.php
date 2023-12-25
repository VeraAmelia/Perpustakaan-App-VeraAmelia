<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawais = Pegawai::latest()->get();
        return view('pegawai.index', compact('pegawais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_pegawai' => 'required|string|max:155',
            'no_tlp' => 'required',
            'email' => 'required',
            'nik' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required'
        ]);

        $pegawais = Pegawai::create([
            'nama_pegawai' => $request->nama_pegawai,
            'no_tlp' => $request->no_tlp,
            'email' => $request->email,
            'nik' => $request->nik,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat
        ]);

        if ($pegawais) {
            return redirect()
                ->route('pegawai.index')
                ->with([
                    'success' => 'Data Berhasil ditambahkan'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Terjadi kesalahan, Tolong ulangi kembali'
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pegawais = Pegawai::findOrFail($id);
        return view('pegawai.edit', compact('pegawais'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_pegawai' => 'required|string|max:155',
            'no_tlp' => 'required',
            'email' => 'required',
            'nik' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required'
        ]);

        $pegawais = Pegawai::findOrFail($id);

        $pegawais->update([
            'nama_pegawai' => $request->nama_pegawai,
            'no_tlp' => $request->no_tlp,
            'email' => $request->email,
            'nik' => $request->nik,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat
        ]);

        if ($pegawais) {
            return redirect()
                ->route('pegawai.index')
                ->with([
                    'success' => 'Data Berhasil diperbaharui'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Terjadi kesalahan, Tolong ulangi kembali'
                ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawais = Pegawai::findOrFail($id);
        $pegawais->delete();

        if ($pegawais) {
            return redirect()
                ->route('pegawai.index')
                ->with([
                    'success' => 'Data Berhasil dihapuskan'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Terjadi kesalahan, Tolong ulangi kembali'
                ]);
        }
    }
}
