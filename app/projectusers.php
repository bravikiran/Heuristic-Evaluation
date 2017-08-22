<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class projectusers extends Model
{
    protected $table = 'projectusers';

    public function projectusers(){
    	 return $this->belongsTo('App\projectlist');
    }
}
