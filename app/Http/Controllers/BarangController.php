<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title  = 'Daftar Barang';
        $data   = Barang::all();

        return view('pages.barang.index', ['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title          = 'Form Tambah Barang';
        $kategori       = Kategori::all();
        $kode_barang    = new Barang();

        return view('pages.barang.tambah', [
            'title'         => $title,
            'kategori'      => $kategori,
            'kode_barang'   => $kode_barang->getKodeBarang()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'          => 'required',
            'kategori'      => 'required',
            'harga'         => 'required',
            'stock'         => 'required',
            'foto'          => 'required'
        ]);

        try {
            $barang = new Barang();
            $barang->kode_barang    = $request->kode_barang;
            $barang->nama           = $request->nama;
            $barang->kategori_id    = $request->kategori;
            $barang->harga_barang   = $request->harga;
            $barang->stock          = $request->stock;

            $imgFoto = $request->file('foto');
            if ($imgFoto) {
                $fileNama = $request->kode_barang . '-' . $imgFoto->getClientOriginalExtension();
                $path = $imgFoto->storeAs('images', $fileNama);
                $barang->foto_barang = $path;
            }
            $barang->save();

            return redirect('/barang')->with('success', 'Barang added successfully...');
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {

        $title  = 'Detail Barang';
        $barang = Barang::where('id', $barang->id)->first();

        return view('pages.barang.detail', [
            'title' => $title,
            'barang' => $barang
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        $title      = 'Form Edit Barang';
        $data       = Barang::where('id', $barang->id)->first();
        $kategori   = Kategori::all();

        return view('pages.barang.edit', [
            'title' => $title,
            'data' => $data,
            'kategori' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $this->validate($request, [
            'nama'          => 'required',
            'kategori'      => 'required',
            'harga'         => 'required',
            'stock'         => 'required',

        ]);

        try {
            $barang                 = Barang::where('id', $barang->id)->first();
            $barang->nama           = $request->nama;
            $barang->kategori_id    = $request->kategori;
            $barang->harga_barang   = $request->harga;
            $barang->stock          = $request->stock;
            $imgFoto = $request->file('foto');

            if ($imgFoto) {
                if ($barang->foto_barang != null) {
                    Storage::delete($barang->foto_barang);
                }
                $fileNama               = $barang->kode_barang . '-' . $imgFoto->getClientOriginalExtension();
                $path                   = $imgFoto->storeAs('iamges', $fileNama);
                $barang->foto_barang    = $path;
            } else {
                $path                   = $barang->foto_barang;
            }
            $barang->foto_barang        = $path;
            $barang->update();

            return redirect('barang')->with('success', 'Barang updated successfully');
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang = Barang::where('id', $barang->id)->first();
        $barang->delete();

        return back()->with('success', 'Barang deleted successfully');
    }
}
