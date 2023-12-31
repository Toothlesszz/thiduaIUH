<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hệ thống Thi đua khen thưởng IUH</title>
    <link rel="icon" href="/images/icon-award.png" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link rel="stylesheet" href="/css/Styles.css" />
    <link
      rel="stylesheet"
      href="/css/Style-AdminDepartment/Style-AdminDepartmentMain.css"
    />
    <link
      rel="stylesheet"
      href="/css/Style-AdminDepartment/Style-AdminDepartmentCandidateDetail/Style-AdminDepartmentCandidateDetail.css"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
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
    @if(session('success1'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              MessageSuccess("THÀNH CÔNG!", "Đặt lại mật khẩu ứng viên thành công.");
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
    <section class="Main">
    <div class="Main__Navigation">
        <ul>
          <li>
            <a href="{{ url('/admin-department') }}"
              ><i class="fa-solid fa-house"></i
            ></a>
          </li>
          <li>
          <a
              href="{{route('stylized-department.index')}}"
              ><i class="fa-solid fa-clipboard-check"></i
            ></a>
          </li>
          <li class="li-active">
            <a href="{{ route('user-department.index') }}"><i class="fa-solid fa-id-card-clip"></i></a>
          </li>
          <li>
          <form action="{{route('changeInforAdminDepartmentGet') , Auth::guard('department')->user()->_id}}" method="POST">
            <a href="{{route('changeInforAdminDepartmentGet') , Auth::guard('department')->user()->_id}}" class="btn btn-info"><i class="fa-solid fa-user-gear"></i></a>
          </form>
          </li>
          <li>
            <a href="{{ url('/logout-admin-department')}}"
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
          <img src="{{ asset('uploads/user/'. Auth::guard('department')->user()->image) }}" alt="" />
            <div class="info">
              <span> {{ Auth::guard('department')->user()->type }}</span>
              <span> {{ Auth::guard('department')->user()->name }}</span>
            </div>
            <i class="fa-solid fa-angle-down" id="openDropdown-Account"></i>
            <i
              class="fa-solid fa-angle-down fa-rotate-180 hidden"
              id="closeDropdown-Account"
            ></i>
            <div class="nav">
              <ul>
                <li>
                <form action="{{route('changeInforAdminDepartmentGet') , Auth::guard('department')->user()->_id}}" method="POST">
            <a href="{{route('changeInforAdminDepartmentGet') , Auth::guard('department')->user()->_id}}" class="btn btn-info"><i class="fa-solid fa-user-gear"></i><span>TÀI KHOẢN</span></a>
          </form>
                </li>
                <li>
                  <a href="{{ url('/logout-admin-department')}}"
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
      <div class="Main__Content--Achievements">
          <img src="/images/Achievements.png" alt="" />
          <h2>THÀNH TÍCH ỨNG VIÊN</h2>
          <h3>DANH HIỆU ĐÃ ĐĂNG KÍ</h3>
          <h1>{{$regisCount}}</h1>
          <h3>DANH HIỆU ĐÃ ĐẠT</h3>
          <h1>{{$regisPassCount}}</h1>
        </div>
        <div class="Main__Content--CandidateProfile">
          <div class="Title">
            <i class="fa-solid fa-address-card"></i>
            <span>THÔNG TIN ỨNG VIÊN</span>
          </div>
          @foreach($user as $value)
          <div class="AccountInfor">
            <h4>Thông tin tài khoản</h4>
            <div class="InfoAvatar">
              <img src="{{ asset('uploads/user/'.$value->image) }}" alt="" />
            </div>
            <div class="InfoTitle">
              <p>Họ và tên</p>
              <p>ID</p>
              <p>Đơn vị</p>
              <p>Đối tượng</p>
            </div>
            
            <div class="InfoContent">
              <p>{{ $value->name }}</p>
              <p>{{ $value->code }}</p>
              <p>{{ $value->department->name_depart }}</p>
              <p>{{ $value->type }}</p>
            </div>
            @endforeach
            <form action="{{ route('changePassUser', [$value->_id]) }}" method="POST" class="ChangePass">
              @csrf
              <input
                  name="pass_new"
                  type="hidden"
                  value="Ungvien@111"
                  placeholder="Mật khẩu mới"
                />    
              <input
                class="custom-button-m"
                type="submit"
                value="ĐẶT LẠI MẬT KHẨU"
                id="btn-changePass"
              />
            </form>
          </div>
          <div class="PersonalInfor">
            <h4>Thông tin cá nhân</h4>
            @if(session('success'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              MessageSuccess("THÀNH CÔNG!", "Cập nhật thông tin ứng viên thành công.");
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
              @if(session('error'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              //MessageSuccess("THÀNH CÔNG!", "Cập nhật thông tin ứng viên thành công.");
              MessageError(
                "CẬP NHẬT KHÔNG THÀNH CÔNG!",
                "Vui lòng nhập đúng định dạng của thông tin !"
              );
              Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
              </script>
              @endif
            <form action="{{ route('user-department.update', [$value->_id]) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
              <div id="InforForm-items" class="DateOfBirth">
                <p id="" for="">Ngày sinh</p>
                <input type="date" name="birthday" placeholder="" value="{{ $value->birthday }}" required />
                <i id="FormIcon" class="fa-solid fa-cake-candles"></i>
                <i id="SelectCalendar" class="fa-solid fa-calendar-plus"></i>
                <span id="message" class="ChangePass__items--message"></span>
              </div>
              
              <div id="InforForm-items" class="Gender">
                <p id="" for="">Giới tính</p>
                @if($value->gender == 1)
                  <div class="Gender__radio">
                  <input type="radio" id="male" name="gender" value="1" checked="checked">
                  <label for="male">Nam</label>
                  <input type="radio" id="female" name="gender" value="2">
                  <label for="female">Nữ</label>
                  </div>
              @else
                  <div class="Gender__radio">
                  <input type="radio"  id="male" name="gender" value="1">
                  <label for="male">Nam</label>
                  <input type="radio" id="female" name="gender" value="2" checked="checked">
                  <label for="female">Nữ</label>
                  </div>
              @endif
                <span id="message" class="ChangePass__items--message"></span>
              </div>
              <div id="InforForm-items" class="Email">
                <p id="" for="">Email</p>
                <input
                  type="text"
                  name="email"
                  placeholder="Nhập Email"
                  value="{{ $value->email }}"
                  required
                />
                <i id="FormIcon" class="fa-solid fa-envelope-circle-check"></i>
                <span id="message" class="ChangePass__items--message"></span>
              </div>
              <div id="InforForm-items" class="Phone">
                <p id="" for="">Số điện thoại</p>
                <input
                  type="text"
                  name="phone"
                  placeholder="Nhập số điện thoại"
                  value="{{ $value->phone }}"
                  required
                />
                <i id="FormIcon" class="fa-solid fa-phone"></i>
                <span id="message" class="ChangePass__items--message"></span>
              </div>
              <div id="InforForm-items" class="Course">
                <p id="" for="">Địa chỉ</p>
                <input type="text" name="address" placeholder="Nhập địa chỉ" value="{{ $value->address }}" required/>
                <i id="FormIcon" class="fa-solid fa-location-dot"></i>
                <span id="message" class="ChangePass__items--message"></span>
              </div>
              <div id="InforForm-items" class="Course">
                <p id="" for="">Niên khóa</p>
                <input
                  type="text"
                  name="course"
                  placeholder=""
                  value="{{ $value->course }}"
                  disabled
                />
                <i id="FormIcon" class="fa-solid fa-graduation-cap"></i>
                <span id="message" class="ChangePass__items--message"></span>
              </div>

              <input
                id="btn-UpdatePersonalInfor"
                class="custom-button-m"
                type="submit"
                value="LƯU THAY ĐỔI"
                id=""
              />
        </form>
              
          </div>
        </div>
        <div class="Main__Content--Medals">
          <div class="Title">
            <i class="fa-solid fa-medal"></i>
            <span>DANH HIỆU ĐÃ ĐĂNG KÍ</span>
          </div>
          <div class="Medal">
          @foreach($regis as $value)
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
              <a href="{{ route('downloadFile', $value->competitionperiod->stylized->file) }}"><i class="fa-solid fa-file-pdf"></i></a>
              
              <a href=" {{route('showDetailCeriteria',[$value->_id])}}"
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

    <div class="popupCertification">
      <div class="popupCertification__content">
        <i id="closePopup" class="fa-solid fa-xmark"></i>
        <span>CHỨNG NHẬN DANH HIỆU</span>
        <div class="popupCertification__content--Certification">
          <img src="/images/GCN-TTTT2021.jpg" alt="" />
          <div class="Content">
            <h2>PHẠM TẤN LỢI</h2>
            <h4>KHOA CÔNG NGHỆ THÔNG TIN</h4>
          </div>
        </div>
        <button class="custom-button-m" id="btn-DownloadCertification">
          DOWNLOAD FILE PDF
        </button>
      </div>
    </div>

    <script src="/js/Js-AdminDepartmentCandidateDetail.js"></script>
    <script src="/js/Js-AdminDepartmentMain.js"></script>
    <script src="/js/Js-Main.js"></script>
  </body>
</html>
