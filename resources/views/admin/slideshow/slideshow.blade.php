<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hệ thống Thi đua khen thưởng IUH</title>
    <link rel="icon" href="/Front-End/Icon/icon-award.png" />
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
      href="/css/Style-AdminManagement/Style-AdminManagementSlideShow/Style-AdminManagementSlideShow.css"
    />
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
              MessageSuccess("THÀNH CÔNG!", "Thêm ảnh mới thành công !");
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
              MessageSuccess("THÀNH CÔNG!", "Chỉnh sửa Slideshow thành công !");
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
              MessageSuccess("THÀNH CÔNG!", "Xóa ảnh thành công !");
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
              @if(session('error1'))
              <script>
                sessionStorage.setItem("reloadStatus", "true");
            window.addEventListener("load", function () {
       
            // Kiểm tra trạng thái đã được lưu trữ
            var reloadStatus = sessionStorage.getItem("reloadStatus");

            if (reloadStatus === "true") {
              // MessageSuccess("THÀNH CÔNG!", "Xóa ảnh thành công !");
              MessageError(
                "XÓA KHÔNG THÀNH CÔNG!",
                "Không thể xóa ảnh đang tồn tại trên Slideshow !."
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
              // MessageSuccess("THÀNH CÔNG!", "Xóa ảnh thành công !");
              MessageError(
                "XÓA KHÔNG THÀNH CÔNG!",
                "Đã có lỗi xảy ra. Không tìm thấy ảnh cần xóa !."
              );
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
          <li class="li-active" @if(Auth::guard('admin')->user()->level != '5') style="opacity: 0.7; pointer-events: none;" @endif>
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
              <p style="font-size: 0.8vw; margin-left: 1vw">
                <i>Tài khoản chưa có thông báo có thông báo!</i>
              </p>
              <!-- <div class="Notification__content--items">
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
              </div> -->
            </div>
          </div>
        </div>
      </div>
      <div class="Main__Content">
        <div class="Main__Content--Slidebar">
          <div class="Slider">
            <i class="fa-solid fa-angle-right fa-rotate-180 prev"></i>
            <i class="fa-solid fa-angle-right next"></i>
            <div class="Slider__direction">
            @foreach($slideShow as $slide)
              <button data-direction="{{$slide->number}}" @if($slide->number == '0')class="active"@endif></button>
              @endforeach
            </div>
            <div class="Slider__main">
              <div class="Slider__main--img">
              @foreach($slideShow as $picture)
                <a href=""
                  ><img src="{{asset('images/'.$picture->image)}}" alt=""/></a>
              @endforeach
              </div>
            </div>
          </div>
          <div class="UpdateSlider">
            <form id="formEditSlider" action="{{route('slideShow')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <p>
                <i class="fa-solid fa-photo-film"></i> TÙY CHỈNH SLIDER
                <i>(Tối đa 4 ảnh)</i>
              </p>
              <div id="selected-images"></div>
              <div>
                <button
                  type="submit"
                  class="custom-button-s"
                  id="submitEditSlider"
                  style="background-color: rgba(29, 171, 161, 1)"
                >
                  CẬP NHẬT SLIDER
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="Main__Content--SlideLibrary">
          <div class="SlideLibraryTitle">
            <div class="Title">
              <i class="fa-regular fa-copy"></i>
              <h4>QUẢN LÍ SLIDE SHOW</h4>
            </div>
            <form
              action="{{route('uploadImages')}}"
              method="POST"
              style="display: flex; margin-top: 0.5vw"
              enctype="multipart/form-data"
            >
            @csrf
              <div class="UploadImage">
                <span
                  ><i class="fa-solid fa-file-arrow-up"></i> SLIDE IMAGE</span
                >
                <input
                  type="file"
                  name= "image"
                  accept="image/png, image/jpeg"
                  id="TemplateMedal"
                  required
                />
              </div>
              <button
                type="submit"
                class="custom-button-s"
                style="background-color: rgba(29, 171, 161, 1)"
              >
                TẢI ẢNH LÊN
              </button>
            </form>
          </div>

          <div class="SlideLibraryImgs">
            <div class="SlideLibraryImgs__Container">
            @php
            $filteredSlideShow = \App\Models\SlideStorage::pluck('image')->toArray();
            @endphp
            @foreach($slideShow as $data)
                <div class="ImgItems">
                  <a href="{{route('deleteImages', $data->image)}}"><i class="fa-solid fa-folder-minus"></i></a>
                  <img src="{{asset('/images/'.$data->image)}}" alt="" />
                  <label class="ImgItems__Checkbox">
                    <input type="checkbox" checked class="image-checkbox" />
                    <span class="checkmark"></span>
                    </label>
                </div>
            @endforeach
            @foreach($pictures as $pic)
            @if(!in_array($pic->name, $filteredSlideShow))
                <div class="ImgItems">
                    <a href="{{route('deleteImages', $pic->name)}}"><i class="fa-solid fa-folder-minus"></i></a>
                    <img src="{{asset('/images/'.$pic->name)}}" alt="" />
                        <label class="ImgItems__Checkbox">
                            <input type="checkbox" class="image-checkbox" />
                            <span class="checkmark"></span>
                        </label>
                    
                </div>
            @endif
            @endforeach
              
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="/js/Js-AdminManagementMain.js"></script>
    <script src="/js/Js-AdminManagementSlideShow.js"></script>
    <script src="/js/Js-Main.js"></script>
  </body>
</html>
