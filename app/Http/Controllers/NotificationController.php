<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Project;


class NotificationController extends Controller
{
    public function select(){
        
        try{
            $query =DB::table('projects')
                    ->select('projects.*')
                    ->whereNull('closureDate')
                    ->orWhereRaw(DB::raw('deadlineDate < closureDate'))
                    ->get();
            if($query->isNotEmpty()) {
                return response('You have overdue projects', 200);

            }else{

                return response('There are no late projects', 301);
            }
            
        } catch (QueryException $e) {
            if($e->errorInfo[0] == "2300" && $e->errorInfo[1]=="1062"){
                return response('SQL ERROR',501);
            }
            
        }


    }
}