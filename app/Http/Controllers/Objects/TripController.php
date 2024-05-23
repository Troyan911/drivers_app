<?php

namespace App\Http\Controllers\Objects;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Support\Facades\DB;

class TripController extends Controller
{
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
        DB::table('trips')->truncate();
        DB::table('drivers')->truncate();

        return redirect()->route('import');
    }
}
