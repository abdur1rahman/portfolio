<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactModal;

class ContactController extends Controller
{
    function ContactIndex(){
        return view('Contact');
    }
    function GetContact(){
        $result = json_encode(ContactModal::orderBy('id','desc')->get());
        return $result;
    }
    function ContactgetDelete(Request $request){
        $id=$request->input('id');
        $result = ContactModal::where('id','=',$id)->delete();
        if($result==true){
            return 1;

        }else{
            return 0;
        }
    }

}
