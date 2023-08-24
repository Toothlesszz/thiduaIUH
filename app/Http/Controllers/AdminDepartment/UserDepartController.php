<?php

namespace App\Http\Controllers\AdminDepartment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Registration;
use App\Models\Department;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Reader\ReaderFactory;
use Crypt;

class UserDepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Dữ liệu trả về trên trang index
    public function index(Request $request)
    {
        $keyword = $request['keyword'] ?? "";
        $custom = $request['custom'] ;
        $type = $request['type'];
        
        $query = User::with('department')
          ->where('id_depart', '=', Auth::guard('department')->user()->id_depart)
          ->where('level' , '=' ,'1' )
          ->orderBy('_id', 'DESC');

        if($keyword !== '' && $custom == '1') {
          $query->where('code','=', $keyword);
        }
        elseif($keyword !== '' && $custom == '2'){
            $query->where('name','like', '%'.$keyword.'%');
        }elseif($type != ''){
            $query->where('type','like', $type);
        }

        $user = $query->paginate(5)->withQueryString();

        return view('adminDepartment.users.index')->with(compact('keyword', 'query', 'user', 'type','custom'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminDepartment.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //Tạo ứng viên mới
    public function store(Request $request)
    {
        //Kiểm tra đã tồn tại mã ứng viên chưa 
        $userCode=User::select('code')->where('code','=',$request['code'])->first();
        
      $data = $request;
      if(empty($userCode)){
        $user = new User();
        $user->name = $data['name'];
        $user->gender = $data['gender'];
        $user->birthday = $data['birthday'];
        $user->address = $data['address'];
        $user->phone = $data['phone'];
        $user->email = $data['email'];
        $user->image = $data['image'];
        $user->code = $data['code'];
        $user->id_depart = Auth::guard('department')->user()->id_depart;
        $user->course = $data['course'];
        $user->type = $data['type'];
        $user->id_creator = $data['id_creator']; 
        $user->password = Hash::make('Ungvien@111');
        $user->level = '1';
        $user->status = '1';
        
        
        //Xử lý để lấy ảnh mặc định cho user
            $sourcePath = 'images/avatar05.jpg'; // Đường dẫn đến ảnh nguồn
            $fileSystem = new Filesystem();
            $name_image = current(explode('.', 'avatar05.jpg'));
            $new_name_image = $name_image.'_'.time().'.'.'avatar05.jpg';
            $path = 'uploads/user/'.$new_name_image; // Đường dẫn đến thư mục đích và tên của ảnh bản sao
            $fileSystem->copy($sourcePath, $path);
            $user->image = $new_name_image;
        
        $user->save();

        return redirect()->back()->with('success', 'Thêm ứng viên thành công!');
    }
    else{
        return redirect()->back()->with('error', 'Mã ứng viên đã tồn tại !');
    }
      
    }

    public function importExcel(Request $request)
    {        
        dd($request->all());
        // $file = $request->file('file');

        // $excel = Excel::load($file);

        // $collection = $excel->get();

        // foreach ($collection as $row) {
        //     // Do something with the row data
        // }

        // return redirect()->back()->with('success', 'Import successful!');
    }
    



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Change user's information
    public function edit($id) {
        $id = Crypt::decrypt($id);
        $user = User::where('_id', '=', $id)
              ->limit(1)->get();
              $regis = Registration::with('users','competitionperiod')->where('id_user' , '=' , $id)->get();
              $regisCount = Registration::where('id_user' , '=' , $id)->count();
              $regisPassCount = Registration::where('id_user' , '=' , $id)->where('admin_status','=','4')->count();
        return view('adminDepartment.users.update')->with(compact('user','regis','regisCount','regisPassCount'));
    }
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

        $user = User::find($id);
        
        $user->gender = $request->gender;
        $user->birthday = $data['birthday'];
        $user->address = $data['address'];
        $user->phone = $data['phone'];
        $user->email = $data['email'];
        $user->id_depart = Auth::guard('department')->user()->id_depart;
        

        $user->save();

        return redirect()->back()->with('success', 'Cập nhật ứng viên thành công!');
    }

    public function changePassUser(Request $request, $id)
    {
        $data = $request;
  
        
  
        //Change pass
        $user = User::find($id);
        $user->password = Hash::make($data['pass_new']);
        $user->save();
        return redirect()->back()->with("success1","Đổi mật khẩu thành công!");
    }

    // Change status user 
    public function changeStatusUserAdminDepart($id)
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