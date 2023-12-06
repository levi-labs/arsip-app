<?php

namespace App\Http\Controllers;

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
        $inputkode  = $request->kode_surat;
        // if (isset($inputkode) != null) {
        //     $startTime  = microtime(true);
        //     $data     = BarangMasuk::where('kode_surat', 'LIKE', '%' . $inputkode . '%')->get();

        //     $endTIme      = microtime(true) - $startTime;

        //     dd($data, number_format($endTIme, 7));
        // }
        if (isset($inputkode) != null) {
            $startTime  = microtime(true);
            $data       = DB::table('barang_masuk')
                ->join('barang', 'barang_masuk.barang_id', '=', 'barang.id')
                ->select('barang_masuk.kode_surat', 'barang_masuk.tanggal_masuk')
                ->groupBy('kode_surat', 'tanggal_masuk')
                ->get()->toArray();

            $result     = $this->binarySearch($data, $inputkode);
            // $reresult   = $result[0];
            if ($result != -1) {

                $final_result = "Arsip found at index: $result";
                $endTIme      = number_format(microtime(true) - $startTime, 2);

                // dd($final_result, number_format($endTIme, 7) . ' milesecond');
                return view('pages.arsip-masuk.index', ['title' => $title, 'data' => $data[$result], 'endtime' => $endTIme, 'final_result' => $final_result]);
            } else {
                $data         = "element not found in the array";
                return view('pages.arsip-masuk.index', ['title' => $title, 'data' => $data]);
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
                'title' => $title,
                'data' => $data,
                'endtime' => $endTIme
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
            'title' => $title,
            'data' => $data,
            'endtime' => $endTIme
        ]);
    }

    public function binarySearch($arr, $target)
    {
        //batas kiri
        $left   = 0;
        //batas kanan
        $right  = BarangMasuk::count() - 1;

        while ($left <= $right) {
            //panjang data di bagi 2, untuk menentukan titik tengah
            $middle      = floor(($left + $right) / 2);

            $comparasionResult = strcmp($arr[$middle]->kode_surat, $target);

            if ($comparasionResult == 0) {
                return $middle;
            }

            if ($comparasionResult < 0) {
                $left   = $middle + 1;
            } else {
                $right  = $middle - 1;
            }
        }
        return -1;
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
        return view('pages.arsip-masuk.detail', [
            'title'         => $title,
            'data'          => $data,
            'kopTitle'      => $kopTitle,
            'kopAlamat'     => $kopAlamat,
            'kopTelp'       => $kopTelp,
            'kopTanggal'    => $kopTanggal
        ]);
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
