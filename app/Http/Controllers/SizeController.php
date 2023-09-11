<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index(Request $request){

        return view('administrator.variables', ['title2' => 'Sizes', 'variable' => 'Size', 'icon' => 'align-left']);
    }

    public function selectAll(){
        return Size::all();


    }
    
    public function create(Request $request){
        try{
            
            $size = new Size;
            $size->size = trim($request->size);
            return strval($size->save());

        }
         catch(QueryException $e){
            if($e->errorInfo[0] == "23000" && $e->errorInfo[1] == 1062 ){
                return response('Value already exists, try saving with another name', 405);
            }
            return response($e->getMessage(), 405);

         }
    }

    public function update(Request $request){
        try{

            return strval(Size::find($request->id)->update($request->all()));
        }catch(QueryException $e){
            if($e->errorInfo[0] == "23000" && $e->errorInfo[1] == 1062 ){
                return response('Value already exists, try saving with another name', 405);
            }
            return response($e->getMessage(), 405);

        }
    }

    public function delete(Request $request){
        try{
            return strval(Size::find($request->id)->delete());

        }
        catch(QueryException $e){
            if($e->errorInfo[0]=="23000"){
                return response('Unable to delete. This item is assigned to some project', 405);
            }
            return response($e->getMessage(), 405);
        }
        
    }

    
}
