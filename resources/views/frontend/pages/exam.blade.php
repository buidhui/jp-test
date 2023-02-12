@include('frontend.layouts.head')

<body style="background: #f2f2f2;">
<div class="menu-float-left">
    <ul>
        <li>
            <a href="{{ asset('/') }}" class="ioe-blue-bg">
                <i class="material-icons">school</i>Về JPT
            </a>
        </li>

        <li>
            <a href="{{ route('self-training') }}" class="ioe-green-bg">
                <i class="material-icons">forum</i>Vào thi
            </a>
        </li>

        <li>
            <a href="https://www.facebook.com/VanHoang260598/" class="ioe-pink-bg" target="_blank">
                <i class="material-icons">share</i>Hỗ trợ</a>
        </li>

        <li>
            <a href="javascript:window.scrollTo({ top: 0, behavior: 'smooth' });" class="ioe-yellow-bg">
                <i class="material-icons">navigation</i>Top
            </a>
        </li>
    </ul>
</div>

<div class="ioe-header">
    <div class="ioe-header-menu-top" id="ioe-header-keep_top">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="show_hide_right_menu">
                        <ul class="header-menu-top">
                            <li>
                                <a href="javascript:;">
                                    ĐƠN VỊ THỰC HIỆN<br/>
                                    <img src={{ asset("Themes/v1/images/logo_hedspi.png") }} style="margin-left:5px;height:31px;width:auto;margin-top:2px" alt="ĐƠN VỊ THỰC HIỆN"/>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:;">
                                    ĐƠN VỊ ĐỒNG HÀNH<br/>
                                    <img src={{ asset("Themes/v1/images/soict.png") }} style="margin-left:5px;height:31px;width:auto;margin-top:2px" alt="ĐƠN VỊ ĐỒNG HÀNH"/>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="ioe-header-btn">
                        <div class="show_hide_right_menu">
                            <a href="" class="ieo-header-btn-tu-luyen-ioe">0855.670.117</a>
                            <span style="font-size: 10px;position:absolute;margin-top:-35px;background-color:yellow;padding-left: 8px;padding-right: 8px;text-align:center;">HỖ TRỢ</span>
                            <a href="{{ route('self-training') }}" class="ieo-header-btn-thi-thu-ioe">Luyện Thi</a>
                        </div>
                        @if (Auth::guard('web')->check())
                            <a href="javascript:void(0)" class="ieo-header-btn-login" id="id-header-login">
                                <i class="material-icons-round">person</i>{{ Auth::guard('web')->user()->name }}
                            </a>

                            <a href="{{ route('logout') }}" class="ioe-header-btn-register"
                               id="id-header-logout">Thoát</a>
                        @else
                            <a href="{{ route('user.login') }}" class="ieo-header-btn-login" id="id-header-login"><i
                                    class="material-icons-round">person</i>Đăng nhập</a>
                            <a href="{{ route('get_registration_student') }}" class="ioe-header-btn-register"
                               id="id-header-register">Đăng ký học viên</a>
                            <a href="{{ route('get_registration_teacher') }}" class="ioe-header-btn-register"
                               id="id-header-register">Đăng ký giáo viên</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container exam" style="font-family: sans-serif;">
    <div class="row">
        <div class="col-md-12" style="font-size: 30px; margin-top: 20px; text-align: left">
            {{$test->round->name}} - {{ $test->name }} - {{ $test->cate->name }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 left">
            <div class="row" style="padding: 20px 10px; border-bottom: 1px solid #e2e8f0;">
                <div class="col-md-8">
                    <p style="    font-size: 17px;
                        margin-bottom: 0;
                        font-weight: 700;">Danh sách câu hỏi</p>
                </div>
                <div class="col-md-4">
                    <img
                        src="{{ asset("Themes/v1/images/clock.png") }}" style="margin-left: 15px;
                        margin-top: -3px;
                        height: 27px;
                        width: auto;"
                        alt="TIME"/>
                    <div class="pull-right" id="countdown"
                         style="font-size: 17px; font-weight: 700; color: #424B5F; float: right; display: inline-block"></div>
                </div>
            </div>

            <div class="container">
                <div class="row" style="padding: 24px 10px;">
                    <div class="col-md-6" style="display: flex; padding-left: 0;">
                        <div
                            style="box-sizing: border-box; border: 1px solid #DEE5EF; background-color: #DEE5EF; height: 20px; width: 20px; border-radius: 50%;">
                        </div>
                        <span class="ml-2">Chưa trả lời</span>
                    </div>
                    <div class="col-md-6" style="display: flex;">
                        <div
                            style="box-sizing: border-box; border: 1px solid #DEE5EF; background-color: #FEF4C2; height: 20px; width: 20px; border-radius: 50%;">
                        </div>
                        <span class="ml-2">Đã trả lời</span>
                    </div>
                    <div class="mt-4"
                         style="color: #67758D; font-size: 12px; letter-spacing: -0.3px; line-height: 14px;">
                        <p class="mb-0">Bấm vào câu hỏi để xem chi tiết !!!</p>
                    </div>
                </div>
            </div>
            <hr style="color: #e2e8f0; margin: 0;">

            <div style="padding: 15px 3px;">
                @foreach($list_question as $key => $item)
                    <?php
                        $user_question = DB::table('user_question')->where('question_id', $item->id)->where('user_id', Auth::guard('web')->user()->id)->where('selected_answer', '<>', null)->get();
                    ?>
                    <a href="{{$item->id}}" class="btn btn-primary"
                       @if(count($user_question) > 0) style="background: #FEF4C2; color: #FAD20B; font-weight: bold; font-size: 14px; font-family: 'Poppins Bold'; height: 35px; width: 35px;"
                       @endif style="background: #DEE5EF; color: #67758D; font-weight: bold; font-size: 14px; font-family: 'Poppins Bold'; height: 35px; width: 35px;">{{ $key+1 }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-md-8 right" style="margin-top: 20px">

            <div>
                <?php
                $id_question_curent = Request::segment(4);
                ?>
                @foreach($list_question as $key => $item)
                    @if($item->id == $id_question_curent)
                        <b style="font-size: 25px;">Câu hỏi {{$key+1}}</b>
                    @endif
                @endforeach
            </div>
            <div class="content-as"
                 style="color: #191D28; margin-top: 2rem !important; margin-bottom: 2rem !important; width: 100%; font-family: 'Roboto Regular'; font-size: 25px; letter-spacing: 0; line-height: 24px; color: #283040 !important;">
                {!! $question ->name !!}
            </div>
            <hr>
            <div class="clearfix"></div>

            <b>Chọn đáp án đúng:</b>

            <?php 
                $isset_anser = DB::table('user_question')->where('user_id', Auth::guard('web')->user()->id)->where('question_id', $question->id)->first();

                $test = DB::table('test')->where('id', $question->test_id)->first();
            ?>
            <input type="text" id="count_time_default" value="{{ $test->time }}" style="display: none">
            <form action="{{ route('save-answer', $question->id) }}" method="post">
                @csrf
                <div class="radio" style="margin-top: 20px">
                    <div style="display: flex"><input type="radio" name="answer"
                                                      style="width: 20px; height: 20px; margin-right: 10px;" value="A"
                                                      @if($isset_anser !=null &&$isset_anser->selected_answer == 'A') checked @endif>
                        {{ $question->answera }}
                    </div>
                </div>
                <input type="text" name="countdown" id="countdown1" style="display: none">
                <input type="text" name="countdown2" id="countdown2" value="{{ Session::get('countdown')  }}"
                       style="display: none">

                <div class="radio" style="margin-top: 20px">
                    <div style="display: flex"><input type="radio" name="answer"
                                                      style="width: 20px; height: 20px; margin-right: 10px;" value="B"
                                                      @if($isset_anser !=null  && $isset_anser->selected_answer == 'B') checked @endif> {{ $question->answerb }}
                    </div>
                </div>
                <input id="id_test" type="text" name="id_test" value="{{ $test->id }}" style="display: none">
                <div class="radio" style="margin-top: 20px">
                    <div style="display: flex"><input type="radio" name="answer"
                                                      style="width: 20px; height: 20px; margin-right: 10px;" value="C"
                                                      @if($isset_anser !=null  &&$isset_anser->selected_answer == 'C') checked @endif> {{ $question->answerc }}
                    </div>
                </div>
                <div class="radio" style="margin-top: 20px">
                    <div style="display: flex"><input type="radio" name="answer"
                                                      style="width: 20px; height: 20px; margin-right: 10px;" value="D"
                                                      @if($isset_anser !=null  &&$isset_anser->selected_answer == 'D') checked @endif> {{ $question->answerd }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <?php
                            $id_test = \Request::segment(2);
                            $preQuestionID = \App\Question::where('id', '<', $id_question_curent)->where('test_id', $id_test)->max('id');
                        ?>
                        <a href="{{$preQuestionID}}" class="btn-back btn"
                            style="margin-top: 10px; padding-top: 13px;">Quay lại câu trước
                        </a>
                    </div>
                    <div class="col-md-4">
                        <button class="btn-next" style="margin-top: 10px">Lưu và chuyển câu</button>
                    </div>
            </form>
            <form action="{{ route('save-result') }}" method="post">
                @csrf
                <input type="text" name="id_test" value="{{$test->id}}" style="display: none">
                <input type="text" id="time" name="time" style="display: none">
                <div class="col-md-4" style="text-align: right;">
                    <button type="submit" class="btn-submit" style="margin-top: 10px">Nộp bài</button>
                </div>
            </form>
        </div>
    </div>

</div>
</div>

<script>

    function countdown(elementName, minutes, seconds) {
        var element, endTime, hours, mins, msLeft, time;

        function twoDigits(n) {
            return (n <= 9 ? "0" + n : n);
        }

        function updateTimer() {
            var countdown = document.getElementById('countdown').textContent;

            msLeft = endTime - (+new Date);
            if (countdown == '0:00') {
                alert("Đã hết thời gian làm bài thi!");
                var id_test = document.getElementById('id_test').value;
                var time = document.getElementById('time').value;
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('save-result') }}",
                    method:"POST", 
                    data:{id_test:id_test,time:time, _token:_token},
                    success:function(data){
                        window.location.href = '/';
                    }
                });
                window.location.href = 'https://localhost/webonthi/public/tu-luyen';
            } else {
                time = new Date(msLeft);
                hours = time.getUTCHours();
                mins = time.getUTCMinutes();
                element.innerHTML = (hours ? hours + ':' + twoDigits(mins) : mins) + ':' + twoDigits(time.getUTCSeconds());
                document.getElementById("countdown1").setAttribute('value', (hours ? hours + ':' + twoDigits(mins) : mins) + ':' + twoDigits(time.getUTCSeconds()));
                document.getElementById("time").setAttribute('value', (hours ? hours + ':' + twoDigits(mins) : mins) + ':' + twoDigits(time.getUTCSeconds()));
                setTimeout(updateTimer, time.getUTCMilliseconds() + 500);
                localStorage['countdown'] = document.getElementById('countdown').textContent;
            }
        }

        element = document.getElementById(elementName);
        endTime = (+new Date) + 1000 * (60 * minutes + seconds) + 500;
        updateTimer();
    }

    var count = document.getElementById('countdown2').value;
    var count_time_default = document.getElementById('count_time_default').value;

    if (count != '') {
        var count_time = count.split(":");
        var count_minutes = count_time[0];
        var count_seconds = count_time[1];
        countdown("countdown", parseInt(count_minutes), parseInt(count_seconds-1));

    } else {
        if (localStorage.getItem('countdown')!== null) {
            var count_time1 = localStorage.getItem('countdown').split(":");
            var count_minutes1 = count_time1[0];
            var count_seconds1 = count_time1[1];
            countdown("countdown", parseInt(count_minutes1), parseInt(count_seconds1-1));

        } else {
            countdown("countdown", count_time_default, 0);
        }
    }
</script>
@include('frontend.layouts.footer')
</body>
