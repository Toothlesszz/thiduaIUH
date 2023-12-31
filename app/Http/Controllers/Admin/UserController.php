<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Filesystem\Filesystem;
use App\Models\User;
use App\Models\Department;
use App\Models\Registration;
use App\Models\Notifications;
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
        $status = $request['status'];
        $id_depart = $request['id_depart'];
        
        $nameDepart = Department::where('_id', '=', $id_depart)->first();
        if($nameDepart !='')
        {
          $department = Department::where('_id','!=', $id_depart)->get();
        }
        else{
          $department = Department::get();
        }
        $query = User::with('department')->
          where('level' , '=' , '1');

        if($keyword !== '' && $custom == '1') {
          $query->where('code','=', $keyword);
        }
        elseif($keyword !== '' && $custom == '2'){
            $query->where('name','like', '%'.$keyword.'%');
        }elseif($status != '' && $id_depart !=''){
            $query->where('id_depart','=', $id_depart)->where('status','=', $status);
        }elseif($status != '' && $id_depart == ''){
            $query->where('status','=', $status);
        }elseif($status == '' && $id_depart !=''){
            $query->where('id_depart','=', $id_depart);
        }

        $user = $query->paginate(20)->withQueryString();
        $notifications = Notifications::where('id_user','=', Auth::guard('admin')->user()->_id)->get();
        $count = count($notifications);
        return view('admin.users.index')->with(compact('keyword', 'query', 'user','nameDepart','department','notifications','count','custom','status','id_depart'));
      
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
        $department = Department::where('_id', '!=', Auth::guard('admin')->user()->id_depart)->where('_id','!=',$user[0]->id_depart)->get();
        $regisPassCount = Registration::where('id_user' , '=' , $id)->where('admin_status','=','4')->count();
        $notifications = Notifications::where('id_user','=', Auth::guard('admin')->user()->_id)->get();
        $count = count($notifications);
        return view('admin.users.update')->with(compact('user','regis','department','regisCount','regisPassCount','notifications','count'));
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
      $validator = Validator::make($request->all(), 
          [
            'name' =>'required',
            'id_depart' =>'required',
            'birthday' => 'required|before:18 years ago',
            'address' => 'required|max:255',
            'phone' => 'required|regex:/^[0-9]+$/',
            'email' => 'required|email',
          ]);

          if ($validator->fails()) {
            return redirect()->back()->with('error', 'Vui lòng kiểm tra tính chính xác của thông tin!');
        }

      $user = User::find($id);
        
      $user->gender = $request->gender;
      $user->type = $request->type;
      $user->name = $request->name;
      $user->id_depart = $request->id_depart;
      $user->birthday = $request->birthday;
      $user->address = $request->address;
      $user->phone = $request->phone;
      $user->email = $request->email;

        $user->save();
      $checkRegis = Registration::where('id_user', '=', $id)->get();
      if(!empty($checkRegis)){
        $userDepart = User::where('_id', '=', $id)->first();
        foreach($checkRegis as $item){
          $registration = Registration::find($item->_id);
          $registration->id_depart = $userDepart->id_depart;
          $registration->save();
        }
      }
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
      return redirect()->route('user.index')->with("success1","Khóa tài khoản thành công !");

      }
      else{
        $user->status = '2';
      $user->save();
      return redirect()->route('user.index')->with("success1","Khóa tài khoản thành công !");

      }
    }
}
