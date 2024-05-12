<?php

namespace App\Http\Controllers\Objects;

use App\Http\Controllers\Controller;
use App\Models\Driver;

class DriverController extends Controller
{
    public function __construct(private Driver $driver)
    {
    }

    public function index()
    {
        $drivers = $this->driver->total();

        return view('drivers.index', compact('drivers'));
    }

    public function show(Driver $driver)
    {
        $trips = $driver->trips;
        $driver = $driver->total()->where('driver_id', $driver->id)->first();

        return view('drivers.show', compact('driver', 'trips'));
    }
}
