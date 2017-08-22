<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class projectlist extends Model
{
    protected $table  = 'projectlist';
  
    public function getprojectusers()
    {
    	return $this->hasMany('App\projectusers');
    }

    public function getProjectById()
    {
    	return $this->find($id)->get();
    }
}
