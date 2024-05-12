<?php

namespace App\Http\Controllers\Objects;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Trip;

class TripController extends Controller
{
    public function __construct(private Trip $trip, private Driver $driver)
    {
    }

    public function index()
    {
        $trips = Trip::all();

        return view('trips.index', compact('trips'));
    }

    public function show(Trip $trip)
    {
        return view('trips.show', compact('trip'));
    }

    public function clear()
    {
        $this->trip->truncateTable();
        $this->driver->truncateTable();

        return redirect()->route('import');
    }
}
