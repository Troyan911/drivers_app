<?php

namespace App\Http\Controllers\Objects;

use App\Http\Controllers\Controller;
use App\Models\Driver;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::all();

        return view('drivers.index', compact('drivers'));
    }

    public function show(Driver $driver)
    {
        $trips = $driver->trips;

        return view('drivers.show', compact('driver', 'trips'));
    }
}
