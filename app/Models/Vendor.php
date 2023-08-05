<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    public function vendorsbusinessdetail() {
        return $this->belongsTo('App\Models\VendorsBusinessDetail', 'id', 'vendor_id');
    }
}
