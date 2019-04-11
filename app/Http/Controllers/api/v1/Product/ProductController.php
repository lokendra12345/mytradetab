<?php

namespace App\Http\Controllers\api\v1\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product; 
use Illuminate\Support\Facades\Auth; 
use Validator; 

class ProductController extends Controller
{
    //
	 //
    public $successStatus = 200;

    public function store(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'product_name' => ['required', 'string', 'max:255'],
            'sku' => 'required',
            'category' => 'required',
            //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'required',
            'status' => 'required', 
        ]);
		if ($validator->fails()) { 
	            return response()->json(['error'=>$validator->errors()], 401);            
	        }
			$input = $request->all(); 
	        $product = Product::create($input); 
	        $success[] =  $product;
			return response()->json(['success'=>$success], $this-> successStatus); 
	    }


    public function show($id)
    {
        $product = Product::find($id);


        if (is_null($product)) {
            return response()->json(['error'=>'Product not found.'], 401); 
        }

        $success[] =  $product;
        return response()->json(['success'=>$success], $this-> successStatus); 
    }


    public function update(Request $request, $id)
    {
    	$validator = Validator::make($request->all(), [ 
        	'product_name' => ['required', 'string', 'max:255'],
            'sku' => 'required',
            'category' => 'required',
            //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'required',
            'status' => 'required', 
        ]);
        if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 401);            
        }
        $product = Product::find($id);
        //print_r($product); die;
        $input = $request->all();

        $product->product_name = $input['product_name'];
        $product->sku = $input['sku'];
        $product->price = $input['price'];
        $product->sale_price = $input['sale_price'];
        $product->category = $input['category'];
        $product->description = $input['description'];
        $product->short_description = $input['short_description'];
        $product->image = $input['image'];
        $product->gallery = $input['gallery'];
        $product->seo_keywords = $input['seo_keywords'];
        $product->seo_title = $input['seo_title'];
        $product->seo_description = $input['seo_description'];
        $product->status = $input['status'];
        $product->save();
        $success[] =  $product;
        return response()->json(['success'=>$success], $this-> successStatus); 
    }


    public function destroy($id)
	{
	    $product = Product::find($id);

	    if (is_null($product)) {
            return response()->json(['error'=>'Product not found.'], 401); 
        }

        $product = Product::findOrFail($id);
	    $product->delete();

	    $success[] =  $product;
        //return response()->json(['success'=>$success], $this-> successStatus); 
        return response()->json(['success'=>'Product deleted successfully.'], $this-> successStatus); 
	}





}
