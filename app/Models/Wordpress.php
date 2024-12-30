<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wordpress extends Model
{
    use HasFactory;

    protected $fillable = [
        'baseuri',
        'username',
        'password',
        'token',
        'user_id',
    ];

    protected $casts = [
        'password' => 'encrypted',
    ];

    protected $table = 'api_wp_credentials';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
