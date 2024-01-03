<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function coupons(){
        $coupons = Coupon::get()->toArray();
        // dd($coupons);
        return view('admin.coupons.coupons',compact('coupons'));
    }

    public function updateCouponStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Coupon::where('id',$data['coupon_id'])->update(['status' => $status]);
            return  response()->json(['status'=>$status, 'coupon_id'=>$data['coupon_id']]);
        }
    }


    public function deleteCoupon($id){
        Coupon::where('id',$id)->delete();
        $message = "Coupon has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }
}
