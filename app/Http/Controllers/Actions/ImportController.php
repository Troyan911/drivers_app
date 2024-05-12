<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\CsvImportRequest;
use App\Http\Services\CsvServiceContract;
use Illuminate\Http\RedirectResponse;

class ImportController extends Controller
{
    /**
     * @return RedirectResponse
     */
    public function __invoke(CsvImportRequest $request, CsvServiceContract $service)
    {
        $service->parseCsv($request);

        return redirect()->route('trips.index');
    }
}
