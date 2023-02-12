@extends('frontend.master')
@section("content")
    <div class="ioe-page">
        <div class="container">
            @include('frontend.layouts.menu')

            <div class="row">
                <div class="col-12">
                    <div class="tit-page">
                        <span>Kết quả thi của bạn</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ioe-page-container" style="padding:20px">
        <div class="container">  
            <div class="my-ioe">
                <div id="progressbar" style="opacity: 1;">
                    <style>
                        :root {
                            --color-white: #fff;
                            --color-black: #333;
                            --color-gray: #75787b;
                            --color-gray-light: #bbb;
                            --color-gray-disabled: #e8e8e8;
                            --color-green: #3cc2f5;
                            --color-green-dark: #383;
                            --font-size-small: .75rem;
                            --font-size-default: .875rem;
                        }
                        h2 {
                            color: var(--color-gray);
                            font-size: var(--font-size-small);
                            line-height: 1.5;
                            font-weight: 400;
                            text-transform: uppercase;
                            letter-spacing: 3px;
                        }
                        section {
                            margin-bottom: 3rem;
                        }

                        .progress-bar-ioe {
                            display: flex;
                            justify-content: space-between;
                            list-style: none;
                            padding: 0;
                            margin: 0 0 1rem 0;
                        }

                        .progress-bar-ioe li {
                            flex: 2;
                            position: relative;
                            padding: 0 0 14px 0;
                            font-size: var(--font-size-default);
                            line-height: 1.5;
                            color: var(--color-green);
                            font-weight: 600;
                            white-space: nowrap;
                            overflow: visible;
                            min-width: 0;
                            text-align: center;
                            border-bottom: 2px solid var(--color-gray-disabled);
                        }

                        .progress-bar-ioe li:first-child,
                        .progress-bar-ioe li:last-child {
                            flex: 1;
                        }

                        .progress-bar-ioe li:last-child {
                            text-align: right;
                        }

                        .progress-bar-ioe li:before {
                            content: "";
                            display: block;
                            width: 12px;
                            height: 12px;
                            background-color: var(--color-gray-disabled);
                            border-radius: 50%;
                            border: 2px solid var(--color-white);
                            position: absolute;
                            left: calc(50% - 6px);
                            bottom: -7px;
                            z-index: 3;
                            transition: all .2s ease-in-out;
                        }

                        .progress-bar-ioe li:first-child:before {
                            left: 0;
                        }

                        .progress-bar-ioe li:last-child:before {
                            right: 0;
                            left: auto;
                        }

                        .progress-bar-ioe span {
                            transition: opacity .3s ease-in-out;
                            margin-left: -35px;
                        }

                        .progress-bar-ioe li:not(.is-active) span {
                            opacity: 0;
                            margin-left: -35px;
                        }

                        .progress-bar-ioe .is-complete:not(:first-child):after,
                        .progress-bar-ioe .is-active:not(:first-child):after {
                            content: "";
                            display: block;
                            width: 100%;
                            position: absolute;
                            bottom: -2px;
                            left: -50%;
                            z-index: 2;
                            border-bottom: 2px solid var(--color-green);
                        }

                        .progress-bar-ioe li:last-child span {
                            width: 200%;
                            display: inline-block;
                            position: absolute;
                            left: -100%;
                        }

                        .progress-bar-ioe .is-complete:last-child:after,
                        .progress-bar-ioe .is-active:last-child:after {
                            width: 200%;
                            left: -100%;
                        }

                        .progress-bar-ioe .is-complete:before {
                            background-color: var(--color-green);
                        }

                        .progress-bar-ioe .is-active:before,
                        .progress-bar-ioe li:hover:before,
                        .progress-bar-ioe .is-hovered:before {
                            background-color: var(--color-white);
                            border-color: var(--color-green);
                        }

                        .progress-bar-ioe li:hover:before,
                        .progress-bar-ioe .is-hovered:before {
                            transform: scale(1.33);
                        }

                        .progress-bar-ioe li:hover span,
                        .progress-bar-ioe li.is-hovered span {
                            opacity: 1;
                        }

                        .progress-bar-ioe:hover li:not(:hover) span {
                            opacity: 0;
                        }

                        .x-ray .progress-bar-ioe,
                        .x-ray .progress-bar-ioe li {
                            border: 1px dashed red;
                        }

                        .progress-bar-ioe .has-changes {
                            opacity: 1 !important;
                        }

                        .progress-bar-ioe .has-changes:before {
                            content: "";
                            display: block;
                            width: 8px;
                            height: 8px;
                            position: absolute;
                            left: calc(50% - 4px);
                            bottom: -20px;
                            background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%208%208%22%3E%3Cpath%20fill%3D%22%23ed1c24%22%20d%3D%22M4%200l4%208H0z%22%2F%3E%3C%2Fsvg%3E');
                        }
                    </style>
                    <section>
                    <h2>Quá trình luyện thi của bạn</h2>

                    <ol class="progress-bar-ioe" id="progressx">
                        @foreach ($round_pass as $item)
                            <li class="is-complete"><span>{{ $item->round->name }} (đã hoàn thành)</span></li>
                        @endforeach
                        @if (isset($not_pass_rounds->first()->name))
                            <li class="is-active"><span>{{ $not_pass_rounds->first()->name }} (hiện tại)</span></li>
                        @endif
                        @if ($not_pass_rounds->skip(1)->count() > 0)
                            @foreach ($not_pass_rounds->skip(1) as $item)
                                <li><span>{{ $item->name }} (chưa hoàn thành)</span></li>
                            @endforeach
                        @endif
                    </ol>
                    </section>
                </div>
            </div>
            <div class="my-ioe">
                <div class="row align-items-stretch">
                    <div class="col-sm-3">
                        <div class="myioe-l-content">
                            <div class="myioe-user">    
                                <span class="myioe-username">{{ Auth::guard('web')->user()->name }}</span>
                                <span class="myioe-coin">ID: <span>{{ Auth::guard('web')->user()->id }}</span></span>
                                <span class="myioe-coin">Trình độ: <span>N{{ Auth::guard('web')->user()->level }}</span></span>
                                <span class="myioe-coin">Địa chỉ: <span>{{ Auth::guard('web')->user()->address }}</span></span>
                                <span class="myioe-coin">Email: <span>{{ Auth::guard('web')->user()->email }}</span></span>
                            </div>
                            
                            <ul class="myioe-leftmenu" id="accordion">
                                <li data-toggle="collapse" data-target="#myioemenu1" aria-expanded="true" aria-controls="collapseOne" class="collapsed">
                                    <div class="myioe-leftmenu-list">
                                        <span><i class="material-icons">assignment_ind</i>Tài khoản</span>
                                        <i class="material-icons ic-showless">unfold_less</i>
                                        <i class="material-icons ic-showmore">unfold_more</i>
                                    </div>

                                    <ul id="myioemenu1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <li >
                                            <a href="{{ route('results') }}"><i class="material-icons-round">arrow_right</i>Lịch sử điểm thi</a>
                                        </li>
                                        <li >
                                            <a href="{{ route('acount.get', Auth::guard('web')->user()->id) }}" class=""><i class="material-icons-round">arrow_right</i>Thông tin tài khoản</a>
                                        </li>
                                    </ul>
                                </li>
                                <li data-toggle="collapse" data-target="#myioemenu2" aria-expanded="false" aria-controls="collapseOne" class="">
                                    <div class="myioe-leftmenu-list">
                                        <span><i class="material-icons">assignment_ind</i>Học viên</span>
                                        <i class="material-icons ic-showless">unfold_less</i>
                                        <i class="material-icons ic-showmore">unfold_more</i>
                                    </div>

                                    <ul id="myioemenu2" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                                        <li >
                                            <a href="{{ route('self-training') }}" class=""><i class="material-icons-round">arrow_right</i>Luyện thi</a>
                                        </li>
                                        <li >
                                            <a href="" class=""><i class="material-icons-round">arrow_right</i>Kết quả thi</a>
                                        </li>
                                        <li >
                                            <a href="{{ route('get.ranking') }}" class=""><i class="material-icons-round">arrow_right</i>Bảng xếp hạng Tổng</a>
                                        </li>
                                        <li >
                                            <a href="{{ route('lists.video') }}" class=""><i class="material-icons-round">arrow_right</i>Video chữa đề thi</a>
                                        </li>
                                        <li >
                                            <a href="{{ route('user.get_feedback') }}" class=""><i class="material-icons-round">arrow_right</i>Góp ý hệ thống</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>    
                        </div>
                    </div>
    
                    <div class="col-sm-9">
                        <div class="myioe-r-content">
                            <script>
                                $(function () {
                                    $("a").click(function () {
                                        $('.selected').removeClass("selected");
                                    })
                                })
                            </script>
                            <div class="ioe-news">
                                <div class="row">
                                    <span class="tit-18" style="margin-bottom:20px;     padding-left: 15px;">LỊCH SỬ ĐIỂM THI CÁC VÒNG</span>
                                    <div class="col-sm-12">
                                        <ul class="sub-user-info" style="margin-top: -15px;
                                        ">
                                        @if (count($round_pass) == 0)
                                            <li>
                                                <span>Xếp hạng của bạn: 
                                                    <span>-- / --</span>
                                                <span>
                                            </li>
                                        </ul>
                                        <p style="text-align: center; font-size: 17px; font-weight: 500; color: grey;">Hiện tại bạn chưa tham gia vòng thi nào.</p>
                                        @else 
                                            <li>
                                                <span>Xếp hạng của bạn: 
                                                    <span>{{ $userIndex + 1 }} / {{ $users_level->count() }}</span>
                                                </span> 
                                            </li>
                                        </ul>
                                        <div class="ioe-tbl">
                                            <table>
                                                <tbody>
                                                    <tr style="text-align: center;">
                                                        <th>STT</th>
                                                        <th>Vòng thi</th>
                                                        <th>Thời gian thi</th>
                                                        <th>Điểm</th>
                                                    </tr>
                                                    @foreach ($round_pass as $key => $item)
                                                        <tr style="text-align: center;">
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $item->round->name }}</td>
                                                            <?php 
                                                                $minutes = floor(($item->time / 60) % 60);
                                                                $seconds = $item->time % 60;
                                                            ?>
                                                            <td>{{ $minutes }} phút {{ $seconds }} giây</td>
                                                            <td class="ioe-blue-color">
                                                                <strong>{{ $item->point }}</strong>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                              
                            <div class="myioe-note" style="padding:0px">
                                <span class="tit-18">BẢNG XẾP HẠNG TRÌNH ĐỘ N{{ Auth::guard('web')->user()->level }}</span>                            
                                <div class="myioe-r-info">
                                    <div class="row">
                                        @if (isset($last_round))
                                            <div class="col-sm-6">
                                                <div class="myioe-banks" style="background:#fff">
                                                    <span class="new_float_icon"><img src={{ asset("/Themes/v1/images/icon1.jpg") }}></span>
                                                    <label class="xhtl" style="text-transform: uppercase;">XẾP HẠNG LUYỆN THI {{ $last_round->round->name }}</label>         
                                                    <div class="ioe-tbl-static">
                                                        <table>
                                                            <tbody>
                                                                @foreach ($user_pass_last_round as $key => $item)
                                                                    <tr>
                                                                        <td>{{ $key + 1 }}</td>
                                                                        <td class="xhtl_link_top">{{ $item->user->name }}</td>
                                                                        <td>{{ $item->point }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>                       
                                                </div>
                                            </div>
                                        @endif 
                            
                                        <div class="col-sm-6">
                                            <div class="myioe-banks" style="background:#fff">                       
                                                <span class="new_float_icon"><img src={{ asset("/Themes/v1/images/icon2.jpg") }}></span>
                                                <label class="xhtl">XẾP HẠNG TỔNG ĐIỂM</label>
                                                <div class="ioe-tbl-static">
                                                    <table>
                                                        <tbody>
                                                            @foreach ($top5 as $key => $item)
                                                                    <tr>
                                                                        <td>{{ $key + 1 }}</td>
                                                                        <td class="xhtl_link_top">{{ $item->user->name }}</td>
                                                                        <td>{{ $item->sum }}</td>
                                                                    </tr>
                                                                @endforeach
                                                        </tbody>
                                                    </table>
                                                </div> 
                                            </div>
                                        </div>                                                   
                                    </div>                            
                                </div>                                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
