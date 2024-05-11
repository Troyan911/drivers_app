<?php

namespace App\Http\Services;

use App\Http\Requests\CsvImportRequest;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\StreamedResponse;

interface CsvServiceContract
{
    public function parseCsv(CsvImportRequest $request): void;

    public function exportCsv(Collection $trips): StreamedResponse;

    public function removeCsv(): void;
}
