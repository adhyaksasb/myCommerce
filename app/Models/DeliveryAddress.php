<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class DeliveryAddress extends Model
{
    use HasFactory;

    public static function deliveryAddresses() {
        $addresses = DeliveryAddress::where('user_id',Auth::user()->id)->get()->toArray();
        return $addresses;
    }
}
