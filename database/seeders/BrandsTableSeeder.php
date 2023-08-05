<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandRecords = [['id'=>1,'name'=>'Samsung','status'=>1],
        ['id'=>2,'name'=>'Apple','status'=>1],
        ['id'=>3,'name'=>'Panasonic','status'=>1],
        ['id'=>4,'name'=>'LG','status'=>1],
        ['id'=>5,'name'=>'Lenovo','status'=>1],
        ['id'=>6,'name'=>'MSI','status'=>1],
        ['id'=>7,'name'=>'Lee Cooper','status'=>1],
        ['id'=>8,'name'=>'Hush Puppies','status'=>1]
    ];
        Brand::insert($brandRecords);
    }
}
