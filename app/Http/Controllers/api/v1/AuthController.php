<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;

class AuthController extends Controller
{
    //

public $successStatus = 200;
  
public function register(Request $request) {

 $validator = Validator::make($request->all(), [ 
              'name' => 'required',
              'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
              'password' => 'required',  
              'c_password' => 'required|same:password', 
    ]);

 if ($validator->fails()) {          
       return response()->json(['error'=>$validator->errors()], 401); 
                              }    
	   $input = $request->all();  
	   $input['password'] = bcrypt($input['password']);
	   $user = User::create($input); 
	   $success['token'] =  $user->createToken('AppName')-> accessToken;
	    $success['name'] =  $user->name;
	   return response()->json(['success'=>$success], $this-> successStatus); 
}
  
   
public function login(Request $request){

	$validator = Validator::make($request->all(), [ 
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:6'],
            ]);

            if ($validator->fails()) { 

                return response()->json(['error'=>$validator->errors()], 401);  

            }

	if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
	    $user = Auth::user(); 
	    $success['token'] =  $user->createToken('AppName')-> accessToken; 
	    return response()->json(['success' => $success], $this-> successStatus); 
	  } else { 
	    return response()->json(['error'=>'Unauthorised'], 401); 
	   } 
	}

  
public function get($id) {
	 //$user = Auth::user();
	 $user = User::find($id);
	 if (is_null($user)) {
        return response()->json(['error'=>'User not found.'], 401); 
      }
	 return response()->json(['success' => $user], $this-> successStatus); 
 }


public function update(Request $request, $id){

    $validator = Validator::make($request->all(), [ 
	      'name' => 'required',
	      //'email' => ['required', 'string', 'email', 'max:255'],
	      'password' => 'required',  
	      'c_password' => 'required|same:password', 
	 ]);

    if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
    }
    $user = User::find($id);
    $input = $request->all();
    $user->name = $input['name'];
    $user->email = $user->email;
    $user->password = bcrypt($input['password']); 
    $user->save();
    $success[] =  $user;
    return response()->json(['success'=>$success], $this-> successStatus); 
}



public function dashboard($id)
	{

	    $user = User::find($id);
	     if (is_null($user)) {
	        return response()->json(['error'=>'User not found.'], 401); 
	    }
	    $business = User::find($id)->business;
	    if (is_null($business)) {
	        return response()->json(['error'=>'Business not found.'], 401); 
	    }
	   
	    $success['success'] =  true;
	    $success['message'] =  'Request proccessed successfully';
	    $success['user'] =  $user;
	    $success['business'] =  $business;
	    return response()->json(['result'=>$success], $this-> successStatus); 
	}



}
