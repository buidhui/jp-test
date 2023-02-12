<div class="menu-float-left">
    <ul>
        <li><a href="{{ asset('/') }}" class="ioe-blue-bg"><i class="material-icons">school</i>Về JPT</a></li>
        <li><a href="{{ route('self-training') }}" class="ioe-green-bg"><i class="material-icons">forum</i>Vào thi</a></li>
        <li><a href="https://www.facebook.com/VanHoang260598/" class="ioe-pink-bg" target="_blank"><i class="material-icons">share</i>Hỗ trợ</a></li>
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
                                    ĐƠN VỊ ĐỒNG HÀNH<br/>
                                    <img
                                        src={{ asset("Themes/v1/images/soict.png") }} style="margin-left:5px;height:31px;width:auto;margin-top:2px"
                                        alt="ĐƠN VỊ ĐỒNG HÀNH"/>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="ioe-header-btn">
                        <div class="show_hide_right_menu">
                            <a href="" class="ieo-header-btn-tu-luyen-ioe">0814.090.456</a>
                            <span
                                style="font-size: 10px;position:absolute;margin-top:-35px;background-color:yellow;padding-left: 8px;padding-right: 8px;text-align:center;">HỖ TRỢ</span>
                            <a href="{{ route('self-training') }}" class="ieo-header-btn-thi-thu-ioe">Luyện
                                Thi</a>
                        </div>
                        @if (Auth::guard('web')->check())
                            <div class="dropdown show">
                                <a href="{{ route('acount.get', Auth::guard('web')->user()->id) }}" class="ieo-header-btn-login" id="myIOeMenu" aria-expanded="true">
                                    <i class="material-icons-round">person</i>{{ Auth::guard('web')->user()->name }}
                                </a>
                            </div>
                            <a href="{{ route('logout') }}" class="ioe-header-btn-register" id="id-header-logout">Thoát</a>
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

    <div class="container">
        <div class="ioe-header-banner">
            <div class="row align-items-center">
                <div class="col-3">
                    <a href="{{ asset('/') }}" class="ioe-header-logo"><img
                            src="{{ asset("Themes/v1/images/logo_jpt.png") }}" alt="Trang chủ"></a>
                </div>
                <div class="col-8">
                    <span class="ioe-white-color">
                        <b style="font-size: 30px; margin-left: -120px;">Welcome to Japanese Proficiency of Test</b>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
