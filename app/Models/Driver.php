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

    public static function dataForExport(): array
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

    public static function createDrivers($drivers): void
    {
        try {
            DB::table('drivers')->truncate();
            foreach ($drivers as $driver => $time) {
                static::create(['id' => $driver, 'minutes' => $time]);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
