<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    public $timestamps = false;

    public function getKodeBarang()
    {

        $date = Carbon::now()->format('dm');
        $supplier = $this->count();

        if ($supplier == 0) {
            $counter  = 00001;
            $number   = 'BRG-' . sprintf('%05s', $counter);
        } else {
            $last     = $this->all()->last();
            $sequence = (int)substr($last->kode_barang, -5) + 1;

            $number  = 'BRG-' . sprintf('%05s', $sequence);
        }

        return $number;
    }

    public function getImage()
    {
        return '/storage/' . $this->foto_barang;
    }
}
