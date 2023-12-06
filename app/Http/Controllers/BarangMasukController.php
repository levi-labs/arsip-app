<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Cabang;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session()->forget('sumber');
        session()->forget('surat');


        $title      = 'Daftar Barang Masuk';
        // $data       = BarangMasuk::all();
        $data       = DB::table('barang_masuk')
            ->join('barang', 'barang_masuk.barang_id', '=', 'barang.id')
            ->select('barang_masuk.kode_surat', 'barang_masuk.tanggal_masuk')
            ->groupBy('kode_surat', 'tanggal_masuk')
            ->get();

        return view('pages.barangmasuk.index', [
            'title' => $title,
            'data'  => $data
        ]);
    }
    public function listDetailItem($params)
    {
        $title      = 'Daftar Barang Masuk | No Surat ' . $params;
        $data       = BarangMasuk::where('kode_surat', $params)->get();
        $singleData = BarangMasuk::where('kode_surat', $params)->first();
        session()->put('sumber', $singleData->kategori_sumber);
        session()->put('surat', $singleData->kode_surat);

        return view('pages.barangmasuk.daftar_detail', [
            'title'     => $title,
            'data'      => $data,
            'params'    => $params
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $title              =  'Form Tambah Barang Masuk';
        $barang             = Barang::all();


        $kodeBarangMasuk    = new BarangMasuk();
        $sumber             = strtolower($request->input('sumber'));

        $sumberDetail       = strtolower(session()->get('sumber'));
        session()->put('sumber', $sumberDetail);

        $alternatif         = strtolower($request->input('params'));
        $kodeSuratFlash     = session()->get('surat');
        $barangMasukList    = BarangMasuk::where('kode_surat', $kodeSuratFlash)->get();
        $key                = BarangMasuk::where('kode_surat', $alternatif)->first();
        if ($key != null) {
            $kategori_sumber    = $key->kategori_sumber;
            if ($sumber == 'cabang' || $sumberDetail == 'cabang' || $kategori_sumber == 'cabang') {
                session()->put('sumber', $sumber);

                $dataSumber         = Cabang::all();
            } else {
                session()->put('sumber', $sumber);
                $dataSumber         = Supplier::all();
            }
            return view('pages.barangmasuk.tambah', [
                'title'             => $title,
                'barang'            => $barang,
                'sumber'            => $sumber,
                'kodeBarangMasuk'   => $kodeBarangMasuk->getKodeBarangMasuk(),
                'sumber_barang'     => $dataSumber,
                'barangMasukList'   => $barangMasukList,
                'sumberDetail'      => $sumberDetail,
                'kategori_sumber'   => $kategori_sumber


            ]);
        }

        if ($sumber == 'cabang' || $sumberDetail == 'cabang') {
            session()->put('sumber', $sumber);

            $dataSumber         = Cabang::all();
        } else {
            session()->put('sumber', $sumber);
            $dataSumber         = Supplier::all();
        }


        return view('pages.barangmasuk.tambah', [
            'title'             => $title,
            'barang'            => $barang,
            'sumber'            => $sumber,
            'kodeBarangMasuk'   => $kodeBarangMasuk->getKodeBarangMasuk(),
            'sumber_barang'     => $dataSumber,
            'barangMasukList'   => $barangMasukList,
            'sumberDetail'      => $sumberDetail,

        ]);
    }

    /**
     * Make choice item delivered CBG / SPL
     */

    public function createCabangOrSupplier()
    {
        session()->forget('sumber');
        session()->forget('surat');

        $title              = 'Sumber Barang';
        return view('pages.barangmasuk.pilih', ['title' => $title]);
    }

    public function storeCabangOrSupplier($request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $this->validate($request, [

            'kode_surat'        => 'required',
            'sumber_barang'     => 'required',
            'barang'            => 'required',
            'qty_masuk'         => 'required',
            'qty_rusak'         => 'required',
            'satuan'            => 'required',
            'harga_beli'        => 'required',
            'tanggal_masuk'     => 'required',
            'foto_surat'        => 'required'
        ]);


        DB::beginTransaction();

        try {
            $barangMasuk                    = new BarangMasuk();
            $barangMasuk->kode_barang_masuk = $request->kode_barang_masuk;
            $barangMasuk->kategori_sumber   = $request->kategori_sumber;
            $barangMasuk->kode_surat        = $request->kode_surat;
            $barangMasuk->barang_id         = $request->barang;
            $barangMasuk->sumber_barang     = $request->sumber_barang;
            $barangMasuk->qty_masuk         = $request->qty_masuk;
            $barangMasuk->qty_rusak         = $request->qty_rusak;
            $barangMasuk->qty_diterima      = $request->qty_masuk - $request->qty_rusak;
            $barangMasuk->satuan            = $request->satuan;
            $barangMasuk->harga_beli        = $request->harga_beli;
            $barangMasuk->tanggal_masuk     = $request->tanggal_masuk;

            $imgSuratJalan                  = $request->file('foto_surat');
            if ($imgSuratJalan) {
                $fileName                   = $request->kode_barang_masuk . '-' . $imgSuratJalan->getClientOriginalExtension();
                $path                       = $imgSuratJalan->storeAs('images', $fileName);

                $barangMasuk->foto_surat    = $path;
            }


            $barang                         =  Barang::where('id', $request->barang)->first();
            $barang->stock                  =  $barang->stock + $barangMasuk->qty_diterima;
            $barang->update();
            $barangMasuk->save();


            DB::commit();

            session()->put('surat', $request->kode_surat);


            // return redirect('barang-masuk')->with('success', 'Barang Masuk added successfully...');

            return back()->with('adding', 'Barang Masuk added successfully');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */


    public function show(BarangMasuk $barangMasuk)
    {
        $title          = 'Detail Barang Masuk';
        $data           = BarangMasuk::where('id', $barangMasuk->id)->first();
        $barang         = Barang::where('id', $data->barang_id)->first();

        return view('pages.barangmasuk.detail', [
            'title'     => $title,
            'data'      => $data,
            'barang'    => $barang
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangMasuk $barangMasuk)
    {
        $title          = 'Form Edit Barang Masuk';
        $data           = BarangMasuk::where('id', $barangMasuk->id)->first();
        $barang         = Barang::all();

        session()->put('kode', $data->kode_surat);
        if ($data->kategori_sumber == 'cabang') {
            $sumber_barang  = Cabang::all();
        } else {
            $sumber_barang  = Supplier::all();
        }

        return view('pages.barangmasuk.edit', [
            'title'         => $title,
            'data'          => $data,
            'sumber_barang' => $sumber_barang,
            'barang'        => $barang,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangMasuk $barangMasuk)
    {

        $this->validate($request, [

            'kode_surat'        => 'required',
            'sumber_barang'     => 'required',
            'barang'            => 'required',
            'qty_masuk'         => 'required',
            'qty_rusak'         => 'required',
            'satuan'            => 'required',
            'harga_beli'        => 'required',
            'tanggal_masuk'     => 'required',
        ]);


        DB::beginTransaction();

        try {
            $barangMasuk                    = BarangMasuk::where('id', $barangMasuk->id)->first();
            $barangMasuk->kode_barang_masuk = $request->kode_barang_masuk;
            $barangMasuk->kode_surat        = $request->kode_surat;
            $barangMasuk->barang_id         = $request->barang;
            $barangMasuk->sumber_barang     = $request->sumber_barang;
            $barangMasuk->qty_masuk         = $request->qty_masuk;
            $barangMasuk->qty_rusak         = $request->qty_rusak;

            $barangMasuk->satuan            = $request->satuan;
            $barangMasuk->harga_beli        = $request->harga_beli;
            $barangMasuk->tanggal_masuk     = $request->tanggal_masuk;

            $imgSuratJalan                  = $request->file('foto_surat');
            if ($imgSuratJalan) {

                if ($barangMasuk->foto_surat != null) {
                    Storage::delete($barangMasuk->foto_surat);
                }

                $fileName                   = $request->kode_barang_masuk . '-' . $imgSuratJalan->getClientOriginalExtension();
                $path                       = $imgSuratJalan->storeAs('images', $fileName);
            } else {
                $path                       = $barangMasuk->foto_surat;
            }
            $barangMasuk->foto_surat        = $path;

            $barang                         = Barang::where('id', $request->barang)->first();

            $tempStock                      = $barang->stock - $barangMasuk->qty_diterima;
            $barangMasuk->qty_diterima      = $request->qty_masuk - $request->qty_rusak;

            $result                         = $tempStock + $barangMasuk->qty_diterima;

            $barang->stock                  = $result;

            $barang->update();
            $barangMasuk->save();

            $params                         = session()->get('kode');


            DB::commit();



            // return redirect('barang-masuk')->with('success', 'Barang Masuk added successfully...');

            return redirect('/daftar-detail/' . $params)->with('success', 'Barang Masuk updated successfully...');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangMasuk $barangMasuk)
    {

        DB::beginTransaction();

        try {

            $data       = BarangMasuk::where('id', $barangMasuk->id)->first();
            $params     = $data->kode_surat;
            $barang     = Barang::where('id', $data->barang_id)->first();
            $result     = $barang->stock - $data->qty_diterima;
            $barang->stock =  $result;
            $barang->update();
            $data->delete();
            DB::commit();

            $count      = BarangMasuk::where('kode_surat', $params)->count();

            if ($count > 0) {

                return redirect('daftar-detail/' . $params)->with('success', 'Barang Masuk delete successfully...');
            } elseif ($count == 0) {

                return redirect('/barang-masuk')->with('success', 'Semua Barang Masuk delete successfully...');
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('failed', $e->getMessage());
        }
    }
}
