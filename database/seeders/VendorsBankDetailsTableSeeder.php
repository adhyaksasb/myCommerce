<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorsBankDetail;

class VendorsBankDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = [
            ['id' => 1, 'vendor_id' => 1, 'account_holder_name' => 'John Dee', 'bank_code' => '014', 
            'bank_name' => 'BCA', 'account_number' => '01254877493'],
        ];
        VendorsBankDetail::insert($vendorRecords);
    }
}
