<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Department;

class LoginAdminController extends Controller
{
    public function getLogin() {
      return view('auth.loginAdmin');
    }

    public function postLogin(Request $request) { 
      $this->validate($request, [
          'email'=>'required|email',
          'password'=>'required|min:6|max:32',
      ],
      [
          'email.required'=>'Vui lòng nhập email của bạn!',
          'email.email'=>'Vui lòng nhập đúng định dạng email!',
          'password.required'=>'Vui lòng nhập mật khẩu của bạn!',
          'password.min'=>'Mật khẩu có ít nhất 6 ký tự!',
          'password.max'=>'Mật khẩu không vượt quá 32 ký tự!',
      ]);
      
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password,])) {
        $user = user::with('Department')->where('email','=',$request->email)->get();
        if($user[0]->status == '1')
            {
                return redirect('/add-information-admin');
            }
            elseif($user[0]->status == '2'){
                 return redirect('/admin');
            }
            else {
                return redirect()->back()->with('error1', 'Tài khoản của bạn khóa!');
            }
    }
    else{
            return redirect('/login-admin')->with('error', 'Thông tin tài khoản hoặc mật khẩu không chính xác!');
        }
    }
 // User need to add information after fisrt time login.
//  public function addInformationAdmin(Request $request, $id)
//  {
//    $data = $request->validate(
//      [
//          'birthday' => 'before:18 years ago',
//          'address' => 'max:255',
//          'phone' => 'regex:/^[0-9]+$/',
//          'email' => 'email|max:155',
//      ],
//      [
//          'birthday.before' => 'Ứng viên phải trên 18 tuổi!',
//          'address.max' => 'Địa chỉ không vượt quá 255 ký tự!',
//          'phone.regex' => 'Số điện thoại chỉ bao gồm số!',
//          'email.required' => 'Vui lòng nhập email!',
//          'email.email' => 'Vui lòng nhập đúng định dạng email!',
//          'email.max' => 'Email không vượt quá 155 ký tự!',
         
//      ]
//  );

//    $User = User::find($id);
//    $User->birthday = $data['birthday'];
//    $User->email = $data['email'];
//    $User->address = $data['address'];
//    $User->gender = $request->gender;
//    $User->phone = $data['phone'];
//    $User->status = '2';
//    $User->save();

//    return redirect('/admin')->with("success1", 'Cập nhật thành công!');
//  }
//  // Change password fisrt time
//  public function changePassFirsttimeAdmin(Request $request, $id) {
//      $data = $request->validate(
//          [
//            'pass_old' => 'required|min:6',
//            'pass_new' => 'required|min:6|max:32',
//            'confirm_pass_new' => 'required|min:6|max:32',
//          ],
//          [
//            'pass_old.required' => 'Vui lòng nhập vào mật khẩu cũ!',
//            'pass_old.min' => 'Mật khẩu cũ chứa tối đa 6 ký tự!',
//            'pass_new.required' => 'Vui lòng nhập vào mật khẩu mới!',
//            'pass_new.min' => 'Mật khẩu phải dài hơn 6 ký tự!',
//            'pass_new.max' => 'Mật khẩu không dài hơn 32 ký tự!',
//            'confirm_pass_new.required' => 'Vui lòng nhập lại mật khẩu!',
//            'confirm_pass_new.min' => 'Mật khẩu phải dài hơn 6 ký tự!',
//            'confirm_pass_new.max' => 'Mật khẩu không dài hơn 32 ký tự!',
//          ]
//      );

//      //Check password
//      if(!(Hash::check($request->get('pass_old'), Auth::user()->password))) {
//        return redirect()->back()->with("error", "Mật khẩu cũ của bạn không chính xác!");
//      }

//      if(strcmp($request->get('pass_old'), $request->get('pass_new')) == 0) {
//        return redirect()->back()->with("error", "Mật khẩu mới và mật khẩu cũ không được giống nhau!");
//      }

//      if($request->get('pass_new') != $request->get('confirm_pass_new')) {
//        return redirect()->back()->with("error", "Mật khẩu nhập lại không trùng khớp!");
//      }

//      //Change pass
//      $user = User::find($id);
//      $user->password = Hash::make($data['pass_new']);
//      $user->save();
//      // dd($id);
//      return redirect()->back()->with("success","Đổi mật khẩu thành công!");
//    }
//    public function changeImageFirsttimeAdmin(Request $request, $id) {
   
//      $data = $request;
//        //Change information
//        $user = User::find($id);
//        $get_image = $request->image;
//        if($get_image) {
//            $path = 'uploads/user/'.$user->image;
//            if($path != 'uploads/user/' ) {
//                unlink($path);
//            $path = 'uploads/user/';
//            $get_name_image = $get_image->getClientOriginalName();
//            $name_image = current(explode('.', $get_name_image));
//            $new_name_image = $name_image.'_'.time().'.'.$get_image->getClientOriginalExtension();
//            $get_image->move($path, $new_name_image);

//            $user->image = $new_name_image;
//            }
//            else{
//              $path = 'uploads/user/';
//            $get_name_image = $get_image->getClientOriginalName();
//            $name_image = current(explode('.', $get_name_image));
//            $new_name_image = $name_image.'_'.time().'.'.$get_image->getClientOriginalExtension();
//            $get_image->move($path, $new_name_image);

//            $user->image = $new_name_image;
//            }   
//        }
       

//        $user->save();
//        return redirect()->back()->with("success","Đổi ảnh thành công!");
//    }
    public function getLogout() {
        return redirect('/login-admin')->with(Auth::guard('admin')->logout());
    }
}
