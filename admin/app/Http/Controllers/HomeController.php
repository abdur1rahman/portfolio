<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactModal;
use App\CourseModel;
use App\ProjectMOdal;
use App\RivewModel;
use App\servicesModel;
use App\visitorModel;

class HomeController extends Controller
{
    function HomeIndex(){
        $Totalcontact = ContactModal::count();
        $TotalCourse = CourseModel::count();
        $TotalProject = ProjectMOdal::count();
        $TotalRivew = RivewModel::count();
        $Totalservice = servicesModel::count();
        $Totalvisitor = visitorModel::count();
       return view('Home',[
           'contactData'=>$Totalcontact,
           'CourseData'=>$TotalCourse,
           'ProjectData'=>$TotalProject,
           'RivewDAta'=>$TotalRivew,
           'serviceData'=>$Totalservice,
           'visitorData'=>$Totalvisitor
       ]);

    }
}
