<?php

namespace Tests\Feature;

use App\Models\Driver;
use Database\Seeders\DriversSeeder;
use Tests\TestCase;

class DriverTest extends TestCase
{
    protected function afterRefreshingDatabase()
    {
        $this->seed(DriversSeeder::class);
    }

    /**
     * @test
     */
    public function test_view_display_data(): void
    {
        $driver = Driver::factory(2)->create();

        $this->get(route('drivers.index'))
            ->assertStatus(200)
            ->assertViewIs('drivers.index');
    }
}
