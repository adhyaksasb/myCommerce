<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductsAttribute;

class ProductsAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productsAttributesRecords = [
            ['id'=>1,'product_id'=>2,'size'=>'small','price'=>'100','stock'=>10,'sku'=>'LC01-RTS-S', 'status'=>1],
            ['id'=>2,'product_id'=>2,'size'=>'medium','price'=>'101','stock'=>25,'sku'=>'LC01-RTS-M', 'status'=>1],
            ['id'=>3,'product_id'=>2,'size'=>'large','price'=>'102','stock'=>15,'sku'=>'LC01-RTS-L', 'status'=>1],
            ['id'=>4,'product_id'=>2,'size'=>'xlarge','price'=>'103','stock'=>15,'sku'=>'LC01-RTS-XL', 'status'=>1]
        ];
        ProductsAttribute::insert($productsAttributesRecords);
    }
}
