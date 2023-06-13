<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Validator;

class ApiController extends Controller
{
    // Register Funtion
    public function registerUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();

            $rules = [
                "name" => "required",
                "email" => "required|email|unique:users",
                "mobile" => "required",
                "password" => "required"
            ];

            $customMessages = [
                "name.required" => "Name is required",
                "email.required" => "Email is required",
                "email.unique" => "Email already exists",
                "mobile.required" => "Mobile number required",
                "password.required" => "Password is required",

            ];

            $validator = Validator::make($data, $rules, $customMessages);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $user = new User;
            $user->name = $data['name'];
            $user->mobile = $data['mobile'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->status = 1;
            $user->save();

            return response()->json(['status' => true, 'message' => 'User Register Successfull!'], 201);
        }
    }

    public function loginUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();

            $rules = [
                "email" => "required|email|exists:users",
                "password" => "required"
            ];

            $customMessages = [
                "email.required" => "Email is required",
                "email.exists" => "Email does not exists",
                "password.required" => "Password is required",
            ];

            $validator = Validator::make($data, $rules, $customMessages);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // verify user email
            $userCount = User::where('email', $data['email'])->count();

            if ($userCount > 0) {
                // fetch user details
                $userDetails = User::where('email', $data['email'])->first();

                // verify the password
                if (password_verify($data['password'], $userDetails->password)) {
                    return response()->json([
                        "userDetails" => $userDetails,
                        "status" => true,
                        "message" => "User login successfully!"
                    ], 201);
                } else {
                    $message = "Password is incorrect!";
                    return response()->json(['status' => false, 'message' => $message], 422);
                }
            } else {
                $message = "Email is incorrect!";
                return response()->json(['status' => false, 'message' => $message], 422);
            }
        }
    }

    public function updateUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();

            $rules = [
                "name" => "required"
            ];

            $customMessages = [
                "name.required" => "Name is required"
            ];

            $validator = Validator::make($data,$rules,$customMessages);
            if($validator->fails()){
                return response()->json($validator->errors(),422);
            }

            // User id verify
            $userCount = User::where('id', $data['id'])->count();
            if ($userCount > 0) {

                if(empty($data['address'])){
                    $data['address'] = "";
                }
                if(empty($data['mobile'])){
                    $data['mobile'] = "";
                }
                if(empty($data['city'])){
                    $data['city'] = "";
                }
                if(empty($data['state'])){
                    $data['state'] = "";
                }
                if(empty($data['country'])){
                    $data['country'] = "";
                }
                if(empty($data['pincode'])){
                    $data['pincode'] = "";
                }
                // Update user id
                User::where('id', $data['id'])->update(['name' => $data['name'], 'address' => $data['address'],'mobile'=>$data['mobile'], 'city'=>$data['city'],'state'=>$data['state'],'country'=>$data['country'],'pincode' => $data['pincode']]);

                $userDetails = User::where('id', $data['id'])->first();

                return response()->json([
                    'userDetails' => $userDetails,
                    'status' => true,
                    'message' => 'User Updated Successfully!'
                ], 201);
            } 
            else {
                $message = "User does not exists";
                return response()->json(['status' => false, "message" => $message], 422);
            }
        }
    }
}
