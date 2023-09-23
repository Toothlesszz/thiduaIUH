<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Department;

class AddInformationUser extends Controller
{
    public function index()
{

    if(Auth::user()->_id != ''){
        $user = User::where('_id','=',Auth::user()->_id)->get();
    return view('users.addinformation.addInfor')->with(compact('user'));
    }
    
}
    // User need to add information after first time login.
public function addInformationUser(Request $request, $id)
{   
  $data = $request->validate(
    [
        'birthday' => 'before:18 years ago',
        'address' => 'max:255',
        'phone' => 'regex:/^[0-9]+$/',
        'email' => 'required|email|max:155',
        'pass_old' => 'required|min:6',
        'pass_new' => 'required|min:6|max:32',
        'confirm_pass_new' => 'required|min:6|max:32',
    ],
    [
        'birthday.before' => 'Ứng viên phải trên 18 tuổi!',
        'address.max' => 'Địa chỉ không vượt quá 255 ký tự!',
        'phone.regex' => 'Số điện thoại chỉ bao gồm số!',
        'email.required' => 'Vui lòng nhập email!',
        'email.email' => 'Vui lòng nhập đúng định dạng email!',
        'email.max' => 'Email không vượt quá 155 ký tự!',
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
    return redirect()->back()->with("error3", "Mật khẩu cũ của bạn không chính xác!");
  }

  if(strcmp($request->get('pass_old'), $request->get('pass_new')) == 0) {
    return redirect()->back()->with("error4", "Mật khẩu mới và mật khẩu cũ không được giống nhau!");
  }

  if($request->get('pass_new') != $request->get('confirm_pass_new')) {
    return redirect()->back()->with("error5", "Mật khẩu nhập lại không trùng khớp!");
  }
            $User = User::find($id);
            $User->birthday = $data['birthday'];
            $User->email = $data['email'];
            $User->address = $data['address'];
            $User->gender = $request->gender;
            $User->phone = $data['phone'];
            $User->status = '2';
            $User->password = Hash::make($data['pass_new']);
            $User->save();
        return redirect('/user')->with("success1", 'Cập nhật thành công!');
}

}
