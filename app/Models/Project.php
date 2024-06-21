<?php

namespace App\Models;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class Project extends Model
{

    protected $fillable = [
        'project',
        'description',
        'id_user',
        'id_status',
        'id_size',
        'id_product',
        'id_contact',
        'id_customer',
        'deadlineDate',
        'beginDate',
        'closureDate',
    ];


    // use HasFactory;
    public function size(){
        return $this->hasMany('App\Models\Size');
    }
    public function status(){
        return $this->hasMany('App\Models\Status');
    }
    public function customer(){
        return $this->hasMany('App\Models\Customer');
    }
    public function contact(){
        return $this->hasMany('App\Models\Contact');
    }
    public function product(){
        return $this->hasMany('App\Models\Product');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function note(){
        return $this->belongsTo('App\Models\Note');
    }
    public static function verifyDescription($parameters){
    
        if(strlen($parameters) >= 501){
            return response("The field 'description' exceeded the character limit.",401);
        }
    }

    public static function validateForm($parameters){
        // dd($parameters->isEmpty());
        if(empty($parameters)){
            throw new \Exception('Empty fields',400);
        }
        return true;
        
    }
    public static function indentifyProject($uuid){
        $indentify = DB::table('projects')
        ->select('projects.*')
        ->where('uuid','=',$uuid)
        ->get()
        ->first();
        return $indentify;
    }
    public static function generateUuidForProjects()
    {
        // Busca todos os customers que tem o campo uuid vazio
        $projects = self::whereNull('uuid')->get();

        // Percorre cada customer e adiciona um UUID4
        foreach ($projects as $project) {
            $project->uuid = Uuid::uuid4();
            $project->save();
        }
        return true;

    }
    
}
