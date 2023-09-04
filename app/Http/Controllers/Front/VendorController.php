<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use DB;

class VendorController extends Controller
{
    public function loginRegister()
    {
        return view('front.vendors.login_register');
    }

    public function vendorRegister(Request $request)
    {
        if ($request->isMethod('post')) {
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

            $validator = Validator::make($data, $rules, $customMessages);

            if ($validator->fails()) {
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
            $admin->type = "vendor";
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

            // Send Confirmation Email
            $email = $data['email'];
            $messageData = [
                'email' => $data['email'],
                'name' => $data['name'],
                'code' => base64_encode($data['email']),
            ];

            Mail::send('emails.vendor_confirmation', $messageData, function ($message) use ($email) {
                $message->to($email)->subject('Confirm your vendor account');
            });

            DB::commit();

            // Return redirect back
            $message = "Thanks for registering as Vendor.Please confirm your email to activate your account.";

            return redirect()->back()->with('success_message', $message);
        }
    }

    public function confirmVendor($email)
    {
        $email = base64_decode($email);
        // Check Vendor email exists or not
        $vendorCount = Vendor::where('email', $email)->count();
        if ($vendorCount > 0) {
            // Vendor email is already activated or not
            $vendorDetails = Vendor::where('email', $email)->first();
            if ($vendorDetails->confirm == 'Yes') {
                $message = 'Your vendor account is already confirmed.You can login';
                return redirect('vendor/login-register')->with('error_message', $message);
            } else
                // Update confirm column to Yes in both admin/vendor table to activate account
                Admin::where('email', $email)->update(['confirm' => 'Yes']);
            Vendor::where('email', $email)->update(['confirm' => 'Yes']);

            // Send Register Email
            $messageData = [
                'email' => $email,
                'name' => $vendorDetails->name,
                'mobile' => $vendorDetails->mobile,
            ];

            Mail::send('emails.vendor_confirmed', $messageData, function ($message) use ($email) {
                $message->to($email)->subject('Your vendor account has been confirmed!');
            });
            // Redirect to vendor login/register page with success message
            $message = "Your vendor email account is confirmed. You can login and add your personal, business and bank details to activate your vendor account to add products.";

            return redirect('vendor/login-register')->with('success_message', $message);
        } else {
            abort(404);
        }
    }
}
