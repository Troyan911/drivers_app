<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Http\Services\CsvServiceContract;
use App\Models\Driver;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    /**
     * @return StreamedResponse
     */
    public function __invoke(Driver $driver, CsvServiceContract $service)
    {
        $data = $driver->dataForExport();

        return $service->exportCsv($data);
    }
}
