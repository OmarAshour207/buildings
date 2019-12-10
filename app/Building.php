<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'square',
        'rent',
        'rooms',
        'price',
        'meta',
        'content',
        'latitude',
        'longitude',
        'place',
        'status',
        'image',
        'user_id',
        'month',
        'year'
    ];

    protected $appends = [
        'image_path'
    ];

    public function getImagePathAttribute()
    {
        return asset('uploads/buildings_images/' . $this->image);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
