<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Pusher\Pusher;
use Illuminate\Support\Facades\Notification\Certificated;
use App\Events\CertificatedEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\RegistrationDetails;
use App\Models\Ceriterias;
use App\Models\Stylized;
use App\Models\CeriteriasDetail;
use App\Models\UserTracing;
use App\Models\Notifications;
use Carbon\Carbon;
use Crypt;

class ReviewDetailStylizedController extends Controller
{
    public function showDetailCeriteriaAdmin($id)
    {
        if( Auth::guard('admin')->user()->status != '2'){
            return redirect('/login-admin')->with(Auth::logout());
        }
        $userTracing = UserTracing::with('users')->where('id_profile', '=', $id)->orderBy('update_date','desc')->get();
        $regis = Registration::with('competitionperiod', 'users')
        ->where('_id', $id)->first();

    $regis_detail = RegistrationDetails::where('id_regis', $id)->get();
    $criterias = Ceriterias::where('id_styli', $regis->competitionperiod->id_styli)->get();

    $id_criteria_detail = $regis_detail->pluck('id_criteria_detail')->toArray();

    $filtered_criterias = $criterias->filter(function ($criteria) use ($id_criteria_detail) {
        return CeriteriasDetail::whereIn('_id', $id_criteria_detail)
            ->where('id_criter', $criteria->_id)
            ->exists();
    });

    foreach ($filtered_criterias as $criteria) {
        $criteria->criteria_detail = CeriteriasDetail::whereIn('_id', $id_criteria_detail)
            ->where('id_criter', $criteria->_id)
            ->get();
        // Gán tiêu chí vào tiêu chuẩn
    }
    $notifications = Notifications::where('id_user','=', Auth::guard('admin')->user()->_id)->get();
    $count = count($notifications);
    return view('admin.reviewStylized.criteria-detail')->with(compact('userTracing','regis_detail', 'regis', 'filtered_criterias','id_criteria_detail','notifications','count'));
    }

    public function updateRegistrationDetailAdmin(Request $request, $id)
    {

    // Thiết lập múi giờ là 'Asia/Ho_Chi_Minh' (Việt Nam)
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    // Lấy ngày hiện tại của Việt Nam
    $currentDate = Carbon::now()->toDateTimeString();

    $Registration = Registration::find($id);
    //Lưu lại nội dung thông báo
    $notification = new Notifications();
    $notification->id_user = $Registration->id_user;
    $notification->status = $request->status_input; 
    $notification->date = $currentDate;
    $notification->read = 'False';
    $notification->id_stylized = $Registration->competitionperiod->id_styli;
    $notification->save();

    // Lưu vết của người dùng
    $userTracing = new UserTracing();
    $userTracing->id_user = Auth::guard('admin')->user()->_id;
    $userTracing->name_user = Auth::guard('admin')->user()->name;
    $userTracing->content = $request->admin_note;
    $userTracing->update_date = $currentDate;
    $userTracing->id_profile = $id;
    $userTracing->save();
    //Xét duyệt
        if($request->status_input == '4')
        {
            $Registration->admin_status = $request->status_input;
            $Registration->admin_note = $request->admin_note;
            $Registration->save();
            

            $checked_values = $request->input('id_registration_detail');
            if($checked_values == '')
            {
                $message = 'Trạng thái hồ sơ đã được cập nhật !';
                $userID = $Registration->id_user;

                $option = array(
                'cluster' => 'ap1',
                'useTLS' => true
                );
                $pusher = new Pusher(
                    
                    env('PUSHER_APP_KEY'),
                    env('PUSHER_APP_SECRET'),
                    env('PUSHER_APP_ID'),
                    $option
                );
                $data = ['userID' => $userID,
                        'message' => $message
                        ];
                $pusher->trigger('noti-channel', 'profile-reviewed', $data );

                // event(new CertificatedEvent($message));
                return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
            }
            else{
                foreach ($checked_values as $regis_detail_id => $regis_detail) {
                    $Registration_detail = RegistrationDetails::find($regis_detail_id);
                    
                    if ($Registration_detail) {
                        if (isset($regis_detail['checked'])) {
                            $Registration_detail->reason = $regis_detail['checked'];
                        } else {
                            $Registration_detail->reason = 0; // Giá trị mặc định nếu không được chọn
                            }
                        
                        $Registration_detail->save();
                            }
                        }
            }
    
            
        }
        elseif($request->status_input == '5')
        {
            
            
            $Registration->admin_status = $request->status_input;
            $Registration->admin_note = $request->admin_note;

            $Registration->save();
            $checked_values = $request->input('id_registration_detail');
            if($checked_values == ''){
               
                $message = 'Trạng thái hồ sơ đã được cập nhật !';
                $userID = $Registration->id_user;

                $option = array(
                'cluster' => 'ap1',
                'useTLS' => true
                );
                $pusher = new Pusher(
                    
                    env('PUSHER_APP_KEY'),
                    env('PUSHER_APP_SECRET'),
                    env('PUSHER_APP_ID'),
                    $option
                );
                $data = ['userID' => $userID,
                        'message' => $message
                        ];
                $pusher->trigger('noti-channel', 'profile-reviewed', $data );
                return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
            }
            else{
                foreach ($checked_values as $regis_detail_id => $regis_detail) {
                    $Registration_detail = RegistrationDetails::find($regis_detail_id);
                    
                        if ($Registration_detail) {
                            if (isset($regis_detail['checked'])) {
                                $Registration_detail->reason = $regis_detail['checked'];
                            } else {
                                $Registration_detail->reason = 0; // Giá trị mặc định nếu không được chọn
                            }
                            
                            $Registration_detail->save();
                            }
                        }   
            }
        
        }
           
        $message = 'Trạng thái hồ sơ đã được cập nhật !';
                $userID = $Registration->id_user;

                $option = array(
                'cluster' => 'ap1',
                'useTLS' => true
                );
                $pusher = new Pusher(
                    
                    env('PUSHER_APP_KEY'),
                    env('PUSHER_APP_SECRET'),
                    env('PUSHER_APP_ID'),
                    $option
                );
                $data = ['userID' => $userID,
                        'message' => $message
                        ];
                $pusher->trigger('noti-channel', 'profile-reviewed', $data );
        
        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
    }
}

