<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Department;

class LoginAdminDepartmentController extends Controller
{
    public function getLogin() {
     
          return view('auth.loginAdminDepartment');
      
    }

    public function postLogin(Request $request) {
        $this->validate($request, [
            'email'=>'required|email|max:255',
            'password'=>'required|min:3|max:32',
        ],
        [
            'email.required'=>'Vui lòng nhập email của bạn!',
            'email.email' => 'Email chưa đúng định dạng!',
            'email.max'=>'Email không vượt quá 255 ký tự!',
            'password.required'=>'Vui lòng nhập mật khẩu của bạn!',
            'password.min'=>'Mật khẩu có ít nhất 3 ký tự!',
            'password.max'=>'Mật khẩu không vượt quá 32 ký tự!',
        ]);
        
        if (Auth::guard('department')->attempt(['email' => $request->email, 'password' => $request->password])) {
          $user = user::with('Department')->where('email','=', $request->email)->get();
          if($user[0]->status == '1')
          {
              return redirect('/add-information-admindepart');
          }
          elseif($user[0]->status == '2'){
               return redirect('/admin-department');
          }
          else {
              return redirect()->back()->with('error1', 'Tài khoản của bạn khóa!');
          }   
          }
          else {
              return redirect()->back()->with('error', 'Tài khoản hoặc mật khẩu không chính xác!');
          }
    }

    public function getLogout() {
        return redirect('/login-admin-department')->with(Auth::guard('department')->logout());
    }
}
