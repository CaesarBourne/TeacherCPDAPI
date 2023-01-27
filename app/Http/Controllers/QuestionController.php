<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Question;
use App\QuestionOption;

use DB;

class QuestionController extends Controller
{
    function getAll($assessment_id)
    {
        return response()->json(Question::where('assessment_id',$assessment_id)->get());
    }

    function get($assessment_id,$id)
    {
      
        return response()->json(Question::find($id));
    }
    

    function create($assessment_id,Request $request)
    {
      //  $this->validate($request->json(),["name"=>"required"]);
 
      $data = $request->json()->all();

      $result = Question::create(['index'=>$data['index'], 'question'=> $data['question'],'assessment_id' => $assessment_id, 'answer'=>$data['answer']]);

      if($result)
      {
        foreach ($data["options"] as $opt) {
           
            $option = new QuestionOption();

            $option->value = $opt["value"];
            $option->question_id = $result->id;
            $option->save();
        }
      }

      return  response()->json($result,201);
    }

    function update($assessment_id,$id,Request $request)
    {
      
        $Question = Question::findOrFail($id);

        $Question->update($request->json()->all());

        return response()->json($Question,200);
    }

    function delete($assessment_id,$id)
    {
       Question::findOrFail($id)->delete();

       return response()->json($id, 200);
    }

}
