<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng ký - Hệ thống Thi đua khen thưởng IUH</title>
    <link rel="icon" href="/images/icon-award.png" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link rel="stylesheet" href="../css/Style-Login/Style-Login.css" />
    <link rel="stylesheet" href="../css/Styles.css" />
  </head>
  <body>
    <section id="instruction">
      <img src="./images/instruction.png" alt="" />
    </section>
    <section class="MainMessage"></section>
    @if(session('success')) 
          <script>
          sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
        // Kiểm tra trạng thái đã được lưu trữ
        var reloadStatus = sessionStorage.getItem("reloadStatus");

        if (reloadStatus === "true") {
          MessageSuccess("THÀNH CÔNG!", "Đăng kí thành công, vui lòng chờ xác nhận để đăng nhập hệ thống.");
          // MessageError(
          //   "ĐĂNG NHẬP KHÔNG THÀNH CÔNG!",
          //   "Thông tin đăng nhập chưa chính xác."
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
          //MessageSuccess("THÀNH CÔNG!", "Cập nhật dữ liệu thành công.");
          MessageError(
            "ĐĂNG KÍ KHÔNG THÀNH CÔNG!",
            "Mã đã được sử dụng để đăng kí."
          );
          // Xóa trạng thái đã được lưu trữ
          sessionStorage.removeItem("reloadStatus");
        }
      });
          </script>
        @endif
    <section class="login">
      <div class="login__header">
        <img src="./images/logo-main.png" alt="Logo" />
        <h6>TRƯỜNG ĐẠI HỌC CÔNG NGHIỆP THÀNH PHỐ HỒ CHÍ MINH</h6>
        <h4>HỆ THỐNG DANH HIỆU THI ĐUA KHEN THƯỞNG</h4>
      </div>
      <div class="login__form">
        <h1>ĐĂNG KÝ</h1>
        <p class="custom-text-green-s">
          Trang đăng ký tài khoản dành cho ứng viên!
          <a href="{{url('/login-user')}}">Đăng nhập?</a>
        </p>
        <form id="form-registration" action="{{route('postRegister')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div id="" class="CreateCandidate-Input">
            <p id="" for="">Họ tên ứng viên</p>
            <input type="text" name="name" placeholder="Nguyễn Văn A" required />
            <i class="fa-solid fa-user-plus"></i>
            <span>Viết hoa chữ cái đầu, ví dụ: Nguyến Văn A</span>
          </div>
          <div id="IDCandidate" class="CreateCandidate-Input">
            <p id="" for="">Mã ứng viên</p>
            <input type="number" name="code" placeholder="20000000" required />
            <i class="fa-solid fa-hashtag"></i>
            <span>Mã ứng viên là mã số sinh viên, giảng viên,...</span>
          </div>

          <div class="custom-Select" id="department">
            <div class="custom-Select__Title">
              <i class="fa-solid fa-sitemap"></i>
              <span id="">Đơn vị</span>
            </div>

            <select name="department" id="">
            <option value="">Chọn khoa</option>
            @foreach($department as $depart)
              <option value="{{$depart->_id}}">{{$depart->name_depart}}</option>
              @endforeach
            </select>
          </div>
          <div class="custom-Select" id="type">
            <div class="custom-Select__Title">
              <i class="fa-solid fa-user-pen"></i>
              <span id="">Đối tượng</span>
            </div>
            <select name="type" id="candidateObject">
              <option value="Sinh viên">Sinh viên</option>
              <option value="Giảng viên">Giảng viên</option>
              <option value="Viên chức">Viên chức</option>
            </select>
          </div>
          <div id="courseCandidate" class="CreateCandidate-Input">
            <!-- <p id="" for="">Niên khóa</p> -->
            <input type="hidden" name="course" placeholder="2019 - 2023" />
            <!-- <i class="fa-solid fa-business-time"></i> -->
            <!-- <span>Niên khóa được tạo tự động</span> -->
          </div>
          <i
            >Đăng nhập sau khi tài khoản được duyệt! Mật khẩu mặc định:
            Ungvien@111
          </i>
          <input class="custom-button-m" type="submit" value="ĐĂNG KÝ" />
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

    <script src="./Js/Js-UserRegistrationAcc.js"></script>
    <script src="./Js/Js-Main.js"></script>
  </body>
</html>
