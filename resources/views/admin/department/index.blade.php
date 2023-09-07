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
      href="/css/Style-AdminManagement/Style-AdminManagementAdministrators/Style-AdminManagementAdministrators.css"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.js"></script>
  </head>
  <body>
    <section id="instruction">
      <img src="/images//instruction.png" alt="" />
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
          @if(session('success1'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              MessageSuccess("THÀNH CÔNG!", "Thêm Quản trị viên Khoa thành công.");
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
              @if(session('error1'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              //MessageSuccess("THÀNH CÔNG!", "Thêm Quản trị viên Khoa thành công.");
              MessageError(
                "TẠO MỚI KHÔNG THÀNH CÔNG!",
                "Vui lòng chọn Khoa cho quản trị viên Khoa!"
              );
              //Xóa trạng thái đã được lưu trữ
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
              //MessageSuccess("THÀNH CÔNG!", "Thêm Quản trị viên Khoa thành công.");
              MessageError(
                "TẠO MỚI KHÔNG THÀNH CÔNG!",
                "Mã quản trị viên đã tồn tại!"
              );
              //Xóa trạng thái đã được lưu trữ
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
              //MessageSuccess("THÀNH CÔNG!", "Thêm Quản trị viên Khoa thành công.");
              MessageError(
                "TẠO MỚI KHÔNG THÀNH CÔNG!",
                "Email đã tồn tại !"
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
          <img src="/images//logo-main.png" alt="" />
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
            <div class="Notification__content">
              <span><i class="fa-regular fa-bell"></i> Thông báo</span>
              <div class="Notification__content--items">
                <img src="/images//admin.jpg" alt="" />
                <span id="sender">ADMIN</span>
                <span id="sending-time">Hôm nay</span>
                <p>
                  Chúc mừng, bạn đã đạt danh hiệu “THANH NIÊN TIÊN TIẾN LÀM THEO
                  LỜI BÁC”!
                </p>
              </div>
              <div class="Notification__content--items">
                <img src="/images//admin.jpg" alt="" />
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
        <div class="Main__Content--CreateCandidate">
          <div class="Title">
            <i class="fa-solid fa-id-badge"></i>
            <h4>THÊM QUẢN TRỊ VIÊN</h4>
          </div>
          <form action="{{ route('department.store') }}" method="POST" enctype="multipart/form-data" >
            @csrf
            <div id="" class="CreateCandidate-Input">
              <p id="" for="">Họ tên Quản trị viên</p>
              <input type="text" name="name" placeholder="Nguyễn Văn A" required />
              <i class="fa-solid fa-user-plus"></i>
              <span>Viết hoa chữ cái đầu, ví dụ: Nguyến Văn A</span>
            </div>
            <div id="" class="CreateCandidate-Input">
              <p id="" for="">Email</p>
              <input type="email" name="email" placeholder="nguyenvanA@gmail.com" required />
              <i class="fa-solid fa-at"></i>
              <span>Email dùng để đăng nhập tài khoản</span>
            </div>
            <div id="CreateAdCode" class="CreateCandidate-Input">
              <p id="" for="">ID Quản trị viên</p>
              <input type="text" name="code" placeholder="QTV00000000" required />
              <i class="fa-solid fa-hashtag"></i>
              <span>Mã QTV là mã số cá nhân</span>
            </div>
            <div class="custom-Select">
              <div class="custom-Select__Title">
                <i class="fa-solid fa-sitemap"></i>
                <span id="">Đơn vị</span>
              </div>

              <select name="id_depart" id="">
              <option value="">Chọn Khoa</option>
              @foreach($department as $key)
                <option value="{{$key->_id}}">{{$key->name_depart}}</option>
                @endforeach
              </select>
            </div>
            <input type="hidden" name="password" value="Quantri@111" required />
            <input type="hidden" name="id_creator" value="{{ Auth::guard('admin')->user()->_id }}" required />
            <input type="hidden" name="level" value="3" required />
            <input type="hidden" name="status" value="1" required />
            <input type="hidden" name="type" value="QTV Khoa" required />
            <input
              class="custom-button-m"
              type="submit"
              value="TẠO TÀI KHOẢN"
            />
          </form>
        </div>
        <div class="Main__Content--ListRegkMedal">
          <div class="Title">
            <i class="fa-solid fa-users-gear"></i>
            <h4>QUẢN LÝ QUẢN TRỊ VIÊN</h4>
          </div>
          <form action="{{ route('department.index') }}" method="GET" class="custom-Filter">
            <div class="custom-Select">
              <div class="custom-Select__Title">
                <i class="fa-solid fa-sitemap"></i>
                <span id="">Đơn vị</span>
              </div>

              <select name="type" id="">
              <option value="">Chọn khoa</option>
                @foreach($department as $key)
                <option value="{{$key->_id}}">{{$key->name_depart}}</option>
                @endforeach
              </select>
            </div>

            <input class="custom-button-m" type="submit" value="LỌC" />
          </form>
          <form action="{{ route('department.index') }}" method="GET" class="custom-Search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input
              class="custom-Search__input"
              name="keyword"
              type="text"
              value="{{$keyword}}"
              placeholder="Tìm kiếm..."
            />
            <div class="custom-Search__select">
              <select name="custom" id="">
                <option value="1">Mã quản QTV</option>
                <option value="2">Tên QTV</option>
              </select>
            </div>
            <input
              class="custom-button-m custom-Search__submit"
              type="submit"
              value="TÌM KIẾM"
            />
          </form>
          <table>
         
            
            <tr>
              <th id="CandidateName">Quản trị viên</th>
              <th>Mã QTV</th>
              <th>Email</th>
              <th id="MedalName">Đơn vị</th>
              <th>Số điện thoại</th>
              <th id="btn-BrowserMedal"></th>
            </tr>
            @foreach ($user as $value)
            <tr>
              <td>
                <div class="Profile">
                  <img src="{{asset('uploads/user/'. $value->image) }}" alt="" />
                  <span>{{ $value->name}}</span>
                </div>
              </td>
              <td>{{$value->code}}</td>
              <td>{{$value->email}}</td>
              <td>
                <span>{{$value->department->name_depart}}</span>
              </td>
              <td>{{$value->phone}}</td>
              <td>
           
                <a
                  id=""
                  href="{{ route('department.edit', [Crypt::encrypt($value->_id)]) }}"
                  class="custom-button-s"
                >
                  CHI TIẾT
                </a>
              </td>
            </tr>
            @endforeach
          
          </table>
          <div class="pagination">
          {{$user->links()}}
          </div>
        </div>
      </div>
    </section>

    <script src="/js/Js-AdminManagementAdministrators.js"></script>
    <script src="/js/Js-AdminManagementMain.js"></script>
    <script src="/js/Js-Main.js"></script>
  </body>
</html>
