<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Assessment;
use DB;

class AssessmentController extends Controller
{
    function getAll()
    {
        return response()->json(Assessment::all());
    }

    function getAssessmentCount()
    {
        return response()->json(Assessment::count());
    }

    function get($id)
    {
      
        return response()->json(Assessment::find($id));
    }
    

    function create(Request $request)
    {
      //  $this->validate($request->json(),["name"=>"required"]);
 
      $result = Assessment::create($request->json()->all());

      return  response()->json($result,201);
    }

    function update($id,Request $request)
    {
      
        $Assessment = Assessment::findOrFail($id);

        $Assessment->update($request->json()->all());

        return response()->json($Assessment,200);
    }

    function delete($id)
    {
       Assessment::findOrFail($id)->delete();

       return response()->json($id, 200);
    }

}
