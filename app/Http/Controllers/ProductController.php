<?php
namespace App\Http\Controllers;
use Illuminate\Database\QueryException;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){
        if(\Auth::user()->profile != 0){
            return redirect('/')->withErrors([
                'message' => 'User not access option.'
            ]);
        }

        return view('administrator.variables', ['title2' => 'Products', 'variable' => 'Product', 'icon' => 'shopping-bag']);
    }

    public function selectAll(){
        return Product::all();


    }

    public function create(Request $request){
        try{
            $product = new Product;
            $product->product = $request->product;
            return strval($product->save());
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

            return strval(Product::find($request->id)->update($request->except(['id'])));
        }catch(QueryException $e){
            if($e->errorInfo[0] == "23000" && $e->errorInfo[1] == 1062 ){
                return response('Value already exists, try saving with another name', 405);
            }
            return response($e->getMessage(), 405);

        }
    }

    public function delete(Request $request){
        try{

            return strval (Product::find($request->id)->delete());
        }
        catch(QueryException $e){
            if($e->errorInfo[0]=="23000"){
                return response('Unable to delete. This item is assigned to some project', 405);
            }
            return response($e->getMessage(), 405);
        }
    }

}

