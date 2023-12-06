<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar';


    public function getKodeBarangKeluar()
    {
        $date       = Carbon::now()->format('dm');
        $count      = $this->count();


        if ($count == 0) {
            $counter = 00001;
            $number  = 'BRK-' . sprintf('%05s', $counter);
        } else {
            $last       = $this->all()->last();
            $squence    =  (int)substr($last->kode_barang_keluar, -5) + 1;
            $number     = 'BRK-' . sprintf('%05s', $squence);
        }

        return $number;
    }
}
