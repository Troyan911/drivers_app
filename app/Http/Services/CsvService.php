<?php

namespace App\Http\Services;

use App\Http\Requests\CsvImportRequest;
use App\Models\Driver;
use App\Models\Trip;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Writer;

class CsvService
{
    public function parseCsv(CsvImportRequest $request)
    {
        $file = $request->file('csv_file');
        $csv = Reader::createFromPath($file->getPathname(), 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        DB::table((new Trip)->getTable())->truncate();
        foreach ($records as $record) {
            $seconds = strtotime($record['dropoff']) - strtotime($record['pickup']);
            $record['seconds'] = $seconds;
            (new Trip)::create($record);
        }

        $trips = collect($csv->getRecords());
        $drivers = $trips->pluck(['driver_id'])->unique()->toArray();

        DB::table((new Driver)->getTable())->truncate();
        foreach ($drivers as $driver) {
            (new Driver())->create(['id' => $driver]);
        }
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
