<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Http\Services\CsvServiceContract;
use App\Models\Driver;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function __invoke(Driver $driver, CsvServiceContract $service): StreamedResponse
    {
        $trips = $driver->trips();

        return $service->exportCsv($trips);
    }
}
