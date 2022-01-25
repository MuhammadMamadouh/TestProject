<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TruckTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trucks_types')->insert([
            ['type_name' => 'small'],
            ['type_name' => 'medium'],
            ['type_name' => 'large']
        ]);

    }
}
