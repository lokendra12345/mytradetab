<?php

namespace App\Http\Controllers\api\v1\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Business; 
use Illuminate\Support\Facades\Auth; 
use Validator;

class BusinessController extends Controller
{
    //
	public $successStatus = 200;

    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'company_name' => ['required', 'string', 'max:255'],
            'company_mobile' => 'required|min:11|numeric',
            'company_email' => ['required', 'string', 'email', 'max:255', 'unique:business'],
            'address_line1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zip_code' => 'required',
            'category' => 'required', 
            'sub_category' => 'required', 
        ]);
		if ($validator->fails()) { 
	            return response()->json(['error'=>$validator->errors()], 401);            
	        }
			$input = $request->all(); 
	        $business = Business::create($input); 
	        $success[] =  $business;
			return response()->json(['success'=>$success], $this-> successStatus); 
	    }


    public function show($id)
    {
        $business = Business::find($id);


        if (is_null($business)) {
            return response()->json(['error'=>'Business not found.'], 401); 
        }

        $success[] =  $business;
        return response()->json(['success'=>$success], $this-> successStatus); 
    }


    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [ 
            'company_name' => ['required', 'string', 'max:255'],
            'company_mobile' => 'required|min:11|numeric',
            //'company_email' => ['required', 'string', 'email', 'max:255', 'unique:business'],
            'address_line1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zip_code' => 'required',
            'category' => 'required', 
            'sub_category' => 'required',
        ]);

        if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 401);            
        }
            $business = Business::find($id);
            //print_r($business); die;
            $input = $request->all();

            $business->company_name = $input['company_name'];
            $business->company_logo = $input['company_logo'];
            $business->company_banner = $input['company_banner'];
            $business->company_details = $input['company_details'];
            $business->whatsapp_image = $input['whatsapp_image'];
            $business->company_mobile = $input['company_mobile'];
            $business->address_line1 = $input['address_line1'];
            $business->address_line2 = $input['address_line2'];
            $business->landmark = $input['landmark'];
            $business->city = $input['city'];
            $business->state = $input['state'];
            $business->country = $input['country'];
            $business->zip_code = $input['zip_code'];
            $business->category = $input['category'];
            $business->sub_category = $input['sub_category'];
            //$business->cron_activation_date = $input['cron_activation_date'];
            $business->short_url = $input['short_url'];
            $business->business_type = $input['business_type'];
            $business->subscription_type = $input['subscription_type'];
            $business->save();
            $success[] =  $business;
            return response()->json(['success'=>$success], $this-> successStatus); 
    }




}
