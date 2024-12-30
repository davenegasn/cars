<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'featured_image',
        'description',
        'brand_id',
        'user_id',
        'wp_link',
        'wp_featured_media_id',
        'wp_status',
        'wp_id',
        'ca_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function accounts()
    {
        return $this->hasManyThrough(Account::class, User::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function attributes()
    {
        return $this->hasOne(Attribute::class);
    }

    public function equipments()
    {
        return $this->belongsToMany(Equipment::class, 'equipment_vehicles');
    }

    public function imageGallery()
    {
        return $this->hasOne(ImageGallery::class);
    }
}
