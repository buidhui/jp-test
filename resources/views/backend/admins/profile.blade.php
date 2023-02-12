@extends('backend.master')

@section("title-page", "Quản lý tài khoản")
@section("title-description", "Chỉnh sửa
")
@section('content')

    <?php $open = "user"?>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
    </script>

    <div class="row">
{{--        @include("messages")--}}
        <div class="col-md-12">
            @foreach ($errors->all() as $error)
                <p class="text-danger">{{ $error }}</p>
            @endforeach
        </div>

        <form method="POST" action="{{ route('change.password') }}">
            @csrf


            <div class="col-md-9">

                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name..."
                           value="{{ Auth::guard('admin')->user()->name }}">
                </div>


                <div class="form-group">
                    <label for="">Email</label>
                    <input disabled type="email" name="email" id="email" class="form-control" placeholder="Email..."
                           value="{{ Auth::guard('admin')->user()->email }}">
                </div>

                <div class="form-group">
                    <label for="">Current Password</label>
                    <input type="password" name="current_password" id="password" class="form-control" placeholder="Current Password..."
                           value="{{old('current_password')}}">
                </div>

                <div class="form-group">
                    <label for="">New Password</label>
                    <input   type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password..."
                           value="{{old('new_password')}}">
                </div>

                <div class="form-group">
                    <label for="">New Confirm Password</label>
                    <input   type="password" name="new_confirm_password" id="new_confirm_password" class="form-control" placeholder="New Confirm Password..."
                             value="{{old('new_confirm_password')}}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>

                </div>

            </div>


        </form>
    </div>
@endsection
@section("script")
    <script>
        function xoa_dau(str) {
            str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
            str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
            str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
            str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
            str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
            str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
            str = str.replace(/đ/g, "d");
            str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
            str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
            str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
            str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
            str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
            str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
            str = str.replace(/Đ/g, "D");
            str = str.replace(/\s/g, '-');
            return str;
        }


    </script>
@endsection
