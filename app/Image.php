<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable=['name'];
    public $timestamps=false;

    public function image(){
    	return $this->belongsTo("App\Product");
    }
    
}
