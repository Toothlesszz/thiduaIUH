<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Department;

class UserLoginController extends Controller
{
    public function getLogin() {
      return view('auth.loginUser');
    }

    public function postLogin(Request $request) {
        $this->validate($request, [
            'code'=>'required|numeric',
            'password'=>'required|min:6|max:32',
        ],
        [
            'code.required'=>'Vui lòng nhập mã ứng viên của bạn!',
            'code.numeric'=>'Mã số chỉ được nhập số!',
            'password.required'=>'Vui lòng nhập mật khẩu của bạn!',
            'password.min'=>'Mật khẩu có ít nhất 6 ký tự!',
            'password.max'=>'Mật khẩu không vượt quá 32 ký tự!',
        ]);

        if (Auth::attempt(['code' => $request->code, 'password' => $request->password])) {
            $user = user::with('Department')->where('code','=',$request->code)->get();
            
            if($user[0]->status == '1')
            {
              
                return redirect('/add-information');
            }
            elseif($user[0]->status == '2'){
                 return redirect('/user');
            }
            else {
                return redirect()->back()->with('error1', 'Tài khoản của bạn khóa!');
            }
        }
        else {
            return redirect('/login-user')->with('error', 'Thông tin mã số hoặc mật khẩu chưa chính xác!');
        }
    }

    public function getLogout() {
        return redirect('/login-user')->with(Auth::logout());
    }
    
}
