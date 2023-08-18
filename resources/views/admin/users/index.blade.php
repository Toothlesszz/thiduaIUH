<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trang chủ - Hệ thống Thi đua khen thưởng IUH</title>
    <link rel="icon" href="images/icon-award.png" />
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
      href="/css/Style-AdminManagement/Style-AdminManagementCandidate/Style-AdminManagementCandidate.css"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.js"></script>
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

    <section class="Main">
      <div class="Main__Navigation">
        <ul>
          <li>
            <a href="{{url('/admin')}}"
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
          <li class="li-active">
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
                <img src="images/admin.jpg" alt="" />
                <span id="sender">ADMIN</span>
                <span id="sending-time">Hôm nay</span>
                <p>
                  Chúc mừng, bạn đã đạt danh hiệu “THANH NIÊN TIÊN TIẾN LÀM THEO
                  LỜI BÁC”!
                </p>
              </div>
              <div class="Notification__content--items">
                <img src="images/admin.jpg" alt="" />
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
            <h4>THÊM ỨNG VIÊN</h4>
          </div>
          <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          @if(session('success'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              MessageSuccess("THÀNH CÔNG!", "Tạo ứng viên mới thành công.");
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
              //MessageSuccess("THÀNH CÔNG!", "Tạo ứng viên mới thành công.");
              MessageError(
                "KHÔNG THÀNH CÔNG!",
                "Mã ứng viên đã tồn tại !"
              );
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
              //MessageSuccess("THÀNH CÔNG!", "Tạo ứng viên mới thành công.");
              MessageError(
                "KHÔNG THÀNH CÔNG!",
                "Vui lòng chọn khoa của ứng viên!"
              );
              //Xóa trạng thái đã được lưu trữ
              sessionStorage.removeItem("reloadStatus");
            }
          });
              </script>
            @endif
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
            <div class="custom-Select">
              <div class="custom-Select__Title">
                <i class="fa-solid fa-sitemap"></i>
                <span id="">Đơn vị</span>
              </div>

              <select name="id_depart" id="">
              <option value="">Chọn khoa</option>
              @foreach($department as $key)
                <option value="{{$key->_id}}">{{$key->name_depart}}</option>
                @endforeach
              </select>
            </div>
            <div class="custom-Select">
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
              <p id="" for="">Niên khóa</p>
              <input type="text" name="course" placeholder="0000 - 0000" />
              <i class="fa-solid fa-business-time"></i>
              <span>Niên khóa được tạo tự động</span>
            </div>
            <input type="hidden" name="password" value="Ungvien@111" required />
            <input type="hidden" name="id_creator" value="{{ Auth::guard('admin')->user()->_id }}" required />
            <input type="hidden" name="level" value="1" required />
            <input type="hidden" name="status" value="1" required />
            <input class="custom-button-m" type="submit" value="TẠO" />
          </form>
        </div>
        <div class="Main__Content--ListRegkMedal">
          <div class="Title">
            <i class="fa-solid fa-users-gear"></i>
            <h4>QUẢN LÝ ỨNG VIÊN</h4>
          </div>
          <form action="{{ route('user.index') }}" method="GET" class="custom-Filter">
          @csrf
            <div class="custom-Select">
              <div class="custom-Select__Title">
                <i class="fa-solid fa-sitemap"></i>
                <span id="">Đơn vị</span>
              </div>

              <select name="id_depart" id="">
              <option value="">Tất cả các khoa</option>
              @foreach($department as $key)
                <option value="{{$key->_id}}">{{$key->name_depart}}</option>
                @endforeach
              </select>
            </div>
            <div class="custom-Select">
              <div class="custom-Select__Title">
                <i class="fa-solid fa-user-pen"></i>
                <span id="">Đối tượng</span>
              </div>
              <select name="type" id="">
                <option value="Sinh viên">Sinh viên</option>
                <option value="Giảng viên">Giảng viên</option>
                <option value="Viên chức">Viên chức</option>
              </select>
            </div>
            <input class="custom-button-m" type="submit" value="LỌC" />
          </form>
          <form action="{{route('user.index')}}" method="GET" class="custom-Search">
          @csrf
            <i class="fa-solid fa-magnifying-glass"></i>
            <input
              class="custom-Search__input"
              name="keyword"
              type="text"
              value ="{{$keyword}}"
              placeholder="Tìm kiếm..."
            />
            <div class="custom-Search__select">
              <select name="custom" id="">
              @if($custom == '')
                <option value="1">Mã ứng viên</option>
                <option value="2">Tên ứng viên</option>
                @elseif($custom == '1')
                <option value="1">Mã ứng viên</option>
                <option value="2">Tên ứng viên</option>
                @elseif($custom == '2')
                <option value="2">Tên ứng viên</option>
                <option value="1">Mã ứng viên</option>
                @endif
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
              <th id="CandidateName">Ứng viên</th>
              <th>Mã ứng viên</th>
              <th>Đối tượng</th>
              <th id="MedalName">Đơn vị</th>
              <th>Trạng thái</th>
              <th id="btn-BrowserMedal"></th>
            </tr>
            @foreach ($user as $value)
            <tr>
              <td>
                <div class="Profile">
                  <img src="{{asset('uploads/user/'. $value->image) }}" alt="" />
                  <span>{{ $value->name }}</span>
                </div>
              </td>
              <td>{{$value->code}}</td>
              <td>{{$value->type}}</td>
              <td>
                {{$value->department->name_depart}}
              </td>
              @if($value->status== '2')
              <td>
                <div class="Status">
                  <i class="fa-solid fa-circle-user"></i>
                  <span>HOẠT ĐỘNG</span>
                </div>
              </td>
              @elseif($value->status == '1')
              <td>
                <div class="Status" style="background-color: rgba(255, 140, 100, 1);">
                  <i class="fa-solid fa-circle-user"></i>
                  <span>KÍCH HOẠT</span>
                </div>
              </td>
              @elseif($value->status == '4')
              <td>
                <div
                  class="Status"
                  style="background-color: rgba(155, 155, 155, 1)"
                >
                  <i class="fa-solid fa-circle-user"></i>
                  <span>HÊT HẠN</span>
                </div>
              </td>
              @elseif($value->status == '3')
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
                  id=""
                  href="{{ route('user.edit', [Crypt::encrypt($value->id)]) }}"
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

    <script src="/js/Js-AdminManagementCandidate.js"></script>
    <script src="/js/Js-AdminManagementMain.js"></script>
    <script src="/js/Js-Main.js"></script>
  </body>
</html>
