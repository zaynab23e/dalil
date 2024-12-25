<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'map_disc',
        'longitude',
        'latitude',
        'rating',
        'open_at',
        'close_at',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(PlaceImage::class);
    }
    // public function reviews()
    // {
    //     return $this->hasMany(Review::class);
    // }
}
