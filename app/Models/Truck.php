<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    protected $fillable = ['unit_number', 'year', 'notes'];
    // A truck can have many subunits
    public function subunits()
    {
        return $this->belongsToMany(Truck::class, 'truck_subunits', 'main_truck', 'subunit')
            ->withPivot('start_date', 'end_date')
            ->withTimestamps();
    }

    // A truck can also be a subunit to many main trucks
    public function mainTrucks()
    {
        return $this->belongsToMany(Truck::class, 'truck_subunits', 'subunit', 'main_truck')
            ->withPivot('start_date', 'end_date')
            ->withTimestamps();
    }
}
