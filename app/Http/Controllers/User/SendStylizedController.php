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
    public function destroy($id)
    {
        $registrationDetails = RegistrationDetails::where('id_regis', $id)->get();
        foreach ($registrationDetails as $registrationDetail) {
            $path = 'uploads/proof_file/'.$registrationDetail->proof_file;

            if(file_exists($path)) {
              unlink($path);
            }
        }

        Registration::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => "Xóa đăng ký danh hiệu thành công!",
        ]);
    }

    public function dowloadFile($id) {
       $registration = Registration::find($id);
       $path = 'uploads/stylized/'.$registration->file;

       return  response()->download($path);
    }

    public function dowloadDeclareFile($id) {
      $registration_declare = Registration::find($id);
      $path_declare_file = 'uploads/declare_file/'.$registration_declare->declare_file;

      return  response()->download($path_declare_file);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDetailCeriteria($id, $idRegis)
    {
        $regis_detail = RegistrationDetails::where('registration_detail.id_regis', $idRegis)
                        ->join('criteria_detail', 'registration_detail.id_criteria_detail' , '=' , 'criteria_detail.id')
                        ->where('criteria_detail.id_criter', $id)
                        ->select('criteria_detail.*', 'registration_detail.*', 'registration_detail.id as id_res', 'criteria_detail.id as id_criteria_detail')
                        ->get();
        $regis_detail_not_exists = CeriteriasDetail::where('id_criter', $id)->whereNotIn('id', $regis_detail->pluck('id_criteria_detail')->toArray())
        ->select(
        'criteria_detail.id as id_criteria_detail',
        'criteria_detail.name_criter_detail',
        'criteria_detail.request',
        'criteria_detail.id_criter',
        'criteria_detail.created_at'
        )
        ->get();
        foreach ($regis_detail_not_exists as $regis_detail_not_exist) {
            $regis_detail->push($regis_detail_not_exist);
        }

        return view('users.sendStylized.criteria-detail')->with(compact('regis_detail', 'idRegis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCeriteriaDetail(Request $request, $id)
    {
        if (RegistrationDetails::where([['id_criteria_detail', $id], ['id_regis', $request->idRegis]])->exists()) {
            $regis_detail = RegistrationDetails::where([['id_criteria_detail', $id], ['id_regis', $request->idRegis]])->first();
            $regis_detail->revelation = $request->revelation;
            
            if ($request->hasfile('file_ceriter_load')) {
                if ($request->file('file_ceriter_load')->isValid()) {
                    if (!empty($regis_detail->proof_file)) {
                        $path = 'uploads/proof_file/'.$regis_detail->proof_file;

                        if (file_exists($path)) {
                            unlink($path);
                        }
                    }
                    $name = 'UD'.'_'.time().rand(1,100). '.' .$request->file_ceriter_load->extension();//3011
                    $request->file_ceriter_load->move(public_path('uploads/proof_file'), $name);
                    $regis_detail->proof_file = $name;
                }
            }
            $regis_detail->review = 0;
            $regis_detail->save();
        } else {
            if ($request->hasfile('file_ceriter_load')) {
                if ($request->file('file_ceriter_load')->isValid()) {
                    $name = time().rand(1,100). '.' .$request->file_ceriter_load->extension();
                    $request->file_ceriter_load->move(public_path('uploads/proof_file'), $name);
                }
            }
            RegistrationDetails::create([
                'proof_file' => $name ?? '',
                'id_criteria_detail' => $id,
                'id_regis' => $request->idRegis,
                'revelation' => $request->revelation
            ]);
        }

        return redirect()->back()->with('success', 'Cập nhật tiêu chí thành công!');
    }
}
