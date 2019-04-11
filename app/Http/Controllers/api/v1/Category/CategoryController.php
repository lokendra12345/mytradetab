<?php

namespace App\Http\Controllers\api\v1\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category; 
use Illuminate\Support\Facades\Auth; 
use Validator; 

class CategoryController extends Controller
{
    //

    public $successStatus = 200;
 
    public function create(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'category_name' => ['required', 'string', 'max:255', 'unique:categories'],
            'status' => 'required', 
        ]);
		if ($validator->fails()) { 
	            return response()->json(['error'=>$validator->errors()], 401);            
	        }
			$input = $request->all(); 
	        $category = Category::create($input); 
	        $success[] =  $category;
			return response()->json(['success'=>$success], $this-> successStatus); 
	}


    public function show($id)
    {
        $category = Category::find($id);


        if (is_null($category)) {
            return response()->json(['error'=>'Category not found.'], 401); 
        }

        $success[] =  $category;
        return response()->json(['success'=>$success], $this-> successStatus); 
    }


    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [ 
            'category_name' => ['required', 'string', 'max:255'],
            'status' => 'required', 
        ]);

        if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 401);            
        }
        $category = Category::find($id);
        //print_r($business); die;
        $input = $request->all();

        $category->category_name = $input['category_name'];
        $category->display_order = $input['display_order'];
        $category->icon = $input['icon'];
        $category->category_image = $input['category_image'];
        $category->status = $input['status'];
        $category->save();
        $success[] =  $category;
        return response()->json(['success'=>$success], $this-> successStatus); 
    }


    public function destroy($id)
	{
	    $category = Category::find($id);

	    if (is_null($category)) {
            return response()->json(['error'=>'Category not found.'], 401); 
        }

        $category = Category::findOrFail($id);
	    $category->delete();

	    $success[] =  $category;
        //return response()->json(['success'=>$success], $this-> successStatus); 
        return response()->json(['success'=>'Category deleted successfully.'], $this-> successStatus); 
	}

    
}
