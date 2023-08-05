<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = [
            ['id' => 1, 'name' => 'John', 'address' => 'Jl. Contoh Alamat No.23', 'city' => 'Jakarta', 
            'state' => 'Jawa Barat', 'country' => 'Indonesia', 'pincode' => '11750', 
            'mobile' => '081224854939', 'email' => 'john@admin.com', 'status' => 0],
        ];
        Vendor::insert($vendorRecords);
    }
}
