<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Pictures;
use App\Models\SlideStorage;
use App\Models\Notifications;
use DB;

class SlideShowController extends Controller
{
    public function index()
    {
      if( Auth::guard('admin')->user()->status != '2'){
        return redirect('/login-admin')->with(Auth::logout());
    }
        if(Auth::guard('admin')->user()->level == '5'){
            $pictures = Pictures::get();
            $slideShow = SlideStorage::orderBy('number', 'asc')->get();
            $notifications = Notifications::where('id_user','=', Auth::guard('admin')->user()->_id)->get();
            $count = count($notifications);
            return view('admin.slideshow.slideshow')->with(compact('pictures','slideShow','notifications','count'));
        }
        else{
            return redirect()->back()->with("error","Bạn không có quyền truy cập trang này !");
        }
        
    }
    public function slideShow(Request $request)
    {
      DB::collection('slide_storage')->delete();
      $dem = 0;
      foreach($request->input('slide') as $image){
      $SlideStorage = new SlideStorage();
      $SlideStorage->number = $dem++;
      $SlideStorage->image = $image;
      $SlideStorage->save();

      }
      return redirect()->back()->with("success1","Chỉnh sửa Slideshow thành công !");
    }
    public function uploadImages(Request $request){
    
      $get_image = $request->image;

            $path = 'images/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_name_image = $name_image.'_'.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_name_image);

            $pictures = new Pictures();
            $pictures->name = $new_name_image;
            $pictures->save();
        return redirect()->back()->with("success","Thêm ảnh mới thành công !");
    }

    public function deleteImages(Request $request, $name){
      $check = SlideStorage::where('image', '=', $name)->first();
      if(empty($check)){
        $path = 'images/'.$name;
        if(file_exists($path)) {
            unlink($path);
            $pictures = Pictures::where('name', '=', $name)->delete();
            return redirect()->back()->with("success2","Xóa ảnh thành công !");
        }
        else{
          return redirect()->back()->with("error","Đã có lỗi xảy ra, không tìm thấy ảnh cần xóa!");
        } 
      }
       else{
          return redirect()->back()->with("error1","Không thể xóa ảnh đang sử dụng trên Slide!");
       } 
      
    }
}
