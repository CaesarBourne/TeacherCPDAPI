<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use DB;

class UsersController extends Controller
{
    function getAll()
    {
        return response()->json(User::all());
    }

    function getUserCount()
    {
       
        return response()->json(User::count());
    }

    function get($id)
    {
      
        return response()->json(User::find($id));
    }
    

    function create(Request $request)
    {
      //  $this->validate($request->json(),["name"=>"required"]);
 
      $result = User::create($request->json()->all());

      return  response()->json($result,201);
    }

    function update($id,Request $request)
    {
      
        $User = User::findOrFail($id);

        $User->update($request->json()->all());

        return response()->json($User,200);
    }

    function delete($id)
    {
       User::findOrFail($id)->delete();

       return response()->json($id, 200);
    }

}
