<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Http\Services\CsvServiceContract;
use App\Models\Driver;

class ExportController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function __invoke(Driver $driver, CsvServiceContract $service)
    {
        $data = $driver->dataForExport();

        return $service->exportCsv($data);
    }
}
