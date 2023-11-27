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
        $kategori   = Kategori::all();

        return view('pages.kategori.index', ['title' => $title, 'kategori' => $kategori]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title      = 'Form tambah kategori';
        $kode       = 'KTG-0001';

        return view('pages.kategori.tambah', ['title' => $title, 'kode' => $kode]);
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
        $kategori->nama = $request->nama;
        $kategori->kode = 'KTG-0001';

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
        $kategori       = Kategori::where('id', $kategori)->first();


        return view('pages.kategori.edit', ['title' => $title, 'kategori' => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $this->validate($request,  [
            'nama' => 'required',
        ]);

        $kategori       = Kategori::where('id', $kategori)->first();
        $kategori->nama = $request->nama;
        $kategori->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori       = Kategori::where('id', $kategori)->first();
        $kategori->delete();

        return back()->with('success', 'Kategori deleted successfully...');
    }
}
