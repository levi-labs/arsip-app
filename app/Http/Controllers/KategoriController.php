<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title      = 'Daftar Kategori';
        $data   = Kategori::all();

        return view('pages.kategori.index', [
            'title' => $title,
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title              = 'Form tambah kategori';
        $kode_kategori      = new Kategori();

        return view('pages.kategori.tambah', [
            'title' => $title,
            'kode_kategori' => $kode_kategori->getKodeKategori()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'  => 'required',
        ]);

        $kategori       = new Kategori();
        $kategori->nama          = $request->nama;
        $kategori->kode_kategori = $request->kode_kategori;
        $kategori->save();

        return redirect('/kategori')->with('success', 'Kategori added successfully...');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        $title          = 'Form Edit Kategori';
        $data           = Kategori::where('id', $kategori->id)->first();


        return view('pages.kategori.edit', ['title' => $title, 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $this->validate($request,  [
            'nama' => 'required',
        ]);

        $kategori       = Kategori::where('id', $kategori->id)->first();
        $kategori->nama = $request->nama;
        $kategori->save();

        return redirect('/kategori')->with('success', 'Kategori updated successfully...');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori       = Kategori::where('id', $kategori->id)->first();
        $kategori->delete();

        return back()->with('success', 'Kategori deleted successfully...');
    }
}
