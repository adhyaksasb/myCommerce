<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorsBusinessDetail;

class VendorsBusinessDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = [
            ['id' => 1, 'vendor_id' => 1, 'shop_name' => 'John Clothes', 'shop_address' => 'Jl. Contoh Alamat', 
            'shop_city' => 'Jakarta', 'shop_state' => 'Jawa Barat', 'shop_country' => 'Indonesia', 
            'shop_pincode' => '11750', 'shop_mobile' => '081454754332', 'shop_website' => 'johnClothes.com', 
            'shop_email' => 'john@business.com', 'address_proof' => 'Passport', 'address_proof_image' => 'img.jpg', 
            'business_license_number' => '23423420321', 'tax_id' => '09.254.294.3-407.000'],
        ];
        VendorsBusinessDetail::insert($vendorRecords);
    }
}
