<?php

namespace App\Http\Controllers\admin;

use DemeterChain\B;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;
use Image;
use Illuminate\Support\Facades\Input;

class BannerController extends Controller
{
    public function addBanner(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();
            $banner = new Banner;
            $banner->title = $data['title'];
            $banner->link = $data['link'];

            //for image
            if ($request->hasFile('image')) {
                $files = $request->file('image');
                if ($files->isValid()) {
                    $extension = $files->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;
                    $destinationPath = 'images/frontend_images/banners/' . $filename;
                    //$files->move($destinationPath, $filename);
                    Image::make($files)->resize(1140, 340)->save($destinationPath);

                    $banner->image = $filename;
                } else
                    $banner->image = '';

            }
            if (!empty($data['status'])) {
                $banner->status = 2;
            } else
                $banner->status = 0;
            $banner->save();
            return redirect()->back()->with(['success' => 'Banner inserted successfully']);
        }
        return view('pages.admin.banner.addbanner');
    }

    public function viewBanner()
    {
        $banners = Banner::get();
        return view('pages.admin.banner.viewbanner')->with(compact('banners'));
    }

    public function editBanner(Request $request, $id = null)
    {

        if ($request->isMethod('post')) {
            if ($request->hasFile('image')) {
                $filepath = 'images/frontend_images/banners/';
                $banners = Banner::where(['id' => $id])->first();
                $fileName = $banners->image;
                $old_image = $filepath . $fileName;
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }

                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;
                    $path = 'images/frontend_images/banners/'.$filename;

                    Image::make($image_tmp)->resize(1140, 340)->save($path);

                }
            } else {
                $filename = $request->current_image;
            }

            if (!empty($request->status)) {
                $status = 2;
            } else {
                $status = 0;
            }
            $data = [
                'title' => $request->title,
                'link' => $request->link,
                'image' => $filename,
                'status' => $status
            ];
            $update = Banner::where('id', '=', $id)->update($data);
            if ($update)
                return redirect()->back()->with(['success' => 'Banner Updated sucessfully']);
            else
                return redirect()->back()->with(['dismiss' => 'Banner not Updated ']);
        }
        $banners = Banner::where('id', $id)->first();
        return view('pages.admin.banner.editbanner')->with(compact('banners'));

    }

    public function deleteBannerImage($id = null)
    {
        if (isset($id) && is_numeric($id)) {
            $bannerimage1 = Banner::where('id', $id)->first();
            $bannerimage = Banner::where('id', $id)->update(['image' => '']);
            $filepath = 'images/frontend_images/banners/';
            $fileName = $bannerimage1->image;
            $old_image = $filepath . $fileName;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            if ($bannerimage)
                return redirect()->back()->with(['success' => 'Image Deleted Successfully']);
        }


    }

    public function deleteBanner($id=null){
        if (isset($id) && is_numeric($id)) {
            $filepath = 'images/frontend_images/banners/';
            $banners = Banner::where(['id' => $id])->first();
            $fileName = $banners->image;
            $old_image = $filepath . $fileName;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $deleteBanner = Banner::where(['id' => $id])->delete();
            if ($deleteBanner) {
                return redirect()->back()->with(['success' => 'Banner Deleted Successfully']);
            } else {
                return redirect()->back()->with(['dismiss' => 'Banner not Deleted']);
            }
        }
    }
}
