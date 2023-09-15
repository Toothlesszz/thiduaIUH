<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng nhập - Hệ thống Thi đua khen thưởng IUH</title>
    <link rel="icon" href="/images/icon-award.png" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link rel="stylesheet" href="../css/Style-Login/Style-Login.css" />
    <link rel="stylesheet" href="../css/Styles.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.js"></script>
  </head>
  <body>
    <section id="instruction">
      <img src="/images/./instruction.png" alt="" />
    </section>
    <section id="loading-overlay">
      <img src="/images/logo-main.png" alt="" />
      <div class="loading-spinner"></div>
      <h5>ĐANG TẢI...</h5>
    </section>
    <section class="MainMessage"></section>
    <section class="login">
      <div class="login__header">
        <img src="/images/./logo-main.png" alt="Logo" />
        <h6>TRƯỜNG ĐẠI HỌC CÔNG NGHIỆP THÀNH PHỐ HỒ CHÍ MINH</h6>
        <h4>HỆ THỐNG DANH HIỆU THI ĐUA KHEN THƯỞNG</h4>
      </div>
      <div class="login__form">
        <h1>ĐĂNG NHẬP</h1>
        <p class="custom-text-green-s">Trang đăng nhập dành cho ứng viên! <a href="{{route('register.index')}}">Đăng ký tài khoản?</a></p>
        
         
        
        @if(session('error')) 
          <script>
          sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
        // Kiểm tra trạng thái đã được lưu trữ
        var reloadStatus = sessionStorage.getItem("reloadStatus");

        if (reloadStatus === "true") {
          //MessageSuccess("THÀNH CÔNG!", "Cập nhật dữ liệu thành công.");
          MessageError(
            "ĐĂNG NHẬP KHÔNG THÀNH CÔNG!",
            "Thông tin đăng nhập chưa chính xác."
          );
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
          //MessageSuccess("THÀNH CÔNG!", "Cập nhật dữ liệu thành công.");
          MessageError(
            "ĐĂNG NHẬP KHÔNG THÀNH CÔNG!",
            "Tài khoản của bạn đã bị khóa, vui lòng liên hệ với Văn phòng Đoàn trường."
          );
          // Xóa trạng thái đã được lưu trữ
          sessionStorage.removeItem("reloadStatus");
        }
      });
            
          </script>
        @endif
        @if(session('error2')) 
          <script>
          sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
        // Kiểm tra trạng thái đã được lưu trữ
        var reloadStatus = sessionStorage.getItem("reloadStatus");

        if (reloadStatus === "true") {
          //MessageSuccess("THÀNH CÔNG!", "Cập nhật dữ liệu thành công.");
          MessageError(
            "ĐĂNG NHẬP KHÔNG THÀNH CÔNG!",
            "Tài khoản của bạn đang chờ duyệt, vui lòng quay lại sau."
          );
          // Xóa trạng thái đã được lưu trữ
          sessionStorage.removeItem("reloadStatus");
        }
      });
            
          </script>
        @endif
        <form id="form-login" action="login-user" method="POST">
        @csrf
          <div id="form-items" class="login__form--items">
            <label id="name" for="">Mã ứng viên</label>
            <input type="text" value="{{ old('code') }}" name="code" placeholder="Mã ứng viên" />
            <i class="fa-solid fa-user-large"></i>
            <span id="message" class="form__items--message"></span>
          </div>
          <div id="form-items" class="login__form--items">
            <label id="password" for="">Mật khẩu</label>
            <input id="pass" name="password" type="password" placeholder="Mật khẩu" />
            <i class="fa-solid fa-lock"></i>
            <div>
              <i class="fa-solid fa-eye eye-open"></i>
              <i class="fa-solid fa-eye-slash eye-close"></i>
            </div>
            <span id="message" class="form__items--message"></span>
          </div>
          <div class="login__form--btn">
          <div class="">
              <input class="custom-checkbox" type="checkbox" id="checkbox2" />
              <label for="checkbox2" tabindex="2">Ghi nhớ đăng nhập.</label>
            </div>
            <a id="btn-ForgotPassword" class="custom-text-green-s">
              Quên mật khẩu?
            </a>
            <button id="btn-login" type="submit"><b>Đăng nhập</b></button>
          </div>
          
        </form>
      </div>
      <div class="login__image">
        <img src="/images/login-image-resize.jpg" alt="" />
      </div>
    </section>

    <div class="popupHelp">
      <div class="popupHelp__content">
        <i class="fa-regular fa-circle-question fa-shake"></i>
        <p>
          Bạn quên mật khẩu? Vui lòng liên hệ Văn phòng Đoàn trường (tầng trệt
          nhà D) hoặc gửi yêu cầu qua email:
        </p>
        <i>bantochuc@doanthanhnien.edu.vn</i>

        <button id="closePopup">Đồng ý!</button>
      </div>
    </div>

    <script src="../js/Js-UserLogIn.js"></script>
    <script src="../js/Js-Main.js"></script>
  </body>
</html>
