<?php

namespace Tests\Feature;

use App\Models\Trip;
use Database\Seeders\TripsSeeder;
use Tests\TestCase;

class TripsTest extends TestCase
{
    protected function afterRefreshingDatabase()
    {
        $this->seed(TripsSeeder::class);
    }

    /**
     * @test
     */
    public function test_view_display_data(): void
    {
        $trips = Trip::factory(2)->create();

        $this->get(route('trips.index'))
            ->assertStatus(200)
            ->assertViewIs('trips.index');
    }
}
