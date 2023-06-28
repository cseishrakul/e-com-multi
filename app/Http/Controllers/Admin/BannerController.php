<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function banners(){
        $banners = Banner::get()->toArray();
        // dd($banners);
        return view('admin.banner.banner',compact('banners'));
    }

    public function updateBannerStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Banner::where('id', $data['banner_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'banner_id' => $data['banner_id']]);
        }
    }

    public function deleteBanner($id){
        $bannerImage = Banner::where('id',$id)->first();
        $banner_image_path = 'admin/photos/banner_images/';
        if(file_exists($banner_image_path.$bannerImage->image)){
            unlink($banner_image_path.$bannerImage->image);
        }
        Banner::where('id',$id)->delete();

        $message = "Banner has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }
}
