<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

class CategoryController extends Controller
{
    function getAll()
    {
        return response()->json(Category::all());
    }
    function get($id)
    {
        return response()->json(Category::find($id));
    }
    function create(Request $request)
    {
      //  $this->validate($request->json(),["name"=>"required"]);

        $category = Category::create($request->json()->all());

      return  response()->json($category,201);
    }
    function update($id,Request $request)
    {
      
        $category = Category::findOrFail($id);

        $category->update($request->json()->all());

        return response()->json($category,200);
    }

    function delete($id)
    {
       Category::findOrFail($id)->delete();

       return response()->json($id, 200);
    }

}
