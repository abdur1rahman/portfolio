<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectMOdal;

class ProjectController extends Controller
{
    // Project Home View///

   function HomeProject(){
       return view('HomeProject');
   }//end project HOme view///

    // Get Home Project//

    function GetProject(){
        $result = json_decode(ProjectMOdal::all());
        return $result;
    }// end get HomeProject

    //delete fucntion///
        function projectDelete(Request $req){
        $id = $req->input('id');
        $result = ProjectMOdal::where('id','=',$id)->delete();
        if($result== true){
            return 1;
        }else{
            return 0;
        }
   }//end delete function.///

    //Details function///

    function ProjectDetails(Request $req){
        $id = $req->input('id');
        $result = ProjectMOdal::where('id','=',$id)->get();
        return $result;
    }//End details function//

    // Edite function ///

    function ProjectEdite(Request $req){
       $id = $req->input('id');
       $projectname = $req->input('name');
       $projectdesc = $req->input('desc');
       $projectImg = $req->input('img');
       $result = ProjectMOdal::where('id','=',$id)->update([
           'project_name'=>$projectname,
           'project_description'=>$projectdesc,
           'project_img'=>$projectImg,
       ]);
        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }

    //Project Add//

    function ProjectAdd(Request $req){
        $projectname = $req->input('name');
        $projectdesc = $req->input('desc');
        $projectImg = $req->input('img');
        $result = ProjectMOdal::insert([
            'project_name'=>$projectname,
            'project_description'=>$projectdesc,
            'project_img'=>$projectImg,
        ]);
        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }

}//end class function///
