<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'note'
    ];
    public function project(){
        return $this->hasMany('App\Models\Project');
    }
}
