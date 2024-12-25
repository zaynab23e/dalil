<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    use HasFactory;

    protected $fillable=[
        'content',
        'rating',
        'image',
        'user_id',
        //'place_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}