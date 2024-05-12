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
}
