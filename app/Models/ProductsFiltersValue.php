<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsFiltersValue extends Model
{
    use HasFactory;

    public function filter() {
        return $this->belongsTo('App\Models\ProductsFilter', 'filter_id');
    }
}
