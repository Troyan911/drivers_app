<?php

namespace App\Http\Services;

use App\Http\Requests\CsvImportRequest;
use Symfony\Component\HttpFoundation\StreamedResponse;

interface CsvServiceContract
{
    public function parseCsv(CsvImportRequest $request): void;

    public function exportCsv($data): StreamedResponse;

    public function removeCsv(): void;
}
