<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Years;
use App\Models\Department;
use App\Models\Stylized;
use App\Models\Registration;
use App\Models\RegistrationDetails;
use App\Models\CompetitionPeriod;
use App\Models\Pictures;
use App\Models\SlideStorage;
use App\Models\Notifications;
use DB;

class AdminController extends Controller
{
    public function dasboard(Request $request) {
      if( Auth::guard('admin')->user()->status == '0'){
        return redirect('/login-admin')->with(Auth::logout());
    }    
      $regis = Registration::with('competitionperiod','users')
      ->whereIn('admin_status', ['1','2'])->paginate(5)->withQueryString();
//filter
      $nameStyli = Stylized::where('_id', '=', $request['styli'])->first();
      $nameDepart = Department::where('_id','=',$request['depart'])->first();
      $academicYear = Years::where('_id','=', $request['year'])->first();
        if($nameStyli != '')
        {
          $stylized = Stylized::where('_id', '!=', $request['styli'])->get();
        }
        else{
          $stylized = Stylized::get();
        }
        if($nameDepart !='')
        {
          $department = Department::where('_id','!=', $request['depart'])->get();
        }
        else{
          $department = Department::get();
        }
        if($academicYear !='')
        {
          $years = Years::where('_id','!=' ,$request['year'])->get();
        }
        else{
          $years = Years::get();
        }
      
      if($request->has('styli') || $request->has('year') || $request->has('depart'))
      {
        $styli = $request['styli'];
        $depart = $request['depart'];
        $selectedYear = $request['year'];
        if($styli == '' && $selectedYear =='' && $depart == ''){
          $notReviewed = Registration::where('admin_status','=', '0')->count();
        $regisPassCount = Registration::where('admin_status','=', '4')->count();
        $regisCount = Registration::count();
        }
        elseif($styli == '' && $selectedYear =='' && $depart != ''){
          $notReviewed = Registration::where('admin_status','=', '0')->where('id_depart','=', $depart)->count();
        $regisPassCount = Registration::where('admin_status','=', '4')->where('id_depart','=', $depart)->count();
        $regisCount = Registration::where('id_depart','=', $depart)->count();
        }
        elseif($styli == '' && $selectedYear !='' && $depart !='')
        {
          
          $checkPeriodPerYear = CompetitionPeriod::where('id_year','=', $selectedYear )->get();
          if(!empty($checkPeriodPerYear))
          {
            $id_period[] = '';
            foreach($checkPeriodPerYear as $check)
            {
              array_push($id_period, $check->_id);
            }
            $notReviewed = Registration::where('admin_status','=', '0')->where('id_depart','=', $depart)
            ->whereIn('id_competitionperiod', $id_period)->count();
            $regisPassCount = Registration::where('admin_status','=', '4')->where('id_depart','=', $depart)
            ->whereIn('id_competitionperiod', $id_period)->count();
            $regisCount = Registration::whereIn('id_competitionperiod', $id_period)
            ->where('id_depart','=', $depart)->count();
          }
        }
        elseif($styli == '' && $selectedYear !='' && $depart =='')
        {
          
          $checkPeriodPerYear = CompetitionPeriod::where('id_year','=', $selectedYear )->get();
          if(!empty($checkPeriodPerYear))
          {
            $id_period[] = '';
            foreach($checkPeriodPerYear as $check)
            {
              array_push($id_period, $check->_id);
            }
            $notReviewed = Registration::where('admin_status','=', '0')
            ->whereIn('id_competitionperiod', $id_period)->count();
            $regisPassCount = Registration::where('admin_status','=', '4')
            ->whereIn('id_competitionperiod', $id_period)->count();
            $regisCount = Registration::whereIn('id_competitionperiod', $id_period)->count();
          }
        }
        elseif($styli !='' && $selectedYear !='' && $depart == '')
        {
          $checkPeriod = CompetitionPeriod::where('id_year','=', $selectedYear )->where('id_styli','=', $styli)->get();
          if(!empty($checkPeriod))
          {
            $id_period[] = '';
            foreach($checkPeriod as $check)
            {
              array_push($id_period, $check->_id);
            }
            $notReviewed = Registration::where('admin_status','=', '0')
            ->whereIn('id_competitionperiod', $id_period)->count();
            $regisPassCount = Registration::where('admin_status','=', '4')
            ->whereIn('id_competitionperiod', $id_period)->count();
            $regisCount = Registration::whereIn('id_competitionperiod', $id_period)->count();
          }
        }
        elseif($styli !='' && $selectedYear !='' && $depart != '')
        {
          $checkPeriod = CompetitionPeriod::where('id_year','=', $selectedYear )->where('id_styli','=', $styli)->get();
          if(!empty($checkPeriod))
          {
            $id_period[] = '';
            foreach($checkPeriod as $check)
            {
              array_push($id_period, $check->_id);
            }
            $notReviewed = Registration::where('admin_status','=', '0')->where('id_depart','=', $depart)
            ->whereIn('id_competitionperiod', $id_period)->count();
            $regisPassCount = Registration::where('admin_status','=', '4')->where('id_depart','=', $depart)
            ->whereIn('id_competitionperiod', $id_period)->count();
            $regisCount = Registration::whereIn('id_competitionperiod', $id_period)
            ->where('id_depart','=', $depart)->count();
          }
        }
        elseif($styli !='' && $selectedYear =='' && $depart == '')
        {
          $checkPeriodByStyli = CompetitionPeriod::where('id_styli','=', $styli)->get();
          if(!empty($checkPeriodByStyli))
          {
            $id_period[] = '';
            foreach($checkPeriodByStyli as $check)
            {
              array_push($id_period, $check->_id);
            }
            $notReviewed = Registration::where('admin_status','=', '0')
            ->whereIn('id_competitionperiod', $id_period)->count();
            $regisPassCount = Registration::where('admin_status','=', '4')->whereIn('id_competitionperiod', $id_period)->count();
            $regisCount = Registration::whereIn('id_competitionperiod', $id_period)->count();
        }
      }
      elseif($styli !='' && $selectedYear =='' && $depart != '')
        {
          $checkPeriodByStyli = CompetitionPeriod::where('id_styli','=', $styli)->get();
          if(!empty($checkPeriodByStyli))
          {
            $id_period[] = '';
            foreach($checkPeriodByStyli as $check)
            {
              array_push($id_period, $check->_id);
            }
            $notReviewed = Registration::where('admin_status','=', '0')->where('id_depart','=', $depart)
            ->whereIn('id_competitionperiod', $id_period)->count();
            $regisPassCount = Registration::where('admin_status','=', '4')->where('id_depart','=', $depart)
            ->whereIn('id_competitionperiod', $id_period)->count();
            $regisCount = Registration::whereIn('id_competitionperiod', $id_period)
            ->where('id_depart','=', $depart)->count();
        }
      }
    }
      else{
        $notReviewed = Registration::where('admin_status','=', '0')->count();
        $regisPassCount = Registration::where('admin_status','=', '4')->count();
        $regisCount = Registration::count();
      }
      

      $CompetitionPeriod = CompetitionPeriod::with('stylized')->get();
      $pictures = Pictures::get();
      $slideShow = SlideStorage::orderBy('number', 'asc')->get();
      $notifications = Notifications::where('id_user','=', Auth::guard('admin')->user()->_id)->get();
      $count = count($notifications);
      return view('admin.dasboard')
      ->with(compact( 'stylized', 'regisCount','pictures','slideShow','nameStyli','notifications','count','nameDepart','academicYear', 'regisPassCount','CompetitionPeriod','regis','notReviewed','years','stylized','department'));
    }

    public function inforAdmin() {
      $adminInfor = User::where('_id', '=', Auth::guard('admin')->user()->_id)->limit(1)->get();

      return view('admin.informationAdmin.inforAdmin')->with(compact('adminInfor'));
    }
    public function changeInforAdminGet() {
      
      $userInfor = User::where('_id', '=', Auth::guard('admin')->user()->_id)
            ->limit(1)->get();
      $departmentid = User::select('id_depart')->where('_id', '=', Auth::guard('admin')->user()->_id)->first();
      
      $departmentName = Department::where('_id', '=', trim($departmentid->id_depart))->get();
      $notifications = Notifications::where('id_user','=', Auth::guard('admin')->user()->_id)->get();
      $count = count($notifications);
      return view('admin.informationAdmin.changeInfor')->with(compact('userInfor','notifications','count','departmentName'));
    }
    
    public function changeInforAdminPost(Request $request, $id) {
     
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

    public function changeImageAdmin(Request $request, $id) {

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


    public function changePassAdminGet() {
      return view('admin.informationAdmin.changeInfor');
    }

    public function changePassAdmin(Request $request, $id) {
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
      if(!(Hash::check($request->get('pass_old'), Auth::guard('admin')->user()->password))) {
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
}
