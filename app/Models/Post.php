<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content'
    ];

    public function getCreatedAtAttribute(string $value):string
    {
        $Date = date_create($value);
        return $Date->format('m/d/Y H:i')." (".Carbon::createFromTimestamp(strtotime($value))->diffForHumans().")";
    }

    public function getUpdatedAtAttribute(string $value):string
    {
        $Date = date_create($value);
        return $Date->format('m/d/Y H:i')." (".Carbon::createFromTimestamp(strtotime($value))->diffForHumans().")";
    }

    public function photo(){
        return $this->morphOne(Photo::class,'imageable');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function editor(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //Examples
    //Query Scoping example
    /*public static function scopeLatest2($query){
        return $query->orderBy('id','asc');
    }*/

/*    Mutation
    public function setTitleAttribute(string $value):void{
        $this->attributes['title'] = strtoupper($value);
    }*/
}
