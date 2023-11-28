<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    protected $table = 'cabang';
    public $timestamps = false;


    public function getKodeCabang()
    {

        $date = Carbon::now()->format('dm');
        $supplier = $this->count();

        if ($supplier == 0) {
            $counter  = 00001;
            $number   = 'CBG-' . sprintf('%05s', $counter);
        } else {
            $last     = $this->all()->last();
            $sequence = (int)substr($last->kode_cabang, -5) + 1;

            $number  = 'CBG-' . sprintf('%05s', $sequence);
        }

        return $number;
    }
}
