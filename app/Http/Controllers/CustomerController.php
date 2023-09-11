<?php
namespace App\Http\Controllers;
use Illuminate\Database\QueryException;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request){
        return view('administrator.variables', ['title2' => 'Customers', 'variable' => 'Customer', 'icon' => 'users']);
    }

    public function selectAll(){
        return Customer::all();
    }

    public function create(Request $request){
        try{

            $customer = new Customer;
            $customer->customer = $request->customer;
            return strval($customer->save());
        }catch(QueryException $e){
            if($e->errorInfo[0] == "23000" && $e->errorInfo[1] == 1062 ){
                return response('Value already exists, try saving with another name', 405);
            }
            return response($e->getMessage(), 405);

        }
    }

    public function update(Request $request){
        try{

            return strval (Customer::find($request->id)->update($request->except(['id'])));
        }catch(QueryException $e){
            if($e->errorInfo[0] == "23000" && $e->errorInfo[1] == 1062 ){
                return response('Value already exists, try saving with another name', 405);
            }
            return response($e->getMessage(), 405);

        }
    }

    public function delete(Request $request){
        try{

            return strval(Customer::find($request->id)->delete());
        }
        catch(QueryException $e){
            if($e->errorInfo[0]=="23000"){
                return response('Unable to delete. This item is assigned to some project', 405);
            }
            return response($e->getMessage(), 405);
        }
    }

}
