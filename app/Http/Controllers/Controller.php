<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    // protected $id;
    // public function __construct()
    // {
    //     parent::__construct();

    //     if(request()->input('uuid')){
    //         $uuid = request()->input('uuid');
    //         $indentify = \DB::table('projects')
    //         ->select('projects.*')
    //         ->where('uuid','=',$uuid)
    //         ->get()
    //         ->first();
    //         $this->id = $indentify->id;
    //     }
    // }
}
