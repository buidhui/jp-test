@extends('backend.master')

@section("title-page", "Thêm học viên mới")
@section('content')
    <?php $open = "users"?>
    <div class="row">
        @include("messages")
        <form action="{{ route("users.post_add") }}" method="post" enctype="multipart/form-data">
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
                    <label for="">Địa chỉ</label>
                    <input required type="text" name="address" id="address" class="form-control" style="width: 50%" placeholder="Nhập địa chỉ ..." value="{{old('address')}}">
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
                    <label for="">Trình độ</label>
                    <select required name="level" id="" class="form-control" style="width: 50%">
                        <option value="1">N1</option>
                        <option value="2">N2</option>
                        <option value="3">N3</option>
                        <option value="4">N4</option>
                        <option value="5">N5</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </div>
        </form>
    </div>
@endsection
