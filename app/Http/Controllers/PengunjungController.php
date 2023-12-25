<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengunjungs = Pengunjung::latest()->get();
        return view('pengunjung.index', compact('pengunjungs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengunjung.create');
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
            'nama_pengunjung' => 'required|string|max:155',
            'no_tlp' => 'required',
            'email' => 'required',
            'nik' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required'
        ]);

        $pengunjungs = Pengunjung::create([
            'nama_pengunjung' => $request->nama_pengunjung,
            'no_tlp' => $request->no_tlp,
            'email' => $request->email,
            'nik' => $request->nik,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat
        ]);

        if ($pengunjungs) {
            return redirect()
                ->route('pengunjung.index')
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
     * @param  \App\Models\Pengunjung  $pengunjung
     * @return \Illuminate\Http\Response
     */
    public function show(Pengunjung $pengunjung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengunjung  $pengunjung
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengunjungs = Pengunjung::findOrFail($id);
        return view('pengunjung.edit', compact('pengunjungs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengunjung  $pengunjung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_pengunjung' => 'required|string|max:155',
            'no_tlp' => 'required',
            'email' => 'required',
            'nik' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required'
        ]);

        $pengunjungs = Pengunjung::findOrFail($id);

        $pengunjungs->update([
            'nama_pengunjung' => $request->nama_pengunjung,
            'no_tlp' => $request->no_tlp,
            'email' => $request->email,
            'nik' => $request->nik,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat
        ]);

        if ($pengunjungs) {
            return redirect()
                ->route('pengunjung.index')
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
     * @param  \App\Models\Pengunjung  $pengunjung
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengunjungs = Pengunjung::findOrFail($id);
        $pengunjungs->delete();

        if ($pengunjungs) {
            return redirect()
                ->route('pengunjung.index')
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
