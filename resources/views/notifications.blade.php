
    <div class="Notification__content" data-url="/notifications">
              <span><i class="fa-regular fa-bell"></i> Thông báo</span>
              @if($count == 0)
              <p style="font-size: 0.8vw; margin-left: 1vw">
                <i>Tài khoản chưa có thông báo có thông báo!</i>
              </p>
              @else
              @foreach($notifications as $noti)
                @php
                $name_stylized= \App\Models\Stylized::where('_id','=', $noti->id_stylized)->first();
                @endphp
              <div class="Notification__content--items">
                <img src="/images/admin.jpg" alt="" />
                <span id="sender">ADMIN</span>
                <span id="sending-time">{{ date("d/m/Y",strtotime($noti->date)) }} </span>
                @switch($noti->status)
                  @case('1')
                  <p>
                  Hồ sơ đăng kí danh hiệu “{{$name_stylized->name_stylized}}” của bạn đã được khoa duyệt !
                  </p>
                  @break
                  @case('2')
                  <p>
                  Hồ sơ đăng kí danh hiệu “{{$name_stylized->name_stylized}}” của bạn đã được chuyển lên Đoàn trường !
                  </p>
                  @break
                  @case('3')
                  <p>
                  Hồ sơ đăng kí danh hiệu “{{$name_stylized->name_stylized}}” của bạn đã bị khoa từ chối. Vui lòng quay lại mốc thời gian bổ sung hồ sơ để bổ sung lại hồ sơ !
                  </p>
                  @break
                  @case('4')
                  <p>
                  Chúc mừng, bạn đã đạt danh hiệu “{{$name_stylized->name_stylized}}”!
                  </p>
                  @break
                  @case('5')
                  <p>
                  Bạn đã không đạt danh hiệu “{{$name_stylized->name_stylized}}”!
                  </p>
                  @break
                @endswitch
              </div>
              @endforeach
              
              @endif
    </div>
