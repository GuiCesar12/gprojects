<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request){


        return view('administrator.variables', ['title2' => 'Contacts', 'variable' => 'Contact', 'icon' => 'phone']);
    }

    public function selectAll(){
        return  Contact::all();


    }

    public function create(Request $request){
        try{

            $contact = new Contact;
            $contact->contact = $request->contact;
            return strval($contact->save());
        }catch(QueryException $e){
            if($e->errorInfo[0] == "23000" && $e->errorInfo[1] == 1062 ){
                return response('Value already exists, try saving with another name', 405);
            }
            return response($e->getMessage(), 405);

        }
        
    }

    public function update(Request $request){
        try{

            return strval(Contact::find($request->id)->update($request->except(['id'])));
        }catch(QueryException $e){
            if($e->errorInfo[0] == "23000" && $e->errorInfo[1] == 1062 ){
                return response('Value already exists, try saving with another name', 405);
            }
            return response($e->getMessage(), 405);

        }
    }

    public function delete(Request $request){
        try{
            return strval(Contact::find($request->id)->delete());

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