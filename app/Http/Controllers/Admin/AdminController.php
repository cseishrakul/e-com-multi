<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Vendor;
use App\Models\VendorsBankDetail;
use App\Models\VendorsBusinessDetail;
use Image;
use Session;
use Illuminate\Support\Facades\Mail;

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

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                if (Auth::guard('admin')->user()->type == 'vendor' && Auth::guard('admin')->user()->confirm == 'No') {
                    return redirect()->back()->with('error_message', 'Please confirm your email to activate your vendor account');
                } else if (Auth::guard('admin')->user()->type != 'vendor' && Auth::guard('admin')->user()->status == '0') {
                    return redirect()->back()->with('error_message', 'Your admin account is not active.');
                } else {
                    return redirect('admin/dashboard');
                }
            } else {
                return redirect()->back()->with('error_message', 'Invalid Email or Password');
            }
        }

        return view('admin.login');
    }

    // dashboard function
    public function dashboard()
    {
        Session::put('page', 'dashboard');
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
    public function updateAdminDetails(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;

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

            $this->validate($request, $rules, $customMessage);

            // Upload Admin Photo
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    // Get image extension
                    $extension = $image_tmp->getClientOriginalExtension();

                    // Generate new image name
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'admin/photos/' . $imageName;

                    // Upload the image
                    Image::make($image_tmp)->save($imagePath);
                }
            } else if (!empty($data['current_admin_image'])) {
                $imageName = $data['current_admin_image'];
            } else {
                $imageName = "";
            }

            Admin::where('id', Auth::guard('admin')->user()->id)->update(['name' => $data['name'], 'mobile' => $data['mobile'], 'image' => $imageName]);
            return redirect()->back()->with('success_message', 'Admin Details Updated Successfully!');
        }
        return view('admin.settings.update_admin_details');
    }


    // Update vendor details
    public function updateVendorDetails($slug, Request $request)
    {
        if ($slug == "personal") {
            if ($request->isMethod('post')) {
                $data = $request->all();
                // echo "<pre>"; print_r($data); die;
                // validation
                $rules = [
                    'vendor_name' => 'required',
                    'vendor_mobile' => 'required|numeric',
                ];

                $customMessage = [
                    'vendor_name.required' => 'Name is required',
                    'vendor_mobile.required' => 'Mobile number is required',
                    'vendor_mobile.numeric' => 'Mobile digit must be a number'
                ];

                $this->validate($request, $rules, $customMessage);

                // Upload Admin Photo
                if ($request->hasFile('vendor_image')) {
                    $image_tmp = $request->file('vendor_image');
                    if ($image_tmp->isValid()) {
                        // Get image extension
                        $extension = $image_tmp->getClientOriginalExtension();

                        // Generate new image name
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin/photos/' . $imageName;

                        // Upload the image
                        Image::make($image_tmp)->save($imagePath);
                    }
                } else if (!empty($data['current_vendor_image'])) {
                    $imageName = $data['current_vendor_image'];
                } else {
                    $imageName = "";
                }

                // Update in admins table
                Admin::where('id', Auth::guard('admin')->user()->id)->update(['name' => $data['vendor_name'], 'mobile' => $data['vendor_mobile'], 'image' => $imageName]);

                // Update in vendor table
                Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->update(['name' => $data['vendor_name'], 'mobile' => $data['vendor_mobile'], 'address' => $data['vendor_address'], 'city' => $data['vendor_city'], 'state' => $data['vendor_state'], 'country' => $data['vendor_country'], 'pincode' => $data['vendor_pincode']]);

                return redirect()->back()->with('success_message', 'Vendor Details Updated Successfully!');
            }
            $vendorDetails = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        } else if ($slug == "business") {
            if ($request->isMethod('post')) {
                $data = $request->all();
                // echo "<pre>"; print_r($data); die;
                // validation
                $rules = [
                    'shop_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_mobile' => 'required|numeric',
                    'shop_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'address_proof' => 'required',
                ];

                $customMessage = [
                    'shop_name.required' => 'Name is required',
                    'shop_city.required' => 'City is required',
                    'shop_name.regex' => 'Valid name is required',
                    'shop_city.regex' => 'Valid city is required',
                    'shop_mobile.required' => 'Mobile number is required',
                    'shop_mobile.numeric' => 'Mobile digit must be a number',
                    'address_proof.required' => 'Address Proof is required',
                ];

                $this->validate($request, $rules, $customMessage);

                // Upload Admin Photo
                if ($request->hasFile('address_proof_image')) {
                    $image_tmp = $request->file('address_proof_image');
                    if ($image_tmp->isValid()) {
                        // Get image extension
                        $extension = $image_tmp->getClientOriginalExtension();

                        // Generate new image name
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin/photos/proofs/' . $imageName;

                        // Upload the image
                        Image::make($image_tmp)->save($imagePath);
                    }
                } else if (!empty($data['current_address_proof'])) {
                    $imageName = $data['current_address_proof'];
                } else {
                    $imageName = "";
                }

                $vendorCount = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->count();

                if ($vendorCount > 0) {
                    // Update in vendor business table
                    VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update(['shop_name' => $data['shop_name'], 'shop_address' => $data['shop_address'], 'shop_city' => $data['shop_city'], 'shop_state' => $data['shop_state'], 'shop_country' => $data['shop_country'], 'shop_pincode' => $data['shop_pincode'], 'shop_mobile' => $data['shop_mobile'], 'shop_website' => $data['shop_website'], 'address_proof' => $data['address_proof'], 'address_proof_image' => $imageName, 'business_license_number' => $data['business_license_number'], 'gst_number' => $data['gst_number'], 'pan_number' => $data['pan_number'],]);
                } else {
                    // Insert in vendor business table
                    VendorsBusinessDetail::insert(['vendor_id' => Auth::guard('admin')->user()->vendor_id, 'shop_name' => $data['shop_name'], 'shop_address' => $data['shop_address'], 'shop_city' => $data['shop_city'], 'shop_state' => $data['shop_state'], 'shop_country' => $data['shop_country'], 'shop_pincode' => $data['shop_pincode'], 'shop_mobile' => $data['shop_mobile'], 'shop_website' => $data['shop_website'], 'address_proof' => $data['address_proof'], 'address_proof_image' => $imageName, 'business_license_number' => $data['business_license_number'], 'gst_number' => $data['gst_number'], 'pan_number' => $data['pan_number']]);
                }



                return redirect()->back()->with('success_message', 'Vendor Business Details Updated Successfully!');
            }
            $vendorCount = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->count();
            if ($vendorCount > 0) {
                $vendorDetails = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
            } else {
                $vendorDetails = array();
            }
        } else if ($slug == "bank") {
            if ($request->isMethod('post')) {
                $data = $request->all();
                // echo "<pre>"; print_r($data); die;
                // validation
                $rules = [
                    'account_holder_name' => 'required',
                    'bank_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'account_number' => 'required|numeric',
                ];

                $customMessage = [
                    'account_holder_name.required' => 'Name is required',
                    'bank_name.required' => 'Bank name is required',
                    // 'account_holder_name.regex' => 'Valid name is required',
                    'bank_name.regex' => 'Valid bank is required',
                    'account_number.required' => 'Account number is required',
                    'account_number.numeric' => 'Account digit must be a number',
                ];

                $this->validate($request, $rules, $customMessage);

                $vendorCount = VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->count();

                if ($vendorCount > 0) {
                    // Update in vendor bank table
                    VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update(['account_holder_name' => $data['account_holder_name'], 'bank_name' => $data['bank_name'], 'account_number' => $data['account_number'], 'bank_ifsc_code' => $data['bank_ifsc_code']]);
                } else {
                    // Insert in vendor bank table
                    VendorsBankDetail::insert(['vendor_id' => Auth::guard('admin')->user()->vendor_id, 'account_holder_name' => $data['account_holder_name'], 'bank_name' => $data['bank_name'], 'account_number' => $data['account_number'], 'bank_ifsc_code' => $data['bank_ifsc_code']]);
                }

                return redirect()->back()->with('success_message', 'Vendor Bank Details Updated Successfully!');
            }
            $vendorCount = VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->count();
            if ($vendorCount > 0) {
                $vendorDetails = VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
            } else {
                $vendorDetails = array();
            }
        } else {
        }

        $countries = Country::where('status', 1)->get()->toArray();
        return view('admin.settings.vendor.update_vendor_details', compact('slug', 'vendorDetails', 'countries'));
    }


    // Admins Function
    public function admins($type = null)
    {
        $admins = Admin::query();
        if (!empty($type)) {
            $admins = $admins->where('type', $type);
            $title = ucfirst($type) . 's';
        } else {
            $title = "All Admins/Subadmins/Vendors";
        }
        $admins = $admins->get()->toArray();
        // dd($admins);
        return view('admin.admins.admins', compact('admins', 'title'));
    }

    // View Vendor details function
    public function viewVendorDetails($id)
    {
        $vendorDetails = Admin::with('vendorPersonal', 'vendorBusiness', 'vendorBank')->where('id', $id)->first();
        $vendorDetails = json_decode(json_encode($vendorDetails), true);
        // dd($vendorDetails);
        return view('admin.admins.vendor.view_vendor_details', compact('vendorDetails'));
    }

    // Update admin statue
    public function updateAdminStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Admin::where('id', $data['admin_id'])->update(['status' => $status]);
            $adminDetails = Admin::where('id', $data['admin_id'])->first()->toArray();
            if ($adminDetails['type'] == 'vendor' && $status == 1) {
                Vendor::where('id',$adminDetails['vendor_id'])->update(['status' => $status]);
                // send approval email
                $email = $adminDetails['email'];
                $messageData = [
                    'email' => $adminDetails['email'],
                    'name' => $adminDetails['name'],
                    'mobile' => $adminDetails['mobile'],
                ];

                Mail::send('emails.vendor_approved', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Your Vendor Account is Approved!');
                });
            }
            return response()->json(['status' => $status, 'admin_id' => $data['admin_id']]);
        }
    }

    // Admin Logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
