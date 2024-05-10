<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Exception;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
    ];

    public $timestamps = false;

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }

    public function dataForExport()
    {
        $drivers = Driver::withSum('trips', 'seconds')->get();
        $data[] = ['driver_id', 'total_minutes_with_passenger'];

        foreach ($drivers as $driver) {
            $data[] = [
                $driver->getAttribute('id'),
                $driver->getAttribute('trips_sum_seconds') / 60,
            ];
        }

        return $data;
    }

    public function createDrivers($drivers)
    {
        try {
            DB::table((new Driver)->getTable())->truncate();
            foreach ($drivers as $driver) {
                (new Driver())->create(['id' => $driver]);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
