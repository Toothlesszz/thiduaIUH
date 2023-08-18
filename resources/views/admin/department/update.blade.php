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
    <link rel="stylesheet" href="/css/Styles.css" />
    <link
      rel="stylesheet"
      href="/css/Style-AdminManagement/Style-AdminManagementMain.css"
    />
    <link
      rel="stylesheet"
      href="/css/Style-AdminManagement/Style-AdminManagementAdministratorsDetail/Style-AdminManagementAdministratorsDetail.css"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.js"></script>
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
    @if(session('error'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              //MessageSuccess("THÀNH CÔNG!", "Cập nhật thông tin Quản trị viên Khoa thành công.");
              MessageError(
                "CẬP NHẬT KHÔNG THÀNH CÔNG!",
                "Bạn không có quyền khóa tài khoản này !"
              );
              //Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
              </script>
              @endif
    <section class="Main">
    <div class="Main__Navigation">
        <ul>
          <li>
            <a href="{{ url('/admin')}}"
              ><i class="fa-solid fa-house"></i
            ></a>
          </li>
          <li>
            <a href="{{route('stylized.index')}}"
              ><i class="fa-solid fa-award"></i
            ></a>
          </li>
          <li>
          <a
              href="{{route('review-stylized.index')}}"
              ><i class="fa-solid fa-clipboard-check"></i
            ></a>
          </li>
          <li>
            <a
              href="{{ route('user.index') }}"
              ><i class="fa-solid fa-id-card-clip"></i
            ></a>
          </li>
          <li class="li-active">
            <a href="{{ route('department.index') }}"><i class="fa-solid fa-chalkboard-user"></i></a>
          </li>
          <li>
          <form action="{{route('changeInforAdminGet') , Auth::guard('admin')->user()->_id}}" method="POST">
            <a href="{{route('changeInforAdminGet') , Auth::guard('admin')->user()->_id}}" class="btn btn-info"><i class="fa-solid fa-user-gear"></i></a>
          </form>
          </li>
          <li>
            <a href="{{ url('/logout-admin')}}"
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
            <img src="{{ asset('uploads/user/'.Auth::guard('admin')->user()->image) }}" alt="" />
            <div class="info">
            @if(Auth::guard('admin')->user()->level == 4)
              <span> Quản trị viên Trường</span>
              <span> {{ Auth::guard('admin')->user()->name }}</span>
              @endif
            </div>
            <i class="fa-solid fa-angle-down" id="openDropdown-Account"></i>
            <i
              class="fa-solid fa-angle-down fa-rotate-180 hidden"
              id="closeDropdown-Account"
            ></i>
            <div class="nav">
              <ul>
                <li>
                <form action="{{route('changeInforAdminGet') , Auth::guard('admin')->user()->_id}}" method="POST">
            <a href="{{route('changeInforAdminGet') , Auth::guard('admin')->user()->_id}}" class="btn btn-info"><i class="fa-solid fa-user-gear"></i>TÀI KHOẢN</a>
          </form>
                  
                </li>
                <li>
                  <a href="{{ url('/logout-admin')}}"
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
        <div class="Main__Content--CandidateProfile">
          <div class="Title">
            <i class="fa-solid fa-address-card"></i>
            <span>THÔNG TIN QUẢN TRỊ VIÊN</span>
          </div>
          @foreach($userDepart as $value)
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
              <p>{{$value->name}}</p>
              <p>{{$value->code}}</p>
              <p>{{$value->department->name_depart}}</p>
              <p>{{$value->type}}</p>
            </div>
            @endforeach
            <form action="{{ route('changePassAdmindepart', [$value->_id]) }}" method="post" class="ChangePass">
              @csrf
              <input
                  name="pass_new"
                  type="hidden"
                  value="Quantri@111"
                  placeholder="Mật khẩu mới"
                />  
              <input
                class="custom-button-m"
                type="submit"
                value="LƯU THAY ĐỔI"
                id="btn-changePass"
              />
            </form>
            
            @if($value->status == 2)
  <form id="lockAccountForm" action="{{ route('changeStatusDepart', [$value->_id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id_creator" value="{{ $value->id_creator }}" required />
    <input type="hidden" name="level" value="{{ $value->level }}" />
    <button id="btn-LockAccount" class="custom-button-m" type="submit">
      KHÓA TÀI KHOẢN
    </button>
  </form>
          @elseif($value->status == 3)
  <form id="unlockAccountForm" action="{{ route('changeStatusDepart', [$value->_id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id_creator" value="{{ $value->id_creator }}" required />
    <input type="hidden" name="level" value="{{ $value->level }}" />
    <button id="btn-LockAccount" class="custom-button-m" type="submit">
      MỞ KHÓA TÀI KHOẢN
    </button>
  </form>
@endif
        
          </div>
          <div class="PersonalInfor">
          @if(session('success'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              MessageSuccess("THÀNH CÔNG!", "Cập nhật thông tin Quản trị viên Khoa thành công.");
              // MessageError(
              //   "CẬP NHẬT KHÔNG THÀNH CÔNG!",
              //   "Vui lòng nhập đúng định dạng của thông tin !"
              // );
              //Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
              </script>
              @endif
            <h4>Thông tin cá nhân</h4>
            <form action="{{ route('department.update', [$value->_id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
              <div id="InforForm-items" class="DateOfBirth">
                <p id="" for="">Ngày sinh</p>
                <input type="date" placeholder="" name="birthday" value="{{ $value->birthday }}" required />
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
                  type="text" name="email"
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
                  type="text" name="phone"
                  placeholder="Nhập số điện thoại"
                  value="{{ $value->phone }}"
                  required
                />
                <i id="FormIcon" class="fa-solid fa-phone"></i>
                <span id="message" class="ChangePass__items--message"></span>
              </div>
              <div id="InforForm-items" class="Course">
                <p id="" for="">Địa chỉ</p>
                <input type="text" placeholder="Nhập địa chỉ" name="address" value="{{ $value->address }}" />
                <i id="FormIcon" class="fa-solid fa-location-dot"></i>
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
      </div>
    </section>

    <script src="/js/Js-AdminManagementAdministratorsDetail.js"></script>
    <script src="/js/Js-AdminManagementMain.js"></script>
    <script src="/js/Js-Main.js"></script>
  </body>
</html>
