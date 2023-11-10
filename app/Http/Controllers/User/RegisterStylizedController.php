<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Stylized;
use App\Models\Years;
use App\Models\Registration;
use App\Models\RegistrationDetails;
use App\Models\Ceriterias;
use App\Models\CeriteriasDetail;
use App\Models\CompetitionPeriod;
use App\Models\Reregistration;
use Carbon\Carbon;
use Crypt;

class RegisterStylizedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $competitionperiod = CompetitionPeriod::where('_id','=', $id)->first();
        $stylized = Stylized::where('_id' , '=' , $competitionperiod->id_styli)->fisrt();
        $criterias = Ceriterias::where('id_styli','=', $stylized->_id)->get();
         
          return view('users.stylized.index')->with(compact('stylized', 'criterias', 'competitionperiod'));
    }

    /**
     * Show the the stylized detail.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        
        $CriteriaName = Ceriterias::where('id_styli', '=' , $id)->get();
        $CriteriaId = Ceriterias::select('_id')->where('id_styli','=',$id)->get();
       
        return view('users.stylized.detail')->with(compact('id','CriteriaName','CriteriaId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//     public function storeRegistration(Request $request)
// {
    
//     // Check if the form has already been submitted
//     if (Cookie::get('formSubmitted') == 'true') {
//         return redirect('/user')->with('error5','Bạn đã đăng kí đợt thi đua này rồi');
//     }
//     $checkIdUser = Registration::where('id_user','=', $request->id_user)->where('id_competitionperiod','=', $request->id_competitionperiod)->first();
//     if(empty($checkIdUser)){
//         // Thiết lập múi giờ là 'Asia/Ho_Chi_Minh' (Việt Nam)
//         date_default_timezone_set('Asia/Ho_Chi_Minh');

//         // Lấy ngày hiện tại của Việt Nam
//         $currentDate = Carbon::now()->toDateString();

//         $registration = new Registration;
//         $registration->id_user = $request->id_user;
//         $registration->id_depart = $request->id_depart;
//         $registration->date = $currentDate;
//         $registration->update = 'True';
//         $registration->id_competitionperiod = $request->id_competitionperiod;
//         $registration->admin_status = '0';
//         $registration->save();

//         foreach ($request->input('criteria_detail') as $criteria_detailId => $criteria_detailData) {
//             $regis_detail = new RegistrationDetails;
//             $regis_detail->id_criteria_detail = $criteria_detailData['id'];
//             $regis_detail->revelation = $criteria_detailData['revelation'];
//             $regis_detail->id_regis = $registration->_id;
//             $regis_detail->reason = '0';

//             if ($request->hasFile("criteria_detail.{$criteria_detailId}.file")) {
//                 $file = $request->file("criteria_detail.{$criteria_detailId}.file");
//                 $new_name = $request->code_user.'_'.time().rand(1,100).'.'.$file->extension();
//                 $file->move(public_path('uploads/proof_file'), $new_name);
//                 $regis_detail->proof_file = $new_name;
//             } 
//             else {
//                 $regis_detail->proof_file = null; // Hoặc $regis_detail->proof_file = '';
//             }
//             $regis_detail->save();
//             if($regis_detail){
                
//             }else{
//                 return redirect('/user')->with('error4','Bạn đã đăng kí đợt thi đua này rồi');
//             }
//         }
//         $checkErrorUser = Reregistration::where('code_user', '=', Auth::user()->code)->first();
//         if(!empty($checkErrorUser)){
//             $deleteErrorUser = Reregistration::where('code_user','=', Auth::user()->code)->delete();
//         }
//         return redirect('/user/send-stylized')->with('success', 'Đăng ký danh hiệu thành công!');
//     }
//     else{
//         return redirect('/user')->with('error4','Bạn đã đăng kí đợt thi đua này rồi');
//     }
    
// }


public function storeRegistration(Request $request)
{
    try {
        // Bắt đầu một "giao dịch" tượng tự cho MongoDB, chẳng hạn sử dụng nhiều truy vấn
        // Chú ý rằng MongoDB không hỗ trợ giao dịch như RDBMS
        $checkIdUser = Registration::where('id_user', $request->id_user)
            ->where('id_competitionperiod', $request->id_competitionperiod)
            ->first();

        if (empty($checkIdUser)) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $currentDate = now()->toDateString();

            $registration = new Registration;
            $registration->id_user = $request->id_user;
            $registration->id_depart = $request->id_depart;
            $registration->date = $currentDate;
            $registration->update = 'True';
            $registration->id_competitionperiod = $request->id_competitionperiod;
            $registration->admin_status = '0';
            $registration->save();

            foreach ($request->input('criteria_detail') as $criteria_detailId => $criteria_detailData) {
                $regis_detail = new RegistrationDetails;
                $regis_detail->id_criteria_detail = $criteria_detailData['id'];
                $regis_detail->revelation = $criteria_detailData['revelation'];
                $regis_detail->id_regis = $registration->_id;
                $regis_detail->reason = '0';

                if ($request->hasFile("criteria_detail.{$criteria_detailId}.file")) {
                    $file = $request->file("criteria_detail.{$criteria_detailId}.file");
                    $new_name = $request->code_user . '_' . time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('uploads/proof_file'), $new_name);
                    $regis_detail->proof_file = $new_name;
                } else {
                    $regis_detail->proof_file = null;
                }
                $regis_detail->save();
            }

            $checkErrorUser = Reregistration::where('code_user', '=', Auth::user()->code)->first();
            if (!empty($checkErrorUser)) {
                $deleteErrorUser = Reregistration::where('code_user', Auth::user()->code)
                    ->where('id_competitionperiod', $request->id_competitionperiod)
                    ->delete();
            }
            return redirect('/user/send-stylized')->with('success', 'Đăng ký danh hiệu thành công!');
        } else {
            return redirect('/user')->with('error4', 'Bạn đã đăng kí đợt thi đua này rồi');
        }
    } catch (\Exception $e) {
        // Xử lý lỗi do mạng kéo dài timeout ở đây
        return back()->with('error', 'Lỗi mạng. Dữ liệu không được lưu. Vui lòng thử lại sau.');
    }
}
// public function storeRegistration(Request $request)
// {
//     // Định nghĩa quy tắc kiểm tra hợp lệ
//     $rules = [
//         'id_user' => 'required',
//         'id_depart' => 'required',
//         'criteria_detail' => 'required|array',
//         'criteria_detail.*.id' => 'required',
//         'criteria_detail.*.revelation' => 'required',
//         // Thêm quy tắc cho các trường dữ liệu khác nếu cần
//     ];

//     $messages = [
//         'id_user.required' => 'ID user là bắt buộc.',
//         'id_depart.required' => 'ID depart là bắt buộc.',
//         'criteria_detail.required' => 'Chi tiết tiêu chí là bắt buộc.',
//         'criteria_detail.array' => 'Chi tiết tiêu chí phải là một mảng.',
//         'criteria_detail.*.id.required' => 'ID chi tiết là bắt buộc.',
//         'criteria_detail.*.revelation.required' => 'Revelation là bắt buộc.',
//         // Thêm thông báo lỗi cho các trường dữ liệu khác ở đây
//     ];

//     // Kiểm tra hợp lệ
//     $validator = Validator::make($request->all(), $rules, $messages);

//     if ($validator->fails()) {
//         return redirect('/user')->withErrors($validator)->withInput();
//     }
    
 
//         try {
//             // Bắt đầu một giao dịch cơ sở dữ liệu
//             beginTransaction();
//             $checkIdUser = Registration::where('id_user', $request->id_user)
//                 ->where('id_competitionperiod', $request->id_competitionperiod)
//                 ->first();
    
//             if (empty($checkIdUser)) {
//                 date_default_timezone_set('Asia/Ho_Chi_Minh');
//                 $currentDate = Carbon::now()->toDateString();
    
//                 $registration = new Registration;
//                 $registration->id_user = $request->id_user;
//                 $registration->id_depart = $request->id_depart;
//                 $registration->date = $currentDate;
//                 $registration->update = 'True';
//                 $registration->id_competitionperiod = $request->id_competitionperiod;
//                 $registration->admin_status = '0';
//                 $registration->save();
    
//                 foreach ($request->input('criteria_detail') as $criteria_detailId => $criteria_detailData) {
//                     $regis_detail = new RegistrationDetails;
//                     $regis_detail->id_criteria_detail = $criteria_detailData['id'];
//                     $regis_detail->revelation = $criteria_detailData['revelation'];
//                     $regis_detail->id_regis = $registration->_id;
//                     $regis_detail->reason = '0';
    
//                     if ($request->hasFile("criteria_detail.{$criteria_detailId}.file")) {
//                         $file = $request->file("criteria_detail.{$criteria_detailId}.file");
//                         $new_name = $request->code_user.'_'.time().rand(1,100).'.'.$file->extension();
//                         $file->move(public_path('uploads/proof_file'), $new_name);
//                         $regis_detail->proof_file = $new_name;
//                     } 
//                     else {
//                         $regis_detail->proof_file = null;
//                     }
//                     $regis_detail->save();
//                 }
    
//                 $checkErrorUser = Reregistration::where('code_user', '=', Auth::user()->code)->first();
//                 if (!empty($checkErrorUser)) {
//                     $deleteErrorUser = Reregistration::where('code_user', Auth::user()->code)
//                         ->where('id_competitionperiod', $request->id_competitionperiod)
//                         ->delete();
//                 }
    
//                 // Kết thúc giao dịch và lưu dữ liệu vào cơ sở dữ liệu
//                 DB::commit();
//                 return redirect('/user/send-stylized')->with('success', 'Đăng ký danh hiệu thành công!');
//             } else {
//                 // Lỗi: Người dùng đã đăng ký đợt thi đua này rồi
//                 return redirect('/user')->with('error4', 'Bạn đã đăng kí đợt thi đua này rồi');
//             }
//         } catch (\Exception $e) {
//             // Lỗi do mạng kéo dài timeout
//             // Hoàn tác giao dịch để không lưu dữ liệu
//             DB::rollBack();
//     }
// }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getStylized($id)
    {
         
        $competitionperiod = CompetitionPeriod::where('_id','=', $id)->first();
        $stylized = Stylized::where('_id' , '=' , $competitionperiod->id_styli)->first();
        $criterias = Ceriterias::where('id_styli','=', $stylized->_id)->get();
          return view('users.stylized.index')->with(compact('stylized', 'criterias', 'competitionperiod'));
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
        #
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
