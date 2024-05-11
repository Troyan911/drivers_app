<?php

namespace Tests\Unit;

use App\Http\Services\CsvService;
use App\Http\Services\CsvServiceContract;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CsvServiceTest extends TestCase
{
    protected CsvService $service;

    private $filePath = 'drivers.csv';

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(CsvServiceContract::class);
    }

    /**
     * A basic unit test example.
     */
    public function test_export_csv(): void
    {
        $this->service->removeCsv();
        $this->assertFalse(Storage::has($this->filePath));

        //Convert to collection of stdClass objects
        $trips = collect(
            [
                json_decode(json_encode(['driver_id' => '111', 'minutes' => '11'])),
                json_decode(json_encode(['driver_id' => '222', 'minutes' => '22'])),
                json_decode(json_encode(['driver_id' => '333', 'minutes' => '33'])),
            ]
        );

        $this->service->exportCsv($trips);
        $content = Storage::get($this->filePath);

        foreach ($trips as $trip) {
            $this->assertStringContainsString($trip->driver_id, $content);
            $this->assertStringContainsString($trip->minutes, $content);
        }
        $this->assertTrue(Storage::has($this->filePath));
        $this->service->removeCsv($this->filePath);
    }
}
