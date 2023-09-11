<?php
namespace App\Http\Controllers;
use Illuminate\Database\QueryException;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index(Request $request){


        return view('administrator.variables', ['title2' => 'Status', 'variable' => 'Status', 'icon' => 'flag']);
    }

    public function selectAll(){
        return Status::all();


    }

    public function create(Request $request){
        try{

            $status = new Status;
            $status->status = $request->status;
            return strval($status->save());
        }catch(QueryException $e){
            if($e->errorInfo[0] == "23000" && $e->errorInfo[1] == 1062 ){
                return response('Value already exists, try saving with another name', 405);
            }
            return response($e->getMessage(), 405);

        }
    }

    public function update(Request $request){
        try{

            return strval(Status::find($request->id)->update($request->except(['id'])));
        }catch(QueryException $e){
            if($e->errorInfo[0] == "23000" && $e->errorInfo[1] == 1062 ){
                return response('Value already exists, try saving with another name', 405);
            }
            return response($e->getMessage(), 405);

        }
    }

    public function delete(Request $request){
        try{

            return strval(Status::find($request->id)->delete());
        }
        catch(QueryException $e){
            if($e->errorInfo[0]=="23000"){
                return response('Unable to delete. This item is assigned to some project', 405);
            }
            return response($e->getMessage(), 405);
        }
    }

}

?>