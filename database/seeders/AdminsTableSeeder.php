<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords = [
            ['id'=>2, 'name'=>'John', 'type'=>'vendor','vendor_id'=>1, 'mobile'=>'081224854939',
            'email'=>'john@admin.com','password'=>'$2a$12$3BdO6yhwTeJYZ/czU/riNe2zYcuL9W6mxI65CpuuzLTjkkJm0RCOm','image'=>'','status'=>0],
        ];
        Admin::insert($adminRecords);
    }
}
