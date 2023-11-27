<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title  = 'Daftar Supplier';
        $data   = Supplier::all();

        return view('pages.supplier.index', ['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title          = 'Form Tambah Supplier';
        //Combine Unik Code For Supplier and Auto Generate (Increment)

        $kode_supplier  = new Supplier();

        return view('pages.supplier.tambah', ['title' => $title, 'kode_supplier' => $kode_supplier->getKodeSupplier()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'      => 'required',
            'email'     => 'required|email',
            'no_hp'     => 'required',
            'alamat'    => 'required',
        ]);

        $supplier = new Supplier();
        $supplier->nama         = $request->nama;
        $supplier->kode_supplier = $request->kode_supplier;
        $supplier->email        = $request->email;
        $supplier->no_hp        = $request->no_hp;
        $supplier->alamat       = $request->alamat;
        $supplier->save();

        return redirect('/supplier')->with('success', 'Supplier added successfully...');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        $title      = 'Detail Supplier';
        $data       = Supplier::where('id', $supplier)->firstOrFail();

        return view('pages.supplier.detail', ['title' => $title,]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        $title      =  'Form Edit Supplier';
        $data       = Supplier::where('id', $supplier->id)->first();


        return view('pages.supplier.edit', ['title' => $title, 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $this->validate($request, [
            'nama'      => 'required',
            'email'     => 'required|email',
            'no_hp'     => 'required',
            'alamat'    => 'required',
        ]);

        $supplier               = Supplier::where('id', $supplier->id)->first();
        $supplier->nama         = $request->nama;
        $supplier->email        = $request->email;
        $supplier->no_hp        = $request->no_hp;
        $supplier->alamat       = $request->alamat;
        $supplier->save();

        return redirect('/supplier')->with('success', 'Supplier update successfully...');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier   =  Supplier::where('id', $supplier->id)->firstOrFail();
        $supplier->delete();

        return redirect('/supplier')->with('success', 'Supplier delete successfully...');
    }
}
