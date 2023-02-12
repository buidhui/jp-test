@extends('frontend.master')
@section("content")
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 1)
        <script>
        $(function() {
            $('#noti').modal('show');
        });
        </script>
    @endif
    @include('frontend.pages.info_test_result')
    <div class="ioe-banner">
        <div class="container">
            @include('frontend.layouts.menu')
            <div class="banner-content">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="banner-text">
                            <ul>
                                <li><span class="banner-txt-style1 wow fadeInLeft" data-wow-delay="0.2s">Chào mừng bạn đến với</span>
                                </li>
                                <li><span class="banner-txt-style2 wow fadeInRight" data-wow-delay="0.5s">Luyện thi JPT Vòng {{ $count_round }}</span>
                                </li>
                                <li><a href="{{ route('self-training') }}" class="banner-txt-link wow fadeInLeft"
                                    data-wow-delay="0.7s">Vào luyện thi ngay</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-4  wow fadeInRight" data-wow-delay="1.2s">
                        <div class="banner-countdown">
                            <span class="banner-countdown-tit">Thời gian hệ thống mở vòng thi <span>tiếp theo</span> còn</span>
                                <ul class="countdown-time">
                                    <li><span><data id="days_countdown"  value="">{{ $days }}</data><span>Ngày</span></span></li>
                                    <li><span><data id="hours_countdown" value="">{{ $hours }}</data><span>Giờ</span></span></li>
                                    <li><span><data id="minutes_countdown" value="">{{ $minutes }}</data><span>Phút</span></span></li>
                                </ul>
                                <ul>
                                    <li>
                                        <a href="{{ route('self-training') }}" class="countdown-btn-test" id="ioe-exam-thithu">Luyện thi</a>
                                    </li>
                                </ul>
                                <input type="hidden" id="examType" value="village" />
                                <input type="hidden" id="examdate" value="2021-01-15" />
                            </div>
                        </div>

                    <div class="col-sm-4 wow fadeInRight" data-wow-delay="1.5s">
                        @if (Auth::guard('web')->check())
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
                                            <?php 
                                                $count_pass_round = DB::table('user_pass_round')->where('user_id', Auth::guard('web')->user()->id)->count();
                                            ?>
                                            @if ($count_round == $count_pass_round)
                                                <li><span>Vòng thi tiếp theo:</span><span>{{ $count_pass_round + 1 }}</span></li>
                                            @else
                                                <li><span>Vòng thi tiếp theo:</span><span>{{ $count_pass_round + 2 }}</span></li>
                                            @endif
                                        </ul>
                                    </div>
                                    <ul class="home-user-option">
                                        <li><a href="{{ route('acount.get', Auth::guard('web')->user()->id) }}" target="blank"><i class="material-icons-round">arrow_right</i>Thay đổi thông tin cá nhân</a></li>
                                        <li><a href="{{ route('results') }}" target="blank"><i class="material-icons-round">arrow_right</i>Xem kết quả thi</a></li>
                                        <li><a href="{{ route('get.ranking') }}" target="blank"><i class="material-icons-round">arrow_right</i>Bảng xếp hạng</a></li>
                                        <li><a href="{{ route('user.get_feedback') }}" target="blank"><i class="material-icons-round">arrow_right</i>Góp ý hệ thống</a></li>
                                    </ul>
                                </div>
                            </div>
                        @else
                            <div class="home-user-login" style="color: #fff; border-radius: 6px">
                                <div class="home-user-info"
                                    style="background: rgba(59,193,245,0.8); color: #fff; border-radius: 6px;padding:20px">
                                    <p style="font-size:21px;margin-bottom:5px">HỖ TRỢ</p>
                                    <div class="block-200" style="padding:0;border:none;border-radius:0">
                                        <div class="item item-phone" style="padding-top:0;padding-bottom:10px;color:#fff">
                                            <a href="" style="color: #fff">
                                                <span class="label" style="margin-left: 10px; color: #fff;font-size:14px">SĐT 0814090456</span>
                                                <span class="label" style="margin-left: 10px; color: #fff;font-size:14px">TỪ 8:30 đến 17:30 (T2-T6)</span>
                                            </a>
                                        </div>
                                        <div class="item item-email"
                                            style="padding-top: 0;padding-bottom:10px;border-top:none;color:#fff">
                                            <a href="mailto:ioe@go.vn" style="color: #fff">
                                                <span class="label" style="margin-left: 10px; color: #fff;font-size:14px">Email: buidhui@gmail.com</span>
                                                <span class="label" style="margin-left: 10px; color: #fff;font-size:14px">HỖ TRỢ NỘI DUNG VÀ THỂ LỆ CUỘC THI</span>
                                            </a>
                                        </div>
                                        <div class="item item-message"
                                            style="padding-top: 0;padding-bottom:10px;border-top:none;color:#fff">
                                            <a href="https://www.facebook.com/huyybuii/" style="color: #fff">
                                                <span style="margin-left: 10px;color: #fff;font-size:14px" class="label">Messenger trên Facebook</span>
                                                <span style="margin-left: 10px;color: #fff;font-size:14px" class="label">TỪ 8:30 đến 17:30 (T2-T6)</span>
                                            </a>
                                        </div>
                                    </div>
                                    <p style="font-size:21px;margin-bottom:0">TIN TỨC</p>
                                    <ul class="home-user-option">
                                        <?php $news = DB::table('cate_news')->inRandomOrder()->limit(3)->get(); ?>
                                        @foreach ($news as $new)
                                            <li>
                                                <a href="{{ route('tin-tuc', $new->id) }}" style="color: #fff"><i
                                                class="material-icons-round" style="color: #fff">arrow_right</i>{{ $new->name }}
                                                </a>
                                            </li>
                                        @endforeach                                
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ioe-container">
        <div class="container">
            <div class="row align-items-stretch">
                <div class="col-sm-8">
                    <div class="ioe-hot-news">
                        <div class="tit-underline">
                            <a href=""><span>Bài học mỗi ngày <span>Bài học mới nhất</span></span></a>
                        </div>

                        <div class="hot-news-list" id="news_bantochuc">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="hot-news-list-items">
                                        <?php $left_news = DB::table('news')->orderBy('id', 'DESC')->where('cate_id', config('const.bai_hoc_moi_ngay'))->limit(3)->get(); ?>
                                        @foreach ($left_news as $left_new)
                                            <li>
                                                <div class="hot-news-date hot-news-noti">
                                                    <span>{{ date('d/m/Y', strtotime($left_new->created_at)) }}</span>
                                                </div>
                                                <a href="{{ route('news-detail', $left_new->id) }}">
                                                    <span>{{ $left_new->name }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="hot-news-list-items">
                                        <?php $right_news = DB::table('news')->orderBy('id', 'DESC')->where('cate_id', config('const.bai_hoc_moi_ngay'))->skip(3)->take(3)->get(); ?>
                                        @foreach ($right_news as $right_new)
                                            <li>
                                                <div class="hot-news-date hot-news-noti">
                                                    <span>{{ date('d/m/Y', strtotime($right_new->created_at)) }}</span>
                                                </div>
                                                <a href="{{ route('news-detail', $right_new->id) }}">
                                                    <span>{{ $right_new->name }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="ioe-hot-news">
                        <div class="tit-underline-blue">
                            <a href=""><span>Báo NHK<span>Tin mới nhất</span></span></a>
                        </div>

                        <ul class="hot-news-list-items" id="news_sukien">
                            <?php $system_news = DB::table('news')->orderBy('id', 'DESC')->where('cate_id', config('const.bao_nhk'))->limit(3)->get(); ?>
                            @foreach ($system_news as $system_new)
                            <li>
                                <div class="hot-news-date hot-news-noti">
                                    <span>{{ date('d/m/Y', strtotime($system_new->created_at)) }}</span>
                                </div>
                                <a href="{{ route('news-detail', $system_new->id) }}">
                                    <span>{{ $system_new->name }}</span>
                                </a>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ioe-teacher-parent">
        <div class="container">
            <div class="tit-contain">
                <span class="ioe-white-color"><b>Japanese Proficiency of Test (JPT)</b>
                    <span class="ioe-white-color"><b style="font-size: 18px;">Và những con số ấn tượng</b></span>
                </span>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <ul class="ioe-number-value">
                        <li>
                            <?php $users = DB::table('users')->count() ?>
                            <span class="ioe-blue-color wow flipInX" data-wow-delay=".6s">{{ $users }}<span class="ioe-white-color"><b>Học viên</b></span></span>
                        </li>
                        <li>
                            <?php $teachers = DB::table('teachers')->where('status', '1')->count() ?>
                            <span class="ioe-blue-color wow flipInX" data-wow-delay=".8s">{{ $teachers }}<span class="ioe-white-color"><b>Giáo viên</b></span></span>
                        </li>
                        <li>
                            <?php $questions = DB::table('question')->count() ?>
                            <span class="ioe-blue-color wow flipInX" data-wow-delay="1s">{{ $questions }}<span class="ioe-white-color"><b>Câu hỏi</b></span></span>
                        </li>
                        <li>
                            <?php $results = DB::table('result')->count() ?>
                            <span class="ioe-blue-color wow flipInX" data-wow-delay="1.2s">{{ $results }}<span class="ioe-white-color"><b>Số lượt thi</b></span></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
