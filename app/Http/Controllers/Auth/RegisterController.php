<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Department;

class RegisterController extends Controller
{
    public function index(){
        $department = Department::where('code_depart', '!=','QTVT' )->get();
        return view('auth.register')->with(compact('department'));
    }
    public function postRegister(Request $request){
        
        //Kiểm tra đã tồn tại mã ứng viên chưa 
      $userCode=User::select('code')->where('code','=',$request['code'])->first();
      $data = $request;
      if($data['type'] == ''){
        return redirect()->back()->with('error3', 'Vui lòng chọn đối tượng !');
      }
      if($data['department'] != '')
      {
        if($data['type']){
          if(empty($userCode)){
           
            $user = new User();
            $user->name = $data['name'];
            $user->code = $data['code'];
            $user->birthday = $data['birthday'];
            $user->address = $data['address'];
            $user->phone = $data['phone'];
            $user->email = $data['email'];
            $user->id_depart = $data['department'];
            $user->course = $data['course'];
            $user->type = $data['type']; 
            $user->password = Hash::make('Ungvien@111');
            $user->level = '1' ;
            $user->status = '0';
    
            //Xử lý để lấy ảnh mặc định cho user
            $sourcePath = 'images/avatar05.jpg'; // Đường dẫn đến ảnh nguồn
            $fileSystem = new Filesystem();
            $name_image = current(explode('.', 'avatar05.jpg'));
            $new_name_image = $name_image.'_'.time().'.'.'avatar05.jpg';
            $path = 'uploads/user/'.$new_name_image; // Đường dẫn đến thư mục đích và tên của ảnh bản sao
            $fileSystem->copy($sourcePath, $path);
            $user->image = $new_name_image;
            $user->save();
    
            return redirect()->back()->with('success','Đăng kí thành công');
        }
          
            else{
          return redirect()->back()->with('error1', 'Mã ứng viên đã được sử dụng để đăng kí, vui lòng kiểm tra lại !');
        }
        }
        else{
          return redirect()->back()->with('error3', 'Vui lòng chọn đối tượng !');
        }
        
      }
      else{
        return redirect()->back()->with('error2', 'Vui lòng chọn khoa !');
      }
    }
}
