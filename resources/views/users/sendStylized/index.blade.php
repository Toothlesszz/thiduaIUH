<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thành tích - Hệ thống Thi đua khen thưởng IUH</title>
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
      href="/css/Style-User/Style-UserAchievements/Style-UserAchievements.css"
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
    <section id="loading-overlay">
      <img src="/images/logo-main.png" alt="" />
      <div class="loading-spinner"></div>
      <h5>ĐANG TẢI...</h5>
    </section>
    <section class="MainMessage"></section>

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
                  Chúc mừng, bạn đã đạt danh hiệu “THANH NIÊN TIÊN TIẾN LÀM THEO
                  LỜI BÁC”!
                </p>
              </div>
              <div class="Notification__content--items">
                <img src="/images/admin.jpg" alt="" />
                <span id="sender">ADMIN</span>
                <span id="sending-time">26/04/2023</span>
                <p>
                  Chúc mừng, bạn đã đạt danh hiệu “THANH NIÊN TIÊN TIẾN LÀM THEO
                  LỜI BÁC”!
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="Main__Content">
        <div class="Main__Content--Achievements">
          <img src="/images/Achievements.png" alt="" />
          <h2>THÀNH TÍCH ỨNG VIÊN</h2>
          <h3>DANH HIỆU ĐÃ ĐĂNG KÍ</h3>
          <h1>{{$regisCount}}</h1>
          <h3>DANH HIỆU ĐÃ ĐẠT</h3>
          <h1>{{$regisPassCount}}</h1>
        </div>
        <div class="Main__Content--Medals">
          <div class="Title">
            <i class="fa-solid fa-medal"></i>
            <span>DANH HIỆU ĐÃ ĐĂNG KÍ</span>
          </div>
          <div class="Medal">
            @foreach($register as $value)
            <div class="Medal__Items">
              <img src="{{ asset('certificate/img_certificate/'.$value->competitionperiod->stylized->image)}}" alt="" />
              <div class="Medal__Items--Content">
                <span class="Name">{{$value->competitionperiod->stylized->name_stylized}}</span>
                <div class="MedalInfo">
                    @if($value->admin_status == '4')
                  <div class="MedalInfo__Status">
                    <i class="fa-solid fa-award"></i>
                    <span>Đã đạt danh hiệu</span>
                  </div>
                  @elseif($value->admin_status == '5')
                  <div class="MedalInfo__Status">
                  <i class="fa-solid fa-circle-xmark"></i>
                    <span>Không đạt danh hiệu</span>
                  </div>
                  @elseif($value->admin_status == '0')
                  <div class="MedalInfo__Status">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span>Đã gửi, chờ xét duyệt!</span>
                  </div>
                  @elseif($value->admin_status == '1')
                  <div class="MedalInfo__Status">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span>Đã duyệt ở cấp khoa!</span>
                  </div>
                  @elseif($value->admin_status == '2')
                  <div class="MedalInfo__Status">
                  <i class="fa-solid fa-circle-question"></i>
                    <span>Hồ sơ đang được xem xét!</span>
                  </div>
                  @elseif($value->admin_status == '3')
                  <div class="MedalInfo__Status">
                  <i class="fa-solid fa-circle-xmark"></i>
                    <span>Đã bị Khoa từ chối!</span>
                  </div>
                  @endif
                  <div class="MedalInfo__Duration">
                    <i class="fa-solid fa-business-time"></i>
                    <span>Thời gian </span>
                    <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $value->competitionperiod->startdate)->format('d/m/Y') }} - 
                  {{ \Carbon\Carbon::createFromFormat('Y-m-d', $value->competitionperiod->depart_first_time)->format('d/m/Y') }}</span>
                  </div>
                  <div class="MedalInfo__Duration">
                    <i class="fa-solid fa-business-time"></i>
                    <span>Năm học </span>
                    <span>{{$value->competitionperiod->years->year}}</span>
                  </div>
                </div>
              </div>
              <a href="{{ route('downloadFileUser', $value->competitionperiod->stylized->file) }}"><i class="fa-solid fa-file-pdf"></i></a>
              
              <a href="{{ route('showDetail', [$value->_id]) }}"
                class="custom-button-m"
                >CHI TIẾT</a
              >
              @if($value->admin_status == '4')
                <button
                id="btn-ViewCertification"
                href=""
                class="custom-button-m"
              >
                CHỨNG NHẬN
              </button>
              <div class="popupCertification">
                <div class="popupCertification__content">
                  <i id="closePopup" class="fa-solid fa-xmark"></i>
                  <span>CHỨNG NHẬN DANH HIỆU</span>
                  <div class="popupCertification__content--Certification">
                    <img src="{{ asset('certificate/img_certificate/'.$value->competitionperiod->image)}}" alt="" />
                    <div class="Content">
                      <h2 style  = "text-transform: uppercase;">{{$value->users->name}}</h2>
                      <h4 style  = "text-transform: uppercase;">{{$value->users->department->name_depart}}</h4>
                    </div>
                  </div>
                  <button
                    class="custom-button-m"
                    id="btn-DownloadCertification"
                  >
                    DOWNLOAD FILE PDF
                  </button>
                </div>
              </div>
              @endif
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>

    <script src="/js/Js-UserAchievements.js"></script>
    <script src="/js/Js-Main.js"></script>
    <script src="/js/Js-UserMain.js"></script>
  </body>
</html>