<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectMOdal;

class ProjectController extends Controller
{
    function ProjectPage(){
        $ProjectAll = json_decode(ProjectMOdal::all());
        return view('ProjectPage',['PrjectData'=>$ProjectAll]);
    }
}
