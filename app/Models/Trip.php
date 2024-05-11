<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'driver_id',
        'pickup',
        'dropoff',
        'minutes',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false;

    public function createTrips($records): void
    {
        try {
            $this->truncateTable();
            foreach ($records as $record) {
                $minutes = (strtotime($record['dropoff']) - strtotime($record['pickup'])) / 60;
                $record['minutes'] = round($minutes, 2);
                $this::create($record);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    private function truncateTable(): void
    {
        DB::table($this->getTable())->truncate();
    }
}
