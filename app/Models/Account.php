<?php

namespace App\Models;

use App\Models\User;
use App\Models\Vehicle;

class Account extends User
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicles()
    {
        return $this->hasManyThrough(Vehicle::class, User::class);
    }
}
