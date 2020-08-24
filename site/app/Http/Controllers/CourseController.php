<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseModel;

class CourseController extends Controller
{
    function CoursePage(){
        $GetAllCourseData = json_decode(CourseModel::all());
        return view('CoursePage',['AllcourseData'=>$GetAllCourseData]);
    }
}
