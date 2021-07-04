<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(){
        if(Auth::user()){
             return '<h1>Already Login</h1>';   
        }else{
            return view('admin.auth.login');
        }
    }

    public function doLogin(Request $request){
        $this->validate($request,[
	        'email' => 'required|email',
	        'password' => 'required',
	    ]);

        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return response()->json(['response'=>['ResponseCode'=>0,'ResponseStatus'=>422,'ResponseText'=>'Invalid Credential']], 200);
        }
        if(!Auth::user()->hasRole('admin')){
            return response()->json(['response'=>['ResponseCode'=>0,'ResponseStatus'=>422,'ResponseText'=>'Invalid Credential']], 200);
        }
        return response()->json(['response'=>['ResponseCode'=>1,'ResponseStatus'=>200,'ResponseText'=>'login Successfully']], 200);
    }
}
