<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Project;
use App\Models\Status;
use App\Models\Customer;
use App\Models\Contact;
use Hamcrest\Core\HasToString;

class DashboardController extends Controller
{
    public function index(){
        $contacts = Contact::all();
        $customers = Customer::all();
        

        $responsibles = DB::table('projects')
        ->join('users','users.id','=','projects.id_user')
        ->select('projects.id_user','users.name')
        ->get();
        
        
        // array_push($deadlineArray,$last->year.'-'.$last->month.'-'.$last->day);
        //grafico-status
        //contar quantos projetos tem em cada status
        $status = Status::all();
        // foreach($status as $dados){
        //     $statusArray[] = $dados->status;
        // }
        // $concluded = DB::table('projects')
        // ->select(DB::raw('status.status,COUNT(projects.project) as total'))
        // ->join('status','status.id','=','projects.id_status')
        // ->groupBy('status.status')
        // ->get();
        // foreach($concluded as $dados){
        //     $total[] = $dados->total;
        // }
        // $totalLabel = "'Status'";
        // $totalStt = implode(',',$total);
            $deadlineArray = [];
            $statusArray = [];
            $total = [];
            $totalLabel = [];
            $year = "";
            $deadlineTotal = [];
            $totalStt = "";

            
        return view('manager.dashboard',
                    ['deadlineArray'=>$deadlineArray,
                    'title2' => 'Dashboard',
                    'stt'=>$statusArray,
                    'total'=>$total,
                    'customers'=>$customers,
                    'responsibles'=>$responsibles,
                    'contacts'=>$contacts,
                    'totalDeadline'=>$deadlineTotal,
                    'totalLabel'=>$totalLabel,
                    'year'=>$year,
                    'status'=>$status,
                    'totalStt'=>$totalStt]);

    }

    public function projectsStatusDatas(Request $request ){
        //contar quantos projetos tem em cada status
        $concluded = DB::table('projects')
        ->select(DB::raw('status.status as label,COUNT(projects.project) as total'))
        ->join('status','status.id','=','projects.id_status');
        
        foreach($request->all() as $field => $value){
            if(is_numeric($value)){
                $concluded = $concluded->whereIn("projects.".$field, [$value]);
            }
        }

        return $concluded->groupBy('status.status')
        ->get();
    }
 
    public function projectsDeadlineDatas(Request $request){
        // grafico-all-deadlineDate
        $dt = Carbon::parse('America/Sao_Paulo');
        $year = $dt->year;
        $month = $dt->month;
        $deadline = DB::table('projects')
        ->select(DB::raw('projects.deadlineDate as label,COUNT(projects.deadlineDate) as total '))
        ->whereMonth('deadlineDate','=',$month);
        foreach($request->all() as $field=>$value){
            if(is_numeric($value)){
                $deadline = $deadline->whereIn("projects.".$field,[$value]);
            }
        }

        return $deadline->groupBy('projects.deadlineDate')->orderBy('projects.deadlineDate','asc')->get();

        
    }
    public function projectsDeliveryDatas(Request $request){
        $dt = Carbon::parse('America/Sao_Paulo');
        $month = $dt->subDays(15);
        $delivery = DB::table('projects')
        ->select(DB::raw('projects.closureDate as label,COUNT(projects.closureDate) as total '))
        ->whereMonth('closureDate','=',$month);
        foreach($request->all() as $field=>$value){
            if(is_numeric($value)){
                $delivery = $delivery->whereIn("projects.".$field,[$value]);
            }
        }

        return $delivery->groupBy('projects.closureDate')->orderBy('projects.closureDate','asc')->get();

        

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
        foreach($request->all() as $field=>$value ){
            if(is_numeric($value)){
                $table = $table->whereIn("projects.".$field,[$value]);
            }
        }
        return $table->get();
        
    }
}
