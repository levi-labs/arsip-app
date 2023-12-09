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

    public function getCounterKodeSupplierMasuk()
    {
        $supplier_masuk = BarangMasuk::where('kategori_sumber', 'Supplier')->count();

        if ($supplier_masuk == 0) {
            $counter    = 00001;
            $number     = sprintf('%05s' . $counter);
        } else {
            $last       = BarangMasuk::select('kode_surat')->where('kategori_sumber', 'Supplier')
                ->groupBy('kode_surat')
                ->orderBy('kode_surat', 'desc')
                ->first();
            $sequence   = (int)substr($last->kode_surat, -5) + 1;
            $number     = sprintf('%05s', $sequence);
        }
        return $number;
    }
}
