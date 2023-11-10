<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use MongoDB\Driver\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\Models\Stylized;
use App\Models\Registration;
use App\Models\Years;
use App\Models\User;
use App\Models\Ceriterias;
use App\Models\CeriteriasDetail;
use App\Models\CompetitionPeriod;
use App\Models\Notifications;
use App\Models\Reregistration;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class StylizedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $findyear = $request['find_year'];
        
        if($findyear != '')
        {
            $CompetitionPeriod = CompetitionPeriod::with('stylized','years')->where('id_year','=', $findyear)->paginate(5,['*'],'data2_page')->withQueryString()->appends([
                'sort' => 'startdate',
                'order' => 'asc',
            ]);
            
        }
        else{
            $CompetitionPeriod = CompetitionPeriod::with('stylized','years')->orderBy('startdate', 'desc')->paginate(5,['*'],'data2_page')->withQueryString()->appends([
                'sort' => 'startdate',
                'order' => 'desc',
            ]);
        }

        $years = years::get();
        $competeList = CompetitionPeriod::get();
        $stylized = stylized::with('CompetitionPeriod','years')->get();
       //Xuất danh hiệu để quản lý, dùng biến này ở chỗ quản lý danh hiệu
        $stylizedList = stylized::with('CompetitionPeriod','years')->paginate(1,['*'],'data3_page')->withQueryString();
        $notifications = Notifications::where('id_user','=', Auth::guard('admin')->user()->_id)->get();
        $count = count($notifications);
        $re_Registration = Reregistration::paginate(5,['*'],'data1_page')->withQueryString();
        return view('admin.stylized.index')->with(compact( 'competeList','findyear','re_Registration','stylized', 'years','CompetitionPeriod','stylizedList','notifications','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $years = Years::orderBy('id', 'DESC')->get();
        return view('admin.stylized.create')->with(compact('years'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
//Thêm mới danh hiệu 
public function addNewStylized(Request $request)
    {
        $stylized = new Stylized();
        $stylized->name_stylized = $request->input('name');
        $stylized->detail = $request->input('detail');   
        $stylized->criterias_number = $request->input('required_criter');   
        $objects = $request->objects;
        $stylized->object = $objects;
        $stylized->type  = '2';
        $stylized->status  = '1';
        $stylized->number  = $request->number;
        $data=$request;
        //Upload image folder
        $get_image = $data['image'];
        $path = 'certificate/img_certificate/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_name_image = $name_image.'_'.time().'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path, $new_name_image);
  
        $stylized->image = $new_name_image;
      //Upload intruction file into folder called files
        $get_file = $data['file'];
        $path = 'uploads/files/';
        $get_name_file = $get_file->getClientOriginalName();
        $name_file = current(explode('.', $get_name_file));
        $new_name_file = $name_file.'_'.time().'.'.$get_file->getClientOriginalExtension();
        $get_file->move($path, $new_name_file);
  
        $stylized->file = $new_name_file;
  
        $stylized->save();

        foreach ($request->input('criterias') as $criteriaData) {
            $criteria = new Ceriterias();
            $criteria->name_criter = $criteriaData['name'];
            $criteria->intruction = $criteriaData['intruction'];
            $criteria->required_number = $criteriaData['criteriasnumber'];
            $criteria->id_styli = $stylized->_id;
            $criteria->save();

            $details = $criteriaData['details'];
            $numbers = $criteriaData['number'];
        
            $count = count($details);
        
            for ($i = 0; $i < $count; $i++) {
                $detailData = $details[$i];
                $detailNumber = $numbers[$i];
        
                $criteriaDetail = new CeriteriasDetail();
                $criteriaDetail->name_criter_detail = $detailData;
                $criteriaDetail->request = $detailNumber;
                $criteriaDetail->id_criter = $criteria->_id;
                $criteriaDetail->save();
            }
        }

        return redirect()->route('stylized.index')->with('success3', 'Tạo mới danh hiệu thành công!');
    }

    
    //Add new competition period
    public function addCompetition(Request $request)
    {
        $validator = Validator::make($request->all(), 
          [
              'startdate' => 'required|after:today',
              'depart_first_time'=>'required|after:startdate',
              'candidate_add_detail'=>'required|after:depart_first_time',
              'depart_second_time'=>'required|after:candidate_add_detail',
              'depart_end_second_time'=>'required|after:depart_second_time',
              'enddate' => 'required|after:depart_end_second_time',
              'idstylized' => 'required',
              'year'=>'required',
              'file' => 'required',
          ]);

          if ($validator->fails()) {
            return redirect()->route('stylized.index')->with('error', 'Vui lòng kiểm tra tính chính xác của thông tin!');
        }
        
      $competitionperiod = new CompetitionPeriod();
      
      $competitionperiod->id_styli = $request->input('idstylized');
      $competitionperiod->id_year  = $request->year;
      $competitionperiod->type  = '1';
      $competitionperiod->startdate = $request->input('startdate');
      $competitionperiod->depart_first_time = $request->input('depart_first_time');
      $competitionperiod->candidate_add_detail = $request->input('candidate_add_detail');
      $competitionperiod->depart_second_time = $request->input('depart_second_time');
      $competitionperiod->depart_end_second_time = $request->input('depart_end_second_time');
      $competitionperiod->enddate  = $request->input('enddate');
      $competitionperiod->status  = '1';
      
      
      //Upload certification file to folder
        
        $get_image = $request->file;
        $path = 'certificate/img_certificate/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_name_image = $name_image.'_'.time().'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path, $new_name_image);
        $competitionperiod->image = $new_name_image;
      
        $competitionperiod->save();

      return redirect()->route('stylized.index')->with('success2', 'Thêm đợt thi đua thành công!');
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
    public function addNewYear(Request $request)
    {
        $data = $request;
        $selectyear = $data['selectyear'];
        $checkyear = years::select('year')->where('year','=', $data['year'])->first();
        
        if(empty($checkyear))
        {
            if($selectyear != '')
        {
            $years = new years();
            $years->year = $data['year'];
    
            $years->save();
            return redirect()->route('stylized.index')->with('success1', 'Thêm năm học mới thành công!');
        }
        else{
            return redirect()->route('stylized.index');
        }
        }
        else{
            return redirect()->route('stylized.index')->with('error2','Năm học đã tồn tại!');
        }
        
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $stylized = Stylized::where('_id','=', $id)->first();
        $criterias = Ceriterias::where('id_styli','=', $stylized->_id)->get();
        $notifications = Notifications::where('id_user','=', Auth::guard('admin')->user()->_id)->get();
        $count = count($notifications);
        return view('admin.stylized.update')->with(compact('stylized','criterias','notifications','count' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCompetitionPeriod(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), 
          [
              'startdate' => 'required',
              'depart_first_time'=>'required|after:startdate',
              'candidate_add_detail'=>'required|after:depart_first_time',
              'depart_second_time'=>'required|after:candidate_add_detail',
              'depart_end_second_time'=>'required|after:depart_second_time',
              'enddate' => 'required|after:depart_end_second_time',
          ]);

          if ($validator->fails()) {
            return redirect()->route('stylized.index')->with('error', 'Vui lòng kiểm tra tính chính xác của thông tin!');
        }
        else{
            $competitionperiod = CompetitionPeriod::find($id);
            $competitionperiod->startdate = $request->input('startdate');
            $competitionperiod->depart_first_time = $request->input('depart_first_time');
            $competitionperiod->candidate_add_detail = $request->input('candidate_add_detail');
            $competitionperiod->depart_second_time = $request->input('depart_second_time');
            $competitionperiod->depart_end_second_time = $request->input('depart_end_second_time');
            $competitionperiod->enddate  = $request->input('enddate');
            $competitionperiod->save();
            return redirect()->route('stylized.index')->with('success', 'Cập nhật đợt thi đua thành công!');  
        }
            
        
            
    }
    public function updateStylized(Request $request, $id)
    {
        foreach($request->input('criterias') as $detailId => $detailData)
        {
            
            $criteria_detail = CeriteriasDetail::find($detailId);
            $criteria_detail->name_criter_detail = $detailData['details'];
            $criteria_detail->save();
        }
        return redirect()->back()->with('success', 'Cập nhật danh hiệu thành công');
    }
    // Download intruction files
    public function downloadFile(Request $request , $fileName)
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteStylized($id)
    {
      $checkStylized = CompetitionPeriod::where('id_styli' , '=', $id)->first();
      if(empty($checkStylized))
      {
        $criterias = Ceriterias::where('id_styli', '=' , $id)->get();
        foreach($criterias as $criteria)
        {
            $criteriaDetail = CeriteriasDetail::where('id_criter' , '=' , $criteria->_id)->delete(); 
        }
        $deleteCriterias = Ceriterias::where('id_styli','=', $id)->delete();
        $stylized = Stylized::find($id);
            $path = 'uploads/files/'.$stylized->file;
            if(file_exists($path)) {
                unlink($path);
            }
            $imagePath = 'certificate/img_certificate/'.$stylized->image;
            if(file_exists($imagePath))
            {
                unlink($imagePath);
            }
        $deleteStylized = Stylized::find($id)->delete();
        
        return redirect()->back()->with('success4','Xóa thành công');
      }
      else
      {
        return redirect()->back()->with('error3','Xóa không thành công');
      }

    }
    public function deleteCompetitionPeriod($id)
    {
        $checkRegistor = Registration::where('id_competitionperiod', '=' , $id)->first();
        if(empty($checkRegistor))
        {
           $competitionPeriod = CompetitionPeriod::find($id);
            if($competitionPeriod->startdate > now())
            {
                $imagePath = 'certificate/img_certificate/'.$competitionPeriod->image;
                if(file_exists($imagePath))
                {
                    unlink($imagePath);
                }
                $deleteCompete = CompetitionPeriod::find($id)->delete();
                return redirect()->back()->with('success5', 'Xóa đợt thi đua thành công');
            } 
            else{
                return redirect()->back()->with('error6', 'Hoạt động đã mở, không được xóa');
            }
        }
        else
        {
            return redirect()->back()->with('error5', 'Hoạt động đã có người tham gia, không thể xóa !');
        }
        
    }
    public function addErrorUsers(Request $request){
        $codeUser = $request->codeUser;
        $idCompete = $request->idCompetitionperiod;
        if(!empty($idCompete)){
            $checkUser = User::where('code','=', $codeUser)->first();
        $checkErrorUser = Reregistration::where('code_user','=', $codeUser)->first();
        if(empty($checkErrorUser)){
            if(!empty($checkUser)){
            $reRegistration = new Reregistration();
            $reRegistration->id_user = $checkUser->_id;
            $reRegistration->code_user = $codeUser;
            $reRegistration->id_competitionperiod = $request->idCompetitionperiod;
            $reRegistration->save();
        }
        else{
            return redirect()->back()->with('error7', 'Vui lòng kiểm tra lại mã số sinh viên !');
        }
        }else{
            return redirect()->back()->with('error8', 'Vui lòng kiểm tra lại mã số sinh viên !');
        }
        }
        else{
            return redirect()->back()->with('error', 'Vui lòng kiểm tra tính chính xác và đầy đủ của thông tin !');
        }
        
        
        return redirect()->back()->with('success6', 'Thêm ứng viên thành công.');
    }
    public function deleteErrorUsers(Request $request, $id){
        $deleteErrorUser = Reregistration::find($id)->delete();
        return redirect()->back()->with('success7', 'Xóa ứng viên thành công.');
    }
    public function deleteAllErrorUsers(){
        $deleteAllErrorUsers = Reregistration::where('code', '!=', '')->delete();

        return redirect()->back()->with('success7', 'Xóa ứng viên thành công.');
    }
    public function updateCertificate(Request $request){
        $selectedStylized = $request['selectedStylized'];
        $selectedYear = $request['selectedYear'];
        $get_image = $request->newFile;
        if($selectedStylized != '' && $selectedYear != ''){
            $selectedCompete = CompetitionPeriod::where('id_styli','=',$selectedStylized)->where('id_year', '=', $selectedYear)->first();
            if(!empty($selectedCompete)){
                $path = 'certificate/img_certificate/'.$selectedCompete->image;
            if(file_exists($path)) {
                unlink($path);
                $path = 'certificate/img_certificate/';
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_name_image = $name_image.'_'.time().'.'.$get_image->getClientOriginalExtension();
                $get_image->move($path, $new_name_image);
                $selectedCompete->image = $new_name_image;
                $selectedCompete->save();
                return redirect()->back()->with('success8','Thay đổi mẫu minh chứng thành công');
            }
            else{
                return redirect()->back()->with('error10','Đã có lỗi xảy ra, vui lòng kiểm tra lại file mẫu chứng nhận.');
            }
            }
            else{
                return redirect()->back()->with('error11','Không tìm thấy đợt thi đua tương ứng với năm học đã chọn');
            }
        }
        else{
            return redirect()->back()->with('error9', 'Vui lòng chọn danh hiệu hoặc năm học');
        }
        
    }
}
