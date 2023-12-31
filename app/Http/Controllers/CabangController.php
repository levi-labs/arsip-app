<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Supplier;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title      = 'Daftar Cabang';
        $data       = Cabang::all();
        return view('pages.cabang.index', [
            'title' => $title,
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title          = 'Form Tambah Cabang';
        // $supplier       = Supplier::with('kode_supplier', 'nama')->get();
        $kode_cabang    = new Cabang();

        return view('pages.cabang.tambah', [
            'title' => $title,
            'kode_cabang' => $kode_cabang->getKodeCabang()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'      => 'required',
            'no_hp'     => 'required',
            'email'     => 'required',
            'alamat'    => 'required'
        ]);

        $cabang                 = new Cabang();
        $cabang->kode_cabang    = $request->kode_cabang;
        $cabang->nama           = $request->nama;
        $cabang->no_hp          = $request->no_hp;
        $cabang->email          = $request->email;
        $cabang->alamat         = $request->alamat;
        $cabang->save();


        return redirect('/cabang')->with('success', 'Cabang added successfully...');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cabang $cabang)
    {
        $title      = 'Detail Cabang';
        $cabang     = Cabang::where('id', $cabang)->first();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cabang $cabang)
    {
        $title      = 'Form Edit Cabang';
        $data     = Cabang::where('id', $cabang->id)->first();

        return view('pages.cabang.edit', [
            'title' => $title, 'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cabang $cabang)
    {
        $this->validate($request, [
            'nama'      => 'required',
            'no_hp'     => 'required',
            'email'     => 'required',
            'alamat'    => 'required'
        ]);
        $cabang         = Cabang::where('id', $cabang->id)->first();
        $cabang->nama   = $request->nama;
        $cabang->no_hp  = $request->no_hp;
        $cabang->email  = $request->email;
        $cabang->alamat = $request->alamat;
        $cabang->save();

        return redirect('cabang')->with('success', 'Cabang update successfully...');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cabang $cabang)
    {
        $cabang = Cabang::where('id', $cabang->id)->first();
        $cabang->delete();


        return back()->with('success', 'Cabang delete successfully...');
    }
}
