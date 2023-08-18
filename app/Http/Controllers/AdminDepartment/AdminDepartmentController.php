<?php

namespace App\Http\Controllers\AdminDepartment;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Years;
use App\Models\Stylized;
use App\Models\Department;
use App\Models\Registration;
use App\Models\CompetitionPeriod;



class AdminDepartmentController extends Controller
{
    public function homeAdminDepart(Request $request) {
      
      
      $user = User::where('users.id_depart', '=', Auth::guard('department')->user()->id_depart)->get();

      //filter
      $nameStyli = Stylized::where('_id', '=', $request['styli'])->first();
      $academicYear = Years::where('_id','=', $request['year'])->first();
        if($nameStyli != '')
        {
          $stylized = Stylized::where('_id', '!=', $request['styli'])->get();
        }
        else{
          $stylized = Stylized::get();
        }
        if($academicYear !='')
        {
          $year = Years::where('_id','!=' ,$request['year'])->get();
        }
        else{
          $year = Years::get();
        }
      if($request->has('styli') || $request->has('year'))
      {
        $styli = $request['styli'];
        $selectedYear = $request['year'];
        if($styli == '' && $selectedYear ==''){
          $notReviewed = Registration::where('admin_status','=', '0')
          ->where('id_depart','=', Auth::guard('department')->user()->id_depart)->count();
        $regisPassCount = Registration::where('admin_status','=', '4')
        ->where('id_depart','=', Auth::guard('department')->user()->id_depart)
        ->count();
        $regisCount = Registration::where('id_depart','=', Auth::guard('department')->user()->id_depart)->count();
        }
        elseif($styli == '' && $selectedYear !='')
        {
         
          $checkPeriodPerYear = CompetitionPeriod::where('id_year','=', $selectedYear )->get();
          if(!empty($checkPeriodPerYear))
          {
            $id_period[] = '';
            foreach($checkPeriodPerYear as $check)
            {
              array_push($id_period, $check->_id);
            }
            $notReviewed = Registration::where('admin_status','=', '0')->whereIn('id_competitionperiod', $id_period)
          ->where('id_depart','=', Auth::guard('department')->user()->id_depart)->count();
            $regisPassCount = Registration::where('admin_status','=', '4')->whereIn('id_competitionperiod', $id_period)
            ->where('id_depart','=', Auth::guard('department')->user()->id_depart)
            ->count();
            $regisCount = Registration::where('id_depart','=', Auth::guard('department')->user()->id_depart)
            ->whereIn('id_competitionperiod', $id_period)->count();
          }
        }
        elseif($styli !='' && $selectedYear !='')
        {
          
          $checkPeriod = CompetitionPeriod::where('id_year','=', $selectedYear )->where('id_styli','=', $styli)->get();
          if(!empty($checkPeriod))
          {
            $id_period[] = '';
            foreach($checkPeriod as $check)
            {
              array_push($id_period, $check->_id);
            }
            $notReviewed = Registration::where('admin_status','=', '0')->whereIn('id_competitionperiod', $id_period)
          ->where('id_depart','=', Auth::guard('department')->user()->id_depart)->count();
            $regisPassCount = Registration::where('admin_status','=', '4')->whereIn('id_competitionperiod', $id_period)
            ->where('id_depart','=', Auth::guard('department')->user()->id_depart)
            ->count();
            $regisCount = Registration::where('id_depart','=', Auth::guard('department')->user()->id_depart)
            ->whereIn('id_competitionperiod', $id_period)->count();
          }
        }
        elseif($styli !='' && $selectedYear =='')
        {
          $checkPeriodByStyli = CompetitionPeriod::where('id_styli','=', $styli)->get();
          if(!empty($checkPeriodByStyli))
          {
            $id_period[] = '';
            foreach($checkPeriodByStyli as $check)
            {
              array_push($id_period, $check->_id);
            }
            $notReviewed = Registration::where('admin_status','=', '0')->whereIn('id_competitionperiod', $id_period)
          ->where('id_depart','=', Auth::guard('department')->user()->id_depart)->count();
            $regisPassCount = Registration::where('admin_status','=', '4')->whereIn('id_competitionperiod', $id_period)
            ->where('id_depart','=', Auth::guard('department')->user()->id_depart)
            ->count();
            $regisCount = Registration::where('id_depart','=', Auth::guard('department')->user()->id_depart)
            ->whereIn('id_competitionperiod', $id_period)->count();
        }
      }
    }
      else{
        $notReviewed = Registration::where('admin_status','=', '0')
          ->where('id_depart','=', Auth::guard('department')->user()->id_depart)->count();
        $regisPassCount = Registration::where('admin_status','=', '4')
        ->where('id_depart','=', Auth::guard('department')->user()->id_depart)
        ->count();
        $regisCount = Registration::where('id_depart','=', Auth::guard('department')->user()->id_depart)->count();
      }

      $regis = Registration::with('competitionperiod','users')->where('admin_status','=', '0')
      ->where('id_depart','=', Auth::guard('department')->user()->id_depart)
      ->paginate(5)->withQueryString();

        $CompetitionPeriod = CompetitionPeriod::with('stylized')->paginate(5)->withQueryString();
      return view('AdminDepartment.dasboard')
      ->with(compact('user','regis','nameStyli','academicYear', 'regisCount', 'regisPassCount', 'notReviewed','year', 'CompetitionPeriod','stylized'));
    }

    //Change information admin-department
    public function changeInforAdminDepartmentGet() {
      $userInfor = User::where('_id', '=', Auth::guard('department')->user()->_id)
            ->limit(1)->get();
      $departmentid = User::select('id_depart')->where('_id', '=', Auth::guard('department')->user()->_id)->first();
      
      $departmentName = Department::where('_id', '=', trim($departmentid->id_depart))->get();
      return view('adminDepartment.information.changeInfor')->with(compact('userInfor','departmentName'));
    }
    
    public function changeInforAdminDepartmentPost(Request $request, $id) {
     
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

    public function changeImageAdminDepartment(Request $request, $id) {
      
      $data = $request;
        //Change information
        $user = User::find($id);
      
        $get_image = $request->image;
        if($get_image) {
            $path = 'uploads/user/'.$user->image;
            if(file_exists($path)) {
                unlink($path);
            }

            $path = 'uploads/user/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_name_image = $name_image.'_'.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_name_image);

            $user->image = $new_name_image;
        }

        $user->save();
        return redirect()->back()->with("success","Đổi ảnh thành công!");
    }


    public function changePassAdminDepartmentGet() {
      return view('adminDepartment.information.changeInfor');
    }

    public function changePassAdminDepartment(Request $request, $id) {
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
      if(!(Hash::check($request->get('pass_old'), Auth::guard('department')->user()->password))) {
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
    public function downloadFileAdminDepart(Request $request , $fileName)
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
