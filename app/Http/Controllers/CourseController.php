<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course;
use DB;


class CourseController extends Controller
{
    function getAll()
    {
        return response()->json(Course::all());
    }

    function getCourseCount()
    {
        return response()->json(Course::count());
    }

    function get($id)
    {
      
        return response()->json(Course::find($id));
    }
    

    function create(Request $request)
    {
      //  $this->validate($request->json(),["name"=>"required"]);

      $image = '';
      if( $request->file('image') && $request->file('image')->isValid())
      { 
            $file = $request->file('image')->getClientOriginalName();
            $date = date('YmdHms');
            $d = $date.$file;
            $destinationPath ="images/";
            $image = $destinationPath.$file;
            $request->file('image')->move($destinationPath, $d);
           
      }

      $course = new Course();

      $course->name = $request->name;
      $course->description = $request->description;
      $course->image = $image;
      $course->difficulty = $request->difficulty;
      $course->prerequisites = ($request->prerequisites);
      $course->outcomes = $request->outcomes;
      $course->syllabus = ($request->syllabus);
    
      $result = $course->save();

      return  response()->json($result,201);
    }

    function update($id,Request $request)
    {
      
        $course = Course::findOrFail($id);

        $request->replace($request->all()); 

         $image = '';
        // if( $request->file('image') && $request->file('image')->isValid())
        // { 
        //       $file = $request->file('image')->getClientOriginalName();
        //       $date = date('YmdHms');
        //       $d = $date.$file;
        //       $destinationPath ="images/";
        //       $image = $destinationPath.$file;
        //       $request->file('image')->move($destinationPath, $d);
             
        // }
  
        $course->name = $request->name;
        $course->description = $request->description;
        $course->image = $image;
        $course->difficulty = $request->difficulty;
        $course->prerequisites = ($request->prerequisites);
        $course->outcomes = $request->outcomes;
        $course->syllabus = ($request->syllabus);
      
        $result = $course->save();

        return response()->json($result,200);
    }

    function delete($id)
    {
       Course::findOrFail($id)->delete();

       return response()->json($id, 200);
    }

}
