<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index(){


        return view('administrator.users');
    }
    
    public function create(Request $request){
        try{
            $collection = collect($request->all())->except(array('id'))->filter(function($value){
         
                return is_null($value);
            });
            $user = new User;
            $user->name = $request->name;
            $existingUser = User::where('email', $request->email)->first();
            


        if ($existingUser) {
            return response('E-mail already exists', 400);
        }


            $user->email = $request->email;
            
            if($request->profile > 2){
                
                
                return ['msg','Invalid Profile'];
            }

            if($collection->isNotEmpty()){
                return response("Some of the fields are empty",400);
            }


            $user->profile = $request->profile;
            if($request->password == null){
                throw new \Exception('Empty fields');
            }
            $user->password = bcrypt($request->password);
            return strval($user->save());
        }catch(\Exception $e){
            return response('Empty fields',400);
        }
        
    }

    public function alterPass(Request $request){
        try{
            if($request->confirmNewPassword == null || $request->newPassword == null){
                throw new \Exception('Some of the fields are empty',406);
            }

            if($request->confirmNewPassword != $request->newPassword){
                throw new \Exception('Password invalid!', 405);
            }    

            $pass = User::find($request->id);
            $newPassword = bcrypt($request->newPassword);
            $pass->password = $newPassword;
            return strval($pass->update());
        }catch(\Exception $e){
            return response ($e->getMessage(),401);
        }
    }
    
    public function allUsers(){
        return User::all();

    }
    public function alterStatus(Request $request){
        try{
            if($request->status != 1 && $request->status != 0){
                throw new \Exception('Value not valid');
            }
             $status = $request->status == 1 ? 0 : 1;
            return strval(User::find($request->id)->update(['status' => $status]));
        }catch(\Exception $e){
            return response($e->getMessage(), 405);
           }

    }
    public function alterUser(Request $request){
        try{
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->profile = $request->profile;
            $user->status = $request->status;
            return strval($user->update());
    
        }catch(\Exception $e){
            return response($e->getMessage(),405);
        }
    }


}   

