<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hệ thống Thi đua khen thưởng IUH</title>
    <link rel="icon" href="/Front-End/Icon/icon-award.png" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link rel="stylesheet" href="/css/Styles.css" />
    <link
      rel="stylesheet"
      href="/css/Style-User/Style-UserMain.css"
    />
    <link
      rel="stylesheet"
      href="/css/Style-User/Style-UserRegistrationMedalsReview/Style-UserRegistrationMedalsReview.css"
    />
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.0/jspdf.umd.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>
    //realtime notification
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('755f3dd3f1206ea250f6', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('noti-channel');
    channel.bind('profile-reviewed', function(message) {
      alert(JSON.stringify(message));
    });
  </script>
  </head>
  <body>
    <section id="instruction">
      <img src="/images/instruction.png" alt="" />
    </section>
    <section class="MainMessage"></section>
    @if(session('success'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              MessageSuccess("THÀNH CÔNG!", "Cập nhật minh chứng thành công.");
              // MessageError(
              //   "CẬP NHẬT KHÔNG THÀNH CÔNG!",
              //   "Thông tin mật khẩu chưa chính xác."
              // );
              // Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
              </script>
      @endif
      @if(session('error1'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              // MessageSuccess("THÀNH CÔNG!", "Cập nhật minh chứng thành công.");
              MessageError(
                "xÓA HỒ SƠ KHÔNG THÀNH CÔNG!",
                "Xóa hồ sơ không thành công (Lỗi: Không tìm thấy file minh chứng !)."
              );
              // Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
              </script>
      @endif
    <section class="Main">
    <div class="Main__Navigation">
        <ul>
          <li >
            <a href="{{url('/user')}}"><i class="fa-solid fa-house"></i></a>
          </li>
          <li class="li-active">
            <a href="{{route('send-stylized.index')}}"
              ><i class="fa-solid fa-medal"></i
            ></a>
          </li>
          <li>
          <form action="{{route('changeInforGet') , Auth::user()->_id}}" method="POST">
            <a href="{{route('changeInforGet') , Auth::user()->_id}}" class="btn btn-info"><i class="fa-solid fa-user-gear"></i
            ></a>
          </form>
            
          </li>
          <li>
            <a href="{{ url('/logout-user') }}"
              ><i class="fa-solid fa-arrow-right-from-bracket fa-rotate-180"></i
            ></a>
          </li>
        </ul>
      </div>
      <div class="Main__TopBar">
        <div class="Main__TopBar--Logo">
          <img src="/images/logo-main.png" alt="" />
        </div>
        <div class="Main__TopBar--Account">
          <div class="DateTime">
            <i class="fa-regular fa-calendar-check"></i>
            <span id="Date"></span>
            <span id="Time"></span>
          </div>
          <div class="Account">
            <img src="{{ asset('uploads/user/'. Auth::user()->image) }}" alt="" />
            <div class="info">
              <span> {{ Auth::user()->type }}</span>
              <span> {{ Auth::user()->name }}</span>
            </div>
            <i class="fa-solid fa-angle-down" id="openDropdown-Account"></i>
            <i
              class="fa-solid fa-angle-down fa-rotate-180 hidden"
              id="closeDropdown-Account"
            ></i>
            <div class="nav">
              <ul>
                <li>
                <form action="{{route('changeInforGet') , Auth::user()->_id}}" method="POST">
            <a href="{{route('changeInforGet') , Auth::user()->_id}}" class="btn btn-info"><i class="fa-solid fa-user-gear"></i><span>TÀI KHOẢN</span></a>
          </form>
                  
                </li>
                <li>
                  <a href="{{ url('/logout-user') }}"
                    ><i class="fa-solid fa-arrow-right-from-bracket"></i
                    ><span>ĐĂNG XUẤT</span></a
                  >
                </li>
              </ul>
            </div>
          </div>
          <div class="Notification">
            <i class="fa-solid fa-bell" id="openNotification"></i>
            <div class="Notification__content">
              <span><i class="fa-regular fa-bell"></i> Thông báo</span>
              <div class="Notification__content--items">
                <img src="/images/admin.jpg" alt="" />
                <span id="sender">ADMIN</span>
                <span id="sending-time">Hôm nay</span>
                <p>
                  Chúc mừng, bạn đã ĐÃ đạt danh hiệu “THANH NIÊN TIÊN TIẾN LÀM
                  THEO LỜI BÁC”!
                </p>
              </div>
              <div class="Notification__content--items">
                <img src="/images/admin.jpg" alt="" />
                <span id="sender">ADMIN</span>
                <span id="sending-time">26/04/2023</span>
                <p>
                  Chúc mừng, bạn đã ĐÃ đạt danh hiệu “THANH NIÊN TIÊN TIẾN LÀM
                  THEO LỜI BÁC”!
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="Main__Content">
        <div class="Main__Content--Description">
          <div class="Title">
            <i class="fa-solid fa-medal"></i>
            <h4>PHIẾU ĐĂNG KÝ DANH HIỆU</h4>
          </div>
        
          @if( $regis->admin_status == 0)
	 @if($regis->competitionperiod->depart_first_time > now())
          <div class="RegReset">
            <button id="btn-RegReset" class="custom-button-m" href="">
              <i class="fa-solid fa-repeat"></i>Nhấn để "HỦY HỒ SƠ ĐĂNG KÝ"
            </button>
            <div class="popupRegReset">
              <div class="popupRegReset__content">
                <i class="fa-solid fa-circle-exclamation fa-shake"></i>
                <p>Bạn có chắc chắn, thông tin đăng ký hiện tại sẽ bị xóa?</p>
                <div>
                  <button id="close-popupRegReset">Hủy</button>
                  <a href="{{route('deleteDetail', $regis->_id)}}" id="submit-RegReset">Đăng ký lại</a>
                </div>
              </div>
            </div>
          </div>
	@endif
@endif
          <div class="Info">
            <!-- <img src="/Front-End/Image/lamtheoloiBac.jpg" alt="" /> -->
            <div class="Info__Content">
              <h4>{{$regis->competitionperiod->stylized->name_stylized}}</h4>
              <div class="Info__Content--Duration">
                <i class="fa-solid fa-business-time"></i>
                <span>Thời gian đăng kí :</span>
                <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $regis->competitionperiod->startdate)->format('d/m/Y') }} - 
                  {{ \Carbon\Carbon::createFromFormat('Y-m-d', $regis->competitionperiod->depart_first_time)->format('d/m/Y') }}</span>
              </div>
		<div class="Info__Content--Duration">
                <i class="fa-solid fa-business-time"></i>
                <span>Bổ sung hồ sơ :</span>
                <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $regis->competitionperiod->candidate_add_detail)->format('d/m/Y') }} - 
                  {{ \Carbon\Carbon::createFromFormat('Y-m-d', $regis->competitionperiod->depart_second_time)->format('d/m/Y') }}</span>
              </div>
              <div class="Info__Content--UserObject">
                <i class="fa-solid fa-user-graduate"></i>
                <span>Đối tượng :</span>
                @foreach($regis->competitionperiod->stylized->object as $item)
                <span>{{$item['objects']}}</span>
                @endforeach
              </div>
              <div class="Info__Content--UserObject">
              <i class="fa-solid fa-clipboard"></i>
              <span>Trạng thái :</span>
              <span>@if($regis->admin_status == '0')
                  Đang chờ xét duyệt
                  @elseif($regis->admin_status == '1')
                  Đã duyệt
                  @elseif($regis->admin_status == '2')
                  Xem xét
                  @elseif($regis->admin_status == '3')
                  Từ chối
                  @elseif($regis->admin_status == '4')
                  Đã đạt
                  @elseif($regis->admin_status == '5')
                  Chưa đạt
                  @endif
                </span>
              </div>
            </div>
            <a class="custom-button-m" href="{{route('downloadFileUser', $regis->competitionperiod->stylized->file)}}"
              >TẢI FILE<i class="fa-solid fa-file-pdf"></i
            ></a>
          </div>
          <input type="hidden" name="code_user" value="{{$regis->users->code}}"/>
          <div class="Timeline">
            <ul>
              <li>
                <i class="icon">{{ date("d/m/Y",strtotime($regis->competitionperiod->startdate)) }}</i>
                @if($regis->competitionperiod->startdate < now())
                <div
                  class="progress one"
                  style="background-color: rgba(29, 171, 161, 1)">
                  <p><i class="fa-solid fa-check"></i></p>
                  <i class="uil uil-check"></i>
                </div>
                @else
                <div class="progress one">
                  <p>1</p>
                  <i class="uil uil-check"></i>
                </div>
                @endif
                <p class="text">Mở đăng kí danh hiệu</p>
              </li>
              <li>
                <i class="icon">{{ date("d/m/Y",strtotime($regis->competitionperiod->depart_first_time)) }}</i>
          @if($regis->competitionperiod->depart_first_time < now())
          <div
                  class="progress two"
                  style="background-color: rgba(29, 171, 161, 1)">
                  <p><i class="fa-solid fa-check"></i></p>
                  <i class="uil uil-check"></i>
                </div>
                @else
                <div class="progress two">
                  <p>2</p>
                  <i class="uil uil-check"></i>
                </div>
                @endif
                <p class="text">Đóng ĐK, Khoa duyệt lần 1</p>
              </li>
              <li>
                <i class="icon">{{ date("d/m/Y",strtotime($regis->competitionperiod->candidate_add_detail)) }}</i>
                @if($regis->competitionperiod->candidate_add_detail < now())
                <div
                  class="progress three"
                  style="background-color: rgba(29, 171, 161, 1)">
                  <p><i class="fa-solid fa-check"></i></p>
                  <i class="uil uil-check"></i>
                </div>
                @else
                <div class="progress three">
                  <p>3</p>
                  <i class="uil uil-check"></i>
                </div>
                @endif
                <p class="text">Ứng viên nộp bổ sung</p>
              </li>
              <li>
                <i class="icon">{{ date("d/m/Y",strtotime($regis->competitionperiod->depart_second_time)) }}</i>
                @if($regis->competitionperiod->depart_second_time < now())
                <div
                  class="progress four"
                  style="background-color: rgba(29, 171, 161, 1)">
                  <p><i class="fa-solid fa-check"></i></p>
                  <i class="uil uil-check"></i>
                </div>
                @else
                <div class="progress four">
                  <p>4</p>
                  <i class="uil uil-check"></i>
                </div>
                @endif
                <p class="text">Khoa duyệt lần 2</p>
              </li>
              <li>
                <i class="icon">{{ date("d/m/Y",strtotime($regis->competitionperiod->depart_end_second_time)) }}</i>
                @if($regis->competitionperiod->depart_end_second_time < now())
                <div
                  class="progress five"
                  style="background-color: rgba(29, 171, 161, 1)">
                  <p><i class="fa-solid fa-check"></i></p>
                  <i class="uil uil-check"></i>
                </div>
                @else
                <div class="progress five">
                  <p>5</p>
                  <i class="uil uil-check"></i>
                </div>
                @endif
                <p class="text">Khoa kết thúc duyệt lần 2</p>
              </li>
              <li>
                <i class="icon">{{ date("d/m/Y",strtotime($regis->competitionperiod->enddate)) }}</i>
                @if($regis->competitionperiod->enddate < now())
                <div
                  class="progress six"
                  style="background-color: rgba(29, 171, 161, 1)">
                  <p><i class="fa-solid fa-check"></i></p>
                  <i class="uil uil-check"></i>
                </div>
                @else
                <div class="progress six">
                  <p>6</p>
                  <i class="uil uil-check"></i>
                </div>
                @endif
                <p class="text">Kết thúc đợt thi đua</p>
              </li>
            </ul>
          </div>
          <div class="Abstracts">
            <h4>Yêu cầu chung</h4>
            <p>
            {{html_entity_decode(strip_tags($regis->competitionperiod->stylized->detail))}}
            </p>
            <p>
                    <i>Số tiêu chí khác phải đăng kí:</i>
                    
                    <span id="regCriteriaNumber">
                      {{$regis->competitionperiod->stylized->criterias_number}}
                    
                    </span>
                    </p>
          </div>
        </div>
        <div class="Main__Content--Registration">
          <div class="RegistrationForm">
            <form action="{{route('updateDetail', $regis->_id)}}" method="POST" enctype="multipart/form-data" id="RegistrationSubmit">
            @csrf
            @php
            $filteredCriteriaDetails = \App\Models\CeriteriasDetail::whereIn('_id', $id_criteria_detail)
            ->whereIn('id_criter', $filtered_criterias->pluck('_id'))->get();
            @endphp
            <input type="hidden" name="code_user" value="{{Auth::user()->code}}"/>
              @foreach($filtered_criterias as $item)
              <div class="Standard__Items">
                
                <div class="Standard__Items--Title">
                  <label class=""
                    >TIÊU CHUẨN <i class="fa-solid fa-caret-right"></i>
                  </label>
                  <span>{{$item->name_criter}}</span>
                </div>
                <div class="Criteria">
                  <div class="Describe">
                    <i>Hướng dẫn:</i>
                    @foreach($item->intruction as $intruction)
                    <span>{{html_entity_decode(strip_tags($intruction))}}</span>
                    @endforeach
                  </div>
                @foreach($filteredCriteriaDetails->where('id_criter', $item->_id) as $criteriaDetail)
                    @php
                    $detail = \App\Models\RegistrationDetails::where('id_criteria_detail', $criteriaDetail->_id)
                    ->where('id_regis', $regis->_id)
                    ->first();
                    @endphp
                <div class="Criteria__Items">
                  @if($criteriaDetail->request == '2')
                    <div class="ClassifYoblige">
                      <i class="fa-solid fa-tags"></i>
                      <span>Bắt buộc</span>
                    </div>
                    @elseif($criteriaDetail->request == '1')
                    <div class="ClassifOther">
                        <i class="fa-solid fa-tags"></i>
                        <span>Khác</span>
                      </div>
                      @endif
                    <p>
                    {{html_entity_decode(strip_tags($criteriaDetail->name_criter_detail))}}
                    </p>
                    <div class="Answer">
                      <textarea name="detail_input[{{$detail->_id}}][revelation]" tabindex="">{{html_entity_decode(strip_tags($detail->revelation))}}</textarea>
                      <i class="fa-solid fa-envelope-open-text"></i>
                    </div>
                    <div class="Control">
                        <input type="hidden" name="detail_input[{{$detail->_id}}][old_file]" value="{{$detail->proof_file}}"/>
                      <a href="{{asset('uploads/proof_file/'. $detail->proof_file)}}" target="_blank" class="custom-button-s"
                        ><i class="fa-solid fa-file-shield"></i> MINH CHỨNG</a
                      >
                      @if($detail && $detail->reason == '0')
                      <label
                        style="background-color: rgba(240, 123, 63, 1)"
                        class="checkboxQualified"
                        >CHƯA ĐẠT <i class="fa-solid fa-clipboard-check"></i>
                      </label>
                      @elseif($detail && $detail->reason == '1')
                     <label class="checkboxQualified"
                        >ĐÃ ĐẠT <i class="fa-solid fa-clipboard-check"></i>
                      </label>
                      @endif
                    </div>
                    <div class="ImgProof">
                      <div class="ButtonOuter">
                        <input
                          type="file"
                          id="FileInput"
                          name="detail_input[{{$detail->_id}}][new_file]"
                          accept="image/png, image/jpeg, application/pdf"
                        />
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <span>File minh chứng</span>
                      </div>
                    </div>
                </div>
                   @endforeach

              </div>
              @endforeach
            </div>
            
              <div class="Operation"@if( $regis->admin_status == '4' || $regis->admin_status == '5')
              style="opacity: 0.7; pointer-events: none;"
              
              @elseif($regis->competitionperiod->depart_first_time < now() && $regis->competitionperiod->candidate_add_detail > now())
              style="opacity: 0.7; pointer-events: none;"
              @elseif($regis->competitionperiod->candidate_add_detail < now() && $regis->admin_status != '3')
              style="opacity: 0.7; pointer-events: none;"
              @elseif($regis->competitionperiod->depart_second_time < now())
              style="opacity: 0.7; pointer-events: none;"
              @endif>
              <div class="Note">
                  <span>Nhận xét Quản trị viên Khoa</span>
                 
                  <i class="fa-solid fa-message"></i>
                  <textarea readonly placeholder="" tabindex="">{{$regis->note}}</textarea
                  >
                </div>
                <div class="Note">
                  <span>Nhận xét Quản trị viên Trường</span>
                  
                  <i class="fa-solid fa-message"></i>
                  <textarea readonly placeholder="" tabindex="">{{$regis->admin_note}}</textarea
                  >
                </div>
                <h5>CẬP NHẬT PHIẾU ĐĂNG KÝ</h5>
                <button
                  id="btn-RegUpdate"
                  class="custom-button-m btn-ConfirmSubmit"
                  type="submit"
                  
                >
                  <i class="fa-solid fa-file-import"></i> CẬP NHẬT
                </button>
                
              </div>
            </form>
          </div>
        </div>
    </div>
    </section>

    <div class="popupConfirmSubmit">
      <div class="popupConfirmSubmit__content">
        <i class="fa-regular fa-circle-question fa-shake"></i>
        <p>Bạn có chắc chắn thực hiện thao tác?</p>
        <div>
          <button id="close-popupConfirmSubmit">Hủy</button>
          <button id="submit-ConfirmSubmit">Đồng ý!</button>
        </div>
      </div>
    </div>

    <script src="/js/Js-Main.js"></script>
    <script src="/js/Js-UserRegistrationMedalsReview.js"></script>
    <script src="/js/Js-UserMain.js"></script>
  </body>
</html>
