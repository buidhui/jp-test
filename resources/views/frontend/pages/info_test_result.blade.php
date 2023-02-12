<div class="modal fade" id="testResult" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="padding: 1rem 1rem;">
                <h5 class="modal-title" id="exampleModalLabel">Kết quả thi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="    margin-right: 16px;
                    font-size: 25px;">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 1rem !important; text-align: left;">
                <?php 
                    $time = Session::get('time');
                    $minutes = floor(($time / 60) % 60);
                    $seconds = $time % 60;
                    $point = Session::get('point');
                ?>
                <p style="font-size: 17px; color: grey">Chúc mừng bạn đã hoàn thành {{ Session::get('test_name') }}</p>
                <p style="font-size: 17px; color: grey;">
                    - Số câu đúng: <span class="text-danger" style="font-weight: 600">{{ Session::get('count_answer_true') }}/{{ Session::get('answer') }}</span>
                </p>
                <p style="font-size: 17px; color: grey">
                    - Thời gian làm bài: <span class="text-danger" style="font-weight: 600">{{ $minutes }} phút {{ $seconds }} giây</span>
                </p>
                <p style="font-size: 17px; color: grey">
                    - Tổng điểm: <span class="text-danger" style="font-weight: 600">{{ $point }}</span>
                </p>    
                @if ($point <= 60)
                    <p style="font-size: 17px; margin-bottom: 0; color: lightseagreen;
                    font-weight: 600;">
                        Số điểm có vẻ chưa được tốt lắm nhỉ. Hãy cố gắng ở các bài thi tiếp theo nha. 頑張ってくださいね。
                    </p>   
                @elseif ($point > 60 && $point <= 85) 
                    <p style="font-size: 17px; margin-bottom: 0; color: lightseagreen;
                    font-weight: 600; ">
                        Bạn đã làm khá tốt rồi đấy. Hãy tiếp tục phát huy ở các bài thi tiếp theo nha. 頑張ってくださいね。
                    </p>   
                @else
                    <p style="font-size: 17px; margin-bottom: 0; color: lightseagreen;
                    font-weight: 600;">
                        Xuất sắc. Hãy giữ vững phong độ ở các bài thi tiếp theo nha. 頑張ってくださいね。
                    </p>  
                @endif
            </div>
            <div class="modal-footer" style="text-align: center; display: block; padding: 7px;">
                <a href="" class="btn btn-primary btn-close " style="width: 110px; background: #3cc2f5;">
                    Đóng
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="noti" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="padding: 1rem 1rem;">
                <h5 class="modal-title" id="exampleModalLabel">Thông báo từ hệ thống</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="    margin-right: 16px;
                    font-size: 25px;">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 1rem !important; text-align: left;">
                <p style="font-size: 17px; color: grey; margin-top: 1rem;">Bạn đã hoàn thành hết tất cả các vòng thi. Hiện tại chưa có vòng thi mới. Vui lòng xem lịch thi trên trang chủ.</p>     
            </div>
            <div class="modal-footer" style="text-align: center; display: block; padding: 7px;">
                <a href="" class="btn btn-primary btn-close " style="width: 110px; background: #3cc2f5;">
                    Đóng
                </a>
            </div>
        </div>
    </div>
</div>
    
    