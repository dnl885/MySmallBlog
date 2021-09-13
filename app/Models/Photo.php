<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    const PHOTO_DIR = "/uploads/photos/";

    protected $fillable = [
        'path'
    ];

    public function imageable(){
        return $this->morphTo();
    }

    public function getPathAttribute($value){
            return self::PHOTO_DIR.$value;
    }
}
