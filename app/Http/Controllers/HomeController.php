<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Compete;
use App\Models\Stylized;
use App\Models\Years;
use App\Models\Department;
use App\Models\CompetitionPeriod;
use App\Models\Registration;
use App\Models\Certification;

class HomeController extends Controller
{
    public function home() {
    
      $register = Registration::where('id_user', '=', Auth::user()->_id)->get();
    
      $userInfor = User::where('_id', '=', Auth::user()->_id)->limit(1)->get();

      $departmentid = User::select('id_depart')->where('_id', '=', Auth::user()->_id)->first();             
      $departmentName = Department::where('_id', '=', trim($departmentid->id_depart))->first();
      
      $regisCount = Registration::where('id_user', '=', Auth::user()->_id)->count();
      $regisPassCount = Registration::where('id_user', '=', Auth::user()->_id)->where('admin_status','=','4')->count();

      $CompetitionPeriod = CompetitionPeriod::with('stylized')->paginate(6);
        
      return view('users.home')->with(compact('register', 'departmentName', 'regisCount' , 'regisPassCount' ,'CompetitionPeriod'));
    }

     //View user's information
     public function inforUser() {
      $userInfor = User::where('_id', '=', Auth::user()->_id)
            ->limit(1)->get();
            
      $departmentid = User::select('id_depart')->where('_id', '=', Auth::user()->_id)->first();
      $departmentName = Department::where('_id', '=', trim($departmentid->id_depart))->get();
       
      return view('users.information.infor')->with(compact('userInfor', 'departmentName', 'departmentid'));
    }
    //Change user's information
    public function changeInforGet() {
      $userInfor = User::where('_id', '=', Auth::user()->_id)
            ->limit(1)->get();
      $departmentid = User::select('id_depart')->where('_id', '=', Auth::user()->_id)->first();
      
      $departmentName = Department::where('_id', '=', trim($departmentid->id_depart))->get();
      return view('users.information.changeInfor')->with(compact('userInfor','departmentName'));
    }
    
    public function changeInforPost(Request $request, $id) {
     
      $data = $request->validate(
        [
            'birthday' => 'required|before:18 years ago',
            'address' => 'required|max:255',
              'phone' => 'required|regex:/^[0-9]+$/',
              'email' => 'required|email|max:155',
              
        ],
        [
            'birthday.required' => 'Vui lòng nhập ngày sinh!',
            'birthday.before' => 'Ứng viên phải trên 18 tuổi!',
            'address.required' => 'Vui lòng nhập địa chỉ!',
              'address.max' => 'Địa chỉ không vượt quá 255 ký tự!',
              'phone.required' => 'Vui lòng nhập số điện thoại ứng viên!',
              'phone.regex' => 'Số điện thoại chỉ bao gồm số!',
              'email.required' => 'Vui lòng nhập email!',
              'email.email' => 'Vui lòng nhập đúng định dạng email!',
              'email.max' => 'Email không vượt quá 155 ký tự!',
              
              
        ]
    );
      
        //Change information
        $user = User::find($id);
      
      $user->gender = $request->gender;
      $user->birthday = $data['birthday'];
      $user->address = $data['address'];
      $user->phone = $data['phone'];
      $user->email = $data['email'];
      $user->save();
        return redirect()->back()->with("success","Đổi thông tin thành công!");
    }

    public function changeImage(Request $request, $id) {
      
      $data = $request;
        //Change information
        $user = User::find($id);
        $get_image = $request->image;
        if($get_image) {
            $path = 'uploads/user/'.$user->image;
            if($user->image != '' ) {
            unlink($path);
            $path = 'uploads/user/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_name_image = $name_image.'_'.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_name_image);

            $user->image = $new_name_image;
            }
            else{
              $path = 'uploads/user/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_name_image = $name_image.'_'.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_name_image);

            $user->image = $new_name_image;
            }   
        }
        

        $user->save();
        return redirect()->back()->with("success","Đổi ảnh thành công!");
    }


    public function changePassGet() {
      return view('users.information.changeInfor');
    }

    public function changePassPost(Request $request, $id) {
      $data = $request->validate(
          [
            'pass_old' => 'required|min:6',
            'pass_new' => 'required|min:6|max:32',
            'confirm_pass_new' => 'required|min:6|max:32',
          ],
          [
            'pass_old.required' => 'Vui lòng nhập vào mật khẩu cũ!',
            'pass_old.min' => 'Mật khẩu cũ chứa tối đa 6 ký tự!',
            'pass_new.required' => 'Vui lòng nhập vào mật khẩu mới!',
            'pass_new.min' => 'Mật khẩu phải dài hơn 6 ký tự!',
            'pass_new.max' => 'Mật khẩu không dài hơn 32 ký tự!',
            'confirm_pass_new.required' => 'Vui lòng nhập lại mật khẩu!',
            'confirm_pass_new.min' => 'Mật khẩu phải dài hơn 6 ký tự!',
            'confirm_pass_new.max' => 'Mật khẩu không dài hơn 32 ký tự!',
          ]
      );

      //Check password
      if(!(Hash::check($request->get('pass_old'), Auth::user()->password))) {
        return redirect()->back()->with("error", "Mật khẩu cũ của bạn không chính xác!");
      }

      if(strcmp($request->get('pass_old'), $request->get('pass_new')) == 0) {
        return redirect()->back()->with("error", "Mật khẩu mới và mật khẩu cũ không được giống nhau!");
      }

      if($request->get('pass_new') != $request->get('confirm_pass_new')) {
        return redirect()->back()->with("error", "Mật khẩu nhập lại không trùng khớp!");
      }

      //Change pass
      $user = User::find($id);
      $user->password = Hash::make($data['pass_new']);
      $user->save();
      // dd($id);
      return redirect()->back()->with("success","Đổi mật khẩu thành công!");
    }
// Download intruction files
public function downloadFileUser(Request $request , $fileName)
{
    
    $filePath = public_path('uploads/files/'.$fileName);
    $file = $fileName;

    // Kiểm tra xem file có tồn tại hay không
    if (!file_exists($filePath)) {
        abort(404);
    }

    // Thiết lập header cho phản hồi download
    $headers = [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="' . $file . '"',
    ];

    // Trả về response download
    return response()->download($filePath, $file, $headers);
}

}
