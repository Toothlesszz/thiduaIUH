<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Stylized;
use App\Models\Years;
use App\Models\Registration;
use App\Models\RegistrationDetails;
use App\Models\Ceriterias;
use App\Models\CeriteriasDetail;
use App\Models\CompetitionPeriod;
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
    public function storeRegistration(Request $request)
{
    
    // Thiết lập múi giờ là 'Asia/Ho_Chi_Minh' (Việt Nam)
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    // Lấy ngày hiện tại của Việt Nam
    $currentDate = Carbon::now()->toDateString();

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
            $new_name = $request->code_user.'_'.time().rand(1,100).'.'.$file->extension();
            $file->move(public_path('uploads/proof_file'), $new_name);
            $regis_detail->proof_file = $new_name;
         } 
        else {
            $regis_detail->proof_file = null; // Hoặc $regis_detail->proof_file = '';
        }
        $regis_detail->save();
    }

    return redirect('/user/send-stylized')->with('successMessage', 'Đăng ký danh hiệu thành công!');
}

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
