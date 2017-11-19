<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    //
    protected $table = 'genre_tbl';
    public $timestamps = false;
    protected $primaryKey = 'genre_id';

    public function films()
    {
        return $this->belongsToMany(Film::class,'film_genre','film_id','genre_id');
    }
}
