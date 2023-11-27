<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';
    public $timestamps = false;


    public function getKodeSupplier()
    {

        $date = Carbon::now()->format('dm');
        $supplier = $this->count();

        if ($supplier == 0) {
            $counter  = 00001;
            $number   = 'SP-' . sprintf('%05s', $counter);
        } else {
            $last     = $this->all()->last();
            $sequence = (int)substr($last->kode_supplier, -5) + 1;

            $number  = 'SP-' . sprintf('%05s', $sequence);
        }

        return $number;
    }
}
