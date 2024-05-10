<?php

namespace App\Http\Services;

use App\Http\Requests\CsvImportRequest;
use App\Models\Driver;
use App\Models\Trip;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Writer;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CsvService implements CsvServiceContract
{
    /**
     * @param  Trip  $modelTrip
     * @param  Driver  $modelDriver
     */
    private $filePath = 'drivers.csv';

    public function __construct(public Trip $modelTrip, public Driver $modelDriver)
    {
    }

    /**
     * @throws \League\Csv\Exception
     * @throws \League\Csv\UnavailableStream
     */
    public function parseCsv(CsvImportRequest $request): void
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

    /**
     * @throws \League\Csv\CannotInsertRecord
     * @throws \League\Csv\Exception
     */
    public function exportCsv($data): StreamedResponse
    {
        $this->removeCsv();

        $csv = Writer::createFromString('');
        $csv->insertAll($data);

        Storage::put($this->filePath, $csv->toString());

        return Storage::download($this->filePath);
    }

    public function removeCsv(): void
    {
        Storage::delete($this->filePath);
    }
}
