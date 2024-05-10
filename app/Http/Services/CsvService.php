<?php

namespace App\Http\Services;

use App\Http\Requests\CsvImportRequest;
use App\Models\Driver;
use App\Models\Trip;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Writer;

class CsvService
{
    public function __construct(public Trip $modelTrip, public Driver $modelDriver)
    {
    }

    public function parseCsv(CsvImportRequest $request)
    {
        $file = $request->file('csv_file');
        $csv = Reader::createFromPath($file->getPathname(), 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        $this->modelTrip->createTrips($records);
        $trips = collect($csv->getRecords());

        $drivers = $trips->pluck(['driver_id'])->unique()->toArray();
        $this->modelDriver->createDrivers($drivers);
    }

    public function exportCsv($data)
    {
        $csv = Writer::createFromString('');
        $csv->insertAll($data);

        $filePath = 'drivers.csv';
        Storage::put($filePath, $csv->toString());

        return Storage::download($filePath);
    }
}
