<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trang chủ - Hệ thống Thi đua khen thưởng IUH</title>
    <link rel="icon" href="/images/icon-award.png" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link rel="stylesheet" href="css/Styles.css" />
    <link
      rel="stylesheet"
      href="css/Style-User/Style-UserMain.css"
    />
    <link
      rel="stylesheet"
      href="css/Style-User/Style-UserIndex/Style-UserIndex.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.js"></script>
  </head>
  <body>
    <section id="instruction">
      <img src="./images/instruction.png" alt="" />
    </section>
    <section id="loading-overlay">
      <img src="/images/logo-main.png" alt="" />
      <div class="loading-spinner"></div>
      <h5>ĐANG TẢI...</h5>
    </section>
    <section class="MainMessage"></section>
    @if(session('success1'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              MessageSuccess("THÀNH CÔNG!", "Cập nhật thông tin thành công.");
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
      @if(session('error4'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              // MessageSuccess("THÀNH CÔNG!", "Cập nhật thông tin thành công.");
              MessageError(
                "ĐĂNG KÍ KHÔNG THÀNH CÔNG!",
                "Bạn đã đăng kí đợt thi đua này rồi."
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
          <li class="li-active">
            <a href="{{url('/user')}}"><i class="fa-solid fa-house"></i></a>
          </li>
          <li>
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
            @include('notifications')    
	 </div>
        </div>
      </div>
      <div class="Main__Content">
        <div class="Main__Content--SlideShow">
          <div class="Slider">
            <i class="fa-solid fa-angle-right fa-rotate-180 prev"></i>
            <i class="fa-solid fa-angle-right next"></i>
            <div class="Slider__direction">
               @foreach($slideShow as $slide)
              <button data-direction="{{$slide->number}}" @if($slide->number == '0')class="active"@endif></button>
              @endforeach
            </div>
            <div class="Slider__main">
              <div class="Slider__main--img">
                @foreach($slideShow as $picture)
                <a href=""
                  ><img src="{{asset('images/'.$picture->image)}}" alt=""/></a>
              @endforeach
              </div>
            </div>
          </div>
        </div>
        <div class="Main__Content--CandidatesInfor">
          <div class="Avatar">
            <img src="{{ asset('uploads/user/'. Auth::user()->image) }}" alt="" />
            <!-- <a href="">
              <i class="fa-solid fa-camera"></i>
            </a> -->
          </div>
          <div class="Profile">
            <div class="Profile__Title">
              <p>Họ và tên</p>
              <p>Mã số</p>
              <p>Đơn vị</p>
            </div>
            <div class="Profile__Content">
              <p> {{ Auth::user()->name }}</p>
              <p> {{ Auth::user()->code }}</p>
              <p>{{ $departmentName->name_depart}}</p> 
            </div>
            <div class="Profile__Detail">
            
            <a href="{{route('changeInforGet') , Auth::user()->_id}}" class="btn btn-info">Xem chi tiết<i class="fa-solid fa-angles-right"></i></a>
          
            </div>
          </div>
          <div class="Achievements">
            <img src="/images/Achievements.png" alt="" />
            <h2>THÀNH TÍCH ỨNG VIÊN</h2>
            <h3>DANH HIỆU ĐÃ ĐĂNG KÍ</h3>
            <h1>{{$regisCount}}</h1>
            <h3>DANH HIỆU ĐÃ ĐẠT</h3>
            <h1>{{$regisPassCount}}</h1>
          </div>
        </div>
        <div class="Main__Content--RecentMedal">
          <div class="Title">
            <i class="fa-solid fa-medal"></i>
            <span>DANH HIỆU ĐANG XÉT DUYỆT</span>
          </div>
          
          @foreach($CompetitionPeriod as $value)
    @php
    $registerExists = \App\Models\Registration::where('id_user', Auth::user()->_id)
        ->where('id_competitionperiod', $value->_id)
        ->exists();
	$now = \Carbon\Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
    @endphp

    @foreach($value->stylized->object as $item)
        @if(in_array(Auth::user()->type, $item) && !($registerExists))
         @if($value->startdate <= $now && $value->depart_first_time >= $now)
            <div class="Medal">
                <div class="Medal__Items">
                    <img src="{{ asset('certificate/img_certificate/'. $value->stylized->image) }}" alt="" />
                    <div class="Medal__Items--Content">
                        <span class="Name">{{ $value->stylized->name_stylized}}</span>
                        <div class="Duration">
                            <i class="fa-solid fa-business-time"></i>
                            <span>Thời gian:</span>
                            <span>{{ date("d/m/Y",strtotime($value->startdate)) }} 
                    - {{ date("d/m/Y",strtotime($value->depart_first_time)) }}</span>
                        </div>
                    </div>
                    <a href="{{ route('downloadFileUser', $value->stylized->file) }}"><i class="fa-solid fa-file-pdf"></i></a>
                    <a href="{{ route('getStylized', $value->_id) }}" class="custom-button-m">ĐĂNG KÍ</a>
                </div>
            </div>
        @endif
	@endif
    @endforeach
@endforeach
           

          </div>
        </div>
      </div>
    </section>

    <script src="/js/Js-UserMain.js"></script>
    <script src="/js/Js-Main.js"></script>
    <script src="/js/Js-UserIndex.js"></script>
  </body>
</html>
