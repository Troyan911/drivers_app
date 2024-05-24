<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'driver_id',
        'pickup',
        'dropoff',
    ];

    public $timestamps = false;

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public static function createTrips($rows): void
    {
        try {
            DB::table('trips')->truncate();

            foreach ($rows as $row) {
                static::create($row);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
