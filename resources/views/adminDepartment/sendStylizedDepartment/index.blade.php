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
      href="/css/Style-AdminDepartment/Style-AdminDepartmentMarkMedal/Style-AdminDepartmentMarkMedal.css"
    />
  </head>
  <body>
    <section id="instruction">
      <img src="/images/instruction.png" alt="" />
    </section>
    <section class="Main">
    <div class="Main__Navigation">
        <ul>
          <li >
            <a href="{{url('/admin-department')}}"><i class="fa-solid fa-house"></i></a>
          </li>
          <li class="li-active">
            <a 
              href="{{route('stylized-department.index')}}"
              ><i class="fa-solid fa-clipboard-check"></i
            ></a>
          </li>
          <li>
            <a
              href="{{ route('user-department.index') }}"
              ><i class="fa-solid fa-id-card-clip"></i
            ></a>
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
            
            <img src="{{ asset('uploads/user/'.Auth::guard('department')->user()->image) }}" alt="" />
            <div class="info">
              @if(Auth::guard('department')->user()->level == 3)
              <span>QTV Khoa</span>
              <span>{{ Auth::guard('department')->user()->name }}</span>
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
            <div class="Notification__content">
              <span><i class="fa-regular fa-bell"></i> Thông báo</span>
              <div class="Notification__content--items">
                <img src="/Front-End/Image/admin.jpg" alt="" />
                <span id="sender">ADMIN</span>
                <span id="sending-time">Hôm nay</span>
                <p>
                  Chúc mừng, bạn đã đạt danh hiệu “THANH NIÊN TIÊN TIẾN LÀM THEO
                  LỜI BÁC”!
                </p>
              </div>
              <div class="Notification__content--items">
                <img src="/Front-End/Image/admin.jpg" alt="" />
                <span id="sender">ADMIN</span>
                <span id="sending-time">26/04/2023</span>
                <p>
                  Chúc mừng, bạn đã đạt danh hiệu “THANH NIÊN TIÊN TIẾN LÀM THEO
                  LỜI BÁC”!
                </p>
              </div>
              <div class="Notification__content--items">
                <img src="/Front-End/Image/admin.jpg" alt="" />
                <span id="sender">ADMIN</span>
                <span id="sending-time">26/04/2023</span>
                <p>
                  Chúc mừng, bạn đã đạt danh hiệu “THANH NIÊN TIÊN TIẾN LÀM THEO
                  LỜI BÁC”!
                </p>
              </div>
              <div class="Notification__content--items">
                <img src="/Front-End/Image/admin.jpg" alt="" />
                <span id="sender">ADMIN</span>
                <span id="sending-time">26/04/2023</span>
                <p>
                  Chúc mừng, bạn đã đạt danh hiệu “THANH NIÊN TIÊN TIẾN LÀM THEO
                  LỜI BÁC”!
                </p>
              </div>
              <div class="Notification__content--items">
                <img src="/Front-End/Image/admin.jpg" alt="" />
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
        <div class="Main__Content--Filter">
        <form action="{{route('stylized-department.index')}}" method="GET" class="custom-Search">
            <div class="custom-Select">
              <div class="custom-Select__Title">
                <span id="">Năm học</span>
              </div>

              <select name="year" id="">
                <option value="">Chọn năm học</option>
                @foreach($years as $key)
                <option value="{{$key->_id}}">{{$key->year}}</option>
                @endforeach
              </select>
            </div>
            <div class="custom-Select">
              <div class="custom-Select__Title">
                
                <span id="">Danh hiệu</span>
              </div>
              <select name="stylized" id="">
              <option value="">Chọn danh hiệu</option>
                @foreach($stylized as $object)
                <option value="{{$object->_id}}">{{$object->name_stylized}}</option>
                @endforeach
              </select>
            </div>
            <div class="custom-Select">
              <div class="custom-Select__Title">
                
                <span id="">Trạng thái</span>
              </div>
              <select name="status" id="">
                <option value="">Chọn trạng thái</option>
                <option value="0">Chờ duyệt</option>
                <option value="1">Đã duyệt</option>
                <option value="2">Xem xét</option>
                <option value="3">Từ chối</option>
                <option value="4">Đã đạt</option>
                <option value="5">Chưa đạt</option>
              </select>
            </div>
            <input class="custom-button-m" type="submit" value="LỌC DỮ LIỆU" />
          </form>
        </div>
        <div class="Main__Content--ListRegkMedal">
          <div class="Title">
            <i class="fa-solid fa-medal"></i>
            <h4>QUẢN LÝ XÉT DUYỆT THI ĐUA KHEN THƯỞNG</h4>
          </div>
          <form action="{{route('stylized-department.index')}}" method="GET" class="custom-Search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input
              class="custom-Search__input"
              type="text"
              name="keyword"
              value="{{$keyword}}"
              placeholder="Tìm kiếm..."
            />
            <div class="custom-Search__select">
              <select name="type" id="">
                @if($type == '')
                <option value="1">Mã ứng viên</option>
                <option value="2">Tên ứng viên</option>
                @elseif($type == '1')
                <option value="1">Mã ứng viên</option>
                <option value="2">Tên ứng viên</option>
                @elseif($type == '2')
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
              <th id="MedalName">Danh hiệu</th>
              <th>Trạng thái</th>
              <th>Thời gian</th>
              <th id="btn-BrowserMedal"></th>
            </tr>
            @foreach($regis as $value)
            <tr>
              <td>
                <div class="Profile">
                  <img src="{{ asset('uploads/user/'. $value->users->image) }}" alt="" />
                  <span>{{$value->users->name}}</span>
                </div>
              </td>
              <td>{{$value->users->code}}</td>
              <td>
                <span
                  >{{$value->competitionperiod->stylized->name_stylized}}</span
                >
              </td>
              <td>
                @if($value->admin_status == '0')
                <div class="Status">
                  <i class="fa-solid fa-paper-plane"></i>
                  <span>CHỜ DUYỆT</span>
                </div>
                @elseif($value->admin_status == '1')
                <div
                  class="Status"
                  style="background-color: rgba(240, 123, 63, 1)"
                >
                  <i class="fa-solid fa-circle-check"></i>
                  <span>ĐÃ DUYỆT</span>
                </div>
                @elseif($value->admin_status == '3')
                <div
                  class="Status"
                  style="background-color: rgba(155, 155, 155, 1)"
                >
                  <i class="fa-solid fa-circle-xmark"></i>
                  <span>TỪ CHỐI</span>
                </div>
                @elseif($value->admin_status == '2')
                <div class="Status" style="background-color: rgb(63, 122, 240)">
                  <i class="fa-solid fa-circle-question"></i>
                  <span>XEM XÉT</span>
                </div>
                @elseif($value->admin_status == '4')
                <div
                  class="Status"
                  style="background-color: rgba(240, 63, 63, 1)"
                >
                  <i class="fa-solid fa-award"></i>
                  <span>ĐÃ ĐẠT</span>
                </div>
                @elseif($value->admin_status == '5')
                <div
                  class="Status"
                  style="background-color: rgba(155, 155, 155, 1)"
                >
                  <i class="fa-solid fa-circle-xmark"></i>
                  <span>CHƯA ĐẠT</span>
                </div>
                @endif
              </td>
              <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $value->date)->format('d/m/Y') }}</td>
              <td>
                <a
                  href="{{route('showDetailCeriteria',[$value->_id])}}"
                  class="custom-button-s"
                  >CHI TIẾT</a
                >
              </td>
            </tr>
            
            @endforeach
            
          </table>
          <div class="pagination">
            
              {{ $regis->links() }}            
            
          </div>
        </div>
      </div>
    </section>

    <script src="/js/Js-AdminDepartmentMarkMedal.js"></script>
    <script src="/js/Js-Main.js"></script>
    <script src="/js/Js-AdminDepartmentMain.js"></script>
  </body>
</html>
