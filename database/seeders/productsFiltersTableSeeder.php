<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductsFilter;

class productsFiltersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filterRecords = [
            ['id'=>1,'category_ids'=>'1,2,4,5,7,8,9,10,11,12','filter_name'=>'Material','filter_column'=>'material','status'=>1],
            ['id'=>2,'category_ids'=>'71,72,73','filter_name'=>'RAM','filter_column'=>'ram','status'=>'1']
        ];
        ProductsFilter::insert($filterRecords);
    }
}
