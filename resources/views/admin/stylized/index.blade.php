<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Danh hiệu - Hệ thống Thi đua khen thưởng IUH</title>
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
      href="/css/Style-AdminManagement/Style-AdminManagementMedal/Style-AdminManagementMedal.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.4.2/tinymce.min.js"></script>
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
    @if(session('success'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              MessageSuccess("THÀNH CÔNG!", "Cập nhật đợt thi đua thành công.");
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
      @if(session('success3'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              MessageSuccess("THÀNH CÔNG!", "Tạo mới danh hiệu thành công.");
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
    @if(session('success1'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              MessageSuccess("THÀNH CÔNG!", "Tạo năm học mới thành công.");
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
      @if(session('success2'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              MessageSuccess("THÀNH CÔNG!", "Tạo đợt thi đua mới thành công.");
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
              @if(session('error2'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              //MessageSuccess("THÀNH CÔNG!", "Tạo đợt thi đua mới thành công.");
              MessageError(
                "KHÔNG THÀNH CÔNG!",
                "Năm học đã tồn tại."
              );
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
              //MessageSuccess("THÀNH CÔNG!", "Tạo đợt thi đua mới thành công.");
              MessageError(
                "KHÔNG THÀNH CÔNG!",
                "Vui lòng kiểm tra chính xác và đầy đủ của thông tin đã nhập."
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
              //MessageSuccess("THÀNH CÔNG!", "Tạo đợt thi đua mới thành công.");
              MessageError(
                "KHÔNG THÀNH CÔNG!",
                "Danh hiệu đã thuộc vào đợt thi đua, không thể xóa."
              );
              // Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
              </script>
              @endif
              @if(session('success4'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              MessageSuccess("THÀNH CÔNG!", "Xóa danh hiệu thành công.");
              // MessageError(
              //   "KHÔNG THÀNH CÔNG!",
              //   "Danh hiệu đã thuộc vào đợt thi đua, không thể xóa."
              // );
              // Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
              </script>
              @endif
              @if(session('success5'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              MessageSuccess("THÀNH CÔNG!", "Xóa đợt thi đua thành công.");
              // MessageError(
              //   "KHÔNG THÀNH CÔNG!",
              //   "Danh hiệu đã thuộc vào đợt thi đua, không thể xóa."
              // );
              // Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
              </script>
              @endif
              @if(session('success6'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              MessageSuccess("THÀNH CÔNG!", "Thêm ứng viên thành công.");
              // MessageError(
              //   "KHÔNG THÀNH CÔNG!",
              //   "Danh hiệu đã thuộc vào đợt thi đua, không thể xóa."
              // );
              // Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
              </script>
              @endif
              @if(session('success7'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              MessageSuccess("THÀNH CÔNG!", "Xóa ứng viên thành công.");
              // MessageError(
              //   "KHÔNG THÀNH CÔNG!",
              //   "Danh hiệu đã thuộc vào đợt thi đua, không thể xóa."
              // );
              // Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
              </script>
              @endif
              @if(session('error5'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              // MessageSuccess("THÀNH CÔNG!", "Xóa danh hiệu thành công.");
              MessageError(
                "KHÔNG THÀNH CÔNG!",
                "Đợt thi đua đã có người tham gia, không thể xóa."
              );
              // Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
              </script>
              @endif
              @if(session('error6'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              // MessageSuccess("THÀNH CÔNG!", "Xóa danh hiệu thành công.");
              MessageError(
                "KHÔNG THÀNH CÔNG!",
                "Đợt thi đua đã mở, không thể xóa."
              );
              // Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
              </script>
              @endif
              @if(session('error7'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              // MessageSuccess("THÀNH CÔNG!", "Xóa danh hiệu thành công.");
              MessageError(
                "KHÔNG THÀNH CÔNG!",
                "Vui lòng kiểm tra lại tính chính xác của mã số sinh viên !"
              );
              // Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
              </script>
              @endif
              @if(session('error8'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              // MessageSuccess("THÀNH CÔNG!", "Xóa danh hiệu thành công.");
              MessageError(
                "KHÔNG THÀNH CÔNG!",
                "Mã số sinh viên đã tồn tại danh sách!"
              );
              // Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
              </script>
              @endif
              @if(session('error9'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              // MessageSuccess("THÀNH CÔNG!", "Xóa danh hiệu thành công.");
              MessageError(
                "KHÔNG THÀNH CÔNG!",
                "Vui lòng không để trống danh hiệu hoặc năm học!"
              );
              // Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
              </script>
              @endif
              @if(session('error10'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              // MessageSuccess("THÀNH CÔNG!", "Xóa danh hiệu thành công.");
              MessageError(
                "KHÔNG THÀNH CÔNG!",
                "Đã có lỗi xảy ra. Vui lòng kiểm tra file mẫu chứng nhận!"
              );
              // Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
              </script>
              @endif
              @if(session('success8'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              MessageSuccess("THÀNH CÔNG!", "Thay đổi mẫu chứng nhận thành công.");
              // MessageError(
              //   "KHÔNG THÀNH CÔNG!",
              //   "Vui lòng không để trống danh hiệu hoặc năm học!"
              // );
              // Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
              </script>
              @endif
              @if(session('error11'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              // MessageSuccess("THÀNH CÔNG!", "Xóa danh hiệu thành công.");
              MessageError(
                "KHÔNG THÀNH CÔNG!",
                "Không tìm thấy đợt thi đua tương ứng với danh hiệu và năm học đã chọn !"
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
          <li>
            <a href="{{url('/admin')}}"
              ><i class="fa-solid fa-house"></i
            ></a>
          </li>
          <li class="li-active">
            <a href="{{route('stylized.index')}}"><i class="fa-solid fa-award"></i></a>
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
          
          <li>
            <a
              href="{{ route('department.index') }}"
              ><i class="fa-solid fa-chalkboard-user"></i
            ></a>
          </li>
          <li @if(Auth::guard('admin')->user()->level != '5') style="opacity: 0.7; pointer-events: none;" @endif>
            <a
              href="{{route('update-slideshow.index')}}" 
              ><i class="fa-regular fa-copy"></i
            ></a>
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
          <img src="images/logo-main.png" alt="" />
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
            @if(Auth::guard('admin')->user()->level == 4 || Auth::guard('admin')->user()->level == 5)
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
            @include('notifications')
          </div>
        </div>
      </div>
      <div class="Main__Content">
      <div class="Main__Content--CreateYear">
          <div class="Title">
            <i class="fa-solid fa-business-time"></i>
            <h4>TẠO NĂM HỌC</h4>
          </div>
          <form action="{{route('addNewYear')}}" method="post">
            @csrf
            <div class="custom-Select">
              <div class="custom-Select__Title">
                <i class="fa-solid fa-calendar"></i>
                <span id="">Chọn năm</span>
              </div>
              <select name="selectyear" id="yearSelect">
                <!-- <option value="">Chọn năm</option> -->
              </select>
            </div>
            <div id="schoolYear" class="CreateCandidate-Input">
              <p id="" for="">Năm học</p>
              <input type="text" name="year" placeholder="0000 - 0000" value="" required />
              <i class="fa-solid fa-business-time"></i>
              <span>Chọn năm để tạo năm học</span>
            </div>
            <input class="custom-button-m" type="submit" value="THÊM MỚI" />
          </form>
        </div>
        @if(Auth::guard('admin')->user()->level == '5')
        <div class="Main__Content--ListRegkMedal">
          <div class="Title">
            <i class="fa-solid fa-bookmark"></i>
            <h4>MỞ ĐĂNG KÝ QUÁ HẠN</h4>
          </div>
          <form action="{{route('addErrorUsers')}}" method="POST" class="addUser">
            @csrf
            <div class="custom-Select">
              <div class="custom-Select__Title">
                <i class="fa-solid fa-medal"></i>
                <span id="">Đợt thi đua</span>
              </div>
              <select name="idCompetitionperiod" id="">
              <option value="">Chọn đợt thi đua </option>
                @foreach($competeList as $object)
                <option value="{{$object->_id}}">{{$object->stylized->name_stylized}}</option>
                @endforeach
              </select>
            </div>
            <div class="custom-Search">
              <i class="fa-solid fa-address-book"></i>
              <input
                class="custom-Search__input"
                type="text"
                name="codeUser"
                placeholder="Nhập mã ứng viên..."
              />
            </div>

            <input
              class="custom-button-m custom-Search__submit"
              type="submit"
              value="THÊM ỨNG VIÊN"
            />
            <a
              style="margin-left: 1vw; background-color: rgba(240, 63, 63, 1)"
              href=""
              class="custom-button-m"
              >XÓA TẤT CẢ</a
            >
          </form>
          <table>
            <tr>
              <th id="CandidateName">Ứng viên</th>
              <th>Mã ứng viên</th>
              <th>Đối tượng</th>
              <th id="MedalName">Đơn vị</th>
              <th>Trạng thái</th>
              <th id="btn-BrowserMedal"></th>
            </tr>
            @foreach($re_Registration as $item)
            <tr>
              <td>
                <div class="Profile">
                  <img src="{{asset('uploads/user/'. $item->users->image)}}" alt="" />
                  <span>{{$item->users->name}}</span>
                </div>
              </td>
              <td>{{$item->users->code}}</td>
              <td>{{$item->users->type}}</td>
              <td>
                <span>{{$item->users->department->name_depart}}</span>
              </td>
              @if($item->users->status== '2')
              <td>
                <div class="Status">
                  <i class="fa-solid fa-circle-user"></i>
                  <span>HOẠT ĐỘNG</span>
                </div>
              </td>
              @elseif($item->users->status == '1')
              <td>
                <div class="Status" style="background-color: rgba(255, 140, 100, 1);">
                  <i class="fa-solid fa-circle-user"></i>
                  <span>KÍCH HOẠT</span>
                </div>
              </td>
              @elseif($item->users->status == '4')
              <td>
                <div
                  class="Status"
                  style="background-color: rgba(155, 155, 155, 1)"
                >
                  <i class="fa-solid fa-circle-user"></i>
                  <span>HÊT HẠN</span>
                </div>
              </td>
              @elseif($item->users->status == '3')
              <td>
              <div
                  class="Status"
                  style="background-color: rgba(240, 63, 63, 1)"
                >
                  <i class="fa-solid fa-circle-user"></i>
                  <span>ĐÃ KHÓA</span>
                </div>
        </td>
              @endif
              <td>
                <a
                  style="background-color: rgba(240, 63, 63, 1)"
                  id=""
                  href="{{route('deleteErrorUsers', $item->_id)}}"
                  class="custom-button-s"
                >
                  XÓA
                </a>
              </td>
            </tr>
            @endforeach
          </table>
          <div class="pagination">
          
          {{$re_Registration->appends(['data1_page' => $re_Registration->currentPage()])->links()}}

          </div>
        </div>
        @endif
        <div class="Main__Content--CreateEmulation">
          <div class="Title">
            <i class="fa-solid fa-folder-plus"></i>
            <h4>TẠO ĐỢT THI ĐUA</h4>
          </div>
          <form action="{{route('addCompetition')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
              <div class="custom-Select">
                <div class="custom-Select__Title">
                  <i class="fa-solid fa-medal"></i>
                  <span id="">Danh hiệu</span>
                </div>

                <select name="idstylized" id="">
              <option value="">Chọn danh hiệu</option>
                @foreach($stylized as $object)
                <option value="{{$object->_id}}">{{$object->name_stylized}}</option>
                @endforeach
               
              </select>
              
              </div>
              <div class="custom-Select">
                <div class="custom-Select__Title">
                  <i class="fa-solid fa-business-time"></i>
                  <span id="">Năm học</span>
                </div>

                <select name="year" id="">
              <option value="">Chọn năm học</option>
                @foreach($years as $key)
                <option value="{{$key->_id}}">{{$key->year}}</option>
                @endforeach
              </select>
              
              </div>
              <div class="UploadTemplateMedal">
                <span
                  ><i class="fa-solid fa-file-arrow-up"></i> CHỨNG NHẬN</span
                >
                <input
                  type="file"
                  name="file"
                  accept="image/png, image/jpeg"
                  id="TemplateMedal"
                  required
                />
              </div>
            </div>
            <div>
              <div id="" class="MedalDate">
                <div class="MedalDate__Title">
                  <span id="">Mở đăng kí danh hiệu</span>
                </div>
                <input
                  id="DateCreatedMedal"
                  type="date"
                  name="startdate"
                  placeholder=""
                  value=""
                  required
                />
                <i id="SelectCalendar" class="fa-solid fa-calendar-plus"></i>
                
              </div>
              <div id="" class="MedalDate">
                <div class="MedalDate__Title">
                  <span id="">Đóng ĐK, Khoa duyệt lần 1</span>
                </div>
                <input id="" type="date" name="depart_first_time" placeholder="" value="" required />
                <i id="SelectCalendar" class="fa-solid fa-calendar-plus"></i>
                
              </div>

              <div id="" class="MedalDate">
                <div class="MedalDate__Title">
                  <span id="">Ứng viên nộp bổ sung</span>
                </div>
                <input id="" type="date" name="candidate_add_detail" placeholder="" value="" required />
                <i id="SelectCalendar" class="fa-solid fa-calendar-plus"></i>
               
              </div>
              <div id="" class="MedalDate">
                <div class="MedalDate__Title">
                  <span id="">Khoa duyệt lần 2</span>
                </div>
                <input id="" type="date" name="depart_second_time" placeholder="" value="" required />
                <i id="SelectCalendar" class="fa-solid fa-calendar-plus"></i>
                
              </div>

              <div id="" class="MedalDate">
                <div class="MedalDate__Title">
                  <span id="">Khoa kết thúc duyệt lần 2</span>
                </div>
                <input id="" type="date" name="depart_end_second_time" placeholder="" value="" required />
                <i id="SelectCalendar" class="fa-solid fa-calendar-plus"></i>
                
              </div>
              <div id="" class="MedalDate">
                <div class="MedalDate__Title">
                  <span id="">Kết thúc đợt thi đua</span>
                </div>
                <input id="" type="date" name="enddate" placeholder="" value="" required />
                <i id="SelectCalendar" class="fa-solid fa-calendar-plus"></i>
                
              </div>
            </div>
            <input class="custom-button-m" type="submit" value="THÊM MỚI" />
          </form>
          
        </div>
        <div class="Main__Content--CreateEmulation">
          <div class="Title">
            <i class="fa-regular fa-file"></i>
            <h4>CẬP NHẬT CHỨNG NHẬN</h4>
          </div>
          <form action="{{route('updateCertificate')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
              <div class="custom-Select">
                <div class="custom-Select__Title">
                  <i class="fa-solid fa-medal"></i>
                  <span id="">Danh hiệu</span>
                </div>

                <select name="selectedStylized" id="">
                <option value="">Chọn danh hiệu</option>
                @foreach($stylized as $object)
                <option value="{{$object->_id}}">{{$object->name_stylized}}</option>
                @endforeach
                </select>
              </div>
              <div class="custom-Select">
                <div class="custom-Select__Title">
                  <i class="fa-solid fa-business-time"></i>
                  <span id="">Năm học</span>
                </div>

                <select name="selectedYear" id="">
                <option value="">Chọn năm học</option>
                @foreach($years as $key)
                <option value="{{$key->_id}}">{{$key->year}}</option>
                @endforeach
                </select>
              </div>
              <div class="UploadTemplateMedal" id="UploadTemplateMedalReup">
                <span
                  ><i class="fa-solid fa-file-arrow-up"></i> CHỨNG NHẬN</span
                >
                <input
                  type="file"
                  name="newFile"
                  accept="image/png, image/jpeg"
                  id="TemplateMedalReup"
                  required
                />
              </div>
            </div>

            <input class="custom-button-m" type="submit" value="CẬP NHẬT" />
          </form>
        </div>
        <div class="Main__Content--ListEmulation">
          <div class="Title">
            <i class="fa-solid fa-award"></i>
            <h4>QUẢN LÝ ĐỢT THI ĐUA</h4>
          </div>
          <form action="{{ route('stylized.index') }}" method="GET" class="custom-Filter">
          @csrf  
          <div class="custom-Select">
              <div class="custom-Select__Title">
                <i class="fa-solid fa-business-time"></i>
                <span id="">Năm học</span>
              </div>
              <select name="find_year" id="">
              <option value="">Chọn năm học</option>
                @foreach($years as $key)
                <option value="{{$key->_id}}">{{$key->year}}</option>
                @endforeach
              </select>
            </div>
            <input class="custom-button-m" type="submit" value="LỌC" />
          </form>
          <table>
            <tr>
              <th id="CandidateName">Danh hiệu</th>
              <th>Thời gian</th>
              <th>Năm học</th>
              <th>Trạng thái</th>
              <th id="btn-BrowserMedal"></th>
            </tr>
            
              @foreach($CompetitionPeriod as $value)
              <tr>
              <form action="{{ route('updateCompetitionPeriod', $value->_id) }}" method="POST" enctype="multipart/form-data">
               @csrf
                <td>
                  <div class="Profile">
                    <img src="{{ asset( 'certificate/img_certificate/'. $value->stylized->image ) }}" alt="" />
                    <span>{{ $value->stylized->name_stylized }}</span>
                  </div>
                </td>
                <td id="MedalDeadline">
                  <div>
                    <div id="" class="MedalDate">
                      <div class="MedalDate__Title">
                        <span id="">Mở đăng kí danh hiệu</span>
                      </div>
                      <input
                        id="DateCreatedMedal"
                        type="date"
                        name="startdate"
                        placeholder=""
                        value="{{$value->startdate}}"
                        required
                      />
                      <i
                        id="SelectCalendar"
                        class="fa-solid fa-calendar-plus"
                      ></i>
                    </div>
                    <div id="" class="MedalDate">
                      <div class="MedalDate__Title">
                        <span id="">Đóng ĐK, Khoa duyệt lần 1</span>
                      </div>
                      <input
                        id=""
                        type="date"
                        name="depart_first_time"
                        placeholder=""
                        value="{{$value->depart_first_time}}"
                        required
                      />
                      <i
                        id="SelectCalendar"
                        class="fa-solid fa-calendar-plus"
                      ></i>
                    </div>
                  </div>
                  <div>
                    <div id="" class="MedalDate">
                      <div class="MedalDate__Title">
                        <span id="">Ứng viên nộp bổ sung</span>
                      </div>
                      <input
                        id=""
                        type="date"
                        name="candidate_add_detail"
                        placeholder=""
                        value="{{$value->candidate_add_detail}}"
                        required
                      />
                      <i
                        id="SelectCalendar"
                        class="fa-solid fa-calendar-plus"
                      ></i>
                    </div>
                    <div id="" class="MedalDate">
                      <div class="MedalDate__Title">
                        <span id="">Khoa duyệt lần 2</span>
                      </div>
                      <input
                        id=""
                        type="date"
                        name="depart_second_time"
                        placeholder=""
                        value="{{$value->depart_second_time}}"
                        required
                      />
                      <i
                        id="SelectCalendar"
                        class="fa-solid fa-calendar-plus"
                      ></i>
                    </div>
                  </div>
                  <div>
                    <div id="" class="MedalDate">
                      <div class="MedalDate__Title">
                        <span id="">Khoa kết thúc duyệt lần 2</span>
                      </div>
                      <input
                        id=""
                        type="date"
                        name="depart_end_second_time"
                        placeholder=""
                        value="{{$value->depart_end_second_time}}"
                        required
                      />
                      <i
                        id="SelectCalendar"
                        class="fa-solid fa-calendar-plus"
                      ></i>
                    </div>
                    <div id="" class="MedalDate">
                      <div class="MedalDate__Title">
                        <span id="">Kết thúc đợt thi đua</span>
                      </div>
                      <input
                        id=""
                        type="date"
                        name="enddate"
                        placeholder=""
                        value="{{$value->enddate}}"
                        required
                      />
                      <i
                        id="SelectCalendar"
                        class="fa-solid fa-calendar-plus"
                      ></i>
                    </div>
                  </div>
                </td>
                <td>
                  <span>{{$value->years->year}}</span>
                </td>
                <td>
                  @if($value->startdate > now() || $value->depart_first_time <= now())
                  <div class="close-medalStatus">
                    <i class="fa-solid fa-lock"></i>
                    <span> ĐÃ ĐÓNG</span>
                  </div>
                  @else
                  <div class="open-medalStatus">
                    <span> ĐANG MỞ</span>
                    <i class="fa-solid fa-unlock"></i>
                  </div>
                  @endif
                </td>
                <td>
                  <button id="" type="submit" class="custom-button-s">
                    CẬP NHẬT
                  </button>
                  <a
                    id="btnDelete"
                    type="submit"
                    class="custom-button-s"
                    style="background-color: rgba(240, 63, 63, 1)"
                  >
                    XÓA
                  </a>
                  <div class="popupConfirmSubmit">
                    <div class="popupConfirmSubmit__content">
                      <i class="fa-regular fa-circle-question fa-shake"></i>
                      <p>Bạn có chắc chắn thực hiện thao tác?</p>
                      <div>
                        <button id="close-popupConfirmSubmit" type="button">
                          Hủy
                        </button>
                        <a id="submit-ConfirmSubmit" href="{{route('deleteCompetitionPeriod' , $value->_id)}}">Đồng ý!</a>
                      </div>
                    </div>
                  </div>
                  
                </td>

              </form>
            </tr>
              @endforeach

            
            
          </table>
          <div class="pagination">
          
          {{$CompetitionPeriod->appends(['data2_page' => $CompetitionPeriod->currentPage()])->links()}}

          </div>
        </div>
        <div class="Main__Content--ListMedal">
          <div class="Title">
            <i class="fa-solid fa-medal"></i>
            <h4>QUẢN LÝ DANH HIỆU</h4>
          </div>
          <table>
            <tr>
              <th id="CandidateName">Danh hiệu</th>
              <th>Đối tượng</th>
              <th id="btn-BrowserMedal"></th>
            </tr>
            <!-- Xuất danh hiệu ra để quản lý -->
            @foreach($stylizedList as $value)
           
            <tr>
              <form action="" method="post">
                <td>
                  <div class="Profile">
                    <img src="{{ asset( 'certificate/img_certificate/'. $value->image ) }}" alt="" />
                    <span>{{$value->name_stylized}}</span>
                  </div>
                </td>
                <td>
                @foreach($value->object as $item) 
                {{ $item['objects'] }}</br>
                @endforeach
        </td>
                <td>
                  <a
                    href="{{route('stylized.edit' , $value->_id)}}"
                    id=""
                    class="custom-button-s"
                  >
                    CHI TIẾT
                  </a>
                  <a
                    id="btnDelete"
                    type="submit"
                    class="custom-button-s"
                    style="background-color: rgba(240, 63, 63, 1)"
                  >
                    XÓA
                  </a>
                  <div class="popupConfirmSubmit">
                    <div class="popupConfirmSubmit__content">
                      <i class="fa-regular fa-circle-question fa-shake"></i>
                      <p>Bạn có chắc chắn thực hiện thao tác?</p>
                      <div>
                        <button id="close-popupConfirmSubmit" type="button">
                          Hủy
                        </button>
                        <a id="submit-ConfirmSubmit" href="{{route('deleteStylized' , $value->_id)}}">Đồng ý!</a>
                      </div>
                    </div>
                  </div>
                  
                </td>
              </form>
            </tr>
            @endforeach
          </table>
          <div class="pagination">
            {{$stylizedList->appends(['data3_page' => $stylizedList->currentPage()])->links()}}
          </div>
        </div>
        <div class="Main__Content--CreateMedal">
          <div class="Title">
            <i class="fa-solid fa-file-circle-plus"></i>
            
            <h4>TẠO DANH HIỆU MỚI</h4>
            
            <div class="showCreateMedal">
              <i class="fa-solid fa-circle-plus"></i>
              <i class="fa-regular fa-circle-xmark"></i>
            </div>
          </div>
          <form action="{{route('addNewStylized')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="MedalDescription">
              <h4>THÔNG TIN DANH HIỆU</h4>
              <div class="MedalDescription__Avatar">
                <div class="ImgAvatar">
                  <img
                    src="/images/medal-sample.jpg"
                    alt=""
                    id="DefaultImg"
                  />
                  <div id="PreviewImg"></div>
                </div>
                <div class="ImgUpload">
                  <div class="ButtonOuter">
                    <input
                      type="file"
                      id="FileInput"
                      name="image"
                      accept="image/png, image/jpeg"
                      required
                    />
                    <i class="fa-solid fa-camera"></i>
                  </div>
                </div>
                <i>Ảnh danh hiệu với tỉ lệ 1:1</i>
              </div>
              <div class="MedalDescription__Name">
                <i class="fa-solid fa-pen"></i>
                <input
                  type="text"
                  name="name"
                  placeholder="NHẬP TÊN DANH HIỆU..."
                  required
                />
              </div>
              <div class="MedalDescription__Requirements">
                <h4>Yêu cầu chung</h4>
                <textarea name="detail" id="RequirementsMedal" ></textarea>
              </div>
              <div class="MedalDescription__quantityInput">
                <h4>Số tiêu chuẩn được đăng ký</h4>
                <div class="quantityInput">
                  <button
                    class="qty-count qty-count--minus"
                    data-action="minus"
                    type="button"
                  >
                    -
                  </button>
                  <input
                    class="product-qty"
                    type="number"
                    name="required_criter"
                    min="0"
                    max="100"
                    value="1"
                    required
                  />
                  <button
                    class="qty-count qty-count--add"
                    data-action="add"
                    type="button"
                  >
                    +
                  </button>
                </div>
              </div>
              <div class="MedalDescription__Object">
                <div class="MedalDescription__Object--Checkbox">
                  <h4>ĐỐI TƯỢNG</h4>
                  <label class="checkboxQualified"
                    >SINH VIÊN
                    <input value="Sinh viên" type="checkbox" name="objects[][objects]" id="" checked />
                    <span class="checkmark"></span>
                  </label>
                  <label class="checkboxQualified"
                    >GIẢNG VIÊN
                    <input value="Giảng viên" type="checkbox" name="objects[][objects]" id="" />
                    <span class="checkmark"></span>
                  </label>
                  <label class="checkboxQualified"
                    >CÁN BỘ VIÊN CHỨC

                    <input value="Viên chức" type="checkbox" name="objects[][objects]" id="" />
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="MedalDescription__Object--Upload">
                  <span
                    ><i class="fa-solid fa-file-arrow-up"></i> UPLOAD FILE HƯỚNG
                    DẪN</span
                  >
                  <input
                    type="file"
                    name="file"
                    accept="application/pdf"
                    id="InstructMedal"
                    required
                  />
                </div>
              </div>
              <h4>PHIẾU ĐĂNG KÝ DANH HIỆU</h4>
            </div>
            <div class="CreateMedalReg">
              <div class="AddStandard">
                <span>THÊM TIÊU CHUẨN</span>
                <i class="fa-solid fa-circle-plus"></i>
              </div>
              <div class="CreateMedalReg__Standard">
                <p id="IndexStandard" hidden>0</p>
                <div class="StandardName">
                  <span
                    >TÊN TIÊU CHUẨN <i class="fa-solid fa-square-pen"></i
                  ></span>
                  <input type="text" name="criterias[0][name]" />
                </div>
                <div class="StandardInstruct">
                  <h5>Hướng dẫn</h5>
                  <textarea
                    name="criterias[0][intruction][]"
                    id=""
                    cols="30"
                    rows="10"
                  ></textarea>
                </div>
                <div class="MedalDescription__quantityInput">
                  <h4>Số "Tiêu chí khác" phải đăng ký</h4>
                  <div class="quantityInput">
                    <button
                      class="qty-count qty-count--minus"
                      data-action="minus"
                      type="button"
                    >
                      -
                    </button>
                    <input
                      class="product-qty"
                      type="number"
                      name="criterias[0][criteriasnumber][]"
                      min="0"
                      max="100"
                      value="1"
                      required
                    />
                    <button
                      class="qty-count qty-count--add"
                      data-action="add"
                      type="button"
                    >
                      +
                    </button>
                  </div>
                </div>
                <div class="CreateMedalReg__Standard--Criteria">
                  <div class="CriteriaClassify">
                    <span>Tiêu chí</span>
                    <div class="custom-Select">
                      <div class="custom-Select__Title">
                        <i class="fa-solid fa-tags"></i>
                        <span id="">Phân loại</span>
                      </div>

                      <select name="criterias[0][number][]" id="">
                        <option value="1">Tiêu chí khác</option>
                        <option value="2">Tiêu chí bắt buộc</option>
                      </select>
                    </div>
                  </div>
                  <textarea name="criterias[0][details][]" id=""></textarea>
                </div>
                <div class="AddCriteria">
                  <span
                    >Thêm tiêu chí <i class="fa-solid fa-circle-plus"></i
                  ></span>
                </div>
              </div>
            </div>
              
              
            <button class="custom-button-m" type="submit">
              TẠO DANH HIỆU MỚI
            </button>
          </form>
        </div>
      </div>

    </section>
    <script>
  document.addEventListener('DOMContentLoaded', function() {
    let criteriaIndex = 1;

    function addCriteria() {
      const criteriaContainer = document.createElement('div');
      criteriaContainer.classList.add('criteria');

      const criteriaNameInput = document.createElement('input');
      criteriaNameInput.type = 'text';
      criteriaNameInput.name = `criterias[${criteriaIndex}][name]`;
      criteriaNameInput.placeholder = 'Tên tiêu chí';
      criteriaNameInput.required = true;
      criteriaContainer.appendChild(criteriaNameInput);
      
      const criteriaDetailsContainer = document.createElement('div');
      criteriaDetailsContainer.classList.add('criteriaDetails');

      const criteriaDetailInput = document.createElement('input');
      criteriaDetailInput.type = 'text';
      criteriaDetailInput.name = `criterias[${criteriaIndex}][details][]`;
      criteriaDetailInput.placeholder = 'Chi tiết tiêu chí';
      criteriaDetailInput.required = true;
      criteriaDetailsContainer.appendChild(criteriaDetailInput);

      const addCriteriaDetailButton = document.createElement('button');
      addCriteriaDetailButton.type = 'button';
      addCriteriaDetailButton.classList.add('addCriteriaDetail');
      addCriteriaDetailButton.textContent = 'Thêm chi tiết tiêu chí';
      addCriteriaDetailButton.addEventListener('click', addCriteriaDetail);

      criteriaContainer.appendChild(criteriaDetailsContainer);
      criteriaContainer.appendChild(addCriteriaDetailButton);
      
      const criteriaContainerWrapper = document.getElementById('criteriaContainer');
      criteriaContainerWrapper.appendChild(criteriaContainer);

      criteriaIndex++;
    }

    function addCriteriaDetail(event) {
      const criteriaDetailsContainer = event.target.parentNode.querySelector('.criteriaDetails');
      const criteriaDetailInput = document.createElement('input');
      criteriaDetailInput.type = 'text';
      criteriaDetailInput.name = `criterias[${criteriaIndex - 1}][details][]`;
      criteriaDetailInput.placeholder = 'Chi tiết tiêu chí';
      criteriaDetailInput.required = true;
      criteriaDetailsContainer.appendChild(criteriaDetailInput);
    }

    const addCriteriaButton = document.getElementById('addCriteria');
    addCriteriaButton.addEventListener('click', addCriteria);

    const addCriteriaDetailButtons = document.getElementsByClassName('addCriteriaDetail');
    Array.from(addCriteriaDetailButtons).forEach(function(button) {
      button.addEventListener('click', addCriteriaDetail);
    });
  });
</script>
    <script src="/js/Js-AdminManagementMain.js"></script>
    <script src="/js/Js-Main.js"></script>
    <script src="/js/Js-AdminManagementMedal.js"></script>
  </body>
</html>
