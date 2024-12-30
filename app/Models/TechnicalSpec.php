<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicalSpec extends Model
{
    /** @use HasFactory<\Database\Factories\TechnicalSpecFactory> */
    use HasFactory;

    protected $table = 'technical_specs';

    protected $fillable = [
        'name',
        'slug',
    ];

    const TRACCION = 'traccion';

    public function options()
    {
        return $this->hasMany(TechnicalSpecsOptions::class, 'technical_spec_id');
    }

    public function traccion()
    {
        return $this->hasMany(TechnicalSpecsOptions::class, 'technical_spec_id')->where('slug', self::TRACCION);
    }
}
