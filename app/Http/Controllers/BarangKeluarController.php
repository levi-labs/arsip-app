<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session()->forget('tujuan');
        session()->forget('surat');
        session()->forget('kode');

        $title      = 'Daftar Barang Keluar';

        $data       = DB::table('barang_keluar')
            ->join('barang', 'barang_keluar.barang_id', '=', 'barang.id')
            ->select('barang_keluar.kode_surat', 'barang_keluar.tanggal_keluar')
            ->groupBy('kode_surat', 'tanggal_keluar')
            ->get();

        return view('pages.barangkeluar.index', [
            'title'  => $title,
            'data'   => $data
        ]);
    }

    public function listDetailItem($params)
    {
        $title      = 'Daftar Barang Keluar | No Surat ' . $params;
        $data       = BarangKeluar::where('kode_surat', $params)->get();
        $singleData = BarangKeluar::where('kode_surat', $params)->first();

        session()->put('tujuan', $singleData->jenis_tujuan);
        session()->put('surat', $singleData->kode_surat);

        return view('pages.barangkeluar.daftar_detail', [
            'title'     => $title,
            'data'      => $data,
            'params'    => $params
        ]);
    }
    public function createCabangOrCustomer()
    {
        session()->forget('tujuan');
        session()->forget('surat');

        $title              = 'Tujuan Barang';
        return view('pages.barangkeluar.pilih', ['title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $title              =  'Form Tambah Barang Keluar';
        $barang             = Barang::all();

        $kodeBarangMasuk    = new BarangKeluar();
        $tujuan             = strtolower($request->input('tujuan'));
        $tujuanDetail       = strtolower(session()->get('tujuan'));
        session()->put('tujuan', $tujuanDetail);

        $alternatif         = strtolower($request->input('params'));
        $kodeSuratFlash     = session()->get('surat');
        $barangKeluarList   = BarangKeluar::where('kode_surat', $kodeSuratFlash)->get();
        $key                = BarangKeluar::where('kode_surat', $alternatif)->first();
        if ($key != null) {
            $jenis_tujuan    = $key->jenis_tujuan;
            if ($tujuan == 'cabang' || $tujuanDetail == 'cabang' || strtolower($jenis_tujuan) == 'cabang') {
                session()->put('tujuan', $tujuan);

                $dataSumber         = Cabang::all();
            } else {
                session()->put('tujuan', $tujuan);
                $dataSumber         = 'Customer';
            }
            return view('pages.barangkeluar.tambah', [
                'title'             => $title,
                'barang'            => $barang,
                'tujuan'            => $tujuan,
                'kodeBarangKeluar'  => $kodeBarangMasuk->getKodeBarangKeluar(),
                'tujuan_barang'     => $dataSumber,
                'barangKeluarList'  => $barangKeluarList,
                'tujuanDetail'      => $tujuanDetail,
                'jenis_tujuan'      => $jenis_tujuan


            ]);
        }

        if ($tujuan == 'cabang' || $tujuanDetail == 'cabang') {
            session()->put('tujuan', $tujuan);

            $dataSumber         = Cabang::all();
        } else {
            session()->put('tujuan', $tujuan);
            $dataSumber         = 'Customer';
        }


        return view('pages.barangkeluar.tambah', [
            'title'             => $title,
            'barang'            => $barang,
            'tujuan'            => $tujuan,
            'kodeBarangMasuk'   => $kodeBarangMasuk->getKodeBarangKeluar(),
            'tujuan_barang'     => $dataSumber,
            'barangKeluarList'  => $barangKeluarList,
            'tujuanDetail'      => $tujuanDetail,

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
            'kode_surat'         => 'required',
            'nama_tujuan'        => 'required',
            'satuan'             => 'required',
            'tanggal_keluar'     => 'required',
            'foto_surat'         => 'required'
        ]);

        DB::beginTransaction();
        try {
            $barangKeluar                       = new BarangKeluar();
            $barangKeluar->kode_barang_keluar   = $request->kode_barang_keluar;
            $barangKeluar->kode_surat           = $request->kode_surat;
            $barangKeluar->barang_id            = $request->barang;
            $barangKeluar->nama_tujuan          = $request->nama_tujuan;
            $barangKeluar->jenis_tujuan         = $request->jenis_tujuan;
            $barangKeluar->qty_keluar           = $request->qty_keluar;
            $barangKeluar->harga_jual           = $request->harga_jual;
            $barangKeluar->satuan               = $request->satuan;
            $barangKeluar->tanggal_keluar       = $request->tanggal_keluar;

            $imgSuratJalan                  = $request->file('foto_surat');
            if ($imgSuratJalan) {
                $fileName                   = $request->kode_barang_keluar . '-' . $imgSuratJalan->getClientOriginalExtension();
                $path                       = $imgSuratJalan->storeAs('images', $fileName);
                $barangKeluar->foto_surat   = $path;
            }
            $barangKeluar->save();
            $barang                             = Barang::where('id', $request->barang)->first();
            $barang->stock                      = $barang->stock - $barangKeluar->qty_keluar;
            $barang->save();

            DB::commit();

            session()->put('surat',  $barangKeluar->kode_surat);

            return back()->with('success', 'Barang Keluar added successfully...');
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
        try {
            $title          = 'Detail Barang Keluar';
            $barangKeluar   = BarangKeluar::where('id', $barangKeluar->id)->first();

            return view('pages.barangkeluar.detail', [
                'title'         => $title,
                'data'              => $barangKeluar
            ]);
        } catch (\Exception $e) {

            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        //
        $title      = 'Form Edit Barang Keluar';
        $data       = BarangKeluar::where('id', $barangKeluar->id)->first();
        $barang     = Barang::all();
        session()->put('kode', $data->kode_surat);
        $tujuanDetail       = strtolower(session()->get('tujuan')) ?? $data->jenis_tujuan;
        if (strtolower($data->jenis_tujuan) == 'cabang') {
            $tujuan_barang  = Cabang::all();
        } else {
            $tujuan_barang  = $barangKeluar->nama_tujuan;
        }

        return view('pages.barangkeluar.edit', [
            'title'         => $title,
            'data'          => $data,
            'barang'        => $barang,
            'tujuan_barang' => $tujuan_barang,
            'tujuanDetail'  => $tujuanDetail
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangKeluar $barangKeluar)
    {

        $this->validate($request, [

            'barang'             => 'required',
            'qty_keluar'         => 'required',
            'harga_jual'         => 'required',
            'kode_surat'         => 'required',
            'nama_tujuan'        => 'required',
            'satuan'             => 'required',
            'tanggal_keluar'     => 'required',

        ]);



        try {
            DB::beginTransaction();
            $barangKeluar                       = BarangKeluar::where('id', $barangKeluar->id)->first();
            $barangKeluar->kode_barang_keluar   = $request->kode_barang_keluar;
            $barangKeluar->kode_surat           = $request->kode_surat;
            $barangKeluar->barang_id            = $request->barang;
            $barangKeluar->nama_tujuan          = $request->nama_tujuan;
            $barangKeluar->jenis_tujuan         = $request->jenis_tujuan;
            $barangKeluar->harga_jual           = $request->harga_jual;
            $barangKeluar->satuan               = $request->satuan;
            $barangKeluar->tanggal_keluar       = $request->tanggal_keluar;

            $imgSuratJalan                      = $request->file('foto_surat');
            if ($imgSuratJalan) {

                if ($barangKeluar->foto_surat != null) {
                    Storage::delete($barangKeluar->foto_surat);
                }
                $fileName                       = $request->kode_barang_keluar . '-' . $imgSuratJalan->getClientOriginalExtension();
                $path                           = $imgSuratJalan->storeAs('images', $fileName);
            } else {
                $path                           = $barangKeluar->foto_surat;
            }
            $barangKeluar->foto_surat           = $path;

            $barang                             = Barang::where('id', $barangKeluar->barang_id)->first();
            $tempQty                            = $barang->stock + $barangKeluar->qty_keluar;

            $barang->stock                      = $tempQty - $request->qty_keluar;
            $barangKeluar->qty_keluar           = $request->qty_keluar;
            $barang->save();
            $barangKeluar->save();
            DB::commit();

            return redirect('/daftar-detail-barang-keluar/' .  $request->kode_surat)->with('success', 'Barang Keluar updated successfully...');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangKeluar $barangKeluar)
    {

        DB::beginTransaction();
        try {
            $bKeluar        = BarangKeluar::where('id', $barangKeluar->id)->first();

            $barang         = Barang::where('id', $bKeluar->barang_id)->first();
            $result         = $barang->stock + $bKeluar->qty_keluar;
            $barang->stock  = $result;
            $params         = $bKeluar->kode_surat;
            $barang->save();
            $bKeluar->delete();

            DB::commit();
            $count      = BarangKeluar::where('kode_surat', $params)->count();

            if ($count > 0) {

                return redirect('daftar-detail-barang-keluar/' . $params)->with('success', 'Barang Keluar deleted successfully...');
            } elseif ($count == 0) {

                return redirect('/barang-keluar')->with('success', 'Semua Barang Keluar deleted successfully...');
            }
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('failed', $e->getMessage());
        }
    }
}
