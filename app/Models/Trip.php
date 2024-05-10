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
        'seconds',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false;

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function createTrips($records)
    {
        try {
            DB::table($this->getTable())->truncate();
            foreach ($records as $record) {
                $seconds = strtotime($record['dropoff']) - strtotime($record['pickup']);
                $record['seconds'] = $seconds;
                $this::create($record);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
//            redirect()->route('error', $e);
        }
    }
}
