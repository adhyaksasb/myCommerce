<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords = [
            ['id'=>1,'section_id'=>2,'category_id'=>4, 'brand_id'=>1,'vendor_id'=>1,'admin_id'=>0,'admin_type'=>'vendor','product_name'=>'Galaxy Z Fold4','product_code'=>'Sm-GZF4',
            'product_color'=>'black','product_price'=>1325,'product_discount'=>10,'product_weight'=>'500','product_image'=>'','product_video'=>'',
            'meta_title'=>'', 'meta_description'=>'', 'meta_keywords'=>'', 'is_featured'=>'yes', 'status'=> 1],
            ['id'=>2,'section_id'=>1,'category_id'=>6, 'brand_id'=>8,'vendor_id'=>0,'admin_id'=>1,'admin_type'=>'vendor','product_name'=>'Red Regular Fit T-Shirt','product_code'=>'LC-RRF-TS',
            'product_color'=>'white','product_price'=>15,'product_discount'=>10,'product_weight'=>'10','product_image'=>'','product_video'=>'',
            'meta_title'=>'', 'meta_description'=>'', 'meta_keywords'=>'', 'is_featured'=>'yes', 'status'=> 1],
        ];

        Product::insert($productRecords);
    }
}
