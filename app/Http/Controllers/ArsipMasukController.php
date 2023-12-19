<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Algorithm\BinarySearch;
use App\Models\BarangMasuk;
use App\Models\Cabang;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArsipMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        session()->forget('sumber');
        session()->forget('surat');
        $title      = 'Daftar Arsip Masuk';
        $titleForm  = 'Form Kode Arsip';
        $inputkode  = $request->kode_surat;

        if (isset($inputkode) != null) {
            $startTime  = microtime(true);
            $data       = DB::table('barang_masuk')
                ->join('barang', 'barang_masuk.barang_id', '=', 'barang.id')
                ->select('barang_masuk.kode_surat', 'barang_masuk.tanggal_masuk')
                ->groupBy('kode_surat', 'tanggal_masuk')
                ->get()->toArray();

            $binarySearch     = new BinarySearch();
            $result           = $binarySearch->binarySearch($data, $inputkode);

            if ($result != -1) {

                $final_result = "Arsip found at index: $result";
                $endTIme      = number_format(microtime(true) - $startTime, 2);

                // dd($final_result, number_format($endTIme, 7) . ' milesecond');
                return view('pages.arsip-masuk.index', [
                    'title'         => $title,
                    'data'          => $data[$result],
                    'endtime'       => $endTIme,
                    'final_result'  => $final_result,
                    'titleForm'     => $titleForm
                ]);
            } else {
                $data         = "element not found in the array";
                return view('pages.arsip-masuk.index', [
                    'title'         => $title,
                    'data'          => $data,
                    'titleForm'     => $titleForm,
                    'result'        => $result
                ]);
            }
        } elseif (isset($inputkode) == null) {
            $startTime  = microtime(true);
            $data       = DB::table('barang_masuk')
                ->join('barang', 'barang_masuk.barang_id', '=', 'barang.id')
                ->select('barang_masuk.kode_surat', 'barang_masuk.tanggal_masuk')
                ->groupBy('kode_surat', 'tanggal_masuk')
                ->get();
            $endTIme    = number_format(microtime(true) - $startTime, 2);
            // dd(number_format($endTIme, 2));
            return view('pages.arsip-masuk.index', [
                'title'     => $title,
                'data'      => $data,
                'endtime'   => $endTIme,
                'titleForm' => $titleForm
            ]);
        }

        $startTime  = microtime(true);
        $data       = DB::table('barang_masuk')
            ->join('barang', 'barang_masuk.barang_id', '=', 'barang.id')
            ->select('barang_masuk.kode_surat', 'barang_masuk.tanggal_masuk')
            ->groupBy('kode_surat', 'tanggal_masuk')
            ->get();
        $endTIme    = number_format(microtime(true) - $startTime, 2);
        // dd(number_format($endTIme, 2));
        return view('pages.arsip-masuk.index', [
            'title'     => $title,
            'data'      => $data,
            'endtime'   => $endTIme,
            'titleForm' => $titleForm
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    public function detailArsip($barangmasuk)
    {
        $title      = 'Detail Arsip Barang Masuk';

        $kopTitle   = 'PT. TIRTA MULTI BANGUNAN';
        $kopAlamat  = 'JL. H. DJOLE ( BANTARGEBANG-SETU ) RT 001 RW 003 KEL PADURENAN KEC MUSTIKA JAYA KOTA BEKASI';
        $kopTelp    = 'TELP : 021 8259 5311 / 0888 1300 028';
        $kopTanggal = BarangMasuk::where('kode_surat', $barangmasuk)->first();
        $data       = BarangMasuk::where('kode_surat', $barangmasuk)->get();
        $supplier   = Supplier::where('nama', $kopTanggal->sumber_barang)->first();
        $cabang     = Cabang::where('nama', $kopTanggal->sumber_barang)->first();
        // dd($kopTanggal->sumber_barang, $supplier);
        if ($cabang) {
            $sumber_dari = $cabang;
            return view('pages.arsip-masuk.detail', [
                'title'         => $title,
                'data'          => $data,
                'kopTitle'      => $kopTitle,
                'kopAlamat'     => $kopAlamat,
                'kopTelp'       => $kopTelp,
                'kopTanggal'    => $kopTanggal,
                'sumber_dari'   => $sumber_dari
            ]);
        } else if ($supplier) {
            $sumber_dari = $supplier;
            // dd($supplier);

            return view('pages.arsip-masuk.detail', [
                'title'         => $title,
                'data'          => $data,
                'kopTitle'      => $kopTitle,
                'kopAlamat'     => $kopAlamat,
                'kopTelp'       => $kopTelp,
                'kopTanggal'    => $kopTanggal,
                'sumber_dari'   => $sumber_dari
            ]);
        }
    }
    public function show($barangmasuk)
    {


        $title      = 'Detail Arsip Masuk';
        $data       = BarangMasuk::where('kode_surat',  $barangmasuk)->get();
        dd($data);
        return view('pages.arsip-masuk.detail', [
            'title' =>  $title,
            'data'  => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
