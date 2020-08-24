<?php

namespace App\Http\Controllers;
use App\LoginModel;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function login(){
        return view('Login');
    }

    function onLogin(Request $request){
        $name = $request->input('name');
        $password = $request->input('pass');
        $result = LoginModel::where('username',$name)->where('password',$password)->count();
        if($result==true){
            $request->session()->put('name',$name);
            return 1;
        }else{
            return 0;
        }
    }
}
