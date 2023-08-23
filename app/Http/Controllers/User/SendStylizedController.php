<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Registration;
use App\Models\Stylized;
use App\Models\RegistrationDetails;
use App\Models\User;
use App\Models\Ceriterias;
use App\Models\CeriteriasDetail;
use App\Models\Competitionperiod;
use Crypt;

class SendStylizedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $register = Registration::with('competitionperiod','users')
            ->where('id_user', '=', Auth::user()->_id)
            ->paginate(5);
            $regisCount = Registration::where('id_user', '=', Auth::user()->_id)->count();
            $regisPassCount = Registration::where('id_user', '=', Auth::user()->_id)->where('admin_status','=','4')->count();

        return view('users.sendStylized.index')->with(compact('register','regisCount','regisPassCount'));
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

    public function showDetail($id)
    {
        
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
    return view('users.sendStylized.criteria-detail')->with(compact('regis_detail', 'regis', 'filtered_criterias','id_criteria_detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDetail(Request $request, $id)
    {
        
     $Registration = Registration::find($id);
     $Registration->update = 'False';
     $Registration->admin_status = '0';
     $Registration->save();
      foreach ($request->input('detail_input') as $detailId => $detailData) {
        $regis_detail = RegistrationDetails::find($detailId);
        $regis_detail->revelation = $detailData['revelation'];
        $regis_detail->reason = '0';
        if ($request->hasFile("detail_input.{$detailId}.new_file")) {
            $path = 'uploads/proof_file/'.$regis_detail->proof_file;
            if(file_exists($path)) {
            unlink($path);
            $file = $request->file("detail_input.{$detailId}.new_file");
            $new_name = $request->code_user.'_'.time().rand(1,100).'.'.$file->extension();
            $file->move(public_path('uploads/proof_file'), $new_name);
            $regis_detail->proof_file = $new_name;
            } 
         } 

        $regis_detail->save();
    }

      return redirect()->back()->with('success', 'Cập nhật danh hiệu đăng ký thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function dowloadFile($id) {
       $registration = Registration::find($id);
       $path = 'uploads/stylized/'.$registration->file;

       return  response()->download($path);
    }


}
