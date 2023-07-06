<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Image;

class BannerController extends Controller
{
    public function banners()
    {
        $banners = Banner::get()->toArray();
        // dd($banners);
        return view('admin.banner.banner', compact('banners'));
    }

    public function updateBannerStatus(Request $request)
    {
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

    public function deleteBanner($id)
    {
        $bannerImage = Banner::where('id', $id)->first();
        $banner_image_path = 'admin/photos/banner_images/';
        if (file_exists($banner_image_path . $bannerImage->image)) {
            unlink($banner_image_path . $bannerImage->image);
        }
        Banner::where('id', $id)->delete();

        $message = "Banner has been deleted successfully!";
        return redirect()->back()->with('success_message', $message);
    }

    public function addEditBanner(Request $request, $id = null)
    {
        if ($id == '') {
            $banner = new Banner;
            $title = "Add Banner Image";
            $message = "Banner added successfully!";
        } else {
            $banner = Banner::find($id);
            $title = "Edit Banner Image";
            $message = "Banner updated successfully!";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            $banner->type = $data['type'];
            $banner->link = $data['link'];
            $banner->title = $data['title'];
            $banner->alt = $data['alt'];
            $banner->status = 1;

            if($data['type'] == 'Slider'){
                $width = "1920";
                $height = "720";
            }else if($data['type'] == 'Fix'){
                $width = "1920";
                $height = "450";
            }

            // Upload banner image
            if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'admin/photos/banner_images/'.$imageName;

                    Image::make($image_tmp)->resize($width,$height)->save($imagePath);
                    $banner->image = $imageName;
                }
            }

            $banner->save();
            return redirect('admin/banners')->with('success_message',$message);
        }

        return view('admin.banner.add_edit_banner', compact("title", 'banner'));
    }
}
