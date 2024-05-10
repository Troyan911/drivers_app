<?php

namespace App\Http\Controllers\Objects;

use App\Http\Controllers\Controller;
use App\Models\Driver;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::withSum('trips', 'minutes')->get();

        $data = [];
        foreach ($drivers as $driver) {
            $data[$driver->getAttribute('id')] = $driver->getAttribute('trips_sum_minutes');
        }

        return view('drivers.index', compact('data'));
    }

    public function show(Driver $driver)
    {
        $trips = $driver->trips;

        return view('drivers.show', compact('driver', 'trips'));
    }
}
