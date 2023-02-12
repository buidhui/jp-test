@include('frontend.layouts.head')

<body>
<div class="login-page">
    <div class="container">
        <div class="login-container">
            <div class="login-content">
                <div class="row">
                    <div class="col-12">
                        <div class="login-header">
                            <a href="{{ asset('/') }}" class="login-logo"><img src="{{ asset("Themes/v1/images/logo_jpt.png") }}" alt=""></a>
                            <a href="{{ asset('/') }}" class="login-btn-admin">Trang chủ</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5">
                        <div class="login-info" style="margin-top: 15px;">
                            <div class="login-txt" style="margin-bottom: 0;">
                                <span><span>Welcome to</span><b style="color: #4978bc;">Japanese Proficiency of Test</b></span>
                            </div>
                        </div>

                        <div class="login-info" style="margin-top: 15px;">
                            <div class="login-txt" style="margin-bottom: 0;">
                                <span style="font-size: 25px; color: #545454"><b>Đăng ký tài khoản học viên</b></span>
                            </div>
                            <font color="red"><label id="error-message"> @include("messages")
                                </label></font>
                        </div>

                        <form action="{{ route('post_registration_student') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <ul class="login-input">
                                <li>
                                    <div class="ioe-input">
                                        <label>Họ và tên</label>
                                        <input required type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Họ và tên">
                                    </div>
                                </li>

                                <li>
                                    <div class="ioe-input">
                                        <label>Email</label>
                                        <input required type="email" id="Email" name="email" value="{{ old('email') }}" placeholder="Email">
                                    </div>
                                </li>


                                <li>
                                    <div class="ioe-input">
                                        <label>Mật khẩu</label>
                                        <input min="6" required type="password" id="password" name="password" value="{{ old('password') }}" placeholder="Password">
                                    </div>
                                </li>

                                <li>
                                    <div class="input-group ioe-input date" id="datetimepickerbirthday">
                                        <label>Ngày sinh</label>
                                        <input  required type="date" id="birthday" name="birthday" class="form-control"
                                                value="" placeholder="dd/mm/yyyy">
                                        <span class="input-group-addon datetimepicker-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </span>
                                    </div>
                                </li>

                                <li>
                                    <div class="ioe-input">
                                        <label>Địa chỉ</label>
                                        <input required type="text" id="address" name="address" value="{{ old('address') }}" placeholder="Nhập tên quận/huyện, tỉnh/thành phố...">
                                    </div>
                                </li>

                                <li>
                                    <div class="dropdown" id="gender_dropdown">
                                        <label class="ioe-dropdown-lable">Giới tính</label>
                                        <select required name="sex" id="" class="form-control">
                                            <option value="1">Nam</option>
                                            <option value="0">Nữ</option>
                                        </select>
                                    </div>
                                </li>

                                <li>
                                    <div class="dropdown" id="gender_dropdown">
                                        <label class="ioe-dropdown-lable">Level</label>
                                        <select required name="level" id="" class="form-control">
                                            <option value="1">N1</option>
                                            <option value="2">N2</option>
                                            <option value="3">N3</option>
                                            <option value="4">N4</option>
                                            <option value="5">N5</option>
                                        </select>
                                    </div>
                                </li>

                                <li>
                                    <a href="">
                                        <button class="btn-gra-blue-36" style="border: none; outline: none" type="submit" id="btnupdateinfo">Đăng ký tài khoản</button>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('user.login') }}" class="btn-txt-black-36">Đăng nhập</a>
                                </li>

                                <li>
                                    <a href="" class="btn-txt-black-36">Quên mật khẩu</a>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="login-footer">
            </div>
        </div>
    </div>
</div>
</body>
