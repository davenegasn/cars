<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnicalSpecsOptions extends Model
{
    protected $table = 'technical_specs_options';

    protected $fillable = [
        'option',
        'technical_spec_id',
    ];

    public function techicalSpec()
    {
        return $this->belongsTo(TechnicalSpec::class, 'technical_spec_id');
    }
}
