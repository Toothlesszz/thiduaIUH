<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cập nhật tài khoản - Hệ thống Thi đua khen thưởng IUH</title>
    <link rel="icon" href="images/icon-award.png" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link rel="stylesheet" href="/css/Styles.css" />

    <link
      rel="stylesheet"
      href="/css/Style-User/Style-FirstUpdateProfile.css"
    />
  </head>
  <body>
    <section id="instruction">
      <img src="images/instruction.png" alt="" />
    </section>
    <section id="loading-overlay">
      <img src="/images/logo-main.png" alt="" />
      <div class="loading-spinner"></div>
      <h5>ĐANG TẢI...</h5>
    </section>
    <section class="MainMessage"></section>
    @if(session('error1'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              //MessageSuccess("THÀNH CÔNG!", "Cập nhật dữ liệu thành công.");
              MessageError(
                "CẬP NHẬT KHÔNG THÀNH CÔNG!",
                "Số điện thoại đã được sử dụng ."
              );
              // Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
              </script>
              @endif
              @if(session('error3'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              //MessageSuccess("THÀNH CÔNG!", "Cập nhật dữ liệu thành công.");
              MessageError(
                "CẬP NHẬT KHÔNG THÀNH CÔNG!",
              "Mật khẩu không chính xác."
              );
              // Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
              </script>
              @endif
    <section class="Main">
      <div class="Main__TopBar">
        <img src="images/logo-main.png" alt="" />
        <h4>CẬP NHẬT THÔNG TIN TÀI KHOẢN</h4>
        <i
          ><i class="fa-solid fa-triangle-exclamation"></i> Vui lòng cập nhật
          <b>"Thông tin cá nhân"</b> để tiếp tục đăng nhập hệ thống!</i
        >
      </div>
      <div class="Main__Content">
        <div class="Main__Content--Avatar">
          <form action="" method="post" enctype="multipart/form-data">
          @csrf
            <div class="ImgAvatar">
              <img src="{{asset('uploads/user/'. $user[0]->image) }}" alt="" id="DefaultImg" />
              <div id="PreviewImg"></div>
            </div>
            
            
          </form>
        </div>
        <div class="Main__Content--AccountInfor">
            @foreach($user as $value)
          <h4>Thông tin tài khoản</h4>
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
          
        </div>
        <div class="Main__Content--PersonalInfor">
          <h4>Thông tin cá nhân</h4>
          <form action="{{route('addInformationAdminDepartment',[$value->_id])}}" method="post"  enctype="multipart/form-data" >
          @csrf
            <div id="InforForm-items" class="DateOfBirth">
              <p id="" for="">Ngày sinh</p>
              <input type="date" placeholder="" name="birthday" value="{{$value->birthday}}" required />
              <i id="FormIcon" class="fa-solid fa-cake-candles"></i>
              <i id="SelectCalendar" class="fa-solid fa-calendar-plus"></i>
              <span id="message" class="ChangePass__items--message"></span>
            </div>
            <div id="InforForm-items" class="Gender">
              <p id="" for="">Giới tính</p>
              <div class="Gender__radio">
                <input
                  type="radio"
                  id="male"
                  name="gender"
                  value="1"
                  checked
                />
                <label for="male">Nam</label><br />
                <input type="radio" id="female" name="gender" value="2" />
                <label for="female">Nữ</label><br />
              </div>
              <span id="message" class="ChangePass__items--message"></span>
            </div>
            <div id="InforForm-items" class="Email">
              <p id="" for="">Email</p>
              <input
                type="text" name="email"
                placeholder="Nhập Email"
                value="{{$value->email}}"
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
                value="{{$value->phone}}"
                required
              />
              <i id="FormIcon" class="fa-solid fa-phone"></i>
              <span id="message" class="ChangePass__items--message"></span>
            </div>
            <div id="InforForm-items" class="Course">
              <p id="" for="">Địa chỉ</p>
              <input type="text" placeholder="Nhập địa chỉ" name="address" value="{{$value->address}}" />
              <i id="FormIcon" class="fa-solid fa-location-dot"></i>
              <span id="message" class="ChangePass__items--message"></span>
            </div>
            
            <div class="ChangePass">
              <p>Quản lí mật khẩu</p>
              <div id="form-items" class="ChangePass__items">
                <p id="" for="">Mật khẩu hiện tại</p>
                <input type="password" name="pass_old" placeholder="Mật khẩu" />
                <i class="fa-solid fa-lock"></i>
                <div class="ChangePass__items--eyes">
                  <i class="fa-solid fa-eye eye-open"></i>
                  <i class="fa-solid fa-eye-slash eye-close"></i>
                </div>
                <span id="message" class="ChangePass__items--message"></span>
              </div>
              <div id="form-items" class="ChangePass__items">
                <p id="" for="">Mật khẩu mới</p>
                <input
                  id="NewPass"
                  name="pass_new"
                  type="password"
                  placeholder="Mật khẩu mới"
                />
                <i class="fa-solid fa-lock"></i>
                <div class="ChangePass__items--eyes">
                  <i class="fa-solid fa-eye eye-open"></i>
                  <i class="fa-solid fa-eye-slash eye-close"></i>
                </div>
                <span id="message" class="ChangePass__items--message"></span>
              </div>
              <div id="form-items" class="ChangePass__items">
                <p id="" for="">Nhập lại mật khẩu</p>
                <input
                  id="RePass"
                  name="confirm_pass_new"
                  type="password"
                  placeholder="Nhập lại mật khẩu"
                />
                <i class="fa-solid fa-lock"></i>
                <div class="ChangePass__items--eyes">
                  <i class="fa-solid fa-eye eye-open"></i>
                  <i class="fa-solid fa-eye-slash eye-close"></i>
                </div>
                <span id="message" class="ChangePass__items--message"></span>
              </div>
            </div>
            <input
              class="custom-button-m"
              type="submit"
              value="LƯU THAY ĐỔI"
              id="btn-changePass"
            />
          </form>
        </div>
      </div>
    </section>

    <script src="/js/Js-FirstUpdateProfile.js"></script>
    <script src="/js/Js-Main.js"></script>
  </body>
</html>
