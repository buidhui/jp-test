@extends('backend.master')

@section("title-page", "Thêm vòng thi mới")
@section('content')
    <?php $open = "round"?>
    <div class="row">
        <form action="{{ route("round.post_add") }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-9">
                <div class="form-group">
                    <label for="">Tên vòng thi</label>
                    <input required type="text" name="name" id="name" class="form-control" style=" width: 50%"  placeholder="Nhập tên vòng thi..." value="{{old('name')}}">
                </div>
                
                <div class="form-group">
                    <label for="">Trình độ</label>
                    <select name="level" id="" class="form-control" style="width: 50%">
                        <option value="1">N1</option>
                        <option value="2">N2</option>
                        <option value="3">N3</option>
                        <option value="4">N4</option>
                        <option value="5">N5</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Thời gian mở vòng thi</label>
                    <input min="{{date('Y-m-d')}}" required max="2100-01-01" type="date" name="starting_time" id="starting_time" class="form-control" style="width: 50%" placeholder="dd-mm-yyyy" value="dd/mm/yyyy">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </div>
        </form>
    </div>
@endsection
