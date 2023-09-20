<?php

namespace App\Http\Controllers\AdminDepartment;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\RegistrationDetails;
use App\Models\Ceriterias;
use App\Models\Stylized;
use App\Models\CeriteriasDetail;
use App\Models\Notifications;
use Carbon\Carbon;
use Crypt;

class DetailRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDetailCeriteria($id)
    {
        if(Auth::guard('department')->user()->status != '2'){
            return redirect('/login-admin-department')->with(Auth::logout());
        }
        $regis = Registration::with('competitionperiod', 'users')
        ->where('_id', $id)
        ->where('id_depart', Auth::guard('department')->user()->id_depart)
        ->first();

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
    return view('adminDepartment.detailStyliDepartment.criteria-detail')
        ->with(compact('regis_detail', 'regis', 'filtered_criterias','id_criteria_detail','notifications','count'));
//chúng ta sử dụng phương thức filter() để lọc những tiêu chí mà tiêu chí chi tiết tương ứng tồn tại trong câu trả lời.
 //Sau đó, chúng ta gán tiêu chí chi tiết vào tiêu chí. 
 //Kết quả cuối cùng là danh sách tiêu chí đã được lọc và chỉ chứa những tiêu chí có tiêu chí chi tiết tương ứng trong câu trả lời.

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRegistrationDetail(Request $request, $id)
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

        if($request->status_input == '3')
        {
            $Registration = Registration::find($id);
            $Registration->note = $request->note;
            $Registration->admin_status = $request->status_input;
            $Registration->save();
            $checked_values = $request->input('id_registration_detail');
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
        elseif($request->status_input == '2')
        {
            $Registration = Registration::find($id);
            $Registration->note = $request->note;
            $Registration->admin_note = '';
            $Registration->admin_status = $request->status_input;
            $Registration->save();
            $checked_values = $request->input('id_registration_detail');
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
        elseif($request->status_input == '1')
        {
            $Registration = Registration::find($id);
            $Registration->note = $request->note;
            $Registration->admin_status = $request->status_input;
            $Registration->save();
            $checked_values = $request->input('id_registration_detail');
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
        
        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
