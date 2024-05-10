<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\CsvImportRequest;
use App\Http\Services\CsvService;
use App\Models\Trip;

class ImportController extends Controller
{
    public function __invoke(CsvImportRequest $request, CsvService $service, Trip $trip)
    {
        $service->parseCsv($request, $trip);

        return redirect()->route('trips.index');
    }
}
