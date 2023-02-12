<!DOCTYPE html>
<html lang="vi">
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>JPT - Luyện thi Tiếng Nhật Online</title>

    <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i&amp;display=swap&amp;subset=latin-ext,vietnamese"
        rel="stylesheet">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500%7CMaterial+Icons%7CMaterial+Icons+Outlined%7CMaterial+Icons+Two+Tone%7CMaterial+Icons+Round%7CMaterial+Icons+Sharp">

    <script src="{{ asset('libjs/jquery/dist/jquery.js') }}"></script>
    <script src="{{ asset('libjs/popper.js-1.15.0/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('libjs/moment_2.24.0.js') }}"></script>
    <script src="{{ asset('libjs/pdfobject.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('libjs/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libjs/bootstrap/datepicker/css/bootstrap-datepicker.min.css') }}">
    <link rel="icon" href="{{ asset("Themes/v1/images/logo_jpt.png") }}" type="image/gif" sizes="20x20">
    <script src="{{ asset('libjs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('libjs/bootstrap/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('libjs/bootstrap/datepicker/locales/bootstrap-datepicker.vi.min.js') }}"></script>


    <link rel="stylesheet" href="{{ asset('Themes/v1/css/animate.css') }}"/>
    <link rel="stylesheet" href="{{ asset('Themes/v1/css/site_style10ad.css') }}"/>

    <script src="{{ asset('libjs/Loading.js') }}"></script>
    <script src="{{ asset('Themes/v1/js/SessionUpdater.js') }}"></script>
    <script src="{{ asset('Themes/v1/js/IOEMain47b3.js') }}"></script>
</head>
<body>
    @include('sweetalert::alert')

<noscript>
    <img height="1" width="1" style="display:none"
         src="https://www.facebook.com/tr?id=414348366335472&amp;ev=PageView&amp;noscript=1"/>
</noscript>
<!--facebook tracking-->
<div id="fb-root"></div>

<input type="hidden" id="RequestVerificationToken" name="RequestVerificationToken"
       value="CfDJ8A4n7LdbXjJIlwAIFHg9CkRDwvhCcTwVXBnN3K6ml99vNZaqYrPu-ukwvFpagA0th_eKAZKko7Csl9BY1V1Ce7btzWO5V4x0ZvDIcr1leqwYIn-7ZpbpEHWugEidHxwOaTTDT4P_ZSFG_NT036_gBNI">
<form action="{{route('login')}}" method="POST">
    @csrf
    <div class="login-page">
        <div class="container">
            <div class="login-container">

                <div class="login-content">
                    <input type="hidden" id="ur" value=""/>
                    <div class="row">
                        <div class="col-12">
                            <div class="login-header">
                                <a href="{{ asset('/') }}" class="login-logo"><img
                                        src="{{ asset("Themes/v1/images/logo_jpt.png") }}" alt=""></a>
                                <a href="{{ asset('/') }}" class="login-btn-admin">Trang chủ</a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5">
                            <div class="login-info">
                                <div class="login-txt">
                                    <span><span>Welcome to</span><b
                                            style="color: #4978bc;">Japanese Proficiency of Test</b></span>
                                </div>
                            </div>
                            @include("messages")
                            <ul class="login-input">
                                <li>
                                    <div class="ioe-input">
                                        <label>Email</label>
                                        <input type="email" id="email" name="email" placeholder="Email" oninvalid="if (this.value == ''){this.setCustomValidity('Email không được bỏ trống')} if (this.value != ''){this.setCustomValidity('Email không hợp lệ')}" oninput="setCustomValidity('')" required
                                               value="{{ old('email') }}">
                                    </div>
                                </li>
                                <li>
                                    <div class="ioe-input">
                                        <label>Mật khẩu</label>
                                        <input type="password" id="password" name="password" placeholder="Mật khẩu" oninvalid="this.setCustomValidity('Mật khẩu không được bỏ trống')"
                                        oninput="setCustomValidity('')"
                                               required>
                                    </div>
                                </li>
                                @if($errors->any())
                                    <li>
                                        <div class="login-captchar">
                                            <label style="color:red;">{{$errors->first()}}</label>
                                        </div>
                                    </li>
                                @endif
                                <li>
                                    <button type="submit" class="btn-gra-blue-36" id="btnlogin"
                                            style="border: none; outline: none">Đăng nhập
                                    </button>
                                </li>
                                <li style="margin-top:20px">

                                </li>

                                <li>
                                    <a href="{{ route('get_registration_student') }}" class="btn-txt-black-36">Đăng ký
                                        tài khoản</a>
                                </li>
                                <li>
                                    <a href="{{ route('get.forgot_password_user') }}" class="btn-txt-black-36">Quên mật khẩu</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div><!--END login-content-->

            </div><!--END login-container-->
            <div class="row">
                <div class="col-12">
                    <div class="login-footer">
                    </div>
                </div>
            </div>
        </div><!--END container-->

    </div><!--END login-page-->
</form>
</body>

</html>
