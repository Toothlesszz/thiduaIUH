<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Years;
use App\Models\Department;
use App\Models\Stylized;
use App\Models\CompetitionPeriod;
use App\Models\Registration;
use App\Models\RegistrationDetails;
use App\Models\Ceriterias;
use App\Models\CeriteriasDetail;
use App\Models\Notifications;
use DB;

use Intervention\Image\Facades\Image;

class ReviewStylizedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
if( Auth::guard('admin')->user()->status != '2'){
        return redirect('/login-admin')->with(Auth::logout());
    }
        $keyword = $request['keyword'] ?? "";
        $type = $request['type'];
        $status = $request['status'];
        $styli = $request['styli'];
        $depart = $request['depart'];
        $year = $request['year'];

       $nameDepart = Department::where('_id', '=', $depart)->first();
        $nameStylized = Stylized::where('_id','=',$styli)->first();
        $selectedYear = Years::where('_id','=',$year)->first();
        if($nameStylized != '')
        {
            $stylized = Stylized::where('_id','!=',$styli)->get();
        }
        else{
            $stylized = Stylized::get();
        }
        if($selectedYear != ''){
            $years = Years::where('_id','!=',$year)->get();
        }
        else{
            $years = Years::get();
        }
        if($nameDepart != '' ){
            $department = Department::where('_id', '!=', $depart)->get();
        }
        else{
            $department = Department::get();
        }
        $query = Registration::with('competitionperiod','users')
        ->orderBy('date', 'asc');

        if($keyword !== '' && $type == '1') {
            $checkUser = User::where('code','=',$keyword)->first();
            if(!empty($checkUser)){
               $query->where('id_user','=', $checkUser->_id); 
            }
            else{
                $query->where('code' , '=' , $keyword);
            }
            
        }
        elseif($keyword != '' && $type == '2'){
            $id_users[] = '';
            $checkUser = User::where('name', 'like', '%'.$keyword)->get();
            if(!empty($checkUser)){
                foreach($checkUser as $id)
            {
                array_push($id_users , $id->_id); 
            }
            $query->whereIn('id_user', $id_users);
            }
        } 
        if($year == '' && $styli != '' && $status == '' && $depart == '')
        {
            $id_stylized[] = '' ;
            $checkStyli = CompetitionPeriod::where('id_styli' , '=', $styli)->get();
            if(!empty($checkStyli))
            {
                foreach($checkStyli as $id_styli)
                {
                    array_push($id_stylized, $id_styli->_id);
                }
                $query->whereIn('id_competitionperiod', $id_stylized);
            }
        }
        elseif($year == '' && $styli != '' && $status == '' && $depart != '')
        {
            $id_stylized[] = '' ;
            $checkStyli = CompetitionPeriod::where('id_styli' , '=', $styli)->get();
            if(!empty($checkStyli))
            {
                foreach($checkStyli as $id_styli)
                {
                    array_push($id_stylized, $id_styli->_id);
                }
                $query->whereIn('id_competitionperiod', $id_stylized)->where('id_depart','=',$depart);
            }
        }
        elseif($year == '' && $styli != '' && $status != '' && $depart != '')
        {
            $id_stylized[] = '' ;
            $checkStyli = CompetitionPeriod::where('id_styli' , '=', $styli)->get();
            if(!empty($checkStyli))
            {
                foreach($checkStyli as $id_styli)
                {
                    array_push($id_stylized, $id_styli->_id);
                }
                $query->whereIn('id_competitionperiod', $id_stylized)
                ->where('admin_status','=', $status)
                ->where('id_depart','=', $depart);
            }
        }
        elseif($year == '' && $styli != '' && $status != '' && $depart == '')
        {
            $id_stylized[] = '' ;
            $checkStyli = CompetitionPeriod::where('id_styli' , '=', $styli)->get();
            if(!empty($checkStyli))
            {
                foreach($checkStyli as $id_styli)
                {
                    array_push($id_stylized, $id_styli->_id);
                }
                $query->whereIn('id_competitionperiod', $id_stylized)
                ->where('admin_status','=', $status);
            }
        }
        elseif($year != '' && $styli == '' && $status == '' && $depart == '' )
        {
            $id_year[] = '';
            $checkYear = CompetitionPeriod::where('id_year' , '=', $year)->get();
            if(!empty($checkYear))
            {
                foreach($checkYear as $year_id)
                {
                    array_push($id_year, $year_id->_id);
                }
                $query->whereIn('id_competitionperiod', $id_year);
            }
        }
        elseif($year != '' && $styli == '' && $status == '' && $depart != '' )
        {
            $id_year[] = '';
            $checkYear = CompetitionPeriod::where('id_year' , '=', $year)->get();
            if(!empty($checkYear))
            {
                foreach($checkYear as $year_id)
                {
                    array_push($id_year, $year_id->_id);
                }
                $query->whereIn('id_competitionperiod', $id_year)->where('id_depart', '=' , $depart);
            }
        }
        elseif($year != '' && $styli == '' && $status != '' && $depart == '')
        {
            $id_year[] = '';
            $checkYear = CompetitionPeriod::where('id_year' , '=', $year)->get();
            if(!empty($checkYear))
            {
                foreach($checkYear as $year_id)
                {
                    array_push($id_year, $year_id->_id);
                }
                $query->whereIn('id_competitionperiod', $id_year)->where('admin_status' , '=' , $status);
            }
        }
        elseif($year != '' && $styli == '' && $status != '' && $depart != '')
        {
            $id_year[] = '';
            $checkYear = CompetitionPeriod::where('id_year' , '=', $year)->get();
            if(!empty($checkYear))
            {
                foreach($checkYear as $year_id)
                {
                    array_push($id_year, $year_id->_id);
                }
                $query->whereIn('id_competitionperiod', $id_year)
                ->where('admin_status' , '=' , $status)
                ->where('id_depart' , '=', $depart);
            }
        }
        elseif($year == '' && $styli == '' && $status != '' && $depart == ''){
            $query->where('admin_status' , '=' , $status);
        }
	elseif($year == '' && $styli == '' && $status == '' && $depart != ''){
            $query->where('id_depart' , '=', $depart);
        }

        elseif($year == '' && $styli == '' && $status != '' && $depart !=''){
            $query->where('admin_status' , '=' , $status)->where('id_depart' , '=', $depart);
        }
        elseif($year != '' && $styli != '' && $status !='' && $depart == '')
        {
            $id_com[] = '';
                $competition = CompetitionPeriod::where('id_styli' , '=' , $styli)->where('id_year' , '=' , $year)->get();
                if(!empty($competition))
                {
                    foreach($competition as $value)
                    {
                        array_push($id_com, $value->_id);
                    }
                    $query->whereIn('id_competitionperiod',$id_com)->where('admin_status' , '=' , $status);
                }
        }
        elseif($year != '' && $styli != '' && $status !='' && $depart != '')
        {
            $id_com[] = '';
                $competition = CompetitionPeriod::where('id_styli' , '=' , $styli)->where('id_year' , '=' , $year)->get();
                if(!empty($competition))
                {
                    foreach($competition as $value)
                    {
                        array_push($id_com, $value->_id);
                    }
                    $query->whereIn('id_competitionperiod',$id_com)
                    ->where('admin_status' , '=' , $status)
                    ->where('id_depart' , '=' , $depart);
                }
        }
        elseif($year !='' && $styli !='' && $status == '' && $depart == '')
        {
            $id_com[] = '';
                $competition = CompetitionPeriod::where('id_styli' , '=' , $styli)->where('id_year' , '=' , $year)->get();
                if(!empty($competition))
                {
                    foreach($competition as $value)
                    {
                        array_push($id_com, $value->_id);
                    }
                    $query->whereIn('id_competitionperiod',$id_com);
                }
        }
        elseif($year !='' && $styli !='' && $status == '' && $depart != '')
        {
            $id_com[] = '';
                $competition = CompetitionPeriod::where('id_styli' , '=' , $styli)->where('id_year' , '=' , $year)->get();
                if(!empty($competition))
                {
                    foreach($competition as $value)
                    {
                        array_push($id_com, $value->_id);
                    }
                    $query->whereIn('id_competitionperiod',$id_com)->where('id_depart' , '=' , $depart);
                }
        }
        $regis = $query->paginate(50)->withQueryString();
    $notifications = Notifications::where('id_user', '=', Auth::guard('admin')->user()->_id)->orderBy('date','desc')->get();
	$count = count($notifications);
      return view('admin.reviewStylized.index')
      ->with(compact('regis', 'keyword','years','year','nameDepart','selectedYear','nameStylized','stylized','department','type','status','styli','notifications','count'));
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
if( Auth::guard('admin')->user()->status != '2'){
        return redirect('/login-admin')->with(Auth::logout());
    }
        $registration = Registration::find($id);
        $criterias = Ceriterias::where('id_styli', $registration->id_stylized)->paginate(20);

        return view('admin.reviewStylized.criterias')->with(compact('criterias', 'id'));
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
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
   
}
