<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;
use Crypt;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request['keyword'] ?? "";
        $custom = $request['custom'] ;
        $type = $request['type'];
        
        $query = User::with('department')->
          where('level' , '=' , '3')->orwhere('level', '=' , '4');

        if($keyword !== '' && $custom == '1') {
          $query->where('code','=', $keyword);
        }
        elseif($keyword !== '' && $custom == '2'){
            $query->where('name','like', '%'.$keyword);
        }elseif($type != ''){
            $query->where('id_depart','=', $type);
            
        }
        
        $user = $query->paginate(5);
        
        $department = Department::get();
        return view('admin.department.index')->with(compact('keyword', 'query', 'user','department'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
      
      $userCode = User::select('code')->where('code','=',$request['code'])->first();
      $userEmail = User::select('emal')->where('email','=',$request['email'])->first();

      $data = $request;

      if($data['id_depart'] != ''){
        if(empty($userCode))
        {
          if(empty($userEmail))
          {
            $user = new User();

            $user->name = $data['name'];
            $user->gender = $data['gender'];
            $user->code = $data['code'];
            $user->birthday = $data['birthday'];
            $user->address = $data['address'];
            $user->phone = $data['phone'];
            $user->email = $data['email'];
            $user->id_depart = $data['id_depart'];
            $user->course = $data['course'];   
            $user->id_creator = $data['id_creator'];   
            $user->password = Hash::make($data['password']);
      
            if($data['id_depart'] == '6468eda68ab7c76743862c5b')
            {
              $user->level = '4';
              $user->type = 'Quản Trị Viên Trường';
            }
            else{
              $user->level = $data['level'];
              $user->type = $data['type'];
            }
            
            
            $user->status = $data['status'];
      
              //Xử lý để lấy ảnh mặc định cho user
              $sourcePath = 'images/avatar05.jpg'; // Đường dẫn đến ảnh nguồn
              $fileSystem = new Filesystem();
              $name_image = current(explode('.', 'avatar05.jpg'));
              $new_name_image = $name_image.'_'.time().'.'.'avatar05.jpg';
              $path = 'uploads/user/'.$new_name_image; // Đường dẫn đến thư mục đích và tên của ảnh bản sao
              $fileSystem->copy($sourcePath, $path);
              $user->image = $new_name_image;
            $user->save();
      
            return redirect()->route('department.index')->with('success1', 'Thêm quản trị viên Khoa thành công!');
          }
         else{
          return redirect()->route('department.index')->with('error3', 'Email đã tồn tại !');
         }
        }
        else{
          return redirect()->route('department.index')->with('error2', 'Mã quản trị viên đã tồn tại !');
        }
        
      }
      else{
        return redirect()->route('department.index')->with('error1', 'Vui lòng chọn khoa!');
      }
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $userDepart = User::where('_id', '=', $id)
              ->limit(1)->get();
        return view('admin.department.update')->with(compact('userDepart'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $data = $request->validate(
        [
            'birthday' => 'before:18 years ago',
            'address' => 'max:255',
            'phone' => 'regex:/^[0-9]+$/',
            'email' => 'email|max:155',
        ],
        [
            'birthday.before' => 'Ứng viên phải trên 18 tuổi!',
            'address.max' => 'Địa chỉ không vượt quá 255 ký tự!',
            'phone.regex' => 'Số điện thoại chỉ bao gồm số!',
            'email.required' => 'Vui lòng nhập email!',
            'email.email' => 'Vui lòng nhập đúng định dạng email!',
            'email.max' => 'Email không vượt quá 155 ký tự!',
            
        ]
    );

      $User = User::find($id);
      $User->birthday = $data['birthday'];
      $User->email = $data['email'];
      $User->address = $data['address'];
      $User->gender = $request->gender;
      $User->phone = $data['phone'];

      $User->save();

      return redirect()->route('department.index')->with("success", 'Cập nhật thành công!');
    }
    public function changePassAdmindepart(Request $request, $id)
    {
        $data = $request;
  
        //Check password
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
    public function changeStatusDepart(Request $request, $id)
    {
      
      $user = User::find($id);
      if($request->level == '3')
      {
        if($user->status != '3')
        {
          $user->status = '3';
        $user->save();
        return redirect()->back()->with("success","Khóa tài khoản thành công !");
        }
        else{
          
            $user->status = '2';
        $user->save();
        return redirect()->back()->with("success","Mở khóa tài khoản thành công !");
          }
          
      }
      
     elseif($request->level == '4')
     {
        
            if($user->status != '3')
            {
              $user->status = '3';
            $user->save();
            return redirect()->back()->with("success","Khóa tài khoản thành công !");
            }
            else{
              $user->status = '2';
            $user->save();
            return redirect()->back()->with("success","Khóa tài khoản thành công !");
            }
           
    }
    
}
}