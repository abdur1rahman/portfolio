<?php

namespace App\Http\Controllers;

use App\servicesModel;
use Illuminate\Http\Request;
use App\RivewModel;

class RivewController extends Controller
{
    function RivewIndex(){
        return view('Rivew');
    }
  function getRivewData(){
    $result = json_encode(RivewModel::all());
    return $result;
}
    function RivewDetails(Request $request){
        $id= $request->input('id');
        $result = RivewModel::where('id',$id)->get();
        return $result;
    }
    function RivewDelete(Request $request){
        $id= $request->input('id');
        $result = RivewModel::where('id',$id)->delete();
        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }
    function RivewUpdate(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $des = $request->input('des');
        $img = $request->input('img');
        $result = RivewModel::where('id', $id)->update(['RivewName'=>$name,'description'=>$des,'images'=>$img]);
        if($result== true){
            return 1;
        }else{
            return 0;
        }
    }

    function RivewAdd(Request $request){
        $name = $request->input('name');
        $des = $request->input('des');
        $img = $request->input('img');
        $result = RivewModel::insert(['RivewName'=>$name,'description'=>$des,'images'=>$img]);
        if($result== true){
            return 1;
        }else{
            return 0;
        }
    }
}

