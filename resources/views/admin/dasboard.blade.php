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
      href="/css/Style-AdminManagement/Style-AdminManagementIndex/Style-AdminManagementIndex.css"
    />
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
          <li class="li-active">
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
                <img src="/images/admin.jpg" alt="" />
                <span id="sender">ADMIN</span>
                
                <span id="sending-time">Hôm nay</span>
                <p>
                  Chúc mừng, bạn đã đạt danh hiệu “THANH NIÊN TIÊN TIẾN LÀM THEO
                  LỜI BÁC”!
                  <a href="{{route('uploadImages')}}"></a>
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
        <div class="Main__Content--Statistical">
          <div class="Title">
            <i class="fa-solid fa-chart-simple"></i>
            <h4>SỐ LIỆU THỐNG KÊ</h4>
          </div>
          <form action="{{route('mainAdmin')}}" method="GET">
            @csrf
            <div class="Filter">
              <div class="Title">
                <i class="fa-solid fa-sitemap"></i>
                <span id="">Đơn vị</span>
              </div>

              <select name="depart" id="">
                @if($nameDepart == '')
                <option value="">Tất cả đơn vị</option>
                @elseif($nameDepart !='')
                <option value="{{$nameDepart->_id}}">{{$nameDepart->name_depart}}</option>
                <option value="">Tất cả đơn vị</option>
                @endif
                
                @foreach($department as $key)
                <option value="{{$key->_id}}">{{$key->name_depart}}</option>
                @endforeach
              </select>
            </div>
            <div class="Filter">
              <div class="Title">
                <i class="fa-solid fa-medal"></i>
                <span id="">Danh hiệu</span>
              </div>

              <select name="styli" id="">
                @if($nameStyli == '')
                <option value="">Tất cả danh hiệu</option>
                @elseif($nameStyli != '')
                <option value="{{$nameStyli->_id}}">{{$nameStyli->name_stylized}}</option>
                <option value="">Tất cả danh hiệu</option>
                @endif
                
                @foreach($stylized as $object)
                <option value="{{$object->_id}}">{{$object->name_stylized}}</option>
                @endforeach
              </select>
            </div>
            <div class="Filter">
              <div class="Title">
                <i class="fa-solid fa-business-time"></i>
                <span id="">Năm học</span>
              </div>

              <select name="year" id="">
              @if($academicYear == '')
              <option value="">Tất cả năm học</option>
              @elseif($academicYear !='')
                <option value="{{$academicYear->_id}}">{{$academicYear->year}}</option>
                <option value="">Tất cả năm học</option>
                @endif
                
                @foreach($years as $year)
                <option value="{{$year->_id}}">{{$year->year}}</option>
                @endforeach
              </select>
            </div>
            <input type="submit" class="custom-button-m" value="LỌC DỮ LIỆU" />
          </form>
          <div class="Data">
            <div class="Data__Items">
              <i class="fa-solid fa-clipboard-list"></i>
              <h4>CHỜ DUYỆT</h4>
              <h1>{{$notReviewed}}</h1>
            </div>
            <div class="Data__Items">
              <i class="fa-solid fa-user-graduate"></i>
              <h4>ỨNG VIÊN</h4>
              <h1>{{$regisCount}}</h1>
            </div>
            <div class="Data__Items">
              <i class="fa-solid fa-award"></i>
              <h4>ĐẠT DANH HIỆU</h4>
              <h1>{{$regisPassCount}}</h1>
            </div>
          </div>
          <div class="Diagram"></div>
        </div>
        
        <div class="Main__Content--RecentMarkMedal">
          <div class="Title">
            <i class="fa-solid fa-medal"></i>
            <h4>YÊU CẦU XÉT DUYỆT MỚI NHẤT</h4>
          </div>
          <a
            class="SeeAll"
            href="{{route('review-stylized.index')}}"
          >
            <span>Xem tất cả</span>
            <i class="fa-solid fa-share-from-square"></i>
          </a>
          <table>
            <tr>
              <th>Ứng viên</th>
              <th>Danh hiệu</th>
              <th>Trạng thái</th>
            </tr>
            @foreach($regis as $object)
    <tr>
      <td>
        <div class="Profile">
          <img src="{{ asset('uploads/user/'. $object->users->image) }}" alt="" />
          <span>{{ $object->users->name }}</span>
        </div>
      </td>
      
      <td>
        <span id="MedalName">{{ $object->competitionperiod->stylized->name_stylized }}</span>
      </td>
      <td>
        @if($object->admin_status == '2')
        <div class="Status" style="background-color: rgb(63, 122, 240)">
                  <i class="fa-solid fa-circle-question"></i>
                 <span>XEM XÉT</span>
        </div>
        @elseif($object->admin_status == '1')
         <div
                  class="Status"
                  style="background-color: rgba(240, 123, 63, 1)"
                >
                  <i class="fa-solid fa-circle-check"></i>
                  <span>ĐÃ DUYỆT</span>
                </div>
        @endif
      </td>
    </tr>
 
@endforeach
            
          </table>
          <div class="pagination">
            
              {{ $regis->links() }}            
            
          </div>
        </div>
        <div class="Main__Content--RecentMedal">
          <div class="Title">
            <i class="fa-solid fa-medal"></i>
            <h4>DANH HIỆU ĐANG XÉT DUYỆT</h4>
          </div>
          <div class="Medal">
            
          @foreach ($CompetitionPeriod as $value)
          @if($value->startdate <= now() && $value->depart_first_time >= now())
          
          <div class="Medal__Items">
            <img src="images/lamtheoloiBac.jpg" alt="" />
            <div class="Medal__Items--Content">
              <span class="Name">{{$value->stylized->name_stylized}}</span>
              <div class="Duration">
                <i class="fa-solid fa-business-time"></i>
                <span>Thời gian:</span>
                <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $value->startdate)->format('d/m/Y') }} 
                    - {{ \Carbon\Carbon::createFromFormat('Y-m-d', $value->depart_first_time)->format('d/m/Y') }}</span>
              </div>
            </div>
            
            <a href="{{route('downloadFile', $value->stylized->file)}}"><i class="fa-solid fa-file-pdf"></i></a>
          </div>
          @endif
          @endforeach
          
        </div>
      </div>
    </section>
    <script src="/js/Js-AdminManagementMain.js"></script>
    <script src="/js/Js-Main.js"></script>
    <script src="/js/Js-AdminManagementIndex.js"></script>
  </body>
</html>
