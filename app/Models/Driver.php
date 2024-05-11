<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
    ];

    public $timestamps = false;

    public function trips(): Collection
    {
        return DB::table('trips')
            ->selectRaw('driver_id, SUM(minutes) as minutes')
            ->groupBy('driver_id')
            ->get();
    }
}
