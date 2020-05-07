<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=["name", "number_in_stock"];

    public function tags(){
    	return $this->belongsToMany("App\Tag");
    }
    public function images(){
    	return $this->hasMany("App\Image");
    }
}
