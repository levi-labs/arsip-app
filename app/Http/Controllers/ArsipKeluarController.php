<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Algorithm\BinarySearch;
use App\Models\BarangKeluar;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArsipKeluarController extends Controller
{
    public function index(Request $request)
    {session()->forget('sumber');
        session()->forget('surat');
        $title      = 'Daftar Arsip Keluar Barang';
        $titleForm  = 'Form Kode Arsip';
        $inputkode  = $request->kode_surat;

        if (isset($inputkode) != null) {
            $startTime  = microtime(true);
            $data       = DB::table('barang_keluar as bk')
                ->join('barang', 'bk.barang_id', '=', 'barang.id')
                ->select('bk.kode_surat', 'bk.tanggal_keluar')
                ->groupBy('kode_surat', 'tanggal_keluar')
                ->get()->toArray();
            $binarySearch     = new BinarySearch();
            $result           = $binarySearch->binarySearch($data, $inputkode);

            if ($result != -1) {

                $final_result = "Arsip found at index: $result";

                $endTIme      = number_format(microtime(true) - $startTime, 2);

                // dd($final_result, number_format($endTIme, 7) . ' milesecond');
                return view('pages.arsip-keluar.index', [
                    'title'         => $title,
                    'data'          => $data[$result],
                    'endtime'       => $endTIme,
                    'final_result'  => $final_result,
                    'titleForm'     => $titleForm
                ]);
            } else {

                $data         = "element not found in the array";
                return view('pages.arsip-keluar.index', [
                    'title'         => $title,
                    'data'          => $data,
                    'titleForm'     => $titleForm,
                    'result'        => $result
                ]);
            }
        } elseif (!isset($inputkode)) {
            $startTime  = microtime(true);
            $data       = DB::table('barang_keluar as bk')
                ->join('barang', 'bk.barang_id', '=', 'barang.id')
                ->select('bk.kode_surat', 'bk.tanggal_keluar')
                ->groupBy('kode_surat', 'tanggal_keluar')
                ->get();
            $endTIme    = number_format(microtime(true) - $startTime, 2);
            // dd(number_format($endTIme, 2));
            return view('pages.arsip-keluar.index', [
                'title'     => $title,
                'data'      => $data,
                'endtime'   => $endTIme,
                'titleForm' => $titleForm
            ]);
        }

        $startTime  = microtime(true);
        $data       = DB::table('barang_keluar as bk')
            ->join('barang', 'bk.barang_id', '=', 'barang.id')
            ->select('bk.kode_surat', 'bk.tanggal_keluar')
            ->groupBy('kode_surat', 'tanggal_keluar')
            ->get();
        $endTIme    = number_format(microtime(true) - $startTime, 2);
        // dd(number_format($endTIme, 2));
        return view('pages.arsip-keluar.index', [
            'title'     => $title,
            'data'      => $data,
            'endtime'   => $endTIme,
            'titleForm' => $titleForm
        ]);
    }


    public function detailArsip($barangKeluar)
    {
        $title      = 'Detail Arsip Barang Keluar';

        $kopTitle   = 'PT. TIRTA MULTI BANGUNAN';
        $kopAlamat  = 'JL. H. DJOLE ( BANTARGEBANG-SETU ) RT 001 RW 003 KEL PADURENAN KEC MUSTIKA JAYA KOTA BEKASI';
        $kopTelp    = 'TELP : 021 8259 5311 / 0888 1300 028';
        $kopTanggal = BarangKeluar::where('kode_surat', $barangKeluar)->first();
        $data       = BarangKeluar::where('kode_surat', $barangKeluar)->get();
//        $supplier   = Supplier::where('nama', $kopTanggal->sumber_barang)->first();
        $cabang     = Cabang::where('nama', $kopTanggal->nama_tujuan)->first();
        // dd($kopTanggal->sumber_barang, $supplier);
        if ($cabang) {
            $tujuan_dari = $cabang;
            return view('pages.arsip-keluar.detail', [
                'title'         => $title,
                'data'          => $data,
                'kopTitle'      => $kopTitle,
                'kopAlamat'     => $kopAlamat,
                'kopTelp'       => $kopTelp,
                'kopTanggal'    => $kopTanggal,
                'sumber_dari'   => $tujuan_dari
            ]);
        } else if ($kopTanggal->jenis_tujuan == 'Customer') {
            $tujuan_dari = $kopTanggal->jenis_tujuan;
            // dd($supplier);

            return view('pages.arsip-keluar.detail', [
                'title'         => $title,
                'data'          => $data,
                'kopTitle'      => $kopTitle,
                'kopAlamat'     => $kopAlamat,
                'kopTelp'       => $kopTelp,
                'kopTanggal'    => $kopTanggal,
                'sumber_dari'   => $tujuan_dari
            ]);
        }
    }

    public function show($barangKeluar)
    {
    }
}
