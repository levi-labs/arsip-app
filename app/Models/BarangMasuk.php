<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk';


    public function barangs()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }

    public function getImage()
    {
        return '/storage/' . $this->foto_surat;
    }
    public function getKodeBarangMasuk()
    {
        $date           = Carbon::now()->format('dm');
        $barangmasuk    = $this->count();

        if ($barangmasuk == 0) {
            $counter    = 00001;
            $number     = 'BRM-' . sprintf('%05s', $counter);
            # code...
        } else {
            $last       = $this->all()->last();
            $sequence   = (int)substr($last->kode_barang_masuk, -5) + 1;
            $number     = 'BRM-' . sprintf('%05s', $sequence);
        }

        return $number;
    }
}
