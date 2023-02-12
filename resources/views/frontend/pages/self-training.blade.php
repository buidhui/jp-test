@extends('frontend.master')
@section("content")
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
        <script>
        $(function() {
            $('#testResult').modal('show');
        });
        </script>
    @endif
    @include('frontend.pages.info_test_result')
    <div class="ioe-page">
        <div class="container">
            @include('frontend.layouts.menu')

            <div class="row">
                <div class="col-12">
                    <div class="tit-page">
                        <span>Vòng thi hệ thống đang mở: {{ $count_round }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ioe-page-container" style="height: auto !important;">
        <div class="container" style="height: auto !important;">
            <div class="ioe-news" style="height: auto !important;">
                <div class="row" style="height: auto !important;">
                    <div class="col-sm-8">
                        <ul class="list_vaothi">
                            <li>
                                Trình độ bạn đang dự thi: <span class="color1 txtb">
                                <b>N{{ Auth::guard('web')->user()->level }}</b>
                            </span>
                            </li>
                            <li>
                                Số vòng thi đang mở: <span class="color1 txtb">
                                <b>{{ $count_round }}</b>
                            </span>
                            </li>
                            <li>
                                Vòng thi hiện tại của bạn: <span class="color1 txtb"><b>{{ $count_pass_round + 1 }}</b></span>
                                <input type="hidden" id="round" value="1">
                            </li>
                            <li>
                                <div class="list_note">
                                    <p>
                                        <span class="txtb"
                                              style="font-size: 16px; text-decoration: underline;">Lưu ý</span><br>
                                        - Thời gian vòng thi sẽ tính bằng tổng thời gian làm các bài thi.
                                        <br>
                                        - Với các vòng tự luyện điểm thi của bạn phải &gt;=75% của vòng thi bạn mới hoàn
                                        thành.
                                        <br>
                                        <span style="color: rgb(255, 102, 0); cursor: default; text-decoration: none;"
                                              class="style2">
                                            (*) Các trường hợp thi sai luật:
                                        </span>
                                        <br/>
                                        <span class="color1">
                                            - Đăng nhập một tài khoản trên hai máy hoặc hai trình duyệt khác nhau và thi cùng một thời điểm <br>
                                            - Đang làm bài thi mà tải lại trang đề thi hoặc thoát ra không nộp bài
                                        </span>
                                        <br/>
                                        <span class="color1">- Mở nhiều cửa sổ vào thi một lúc</span><br/>
                                        <span class="color1">
                                            Các trường hợp vi phạm sẽ bị hệ thống tự động thoát ra ngoài và tính một lần trượt vòng thi
                                        </span>
                                    </p>
                                </div>
                            </li>
                            <li>
                                <div class="ioe-news">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?php
                                                $level_user = Auth::guard('web')->user()->level;
                                                $count_results = 0;
                                            ?>
                                            <span class="tit-18">Đề thi dành cho học viên trình độ N{{ $level_user }} - {{ $round_curent->name }}</span>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                </div>
                                            </div>
                                            <div class="ioe-tbl">
                                                <table>
                                                    <tbody>
                                                    <tr style="text-align:center">
                                                        <th>STT</th>
                                                        <th>Bài Thi</th>
                                                        <th>Số điểm</th>
                                                        <th>Thời gian (giây)</th>
                                                    </tr>

                                                    <?php $sum = 0;
                                                    $sum_exam = 0;
                                                    $sum_time = 0;
                                                    ?>
                                                    @foreach($tests as $key=> $item)
                                                        <?php
                                                        $question_first = DB::table('question')->where('test_id', $item->id)->first();
                                                        $count_answer_true = DB::table('user_question')
                                                            ->join('question', 'user_question.question_id', '=', 'question.id')
                                                            ->where('user_question.user_id', Auth::guard('web')->user()->id)
                                                            ->whereColumn('user_question.selected_answer', '=', 'question.answer_true')
                                                            ->where('question.test_id', $item->id)
                                                            ->count();
                                                        ?>
                                                        <?php
                                                        $results = \App\Result::where('test_id', $item->id)->where('user_id', Auth::guard('web')->user()->id)->first();
                                                        ?>
                                                        <tr style="text-align:center">
                                                            <td>{{ $key+1 }}</td>
                                                            <?php $sum += (100 / $item->number_questions) * $count_answer_true;
                                                            ?>
                                                            @if($question_first != null)
                                                                @if($results != null)
                                                                    <?php $count_results = $count_results + 1; ?>
                                                                    <td>
                                                                    <span
                                                                        class="ioe-blue-color">{{ $item->name }} Hoàn Thành
                                                                    </span>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <a data-toggle="modal" data-target="#testDescription_{{$item->id}}" href=""  class="btn-result-search"> {{ $item->name }} </a>
                                                                        @include('frontend.pages.test-description')
                                                                    </td>
                                                                @endif
                                                            @endif

                                                            @if($results != null)

                                                                <?php
                                                                $sum_exam = $sum_exam + $results->count;
                                                                $sum_time = $sum_time + $results->time;
                                                                ?>
                                                                <td>{{(100/$item->number_questions) * $count_answer_true}}</td>

                                                                <td>{{ $results->time }}</td>

                                                            @else
                                                                <td>0</td>
                                                                <td>0</td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                    <tr style="text-align:center">
                                                        <td colspan="2">Tổng</td>
                                                        <td>{{ $sum }}</td>
                                                        <td>{{$sum_time}}</td>
                                                    </tr>
                                                    <div>
                                                        @if($count_results == 4)
                                                            @if($sum >= 300)
                                                            <form action="{{ route('save.result_round') }}"
                                                                  method="post">
                                                                @csrf
                                                                <input type="text" name="point" value="{{ $sum }}"
                                                                       style="display: none">
                                                                <input type="text" name="id_round"
                                                                       value="{{ $round_curent->id }}"
                                                                       style="display: none">
                                                                <input type="text" name="time"
                                                                value="{{ $sum_time }}"
                                                                style="display: none">
                                                                <button type="submit" class="btn btn-info">Ghi lại kết
                                                                    quả
                                                                </button>
                                                            </form>
                                                            @endif

                                                            <form action="{{ route('test.retest') }}" method="post"
                                                                  style="float: left">
                                                                @csrf
                                                                <input type="text" name="round_id"
                                                                       value="{{$round_curent->id}}"
                                                                       style="display: none">
                                                                <button type="submit" class="btn btn-danger">Làm lại
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li id="myachievements"></li>
                        </ul>
                    </div>

                    <div class="col-sm-4" style="height: auto !important;">
                        <div class="ioe-news-right" style="height: auto !important;">
                            <div>
                                <div class="home-user-login">
                                    <div class="home-user-info">
                                        <div class="home-user-info-basic">
                                            <div class="home-user-info-ava">
                                                <img src={{ asset('/Themes/v1/images/no-ava.png') }} alt="">
                                            </div>
                                            <ul>
                                                <li>
                                                    <span>{{ Auth::guard('web')->user()->name }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="home-user-info-more">
                                            <ul>
                                                <li><span>ID:</span><span>{{ Auth::guard('web')->user()->id }}</span></li>
                                                <li><span>Email:</span><span>{{ Auth::guard('web')->user()->email }}</span></li>
                                                <li><span>Địa chỉ:</span><span>{{ Auth::guard('web')->user()->address }}</span></li>
                                                <li><span>Trình độ:</span><span>N{{ Auth::guard('web')->user()->level }}</span></li>
                                                <li><span>Vòng thi tiếp theo:</span><span>{{ $count_pass_round + 2 }}</span></li>
                                            </ul>
                                        </div>
                                        <ul class="home-user-option">
                                            <li><a href="{{ route('acount.get', Auth::guard('web')->user()->id) }}" target="blank"><i class="material-icons-round">arrow_right</i>Thay đổi thông tin cá nhân</a></li>
                                            <li><a href="{{ route('results') }}" target="blank"><i class="material-icons-round">arrow_right</i>Xem kết quả
                                                    thi</a></li>
                                            <li><a href="{{ route('get.ranking') }}" target="blank"><i class="material-icons-round">arrow_right</i>Bảng
                                                    xếp hạng</a></li>
                                            <li><a href="{{ route('user.get_feedback') }}" target="blank"><i class="material-icons-round">arrow_right</i>Góp ý hệ thống</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <br><br>

                            <div style="max-width:320px;"></div>

                            <div style="padding-top:10px">
                                <div id="right_bxh_nation">
                                    <div class="col-sm-12">
                                        <div class="ioe-tbl" id="tab_personalmonth_short_content">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <th style="background: #3cc2f5;color:#fff;border-radius:4px 4px 0px 0px">
                                                            TOP ĐIỂM CAO TRÌNH ĐỘ N{{ Auth::guard('web')->user()->level }}
                                                        </th>
                                                    </tr>
                                                    @foreach ($top5 as $item)
                                                        <tr>
                                                            <td>
                                                                Học viên: 
                                                                <b>{{ $item->user->name }} : </b>
                                                                {{ $item->sum }}
                                                                <br>
                                                                {{ $item->user->address }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="right_bxh_province">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script type="text/javascript">
    localStorage.clear();
</script>
