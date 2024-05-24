<?php

namespace App\Http\Services;

use App\Http\Requests\CsvImportRequest;
use App\Models\Driver;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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

    /**
     * @throws Exception
     * @throws UnavailableStream
     */
    public function parseCsv(CsvImportRequest $request): void
    {
        $file = $request->file('csv_file');

        $csv = Reader::createFromPath($file->getPathname(), 'r');
        $csv->setHeaderOffset(0);
        $rows = $csv->getRecords();

        Trip::createTrips($rows);
        Driver::createDrivers($this->calcDriversTime());
    }

    /**
     * @throws CannotInsertRecord
     * @throws Exception
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

    private function calcDriversTime()
    {
        $trips = DB::table('trips')
            ->select('driver_id', 'pickup', 'dropoff')
            ->orderBy('driver_id')
            ->orderBy('pickup')
            ->get();

        $driverTrips = [];
        foreach ($trips as $trip) {
            $driverTrips[$trip->driver_id][] = [
                'pickup' => new Carbon($trip->pickup),
                'dropoff' => new Carbon($trip->dropoff),
            ];
        }

        $totalTimeByDriver = [];

        foreach ($driverTrips as $driverId => $trips) {
            $mergedIntervals = [];
            foreach ($trips as $trip) {
                if (empty($mergedIntervals)) {
                    $mergedIntervals[] = $trip;
                } else {
                    $lastInterval = &$mergedIntervals[count($mergedIntervals) - 1];
                    if ($trip['pickup'] <= $lastInterval['dropoff']) {
                        $lastInterval['dropoff'] = max($lastInterval['dropoff'], $trip['dropoff']);
                    } else {
                        $mergedIntervals[] = $trip;
                    }
                }
            }

            $totalTimeInSeconds = 0;
            foreach ($mergedIntervals as $interval) {
                $totalTimeInSeconds += $interval['dropoff']->diffInSeconds($interval['pickup']);
            }

            $totalTimeByDriver[$driverId] = round($totalTimeInSeconds / 60, 3);
        }

        return $totalTimeByDriver;
    }
}
