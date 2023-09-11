<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use App\Models\Project;
use App\Models\Status;
use App\Models\Size;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Contact;
use App\Models\Checklist;
use App\Models\Note;
use App\Models\User;
use Exception;
use SebastianBergmann\CodeCoverage\Report\Xml\Project as XmlProject;

class ProjectController extends Controller
{
    public function index(Request $request){

        $users = User::all()->where('profile','=', User::PROFILE_PROJECTS);
        $status = Status::all();
        $sizes = Size::all();
        $products = Product::all();
        $customers = Customer::all();
        $contacts = Contact::all();
        $checklists = Checklist::all();
        $notes = Note::all();
        $usersCheck = User::all();
        $projects = Project::all();
        $responsibles = DB::table('projects')
        ->join('users','users.id','=','projects.id_user')
        ->select('projects.id_user','users.name')
        ->get();

        return view('projects.projects', ['title2' => 'Projects',
                    'project' => 'Project',
                     'icon' => 'phone',
                     'status'=> $status,
                     'sizes'=>$sizes,
                     'products'=>$products,
                     'contacts'=>$contacts,
                     'checklists'=>$checklists,
                     'notes'=>$notes,
                     'projects'=>$projects,
                     'usersCheck'=>$usersCheck,
                     'customers'=>$customers,
                     'responsibles' => $responsibles,
                     'users'=>$users]);
    }
    public function selectAll(Request $request){
        $table = DB::table('projects')
            ->join('status','status.id','=','projects.id_status')
            ->join('sizes','sizes.id','=','projects.id_size')
            ->join('products','products.id','=','projects.id_product')
            ->join('contacts','contacts.id','=','projects.id_contact')
            ->join('customers','customers.id','=','projects.id_customer')
            ->join('users','users.id','=','projects.id_user')
            ->select(DB::raw('projects.*,sizes.size ,users.name,contacts.contact,products.product,customers.customer,status.status,DATE_FORMAT(projects.closureDate,"%m-%d-%Y") as formatClosure, DATE_FORMAT(projects.deadlineDate,"%m-%d-%Y") as formatDeadline ,DATE_FORMAT(projects.beginDate,"%m-%d-%Y") as formatBegin'));
            foreach($request->all() as $field=>$value){
                if(is_numeric($value)){
                    $table = $table->whereIn("projects.".$field, [$value]);
                }
            }
        return $table->get();
    }

 

    public function create(Request $request){

        $datas = collect($request->all());
        $collection =$datas->except(array('clDate','id'));
        

        
        //array vazaio
        try{
            // Project::validateForm($collection);
            // Project::verifyDescription($request->description);
            // if($request->beginDate < $request->closureDate || $request->beginDate<$request->deadlineDate){
            //     return response('Regras de datas estão invalidas',401);
            // }
            //se o array for vazio ele retorna true
                
                if($collection->isEmpty()){
                    return response("Fill the form",400);
                }
                
                foreach($collection as $key=>$value){
                    
                    if($value === null){
                        return response("Empty fields",401);
                    }
                }
                
                if(strlen($request->description) >=501 ){
                return response( "Any of the fields exceeded the character limit.", 400);
                
                }

                $clDate = Carbon::parse($request->clDate);
                $bgDate = Carbon::parse($request->bgDate);
                $ddDate = Carbon::parse($request->ddDate);

                if($bgDate->greaterThan($clDate)){
                    return response("You cannot put the start date after the end date.",400);
                }
                if($bgDate->greaterThan($ddDate)){
                    return response("A project cannot be created with the deadline before the start",400);
                }

                if($clDate->greaterThan($ddDate)){
                    return response("A project cannot be created, with the delivery being late",400);
                }
                



            $project = new Project;
            $project->project = $request->project;
            $project->description = $request->description;
            $project->id_status = $request->status;
            $project->id_customer = $request->customer;
            $project->id_product = $request->product;
            $project->id_size = $request->size;
            $project->id_contact = $request->contact;
            $project->id_user = $request->user;
            $project->beginDate = $request->bgDate;
            $project->closureDate = $request->clDate;
            $project->deadlineDate = $request->ddDate;
            $project->uuid = Uuid::uuid4();
            return strval($project->save());
        
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
        $collection =$datas->except(array('clDate'))->filter(function($value){
         
            return is_null($value);
        });

        
        try {
            // Valide o parâmetro antes de executar a consulta
            
            
            if($collection->isNotEmpty()){
               return response("Some of the fields are empty",400); 
               
            }
            
            if(strlen($request->description) >=501 ){
            return response( "Any of the fields exceeded the character limit.", 400);
            
            }


            $clDate = Carbon::parse($request->clDate);
            $bgDate = Carbon::parse($request->bgDate);
            $ddDate = Carbon::parse($request->ddDate);

            if($bgDate->greaterThan($clDate)){
                return response("You cannot put the start date after the end date.",400);
            }
            if($bgDate->greaterThan($ddDate)){
                return response("A project cannot be changed with the deadline before the start",400);
            }




            $project = Project::find($request->id);
            $project->project = $request->project;
            $project->description = $request->description;
            $project->id_status = $request->status;
            $project->id_customer = $request->customer;
            $project->id_product = $request->product;
            $project->id_size = $request->size;
            $project->id_contact = $request->contact;
            $project->id_user = $request->user;
            $project->beginDate = $request->bgDate;
            $project->closureDate = $request->clDate;
            $project->deadlineDate = $request->ddDate;
            // dd($project);
            return strval($project->update());
        }
        catch (QueryException $ex) {
            if($ex->errorInfo[0] === 1406 ){
                return response( "Any of the fields exceeded the character limit.", 401);
            }
        
        }catch(\Exception $e) {
            return response ('Empty Fields',400);}
        
    }

    public function delete(Request $request){
        try{
            return strval(Project::find($request->id)->delete());

        }
        catch(QueryException $e){
            if($e->errorInfo[0]=="23000"){
                return response('Unable to delete the project. There are Checklists and Notes assigned to it.', 405);
            }
            return response($e->getMessage(), 405);
        }
    }

    





}