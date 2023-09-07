
    <div class="Notification__content" >
              <span><i class="fa-regular fa-bell"></i> Thông báo</span>
              @if($count == 0)
              <div>
                <p style ="font-size:20px"> 
                Hiện tại bạn không có thông báo nào.
                </p>
              </div>
              @else
              @foreach($notifications as $noti)
                @php
                $name_stylized= \App\Models\Stylized::where('_id','=', $noti->id_stylized)->first();
                @endphp
              <div class="Notification__content--items">
                <img src="/images/admin.jpg" alt="" />
                <span id="sender">ADMIN</span>
                <span id="sending-time">{{ date("d/m/Y",strtotime($noti->date)) }} </span>
                @if($noti->status == '4')
                <p>
                Chúc mừng, bạn đã đạt danh hiệu “{{$name_stylized->name_stylized}}”!
                </p>
                @elseif($noti->status == '5')
                <p>
                Bạn đã không đạt danh hiệu “{{$name_stylized->name_stylized}}”!
                </p>
                @endif
              </div>
              @endforeach
              
              @endif
    </div>
