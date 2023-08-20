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
      href="/css/Style-AdminManagement/Style-AdminManagementMarkMedalDetail/Style-AdminManagementMarkMedalDetail.css"
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
    @if(session('success'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              MessageSuccess("THÀNH CÔNG!", "Cập nhật trạng thái phiếu đăng kí thành công.");
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
          <li class="li-active">
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
            </div>
          </div>
        </div>
      </div>
      <div class="Main__Content">
        <div class="Main__Content--Profile">
          <div class="Title">
            <i class="fa-solid fa-user-graduate"></i>
            <h4>THÔNG TIN ỨNG VIÊN</h4>
          </div>
          <div class="InfoAvatar">
            <img src="{{asset('uploads/user/'. $regis->users->image)}}" alt="" />
          </div>
          <div class="InfoTitle">
            <p>Họ và tên</p>
            <p>ID</p>
            <p>Đơn vị</p>
            <p>Đối tượng</p>
          </div>
          <div class="InfoContent">
            <p>{{$regis->users->name}}</p>
            <p>{{$regis->users->code}}</p>
            <p>{{$regis->users->department->name_depart}}</p>
            <p>{{$regis->users->type}}</p>
          </div>
        </div>
        <div class="Main__Content--Description">
          <div class="Title">
            <i class="fa-solid fa-medal"></i>
            <h4>PHIẾU ĐĂNG KÝ DANH HIỆU</h4>
          </div>
          <div class="Info">
            <!-- <img src="/Front-End/Image/lamtheoloiBac.jpg" alt="" /> -->
            <div class="Info__Content">
              <h4>{{$regis->competitionperiod->stylized->name_stylized}}</h4>
              <div class="Info__Content--Duration">
                <i class="fa-solid fa-business-time"></i>
                <span>Thời gian :</span>
                <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $regis->competitionperiod->startdate)->format('d-m-Y') }} - 
                  {{ \Carbon\Carbon::createFromFormat('Y-m-d', $regis->competitionperiod->depart_first_time)->format('d-m-Y') }}</span>
              </div>
              <div class="Info__Content--UserObject">
                <i class="fa-solid fa-user-graduate"></i>
                <span>Đối tượng :</span>
                @foreach($regis->competitionperiod->stylized->object as $item)
                <span>{{$item['objects']}}</span>
                @endforeach
              </div>
              <div class="Info__Content--UserObject">
                <i class="fa-solid fa-clipboard"></i>
                <span>Trạng thái :</span>
                <span>@if($regis->admin_status == '1')
                  Đã duyệt
                  @elseif($regis->admin_status == '2')
                  Xem xét
                  @elseif($regis->admin_status == '4')
                  Đã đạt
                  @elseif($regis->admin_status == '5')
                  Chưa đạt
                  @endif
                </span>
              </div>
            </div>
            <a class="custom-button-m" href="{{route('downloadFile', $regis->competitionperiod->stylized->file)}}"
              >TẢI FILE<i class="fa-solid fa-file-pdf"></i
            ></a>
          </div>
          <div class="Abstracts">
            <h4>Yêu cầu chung</h4>
            <p>
            {{html_entity_decode(strip_tags($regis->competitionperiod->stylized->detail))}}
            </p>
            <p>
            <i>Hướng dẫn: Ứng viên đăng ký với số tiêu chuẩn yêu cầu là </i>
                    
                    <span id="regStandardNumber">
                      {{$regis->competitionperiod->stylized->criterias_number}}
                    </span>
                    </p>
          </div>
        </div>
        <div class="Main__Content--Registration">
          <div class="RegistrationForm">
            <form action="{{route('updateRegistrationDetailAdmin',[$regis->_id])}}" method="POST" enctype="multipart/form-data" id="RegistrationSubmit">
              @csrf
            @php
            $filteredCriteriaDetails = \App\Models\CeriteriasDetail::whereIn('_id', $id_criteria_detail)
            ->whereIn('id_criter', $filtered_criterias->pluck('_id'))->get();
            @endphp
              @foreach($filtered_criterias as $item)
              <div class="Standard__Items">
                <div class="Standard__Items--Title">
                  <label class=""
                    >TIÊU CHUẨN <i class="fa-solid fa-caret-right"></i>
                  </label>
                  <span>{{$item->name_criter}}</span>
                </div>
                <div class="Criteria">
                <div class="Describe">
                    <i>Hướng dẫn:</i>
                    @foreach($item->intruction as $intruction)
                    
                    <span>{{html_entity_decode(strip_tags($intruction))}}</span>
                    @endforeach
                    <p>
                    <i>Số tiêu chí khác phải đăng kí:</i>
                    <span id="regCriteriaNumber">
                    @foreach($item->required_number as $required_number)
                      {{$required_number}}
                    @endforeach
                    </span>
                    </p>
                  </div>
                 @foreach($filteredCriteriaDetails->where('id_criter', $item->_id) as $criteriaDetail)
                 @php
                 $detail = \App\Models\RegistrationDetails::where('id_criteria_detail', $criteriaDetail->_id)
                ->where('id_regis', $regis->_id)
                ->first();
                 @endphp
                  
                  <div class="Criteria__Items">
                    @if($criteriaDetail->request == '2')
                    <div class="ClassifYoblige">
                      <i class="fa-solid fa-tags"></i>
                      <span id="Classif">Bắt buộc</span>
                    </div>
                    @elseif($criteriaDetail->request == '1')
                    <div class="ClassifOther">
                        <i class="fa-solid fa-tags"></i>
                        <span id="Classif">Khác</span>
                      </div>
                      @endif
                    <p>
                      {{html_entity_decode(strip_tags($criteriaDetail->name_criter_detail))}}
                    </p>
                    <div class="Answer">
                      <textarea readonly tabindex="">{{html_entity_decode(strip_tags($detail->revelation))}}</textarea>
                      <i class="fa-solid fa-envelope-open-text"></i>
                    </div>
                    <div class="Control">
                      <a href="{{asset('uploads/proof_file/'. $detail->proof_file)}}" target="_blank" class="custom-button-s"
                        ><i class="fa-solid fa-file-shield"></i> MINH CHỨNG</a>
                      @if($detail && $detail->reason == '0')
                      <label
                        style="background-color: rgba(240, 123, 63, 1)"
                        class="checkboxQualified__status"
                        >CHƯA ĐẠT <i class="fa-solid fa-clipboard-check"></i>
                      </label>
                      <div class="checkboxQualified">
                        <label class="checkboxQualified__item"
                          >ĐẠT
                          
                          <input
                            type="checkbox"
                            id="checkboxStandard"
                            value="1"
                            name="id_registration_detail[{{$detail->_id}}][checked]"
                          />
                          <span class="checkmark"></span>
                        </label>
                      </div>
                      @elseif($detail && $detail->reason == '1')
                     <label class="checkboxQualified__status"
                        >ĐÃ ĐẠT <i class="fa-solid fa-clipboard-check"></i>
                      </label>
                      <div class="checkboxQualified">
                        <label class="checkboxQualified__item"
                          >CHƯA ĐẠT
                          <input
                            type="checkbox"
                            id="checkboxStandard"
                            value="0"
                            name="id_registration_detail[{{$detail->_id}}][checked]"
                          />
                          <span class="checkmark"></span>
                        </label>
                      </div>
                      @elseif($detail && $detail->reason == '2')
                      <label
                        class="checkboxQualified__status"
                        style="background-color: rgba(240, 123, 63, 1)"
                        >PHÂN VÂN <i class="fa-solid fa-clipboard-check"></i>
                      </label>
                      <div class="checkboxQualified">
                        <label class="checkboxQualified__item"
                          >ĐẠT
                          <input
                            type="checkbox"
                            id="checkboxStandard"
                            value="1"
                            name="id_registration_detail[{{$detail->_id}}][checked]"
                          />
                          <span class="checkmark"></span>
                        </label>
                      </div>
                      @endif
                    </div>
                  </div>
                  @endforeach
                  
                </div>
              </div>
@endforeach
              <input type="hidden" name="status_input" value="" id="btnOperation" />
              <div class="Operation"> 
              
              <div class="Note">
              <span>Nhận xét Quản trị viên Khoa</span>
                  <input
                    type="hidden"
                    value=""
                    id="commentDepart"
                  />
                  <i class="fa-solid fa-message"></i>
                  <textarea readonly name="note" placeholder="" tabindex="">{{html_entity_decode(strip_tags($regis->note))}}</textarea>
                </div>
                <div class="Note">
                <span>Nhận xét Quản trị viên Trường</span>
                  <input
                    type="hidden"
                    value=""
                    id="commentManage"
                  />
                  <i class="fa-solid fa-message"></i>
                  <input type="hidden" />
                  <textarea name="admin_note" placeholder="" tabindex="">{{html_entity_decode(strip_tags($regis->admin_note))}}</textarea>
                </div>               
                <h5>THAO TÁC XÉT DUYỆT</h5>
                <button
                  id="btn-Evaluate"
                  class="custom-button-m btn-ConfirmSubmit"
                  type="submit"
                >
                  <i class="fa-solid fa-award"></i> LƯU HỒ SƠ
                </button>
               
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>


    <div class="popupConfirmSubmit">
      <div class="popupConfirmSubmit__content">
        <i class="fa-regular fa-circle-question fa-shake"></i>
        <p>Bạn có chắc chắn thực hiện thao tác?</p>
        <div>
          <button id="close-popupConfirmSubmit">Hủy</button>
          <button id="submit-ConfirmSubmit">Đồng ý!</button>
        </div>
      </div>
    </div>
    <script src="/js/Js-AdminManagermentMarkMedalDetail.js"></script>
    <script src="/js/Js-AdminManagementMain.js"></script>
    <script src="/js/Js-Main.js"></script>
  </body>
</html>
