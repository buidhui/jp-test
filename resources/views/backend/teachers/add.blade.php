@extends('backend.master')

@section("title-page", "Thêm giáo viên mới")
@section('content')
    <?php $open = ""?>
    <div class="row">
        @include("messages")
        <form action="{{ route("teachers.post_add") }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-9">
                <div class="form-group">
                    <label for="">Họ tên</label>
                    <input required type="text" name="name" id="name" class="form-control" style="width: 50%" placeholder="Nhập họ và tên..." value="{{old('name')}}">
                </div>

                <div class="form-group">
                    <label for="">Email</label>
                    <input required type="email" name="email" id="email" class="form-control" style="width: 50%" placeholder="Nhập địa chỉ email..." value="{{old('email')}}">
                </div>

                <div class="form-group">
                    <label for="">Ngày sinh</label>
                    <input required type="date" name="date_of_birth" id="date_of_birth" class="form-control" style="width: 50%" placeholder="Ngày sinh" value="{{old('date_of_birth')}}">
                </div>

                <div class="form-group">
                    <label for="">Giới tính</label>
                    <select name="sex" id="" class="form-control" style="width: 50%" required>
                        <option class="form-control" value="0">Nữ</option>
                        <option class="form-control" value="1">Nam</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input class="form-control" style="width: 50%" required type="text" id="name" name="phone" value="{{ old('phone') }}" placeholder="Số điện thoại">
                </div>

                <div class="form-group">
                    <label>Hồ sơ</label><br>
                    <input required type="file" class="form-control" style="width: 50%" id="CV" name="cv" accept="application/pdf">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </div>
       </form>
    </div>
@endsection
