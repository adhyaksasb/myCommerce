<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductsFiltersValue;

class productsFiltersValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filterValueRecords = [
            ['id'=>1,'filter_id'=>1,'filter_value'=>'Cotton','status'=>1],
            ['id'=>2,'filter_id'=>1,'filter_value'=>'Polyester','status'=>1],
            ['id'=>3,'filter_id'=>2,'filter_value'=>'< 512MB','status'=>1],
            ['id'=>4,'filter_id'=>2,'filter_value'=>'512 MB','status'=>1],
            ['id'=>5,'filter_id'=>2,'filter_value'=>'1 GB','status'=>1],
            ['id'=>6,'filter_id'=>2,'filter_value'=>'2 GB','status'=>1],
            ['id'=>7,'filter_id'=>2,'filter_value'=>'3 GB','status'=>1],
            ['id'=>8,'filter_id'=>2,'filter_value'=>'4 GB','status'=>1],
            ['id'=>9,'filter_id'=>2,'filter_value'=>'6 GB','status'=>1],
            ['id'=>10,'filter_id'=>2,'filter_value'=>'8 GB','status'=>1], 
            ['id'=>11,'filter_id'=>2,'filter_value'=>'> 8 GB','status'=>1],
        ];

        ProductsFiltersValue::insert($filterValueRecords);
    }
}
