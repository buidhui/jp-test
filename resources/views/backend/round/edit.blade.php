@extends('backend.master')

@section("title-page", "Sửa thông tin vòng thi")
@section('content')
    <?php $open = "round"?>
    <div class="row">
        <form action="{{ route("round.post_edit",$round->id ) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-9">
                <div class="form-group">
                    <label for="">Tên vòng thi</label>
                    <input required type="text" name="name" id="name" class="form-control" placeholder="Name..." value="{{$round['name']}}">
                </div>

                <div class="form-group">
                    <label for="">Trình độ</label>
                    <select name="level" id="" class="form-control">
                        <option value="1" @if($round->level == 1) selected @endif>N1</option>
                        <option value="2"  @if($round->level == 2) selected @endif>N2</option>
                        <option value="3"  @if($round->level == 3) selected @endif>N3</option>
                        <option value="4"  @if($round->level == 4) selected @endif>N4</option>
                        <option value="5"  @if($round->level == 5) selected @endif>N5</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="">Thời gian mở vòng thi</label>
                    <input min="{{date('Y-m-d')}}" required max="2100-01-01" type="date" name="starting_time" id="starting_time" class="form-control" placeholder="dd-mm-yyyy" value="{{ $round['starting_time'] }}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
        </form>
    </div>
@endsection
