<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Đăng nhập giáo viên</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset("backend/bower_components/bootstrap/dist/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("backend/bower_components/font-awesome/css/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{ asset("backend/bower_components/Ionicons/css/ionicons.min.css")}}">
    <link rel="stylesheet" href="{{ asset("backend/dist/css/AdminLTE.min.css")}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="icon" href="{{ asset("Themes/v1/images/logo_jpt.png") }}" type="image/gif" sizes="20x20">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-box-body">
        <h3 class="login-box-msg">Đăng nhập giáo viên</h3>

        <form action="{{ route('teacher-login') }}" method="post">
            @csrf
            @include("messages")
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" required value="{{ old('email') }}" name="email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="Password" required value="{{ old('password') }}">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
        </form>

    </div>
</div>
</body>
</html>
