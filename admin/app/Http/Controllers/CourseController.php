<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseModel;

class CourseController extends Controller
{
    function CourseIndex(){
         return view('HomeCourse');
    }
    function GetCourse(){
        $result = json_encode(CourseModel::orderBy('id','desc')->get());
        return $result;
    }
    function Coursedelete(Request $req){
        $id= $req->input('id');
        $result= CourseModel::where('id','=',$id)->delete();
        if($result == true ){
        return 1;

        }else{
            return 0;
        }
    }//End delete function///

    //Course Edite function///

    function CourseDetails(Request $req){
        $id= $req->input('id');
        $result= CourseModel::where('id','=',$id)->get();
        return $result;
    }//End CourseDetails function///

    //couse Update function///

    function CourseUpdate(Request $req){
        $id= $req->input('id');
        $name= $req->input('name');
        $des= $req->input('des');
        $fee= $req->input('fee');
        $totalenroll= $req->input('totalenroll');
        $totalclass= $req->input('totalclass');
        $courselink= $req->input('courselink');
        $courseimg= $req->input('courseimg');
        $result= CourseModel::where('id','=',$id)->update([
            'course_name'=>$name,
            'course_des'=>$des,
            'course_fee'=>$fee,
            'course_totalenroll'=>$totalenroll,
            'course_totalclass'=>$totalclass,
            'course_link'=>$courselink,
            'course_img'=>$courseimg,
        ]);
        if($result == true ){
            return 1;

        }else{
            return 0;
        }
    }//End Update function///

    //Add new function ///

    function CourseAddd(Request $req){

        $name= $req->input('name');
        $des= $req->input('des');
        $fee= $req->input('fee');
        $totalenroll= $req->input('totalenroll');
        $totalclass= $req->input('totalclass');
        $courselink= $req->input('courselink');
        $courseimg= $req->input('courseimg');
        $result= CourseModel::insert([
            'course_name'=>$name,
            'course_des'=>$des,
            'course_fee'=>$fee,
            'course_totalenroll'=>$totalenroll,
            'course_totalclass'=>$totalclass,
            'course_link'=>$courselink,
            'course_img'=>$courseimg,
        ]);
        if($result == true ){
            return 1;

        }else{
            return 0;
        }
    }//end Add function///

}//class function///
