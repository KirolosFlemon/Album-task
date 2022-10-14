<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'photo',
        'album_id'
    ];

    public function photos(){
        return $this->belongsTo(Album::class);
    }
}
