<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\Admin;

class AdminController extends Controller
{

    // login function
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];

            $customMessage = [
                'email.required' => 'Email is required',
                'email.email' => 'Valid email address is required',
                'password.required' => 'Password is required'
            ];

            $this->validate($request, $rules, $customMessage);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->with('error_message', 'Invalid Email or Password');
            }
        }

        return view('admin.login');
    }

    // dashboard function
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Update Admin Password
    public function updatePassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            // If current password entered by admin is correct
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {

                // Check if new password and confirm password match
                if ($data['new_password'] == $data['confirm_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_message', 'Password has been updated successfully!');
                } else {
                    return redirect()->back()->with('error_message', 'New password & confirm password does not matched!');
                }
            } else {
                return redirect()->back()->with('error_message', 'Current password is incorrect');
            }
        }
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_password', compact('adminDetails'));
    }

    // Check admin password
    public function checkAdminPassword(Request $request)
    {
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;
        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }

    // Update Admin Details
    public function updateAdminDetails(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            // validation
            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile' => 'required|numeric',
            ];

            $customMessage = [
                'name.required' => 'Name is required',
                'name.regex' => 'Valid name is required',
                'mobile.required' => 'Mobile number is required',
                'mobile.numeric' => 'Mobile digit must be a number'
            ];

            $this->validate($request,$rules,$customMessage);

            Admin::where('id',Auth::guard('admin')->user()->id)->update(['name' => $data['name'], 'mobile' => $data['mobile']]);
            return redirect()->back()->with('success_message','Admin Details Updated Successfully!');
        }
        return view('admin.settings.update_admin_details');
    }

    // Admin Logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
