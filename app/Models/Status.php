<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    // use HasFactory;
    protected $fillable = [
        'status'
    ];
    protected $table = 'status';
    public function project(){
        return $this->belongsTo('App\Models\Project');
    }
}
