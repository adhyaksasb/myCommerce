<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeliveryAddress;

class DeliveryAddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveryRecords = [
            ['id'=>1,'user_id'=>1,'name'=>'John Doe','address'=>'Jl. Aphrodite No. 123', 
            'city'=>'Jakarta','state'=>'Jawa Barat','country'=>'Indonesia','pincode'=>'12103','mobile'=>'825652435454',
            'status'=>1],
            ['id'=>2,'user_id'=>1,'name'=>'John Doe','address'=>'Jl. Emerald No. 66', 
            'city'=>'Bandung','state'=>'Jawa Barat','country'=>'Indonesia','pincode'=>'12153','mobile'=>'825667215454',
            'status'=>1],
        ];
        DeliveryAddress::insert($deliveryRecords);
    }
}
