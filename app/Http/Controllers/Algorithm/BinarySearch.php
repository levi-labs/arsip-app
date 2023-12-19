<?php

namespace App\Http\Controllers\Algorithm;

use App\Http\Controllers\Controller;
use App\Models\BarangMasuk;

class BinarySearch extends Controller
{
    public function binarySearch($arr, $target)
    {
        //batas kiri
        $left   = 0;
        //batas kanan panjang array - 1
        $right  = count($arr) - 1;


        while ($left <= $right) {
            //panjang data di bagi 2, untuk menentukan titik tengah
            $middle             = floor(($left + $right) / 2);

            /**
             * Membandingkan String/Kode Surat yang ada pada Index (dalam Databases),
             * tersebut sama tidak sama dengan yang di inputkan.
             */
            $comparasionResult  = strcmp($arr[$middle]->kode_surat, $target);

            if ($comparasionResult == 0) {
                /**
                 * fungsi @strcmp akan mengembalikan nilai 0 jika string yang dibandingkan tidak memiliki perbedaan
                 * Jika @comparasionResult return int 0 maka akan mengembalikan nilai index yang di cari
                 */
                return $middle;
            }

            if ($comparasionResult < 0) {
                /**
                 * Jika Jika @comparasionResult return int < 0 maka batas pencarian bagian index kiri akan ditambah 1
                 */
                $left   = $middle + 1;
            } else {
                /**
                 * Jika Jika @comparasionResult return selain dari 2 kondisi sebelumnya,
                 *  maka batas pencarian bagian index kiri akan dikurang 1
                 */
                $right  = $middle - 1;
            }
        }
        return -1;
    }
}
