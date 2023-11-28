<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    public $timestamps = false;

    public function getKodeKategori()
    {

        $date = Carbon::now()->format('dm');
        $supplier = $this->count();

        if ($supplier == 0) {
            $counter  = 00001;
            $number   = 'KTG-' . sprintf('%05s', $counter);
        } else {
            $last     = $this->all()->last();
            $sequence = (int)substr($last->kode_kategori, -5) + 1;

            $number  = 'KTG-' . sprintf('%05s', $sequence);
        }

        return $number;
    }
}
