<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\visitorModel;
use App\servicesModel;
use App\CourseModel;
use App\ProjectMOdal;
use App\ContactModal;
use App\RivewModel;

class HomeController extends Controller
{
    function HomeIndex(){
        $UserIP = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate= date("Y-m-d h:i:sa");
        visitorModel::insert(['ip_address'=>$UserIP,'visit_time'=>$timeDate]);

        $serviceData = json_decode(servicesModel::orderBy('id','desc')->limit(4)->get());

        $CourseData = json_decode(CourseModel::orderBy('id','desc')->limit(6)->get());

        $ProjectData = json_decode(ProjectMOdal::all());
        $RivewData = json_decode(RivewModel::all());



        return view(
            'Home',['serviceDataKey'=>$serviceData,
                'Home','CourseDataKey'=>$CourseData,
                'Home','ProjectDataKey'=>$ProjectData,
                'Home','RivewDataKey'=>$RivewData,
        ]);
    }
    function SendContact(Request $request){
        $name = $request->input('name');
        $phone = $request->input('phone');
        $emaile = $request->input('emaile');
        $msg = $request->input('msg');
        $result = ContactModal::insert(['name'=>$name,'phone'=>$phone,'Emaile'=>$emaile,'msg'=>$msg]);
        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }
}
