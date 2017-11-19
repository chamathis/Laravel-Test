<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = 'films_tbl';
    public $timestamps = false;
    protected $primaryKey = 'film_id';

    public function genres()
    {
        return $this->belongsToMany(Genre::class,'film_genre','film_id','genre_id');
    }


}

