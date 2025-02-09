<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    protected $attributes = [
        'image' => 'public/defaults/default-profile.png',
    ];

    public function getImageAttribute($value)
    {
        return $value ?: asset('public/defaults/default-profile.png');
    }

    public function routeNotificationForVonage(Notification $notification): string
    {
        return $this->phone;
    }
    public function review(){
        return $this->hasMany(Review::class);
    }

    public function favorites(){
        return $this->belongsToMany(Place::class, 'favorites', 'user_id', 'place_id');
    }

    public function ratings(){
        return $this->hasMany(Rating::class);
    }

    public function location(){
        return $this->hasOne(UserLocation::class);
    }
}
