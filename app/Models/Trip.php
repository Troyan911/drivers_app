<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
