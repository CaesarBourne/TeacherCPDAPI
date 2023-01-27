<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Topic;

class TopicController extends Controller
{
    function getAll($course_id)
    {
        return response()->json(Topic::where('course_id',$course_id)->get());
    }
    function get($course_id,$id)
    {
        return response()->json(Topic::find($id));
    }
    function create($course_id,Request $request)
    {
      //  $this->validate($request->json(),["name"=>"required"]);

      
      $video = '';
      if( $request->file('video') && $request->file('video')->isValid())
      { 
            $file = $request->file('video')->getClientOriginalName();
            $date = date('YmdHms');
            $d = $date.$file;
            $destinationPath ="videos/";
            $video = $destinationPath.$file;
            $request->file('video')->move($destinationPath, $d);
           
      }

      $topic = new Topic();

      $topic->name = $request->name;
      $topic->index= $request->index;
      $topic->video = $video;
      $topic->notes = $request->notes;
      $topic->course_id = $course_id;
      $result = $topic->save();

      return  response()->json($result,201);
    }
    function update($course_id,$id,Request $request)
    {
      
        $Topic = Topic::findOrFail($id);

        $Topic->update($request->json()->all());

        return response()->json($Topic,200);
    }

    function delete($course_id,$id)
    {
       Topic::findOrFail($id)->delete();

       return response()->json($id, 200);
    }

}
