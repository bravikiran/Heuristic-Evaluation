<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class heuristicrules extends Model
{
     protected $table = 'heuristicrules';
     protected $fillable = ['name'];

     public function titledescription(){
     	return $this->hasMany('App\titledescription','rules_id');
     }
}
