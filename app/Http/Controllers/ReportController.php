<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function formReportMasuk(Request $request)
    {
        $title          = 'Form Report Masuk Barang';

        return view('pages.report.report-masuk', ['title' => $title]);
    }

    public function formReportKeluar(Request $request)
    {
        $title          = 'Form Report Keluar';

        return view('pages.report.report-keluar', ['title' => $title]);
    }

    public function rangeDateReport($data, $input_from = null, $input_to = null)
    {
        try {
            $maxRange       = $data->all()->last();
            $minRange       = $data->all()->first();


            if (isset($input_from) && !isset($input_to)) {

                $data       = $data::where('tanggal_masuk', '>=', $input_from)->get();

                return [
                    'dari'      => $input_to,
                    'sampai'    => $maxRange->tanggal_masuk,
                    'data'      => $data
                ];
            } elseif (!isset($input_from) && isset($input_to)) {

                $data       = $data::where('tanggal_masuk', '<=', $input_to)->get();

                return [

                    'dari'      => $minRange,
                    'sampai'    => $input_to,
                    'data'      => $data
                ];
            }

            if (isset($input_from) && isset($input_to)) {

                $data       = $data::where('tanggal_masuk', '>=', $input_from)
                    ->where('tanggal_masuk', '<=', $input_to)
                    ->get();
                return [

                    'dari'      => $input_from,
                    'sampai'    => $input_to,
                    'data'      => $data
                ];
            }

            return back()->with('message-info', 'Tanggal Harus diinput terlebih dahulu');
        } catch (\Exception $e) {
            return back()->with('message-error', $e->getMessage());
        }
    }

    public function sendReportMasuk(Request $request)
    {

        $barangMasuk = new BarangMasuk();
        $input_from     = $request->input_from;
        $input_to       = $request->input_to;

        $result     = $this->rangeDateReport($barangMasuk, $input_from, $input_to);

        return view('pages.report.print-masuk', ['result' => $result]);
    }

    public function sendReportKeluar(Request $request)
    {
        $barangMasuk = new BarangKeluar();
        $input_from     = $request->input_from;
        $input_to       = $request->input_to;

        $result     = $this->rangeDateReport($barangMasuk, $input_from, $input_to);

        return view('pages.report.print-keluar', ['result' => $result]);
    }

    public function sendReportMasuks(Request $request)
    {

        try {
            $title          = 'Report Masuk Barang';
            $input_from     = $request->input_from;
            $input_to       = $request->input_to;
            $maxRange       = BarangMasuk::all()->last();
            $minRange       = BarangMasuk::all()->first();

            if (isset($input_from) && !isset($input_to)) {

                $data       = BarangMasuk::where('tanggal_masuk', '>=', $input_from)->get();

                return view('pages.report.print-masuk', [
                    'title'     => $title,
                    'dari'      => $input_to,
                    'sampai'    => $maxRange->tanggal_masuk,
                    'data'      => $data
                ]);
            } elseif (!isset($input_from) && isset($input_to)) {

                $data       = BarangMasuk::where('tanggal_masuk', '<=', $input_to)->get();

                return view('pages.report.print-masuk', [
                    'title'     => $title,
                    'dari'      => $minRange,
                    'sampai'    => $input_to,
                    'data'      => $data
                ]);
            }

            if (isset($input_from) && isset($input_to)) {

                $data       = BarangMasuk::where('tanggal_masuk', '>=', $input_from)
                    ->andWhere('tanggal_masuk', '<=', $input_to)
                    ->get();

                return view('pages.report.print-masuk', [
                    'title'     => $title,
                    'dari'      => $input_from,
                    'sampai'    => $input_to,
                    'data'      => $data
                ]);
            }

            return back()->with('message-info', 'Tanggal Harus diinput terlebih dahulu');
        } catch (\Exception $e) {
            return back()->with('message-error', $e->getMessage());
        }
    }
}
