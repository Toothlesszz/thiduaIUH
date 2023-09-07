<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng ký danh hiệu - Hệ thống Thi đua khen thưởng IUH</title>
    <link rel="icon" href="/images/icon-award.png" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link rel="stylesheet" href="/css/Styles.css" />
    <link
      rel="stylesheet"
      href="/css/Style-User/Style-UserMain.css"
    />
    <link
      rel="stylesheet"
      href="/css/Style-User/Style-UserRegistrationMedals/Style-UserRegistrationMedals.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>
    //realtime notification
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('755f3dd3f1206ea250f6', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('noti-channel');
    channel.bind('profile-reviewed', function(message) {
      alert(JSON.stringify(message));
    });
  </script>
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
              MessageSuccess("THÀNH CÔNG!", "Đăng kí đợt thi đua thành công.");
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
            <a href="{{url('/user') }}"><i class="fa-solid fa-house"></i></a>
          </li>
          <li>
          <a href="{{route('send-stylized.index')}}"
              ><i class="fa-solid fa-medal"></i
            ></a>
          </li>
          <li>
          <form action="{{route('changeInforGet') , Auth::user()->_id}}" method="POST">
            <a href="{{route('changeInforGet') , Auth::user()->_id}}" class="btn btn-info"><i class="fa-solid fa-user-gear"></i
            ></a>
          </form>
            
          </li>
          <li>
            <a href="{{ url('/logout-user') }}"
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
            <img src="{{ asset('uploads/user/'. Auth::user()->image) }}" alt="" />
            <div class="info">
              <span> {{ Auth::user()->type }}</span>
              <span> {{ Auth::user()->name }}</span>
            </div>
            <i class="fa-solid fa-angle-down" id="openDropdown-Account"></i>
            <i
              class="fa-solid fa-angle-down fa-rotate-180 hidden"
              id="closeDropdown-Account"
            ></i>
            <div class="nav">
              <ul>
                <li>
                <form action="{{route('changeInforGet') , Auth::user()->_id}}" method="POST">
            <a href="{{route('changeInforGet') , Auth::user()->_id}}" class="btn btn-info"><i class="fa-solid fa-user-gear"></i><span>TÀI KHOẢN</span></a>
          </form>
                  
                </li>
                <li>
                  <a href="{{ url('/logout-user') }}"
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
              <div class="Info__Content--Duration">
                <i class="fa-solid fa-business-time"></i>
                <span>Thời gian </span>
                <span>{{ date("d/m/Y",strtotime($competitionperiod->startdate)) }}
                   - {{ date("d/m/Y",strtotime($competitionperiod->depart_first_time)) }}</span>
              </div>
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
            
            <a class="custom-button-m" href="{{route('downloadFileUser', $stylized->file)}}"
              >TẢI FILE<i class="fa-solid fa-file-pdf"></i
            ></a>
          </div>
          <div class="Abstracts">
            <h4>Yêu cầu chung</h4>
            <p>
              @php
              $test = nl2br(html_entity_decode(strip_tags($stylized->detail)));
                $test1 = str_replace('<br />', "\n", $test)
                @endphp
                {{$test1}}
              
            </p>
            <p>
            <i>Hướng dẫn: Ứng viên đăng ký với số tiêu chuẩn yêu cầu là </i>
            <span id="regStandardNumber">{{$stylized->criterias_number}}</span></p>
          </div>
        </div>
        
        <div class="Main__Content--Registration">
          <div class="RegistrationForm">
            <form action="{{route('storeRegistration')}}" method="POST" id="RegistrationSubmit" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id_competitionperiod" value="{{$competitionperiod->_id}}" />
              <input type="hidden" name="id_user" value="{{ Auth::user()->_id }}" />
              <input type="hidden" name="code_user" value="{{ Auth::user()->code }}" />
              <input type="hidden" name="id_depart" value="{{ Auth::user()->id_depart }}" />
              <input type="hidden" name="date" value="{{ now()->toDateString() }}" />
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
                    
                    <span id="regCriteriaNumber">
                    @foreach($value->required_number as $required_number)
                      {{$required_number}}
                    @endforeach
                    </span>
                    </p>
                  </div>
                  @php
                      $CriteriaDetail = \App\Models\CeriteriasDetail::where('id_criter','=',$value->_id)->get();
                  @endphp

                  @foreach($CriteriaDetail as $item)
                    @if($item->request == '2')
                    <div class="Criteria__Items">
                      <div class="ClassifYoblige">
                        <i class="fa-solid fa-tags"></i>
                        <span>Bắt buộc</span>
                      </div>
                      <p>
                        
                        {{html_entity_decode(strip_tags($item->name_criter_detail))}}
                      </p>
                      <input type="hidden" name="criteria_detail[{{ $item->_id }}][id]" value="{{ $item->_id }}" />
                      <div class="Answer">
                        <textarea
                          placeholder="Nhập câu trả lời..."
                          tabindex=""
                          name="criteria_detail[{{ $item->_id }}][revelation]"
                          required
                        ></textarea>
                        <i class="fa-solid fa-pen-to-square"></i>
                      </div>
                      <div class="ImgProof">
                        <div class="ButtonOuter">
                          <input
                            name="criteria_detail[{{ $item->id }}][file]"
                            type="file"
                            id="FileInput"
                            accept="image/png, image/jpeg, application/pdf"
                            required
                          />
                          <i class="fa-solid fa-cloud-arrow-up"></i>
                          <span>File minh chứng</span>
                        </div>
                      </div>
                    </div>
                    @elseif($item->request == '1')
                    <div class="Criteria__Items">
                      <div class="ClassifOther">
                        <i class="fa-solid fa-tags"></i>
                        <span>Khác</span>
                      </div>
                      <p>
                        
                        {{html_entity_decode(strip_tags($item->name_criter_detail))}}
                      </p>
                      <input type="hidden" name="criteria_detail[{{ $item->_id }}][id]" value="{{ $item->_id }}" />
                      <div class="Answer">
                        <textarea
                          placeholder="Nhập câu trả lời..."
                          tabindex=""
                          name="criteria_detail[{{ $item->_id }}][revelation]"
                        ></textarea>
                        <i class="fa-solid fa-pen-to-square"></i>
                      </div>
                      <div class="ImgProof">
                        <div class="ButtonOuter">
                          <input
                          name="criteria_detail[{{ $item->_id }}][file]"
                            type="file"
                            id="FileInput"
                            accept="image/png, image/jpeg, application/pdf"
                          />
                          <i class="fa-solid fa-cloud-arrow-up"></i>
                          <span>File minh chứng</span>
                        </div>
                      </div>
                    </div>
                    @endif
                  @endforeach
                </div> 
        
              </div>
              @endforeach
              
              <input
                id="btn-RegistrationMedal"
                class="custom-button-m btn-ConfirmSubmit"
                type="submit"
                value="ĐĂNG KÝ DANH HIỆU"
              />
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

    <script src="/js/Js-Main.js"></script>
    <script src="/js/Js-UserRegistrationMedals.js"></script>
    <script src="/js/Js-UserMain.js"></script>
  </body>
</html>
