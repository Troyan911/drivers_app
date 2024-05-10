<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Http\Services\CsvService;
use App\Models\Driver;

class ExportController extends Controller
{
    public function __invoke(Driver $driver, CsvService $service)
    {
        $data = $driver->dataForExport();

        return $service->exportCsv($data);
    }
}
