<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

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

    public function total()
    {
        return DB::table('trips')
            ->selectRaw('driver_id, SUM(minutes) as minutes')
            ->groupBy('driver_id')
            ->get();
    }

    public function dataForExport(): array
    {
        $drivers = Driver::withSum('trips', 'minutes')->get();
        $data[] = ['driver_id', 'total_minutes_with_passenger'];

        foreach ($drivers as $driver) {
            $data[] = [
                $driver->getAttribute('id'),
                $driver->getAttribute('trips_sum_minutes'),
            ];
        }

        return $data;
    }

    public function createDrivers($drivers): void
    {
        try {
            $this->truncateTable();
            foreach ($drivers as $driver) {
                (new Driver())->create(['id' => $driver]);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function truncateTable(): void
    {
        DB::table($this->getTable())->truncate();
    }
}
