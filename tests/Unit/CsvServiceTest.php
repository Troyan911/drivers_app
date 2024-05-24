<?php

namespace Tests\Unit;

use App\Http\Services\CsvService;
use App\Http\Services\CsvServiceContract;
use App\Models\Driver;
use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;
use Tests\TestCase;

class CsvServiceTest extends TestCase
{
    use RefreshDatabase;

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

        $data = [
            ['driver', 'time'],
            ['111', '11'],
            ['222', '22'],
            ['333', '33'],
        ];
        $this->service->exportCsv($data);
        $content = Storage::get($this->filePath);

        foreach ($data as $row) {
            $this->assertStringContainsString($row[0], $content);
            $this->assertStringContainsString($row[1], $content);
        }
        $this->assertTrue(Storage::has($this->filePath));
        $this->service->removeCsv($this->filePath);
    }

    public function test_calculate_drivers_time()
    {
        $driverTime = ['id' => 81, 'minutes' => 21.033];

        Storage::fake('local');

        $csv = Writer::createFromString('');
        $csv->insertOne(['id', 'driver_id', 'pickup', 'dropoff']);

        $trips = [
            ['3558805', '26', '2020-11-20 09:40:05', '2020-11-20 09:49:47'],
            ['3562420', '26', '2020-11-20 13:55:51', '2020-11-20 14:17:49'],
            ['3559673', '81', '2020-11-20 12:51:26', '2020-11-20 12:57:58'],
            ['3562885', '81', '2020-11-20 12:52:26', '2020-11-20 12:58:58'],
            ['3566737', '81', '2020-11-20 10:17:15', '2020-11-20 10:30:45'],
        ];

        $csv->insertAll($trips);

        $csvContent = $csv->toString();
        $csvFile = UploadedFile::fake()->createWithContent('test.csv', $csvContent);

        $response = $this->post(route('import.csv'), [
            'csv_file' => $csvFile,
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas(Trip::class, [
            'id' => $trips[0][0],
            'driver_id' => $trips[0][1],
        ]);

        $this->assertDatabaseHas(Driver::class, [
            'id' => $driverTime['id'],
            'minutes' => $driverTime['minutes'],
        ]);
    }
}
