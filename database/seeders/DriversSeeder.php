<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Driver;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DriversSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('drivers')->truncate();
        Driver::factory(10)->create();
    }
}
