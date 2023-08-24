<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Events\CertificatedEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\RegistrationDetails;
use App\Models\Ceriterias;
use App\Models\Stylized;
use App\Models\CeriteriasDetail;
use App\Models\UserTracing;
use Carbon\Carbon;
use Crypt;

class ReviewDetailStylizedController extends Controller
{
    public function showDetailCeriteriaAdmin($id)
    {
        $userTracing = UserTracing::with('users')->where('id_profile', '=', $id)->get();
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
    return view('admin.reviewStylized.criteria-detail')->with(compact('userTracing','regis_detail', 'regis', 'filtered_criterias','id_criteria_detail'));
    }

    public function updateRegistrationDetailAdmin(Request $request, $id)
    {
        // Thiết lập múi giờ là 'Asia/Ho_Chi_Minh' (Việt Nam)
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    // Lấy ngày hiện tại của Việt Nam
    $currentDate = Carbon::now()->toDateString();
        if($request->status_input == '4')
        {
            $Registration = Registration::find($id);
            $Registration->admin_status = $request->status_input;
            $Registration->admin_note = $request->admin_note;
            $Registration->save();
            // Lưu vết của người dùng
            $userTracing = new UserTracing();
            $userTracing->id_user = Auth::guard('admin')->user()->_id;
            $userTracing->name_user = Auth::guard('admin')->user()->name;
            $userTracing->content = $request->admin_note;
            $userTracing->update_date = $currentDate;
            $userTracing->id_profile = $id;
            $userTracing->save();

            $checked_values = $request->input('id_registration_detail');
            if($checked_values == '')
            {
                $message = 'Trạng thái hồ sơ đã được cập nhật !';
                event(new CertificatedEvent($message));
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
            $Registration = Registration::find($id);
            
            $Registration->admin_status = $request->status_input;
            $Registration->admin_note = $request->admin_note;

            $Registration->save();
            $checked_values = $request->input('id_registration_detail');
            if($checked_values == ''){
                $message = 'Trạng thái hồ sơ đã được cập nhật !';
                event(new CertificatedEvent($message));
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
            event(new CertificatedEvent($message));
        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
    }
}

