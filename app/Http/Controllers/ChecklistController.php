<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Checklist;
use App\Models\Project;
use App\Models\User;

class ChecklistController extends Controller
{
    public function index(Request $request){

        $checklists = Checklist::all();
        $users = User::all();
        $projects = Project::all();
        return view('projects.checklists',['users'=>$users ,'checklists'=>$checklists,'projects'=>$projects,'title2' => 'Checklists', 'variable' => 'Checklist', 'icon' => 'align-left']);

    }
    public function selectAll(Request $request){
        if(isset($request->id)|| $request->id !=null){

            $projectId = $request->id;
            return DB::table('checklists')
            ->join('users','users.id','=','checklists.id_user')
            ->join('projects','projects.id','=','checklists.id_project')
            ->select('checklists.*','projects.project','users.name')
            ->where('id_project', '=', $projectId)
            ->get();
        }
        else{
            return ;
        }
    }
    public function create(Request $request){
        $datas = collect($request->all());
        $collection =$datas->except(array('clDateChecklist','idChecklist'))->filter(function($value){
         
            return is_null($value);
        });
        
        
        try{
            
            if($collection->isNotEmpty()){
                return response("Some of the fields are empty",400); 
                
             }
            

            if(strlen($request->activityChecklist)>=21){
                return response("Any of the fields exceded the character limit",401);
            }


        
            

            

            // Project::validateForm($collection);
            // Project::verifyDescription($request->description);
            $checklist = new Checklist();
            $checklist->checklist = $request->checklist;
            $checklist->id_project = $request->projectChecklist;
            $checklist->id_user = $request->userChecklist;
            $checklist->activity = $request->activityChecklist;
            $checklist->deadlineDate = $request->ddDateChecklist;
            $checklist->closureDate = $request->clDateChecklist;
            return strval($checklist->save());

        }
        catch(QueryException $e){
            if($e->errorInfo[0]=="23000" && $e->errorInfo[1] == 1062){
                return response('Value already exists, try saving with another name', 405);
            }
            if($e->errorInfo[0] === 1406 ){
                return response( "Any of the fields exceeded the character limit.", 400);
            }
        }
    } 
    public function update(Request $request){
        $datas = collect($request->all());
        $collection =$datas->except(array('clDateChecklist','idChecklist'))->filter(function($value){
         
            return is_null($value);
        });

        try{



            if($collection->isNotEmpty()){
                return response("Some of the fields are empty",400); 
            }

            if(strlen($request->activityChecklist)>=21){
            return response( "Any of the fields exceeded the character limit.", 400);
            
            }





            $checklist = Checklist::find($request->idChecklist);
            $checklist->id_project = $request->projectChecklist;
            $checklist->id_user = $request->userChecklist;
            $checklist->activity = $request->activityChecklist;
            $checklist->deadlineDate = $request->ddDateChecklist;
            $checklist->checklist = $request->checklist;
            $checklist->closureDate = $request->clDateChecklist;

            return strval($checklist->update());
        }catch(\Exception $e){
            return response("Empty fields",400);
        } catch (QueryException $ex) {
            // Tratar o erro aqui
            return response( "The field cannot be longer than 50 characters.", 500);
        }


   
    }
    public function delete(Request $request){
        try{
            return strval(Checklist::find($request->id)->delete());

        }
        catch(QueryException $e){
            if($e->errorInfo[0]=="23000" && $e->errorInfo[1] == 1062){
                return response('Value already exists, try saving with another name', 405);
        }
        return response($e->getMessage(), 405);
        }
    }
}