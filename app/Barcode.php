<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Barcode extends Model
{
    protected $guarded = [];

    public function getBarcodeAttribute($barcode){
        return asset(Storage::url($barcode));
    }
}
