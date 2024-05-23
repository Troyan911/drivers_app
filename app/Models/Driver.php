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
        'minutes',
    ];

    public $timestamps = false;

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }

    public function dataForExport(): array
    {
        $drivers = Driver::all();

        $data[] = ['driver_id', 'total_minutes_with_passenger'];
        foreach ($drivers as $driver) {
            $data[] = [
                $driver->id,
                $driver->minutes,
            ];
        }

        return $data;
    }

    public function createDrivers($drivers): void
    {
        try {
            $this->truncateTable();
            foreach ($drivers as $driver => $time) {
                $this::create(['id' => $driver, 'minutes' => $time]);
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
