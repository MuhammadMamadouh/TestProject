<?php

namespace Database\Seeders;

use App\Models\Truck;
use Illuminate\Database\Seeder;

class TruckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Truck::create([
                'license' => 'ABC1234',
                'width' => 2,
                'height'=> 2,
                'depth'=> 2,
                'truck_type'=> 1,
        ]);
        Truck::create([
                'license' => 'DEF1234',
                'width' => 2,
                'height'=> 2,
                'depth'=> 2,
                'truck_type'=> 2,
        ]);
        Truck::create([
                'license' => 'XYZ1234',
                'width' => 2,
                'height'=> 2,
                'depth'=> 2,
                'truck_type'=> 3,
        ]);
    }
}
