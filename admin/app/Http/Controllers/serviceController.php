<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\servicesModel;

class serviceController extends Controller
{
    function serviceIndex(){
        return view('service');
    }
    function getServiceData(){
     $result = json_encode(servicesModel::orderBy('id','desc')->get());
     return $result;
    }
    function ServiceDetails(Request $request){
        $id= $request->input('id');
        $result = servicesModel::where('id',$id)->get();
        return $result;
    }
    function ServiceDelete(Request $request){
        $id= $request->input('id');
        $result = servicesModel::where('id',$id)->delete();
        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }
    function ServiceUpdate(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $des = $request->input('des');
        $img = $request->input('img');
        $result = servicesModel::where('id', $id)->update(['service_name'=>$name,'service_des'=>$des,'service_img'=>$img]);
        if($result== true){
            return 1;
        }else{
            return 0;
        }
    }

      function ServiceAdd(Request $request){
           $name = $request->input('name');
           $des = $request->input('des');
           $img = $request->input('img');
           $result = servicesModel::insert(['service_name'=>$name,'service_des'=>$des,'service_img'=>$img]);
           if($result== true){
               return 1;
           }else{
               return 0;
           }
       }
}
