<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tài khoản - Hệ thống Thi đua khen thưởng IUH</title>
    <link rel="icon" href="/images/icon-award.png" />
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
      href="/css/Style-User/Style-UserAccount/Style-UserAccount.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.js"></script>
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
          <li>
            <a href="{{ url('/user') }}"
              ><i class="fa-solid fa-house"></i
            ></a>
          </li>
          <!-- <li>
            <a href=""><i class="fa-solid fa-clipboard"></i></a>
          </li> -->
          <li>
          <a href="{{route('send-stylized.index')}}"
              ><i class="fa-solid fa-medal"></i
            ></a>
          </li>
          <li class="li-active">
            <a href=""><i class="fa-solid fa-user-gear"></i></a>
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
                  <a href="{{ route('inforUser') }}"
                    ><i class="fa-solid fa-user-gear"></i
                    ><span>TÀI KHOẢN</span></a
                  >
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
      <section class="MainMessage"></section>
      <div class="Main__Content">
        <div class="Main__Content--Avatar">
          <form action="{{ route('changeImage', Auth::user()->_id)}}" method="post" enctype="multipart/form-data">
          @csrf
            <div class="ImgAvatar">
              <img src="{{ asset('uploads/user/'. Auth::user()->image) }}" alt="" id="DefaultImg" />
              <div id="PreviewImg"></div>
            </div>
            <div class="ImgUpload">
              <div class="ButtonOuter">
                <input
                  type="file"
                  id="FileInput"
                  name="image"
                  accept="image/png, image/jpeg"
                />
                <i class="fa-solid fa-camera"></i>
              </div>
            </div>
            <input
              id="btn-UploadImg"
              class="custom-button-m"
              type="submit"
              value="CẬP NHẬT"
            />
          </form>
        </div>
        
        <div class="Main__Content--AccountInfor">
          <h4>Thông tin tài khoản</h4>
          <div class="InfoTitle">
            <p>Họ và tên</p>
            <p>ID</p>
            <p>Đơn vị</p>
            <p>Đối tượng</p>
          </div>
          <div class="InfoContent">
            <p>{{ Auth::user()->name }}</p>
            <p>{{ Auth::user()->code }}</p>
            <p>{{ $departmentName[0]->name_depart }}</p>
            <p>{{ Auth::user()->type }}</p>
          </div>
          <form action="{{ route('changePassPost', Auth::user()->_id) }}" method="POST" class="ChangePass">
          @csrf
            <p>Quản lí mật khẩu</p>
            <div id="form-items" class="ChangePass__items">
              <p id="" for="">Mật khẩu hiện tại</p>
              <input type="password" name="pass_old"placeholder="Mật khẩu" />
              <i class="fa-solid fa-lock"></i>
              <div class="ChangePass__items--eyes">
                <i class="fa-solid fa-eye eye-open"></i>
                <i class="fa-solid fa-eye-slash eye-close"></i>
              </div>
              @if(session('error'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              //MessageSuccess("THÀNH CÔNG!", "Cập nhật dữ liệu thành công.");
              MessageError(
                "CẬP NHẬT KHÔNG THÀNH CÔNG!",
                "Thông tin mật khẩu chưa chính xác."
              );
              // Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
              </script>
              @endif
              <span id="message" class="ChangePass__items--message"></span>
            </div>
            <div id="form-items" class="ChangePass__items">
              <p id="" for="">Mật khẩu mới</p>
              <input id="NewPass" name="pass_new" type="password" placeholder="Mật khẩu mới" />
              <i class="fa-solid fa-lock"></i>
              <div class="ChangePass__items--eyes">
                <i class="fa-solid fa-eye eye-open"></i>
                <i class="fa-solid fa-eye-slash eye-close"></i>
              </div>
              @if($errors->has('pass_new'))
              <div class="alert alert-danger mt-2">                
                  {{ $errors->first('pass_new') }}
              </div>
              @endif
              <span id="message" class="ChangePass__items--message"></span>
            </div>
            <div id="form-items" class="ChangePass__items">
              <p id="" for="">Nhập lại mật khẩu</p>
              <input
                id="RePass" name="confirm_pass_new"
                type="password"
                placeholder="Nhập lại mật khẩu"
              />
              <i class="fa-solid fa-lock"></i>
              <div class="ChangePass__items--eyes">
                <i class="fa-solid fa-eye eye-open"></i>
                <i class="fa-solid fa-eye-slash eye-close"></i>
              </div>
              @if($errors->has('confirm_pass_new'))
              <div class="alert alert-danger mt-2">
                  {{ $errors->first('confirm_pass_new') }}
              </div>
              @endif
              <span id="message" class="ChangePass__items--message"></span>
            </div>
            <input
              class="custom-button-m"
              type="submit"
              value="LƯU THAY ĐỔI"
              id="btn-changePass"
            />
          </form>
        </div>
        
        <div class="Main__Content--PersonalInfor">
          <h4>Thông tin cá nhân</h4>
          @if(session('success'))
          <script>
            sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              MessageSuccess("THÀNH CÔNG!", "Cập nhật thông tin thành công.");
              // MessageError(
              //   "ĐĂNG NHẬP KHÔNG THÀNH CÔNG!",
              //   "Tài khoản hoặc mật khẩu chưa chính xác."
              // );
              // Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
         
    </script>
    @endif 
          @foreach ($userInfor as $value)
          <form action="{{ route('changeInforPost', Auth::user()->_id) }}" method="POST">
          @csrf
            <div id="InforForm-items" class="DateOfBirth">
              <p id="" for="">Ngày sinh</p>
              <input type="date" name="birthday" placeholder="" value="{{ $value->birthday }}" required />
              <i id="FormIcon" class="fa-solid fa-cake-candles"></i>
              <i id="SelectCalendar" class="fa-solid fa-calendar-plus"></i>
              <span id="message" style="color:red" class="ChangePass__items--message">
                @if($errors->has('birthday'))
                <div class="alert alert-danger mt-2">
                {{ $errors->first('birthday') }}
            </div>
            <script>
          sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              //MessageSuccess("THÀNH CÔNG!", "Cập nhật dữ liệu thành công.");
              MessageError(
                "CẬP NHẬT KHÔNG THÀNH CÔNG!",
                "Ứng viên phải trên 18 tuổi !"
              );
              // Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
    </script>
                @endif
              </span>
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
              <span id="message" style="color:red" class="ChangePass__items--message">
                @if($errors->has('phone'))
                <div class="alert alert-danger mt-2">
                {{ $errors->first('phone') }}
                <script>
          sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              // MessageSuccess("THÀNH CÔNG!", "Cập nhật dữ liệu thành công.");
              MessageError(
                "CẬP NHẬT KHÔNG THÀNH CÔNG!",
                "Vui lòng nhập số điện thoại."
              );
              // Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
    </script>
                </div>
              @endif
            </span>
            </div>
            <div id="InforForm-items" class="Course">
              <p id="" for="">Địa chỉ</p>
              <input type="text" name="address" placeholder="Nhập địa chỉ" value="{{ $value->address }}" />
              <i id="FormIcon" class="fa-solid fa-location-dot"></i>
              <span id="message" style="color:red" class="ChangePass__items--message">
              @if($errors->has('address'))
                <div class="alert alert-danger mt-2">
                {{ $errors->first('address') }}
                <script>
          sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              // MessageSuccess("THÀNH CÔNG!", "Cập nhật dữ liệu thành công.");
              MessageError(
                "CẬP NHẬT KHÔNG THÀNH CÔNG!",
                "Vui lòng nhập địa chỉ."
              );
              // Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
    </script>
              </div>
                @endif
            
              </span>
            </div>
            <div id="InforForm-items" class="Course">
              <p id="" for="">Niên khóa</p>
              <input type="text" placeholder="" value="{{ $value->course }}" disabled />
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
          @endforeach
        </div>
      </div>
    </section>

    <script src="../js/Js-UserAccount.js"></script>
    <script src="../js/Js-UserMain.js"></script>
    <script src="../js/Js-Main.js"></script>
  </body>
</html>
