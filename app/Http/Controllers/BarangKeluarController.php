<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title      = 'Daftar Barang Keluar';
        $data       = BarangKeluar::all();

        return view('pages.barangkeluar.index', [
            'title'  => $title,
            'data'   => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title              = 'Form Tambah Barang Keluar';
        $kode_barang_keluar = new BarangKeluar();
        $data               = Barang::all();

        return view('pages.barangkeluar.tambah', [
            'title'                 => $title,
            'kode_barang_keluar'    => $kode_barang_keluar->getKodeBarangKeluar(),
            'data'                  => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_barang_keluar' => 'required',
            'barang'             => 'required',
            'qty_keluar'         => 'required',
            'harga_jual'         => 'required',
            'satuan'             => 'required'
        ]);
        DB::beginTransaction();
        try {
            $barangKeluar                       = new BarangKeluar();
            $barangKeluar->kode_barang_keluar   = $request->kode_barang_keluar;
            $barangKeluar->barang_id            = $request->barang;
            $barangKeluar->nama_tujuan          = $request->nama_tujuan;
            $barangKeluar->jenis_tujuan         = $request->jenis_tujuan;
            $barangKeluar->qty_keluar           = $request->qty_keluar;
            $barangKeluar->harga_jual           = $request->harga_jual;
            $barangKeluar->satuan               = $request->satuan;
            $barangKeluar->save();

            $barang                             = Barang::where('id', $request->barang)->first();
            $barang->stock                      = $barang->stock - $barangKeluar->qty_keluar;
            $barang->save();

            DB::commit();

            return redirect('tambah-barang-keluar/' . $request->jenis_tujuan)->with('success', 'Barang Keluar added successfully...');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangKeluar $barangKeluar)
    {
        //
    }
}
