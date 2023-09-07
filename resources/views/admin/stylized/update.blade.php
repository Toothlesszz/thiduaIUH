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
      href="/css/Style-AdminManagement/Style-AdminManagementMedalDetail/Style-AdminManagementMedalDetail.css"
    />
    <script
      src="https://cdn.tiny.cloud/1/9yhr6phx4oov8mlgeghcgqo61g1zyvqa6zaj9ofgpe7fasii/tinymce/6/tinymce.min.js"
      referrerpolicy="origin"
    ></script>
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
    <section class="MainMessage"></section>
    @if(session('success'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              MessageSuccess("THÀNH CÔNG!", "Cập nhật danh hiệu thành công.");
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
    <section id="loading-overlay">
      <img src="/images/logo-main.png" alt="" />
      <div class="loading-spinner"></div>
      <h5>ĐANG TẢI...</h5>
    </section>
    <section class="Main">
    <div class="Main__Navigation">
        <ul>
          <li >
            <a href="{{url('/admin')}}"
              ><i class="fa-solid fa-house"></i
            ></a>
          </li>
          <li class="li-active">
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
        <div class="Main__Content--Description">
          <div class="Title">
            <i class="fa-solid fa-medal"></i>
            <h4>PHIẾU ĐĂNG KÝ DANH HIỆU</h4>
          </div>
          
          <div class="Info">
            <img src="{{ asset('certificate/img_certificate/'.$stylized->image) }}" alt="" />
            <div class="Info__Content">
              <h4>{{$stylized->name_stylized}}</h4>
              <div class="Info__Content--UserObject">
                <i class="fa-solid fa-user-graduate"></i>
                <span>Đối tượng </span>
                <span>
                @foreach($stylized->object as $item) 
                  {{$item['objects']}}
                @endforeach
              </span>
              </div>
            </div>
            <a class="custom-button-m" href="{{route('downloadFile', $stylized->file)}}"
              >TẢI FILE<i class="fa-solid fa-file-pdf"></i
            ></a>
          </div>
          <div class="Abstracts">
            <h4>Yêu cầu chung</h4>
                <p>{{html_entity_decode(strip_tags($stylized->detail))}}</p>
            <p>
            <i>Hướng dẫn: Ứng viên đăng ký với số tiêu chuẩn yêu cầu là </i>
            <span id="regStandardNumber">{{$stylized->criterias_number}}</span></p>
          </div>
        </div>
        
        <div class="Main__Content--Registration">
          <div class="RegistrationForm">
            <form action="{{route('updateStylized', $stylized->_id)}}" method="POST" enctype="multipart/form-data" id="RegistrationSubmit">
              @csrf
            @foreach($criterias as $value)
              <div class="Standard__Items">
                <div class="Standard__Items--Title">
                  <label class="checkboxStandard"
                    >CHỌN TIÊU CHUẨN <i class="fa-solid fa-caret-right"></i>
                    <input type="checkbox" id="checkboxStandard" />
                    <span class="checkmark"></span>
                  </label>
                  <span>{{$value->name_criter}}</span>
                </div>
                <div class="Criteria">
                  <div class="Describe">
                    <i>Hướng dẫn:</i>
                    @foreach($value->intruction as $intruction)
                    
                    <span>{{html_entity_decode(strip_tags($intruction))}}</span>
                    @endforeach
                    <p>
                    <i>Số tiêu chí khác phải đăng kí:</i>
                    
                    <span id="regCriteriaNumber">@foreach($value->required_number as $required_number)
                      {{$required_number}}
                    @endforeach
                    </span>
                    </p>
                  </div>
                  @php
                      $CriteriaDetail = \App\Models\CeriteriasDetail::where('id_criter','=',$value->_id)->get();
                      
                  @endphp
                  @foreach($CriteriaDetail as $item)
                  <div class="Criteria__Items">
                    @if($item->request == '2')
                    <div class="ClassifYoblige">
                      <i class="fa-solid fa-tags"></i>
                      <span>Bắt buộc</span>
                    </div>
                    @elseif($item->request == '1')
                    <div class="ClassifOther">
                      <i class="fa-solid fa-tags"></i>
                      <span>Khác</span>
                    </div>
                    @endif
                    <div class="editContent">
                      <i
                        class="fa-regular fa-pen-to-square editContent__icon"
                      ></i>
                      <textarea name="criterias[{{$item->_id}}][details]"  class="editContent__Criteria" readonly>{{html_entity_decode(strip_tags($item->name_criter_detail))}}</textarea>
                    </div>
                    <div class="Answer">
                      <textarea
                        placeholder="Nhập câu trả lời..."
                        tabindex=""
                        disabled
                      ></textarea>
                      <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                    <div class="ImgProof">
                      <div class="ButtonOuter">
                        <input
                          disabled
                          type="file"
                          id="FileInput"
                          name=""
                          accept="image/png, image/jpeg, application/pdf"
                        />
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <span>File minh chứng</span>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  
                </div>
              </div>
              @endforeach
              
              <input
                id="btn-RegistrationMedal"
                class="custom-button-m btn-ConfirmSubmit"
                type="submit"
                value="CẬP NHẬT DANH HIỆU"
              />
            </form>
          </div>
        </div>
      </div>
    </section>

    <script src="/js/Js-AdminManagementMain.js"></script>
    <script src="/js/Js-Main.js"></script>
    <script src="/js/Js-AdminManagementMedalDetail.js"></script>
  </body>
</html>
