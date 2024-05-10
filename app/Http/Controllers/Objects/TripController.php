<?php

namespace App\Http\Controllers\Objects;

use App\Http\Controllers\Controller;
use App\Models\Trip;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::all();

        return view('trip.index', compact('trips'));
    }

    public function show(Trip $trip)
    {
        return view('trip.show', compact('trip'));
    }

    public function time()
    {
        $driversWithTime = Trip::withSum('transactions', 'amount')->get();

        return view('trip.show', compact('trip'));
    }
}
