<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Customer;
use App\Models\Checklist;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Controllers\DashboardController;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseStatusCodeSame;

class ReportController extends Controller
{
    public function index(Request $request, $uuid){
        $query = $this->customer($uuid);
        $responsibles =User::all();
        
        $projects = Project::all();
        $status = Status::all();

        $indentify = DB::table('projects')
        ->select('projects.*')
        ->where('uuid','=',$uuid)
        ->get()
        ->first();
        $id = $indentify->id;
    
        return view('manager.reports',[
            'uuid'=>$uuid,
            'responsibles'=>$responsibles,
            'status'=>$status,
            'project'=>$indentify->project
        ]);
    }

    //table
    public function customer($uuid){
        $query = DB::table('projects')
        ->join('status','status.id','=','projects.id_status')
        ->join('sizes','sizes.id','=','projects.id_size')
        ->join('products','products.id','=','projects.id_product')
        ->join('contacts','contacts.id','=','projects.id_contact')
        ->join('users','users.id','=','projects.id_user')
        ->select('projects.*','sizes.size' ,'users.name','contacts.contact','products.product','status.status')
        ->where('uuid','=', $uuid);
        return $query->get();
    }

    public function notesFilter($uuid){
        
      $indentifyProject = DB::table('projects')
      ->select('projects.*')
      ->where('uuid','=',$uuid)
      ->get()->first();
        $id = $indentifyProject->id;



        $query = DB::table('notes')
        ->join('projects','projects.id','=','notes.id_project')
        // ->join('customers','customer.id','=','projects.id_customer')
        ->select(DB::raw('notes.*,DATE_FORMAT(notes.created_at,"%m-%d-%Y") as formatCreated, projects.project'))
        // ->select('notes.*,projects.project,DATE_FORMAT(notes.created_at,"%m-%d-%Y") as formatCreated')
        ->where('projects.id','=',$id);
        
        return $query->get();

    }

    public function deadlinesFilter($uuid){
        $indentify = DB::table('projects')
        ->select('projects.*')
        ->where('uuid','=',$uuid)
        ->get()
        ->first();
        $id = $indentify->id;


        $query = DB::table('checklists')
        ->join('projects','projects.id','checklists.id_project')
        ->join('users','checklists.id_user','=','users.id')
        ->select(DB::raw('checklists.*,DATE_FORMAT(checklists.deadlineDate,"%m-%d-%Y") as formatDeadline, projects.project,users.name'))
        ->where('projects.id','=',$id)
        ->orderBy('formatDeadline','asc');
        return $query->get();




    }
    
    public function projectsStatusDatas($id){
        $idCustomer = $this->customer($id);
        
        $statuses = DB::table('projects')
        ->select(DB::raw('status.status as label,COUNT(projects.project) as total'))
        ->join('status','status.id','=','projects.id_status')
        ->where('projects.id_customer','=',$idCustomer);
        return $statuses->get();

        
    }



    public function statusReports($uuid){
        $currentDate = Carbon::now()->startOfDay();
        
        $indentify = DB::table('projects')
        ->select('projects.*')
        ->where('uuid','=',$uuid)
        ->get()
        ->first();
        $id = $indentify->id;





        $checklist = DB::table('checklists')
        ->where('id_project','=',$id)
        ->select(DB::raw('checklists.*,DATE_FORMAT(checklists.deadlineDate,"%m/%d/%Y") as formatDeadline'))
        ->orderBy('formatDeadline','asc')
        ->get();
        // dd($checklist->last());?
        if($checklist->last()->checklist == 2){
            return Response(['statusProject'=>'550'], 200);//no prazo
        }


        $check = null;
        //conta quantos checks tem no total e verifica se e é mesma quantidade dos checks feitos
        if($checklist->count() == $checklist->where('checklist','=',2)->count()){
            $check = $checklist->last();
           
        }else{
            $check = $checklist->where('checklist','<>',2)->first();
        }

        // // dd($onTime);
        // if($checklist->count() == $checklist->where('checklist','=',2)->count()){

        //     return response('projeto esta adiantado');
        // }
        if($currentDate->greaterThan($check->formatDeadline)){
            
            return response(['statusProject'=>'100'],200);//atrasado
        }elseif($currentDate->lessThan($check->formatDeadline)){
            
            return response(['statusProject'=>'850'],200);//adiantado
        }else{
            return Response(['statusProject'=>'550'], 200);//no prazo
        }
        
        
    

        

        // Última data de entrega com status 2 é posterior à data de hoje
    // Faça algo aqui
    } 
        


}



    // public function uuidVerification(){
    

    //         // Busca todos os customers que tem o campo uuid vazio
    //         $projects = Project::whereNull('uuid')->get();
            
    //         // Percorre cada customer e adiciona um UUID4
    //         foreach ($projects as $project) {
    //             $project->uuid = Uuid::uuid4();
    //             $project->save();
    //         }
    //         return true;
    // }

   

    
