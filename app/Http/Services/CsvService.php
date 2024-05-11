<?php

namespace App\Http\Services;

use App\Http\Requests\CsvImportRequest;
use App\Models\Driver;
use App\Models\Trip;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use League\Csv\CannotInsertRecord;
use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\UnavailableStream;
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
     * @throws Exception
     * @throws UnavailableStream
     */
    public function parseCsv(CsvImportRequest $request): void
    {
        $file = $request->file('csv_file');
        $csv = Reader::createFromPath($file->getPathname(), 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        $this->modelTrip->createTrips($records);
    }

    /**
     * @throws CannotInsertRecord
     * @throws Exception
     */
    public function exportCsv(Collection $trips): StreamedResponse
    {
        $this->removeCsv();
        $csv = Writer::createFromString('');

        $data[] = ['driver_id', 'total_minutes_with_passenger'];

        foreach ($trips as $trip) {
            $data[] = [
                $trip->driver_id,
                $trip->minutes,
            ];
        }

        $csv->insertAll($data);

        Storage::put($this->filePath, $csv->toString());

        return Storage::download($this->filePath);
    }

    public function removeCsv(): void
    {
        Storage::delete($this->filePath);
    }
}
