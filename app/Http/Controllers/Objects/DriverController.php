<?php

namespace App\Http\Controllers\Objects;

use App\Http\Controllers\Controller;
use App\Models\Driver;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::withSum('trips', 'seconds')->get();

        $data = [];
        foreach ($drivers as $driver) {
            $data[$driver->getAttribute('id')] = $driver->getAttribute('trips_sum_seconds') / 60;
        }

        return view('driver.index', compact('data'));
    }

    public function show(Driver $driver)
    {
        $trips = $driver->trips;

        return view('driver.show', compact('driver', 'trips'));
    }
}
