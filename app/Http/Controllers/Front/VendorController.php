<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Redirect;
use DB;

class VendorController extends Controller
{
    public function loginRegister(){
        return view('front.vendors.login_register');
    }

    public function vendorRegister(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            // Validate Vendor
            $rules = [
                "name" => "required",
                "email" => "required|email|unique:admins|unique:vendors",
                "mobile" => "required|unique:admins|unique:vendors",
                "accept" => "required"
            ];

            $customMessages = [
                'name.required' => "Name is required",
                'email.required' => 'Email is required',
                'email.unique' => 'Email already exists',
                'mobile.required' => 'Mobile is required',
                'mobile.unique' => 'This number already exists',
                'accept.required' => 'Accept the terms & conditions',
            ];

            $validator = Validator::make($data,$rules,$customMessages);

            if($validator->fails()){
                return Redirect::back()->withErrors($validator);
            }

            DB::beginTransaction();
            // Create vendor account

            // Insert the vendor details in vendors table
            $vendor = new Vendor;
            $vendor->name = $data['name'];
            $vendor->mobile = $data['mobile'];
            $vendor->email = $data['email'];
            $vendor->status = 0;

            // Set default timezone to bangladesh
            date_default_timezone_set("Asia/Dhaka");
            $vendor->created_at = date("Y-m-d H:i:s");
            $vendor->updated_at = date("Y-m-d H:i:s");

            $vendor->save();

            $vendor_id = DB::getPdo()->lastInsertId();

            // Insert the vedor details in admins table
            $admin = new Admin;
            $admin->type="vendor";
            $admin->vendor_id = $vendor_id;
            $admin->name = $data['name'];
            $admin->mobile = $data['mobile'];
            $admin->email = $data['email'];
            $admin->password = bcrypt($data['password']);
            $admin->status = 0;

            // Set default timezone to bangladesh
            date_default_timezone_set("Asia/Dhaka");
            $admin->created_at = date("Y-m-d H:i:s");
            $admin->updated_at = date("Y-m-d H:i:s");

            $admin->save();

            DB::commit();

            // Return redirect back
            $message = "Thanks for registering as Vendor.We will confirm by email once your account is approved.";

            return redirect()->back()->with('success_message',$message);
        }
    }
}
