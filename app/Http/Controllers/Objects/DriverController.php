<?php

namespace App\Http\Controllers\Objects;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Trip;
use Illuminate\Support\Facades\DB;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = DB::table('trips')
            ->selectRaw('driver_id, SUM(minutes) as minutes')
            ->groupBy('driver_id')
            ->get();

        foreach ($drivers as $driver) {
            $data[$driver->driver_id] = $driver->minutes;
        }

        return view('drivers.index', compact('data'));
    }

    public function show($id)
    {
        $driver = (new Driver())->trips()->where('driver_id', $id)->first();
        $trips = Trip::where('driver_id', '=', $id)->get();

        return view('drivers.show', compact('driver', 'trips'));
    }
}
