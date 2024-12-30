<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleYear extends Model
{
    protected $table = 'years';

    protected $fillable = [
        'year',
        'wp_id'
    ];
}
