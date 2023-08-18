<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Filesystem\Filesystem;
use App\Models\User;
use App\Models\Department;
use App\Models\Registration;
use Crypt;

class UserController extends Controller
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
        $id_depart = $request['id_depart'];
        
        $query = User::with('department')->
          where('level' , '=' , '1');

        if($keyword !== '' && $custom == '1') {
          $query->where('code','=', $keyword);
        }
        elseif($keyword !== '' && $custom == '2'){
            $query->where('name','like', '%'.$keyword.'%');
        }elseif($type != '' && $id_depart !=''){
            $query->where('id_depart','=', $id_depart)->where('type','=', $type);
        }elseif($type != '' && $id_depart == ''){
            $query->where('type','like', $type);
        }

        $user = $query->paginate(5)->withQueryString();
        $department = Department::get();
        return view('admin.users.index')->with(compact('keyword', 'query', 'user','department','custom','id_depart'));
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department = Department::get();
        return view('admin.users.create')->with(compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //Kiểm tra đã tồn tại mã ứng viên chưa 
      $userCode=User::select('code')->where('code','=',$request['code'])->first();
      

      $data = $request;
      if($data['id_depart'] != '')
      {
        if(empty($userCode)){
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
        $user->type = $data['type'];
        $user->id_creator = $data['id_creator']; 
        $user->password = Hash::make($data['password']);
        $user->level = $data['level'];
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

        return redirect()->route('user.index')->with('success', 'Thêm ứng viên thành công!');
    }
      
        else{
      return redirect()->back()->with('error', 'Mã ứng viên đã tồn tại !');
    }
      }
      else{
        return redirect()->back()->with('error1', 'Vui lòng chọn khoa của ứng viên !');
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

        $user = User::where('_id', '=', $id)
        ->limit(1)->get();

        $regis = Registration::with('users','competitionperiod')->where('id_user' , '=' , $id)->get();
        $regisCount = Registration::where('id_user' , '=' , $id)->count();
        $regisPassCount = Registration::where('id_user' , '=' , $id)->where('admin_status','=','4')->count();
        
        return view('admin.users.update')->with(compact('user','regis','regisCount','regisPassCount'));
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
              
              'birthday' => 'required|before:18 years ago',
              'address' => 'required|max:255',
              'phone' => 'required|regex:/^[0-9]+$/',
              'email' => 'required|email',
              
          ],
          [
            'birthday.required' => 'Vui lòng nhập ngày sinh!',
            'birthday.before' => 'Ứng viên phải trên 18 tuổi!',
            'address.required' => 'Vui lòng nhập địa chỉ!',
            'address.required' => 'Vui lòng nhập địa chỉ!',
            'address.max' => 'Địa chỉ không vượt quá 255 ký tự!',
            'phone.required' => 'Vui lòng nhập số điện thoại ứng viên!',
            'phone.regex' => 'Số điện thoại chỉ bao gồm số!',
            'email.required' => 'Vui lòng nhập email!',
            'email.email' => 'Vui lòng nhập đúng định dạng email!',
          ]
      );

      $user = User::find($id);
        
      $user->gender = $request->gender;
      $user->birthday = $data['birthday'];
      $user->address = $data['address'];
      $user->phone = $data['phone'];
      $user->email = $data['email'];

        $user->save();

        return redirect()->back()->with('success', 'Cập nhật ứng viên thành công!');
    }
    public function changePassUserAdmin(Request $request, $id)
    {
        $data = $request;

        //Change pass
        $user = User::find($id);
        $user->password = Hash::make($data['pass_new']);
        $user->save();
        // dd($id);
        return redirect()->back()->with("success1","Đổi mật khẩu thành công!");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatusUser(Request $request, $id)
    {
      
      $user = User::find($id);
     
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
