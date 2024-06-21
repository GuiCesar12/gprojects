<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Checklist extends Model
{
    protected $fillable = [
        'activity',
        'id_project',
        'id_user',
        'closureDate',
        'deadlineDate',
        'checklist',
    ];
    
}
