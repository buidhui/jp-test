@extends('backend.master')

@section("title-page", "Sửa thông tin bài thi")
@section('content')
    <?php $open = "test"?>
    <script>
        var options = {
            filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
            filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
            filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
            filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
            filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
            filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
        };
    </script>
    <div class="row">
        @include("messages")
        <form action="{{ route("test.post_edit", $test->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-9">
                <div class="form-group">
                    <label for="">Tên bài thi</label>
                    <input required type="text" name="name" id="name" class="form-control" style="width: 50%" placeholder="Nhập tên bài thi..." value="{{ $test->name }}">
                </div>

                <div class="form-group">
                    <div><label for="">Vòng thi</label></div>
                    <select name="round" id="" class="form-control select2" style="width: 50%">
                        @foreach($round as $item)
                            <option value="{{$item->id}}" @if( $test->round_id == $item->id ) selected @endif>
                                {{$item->name}} - N{{$item->level}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <div><label for="">Dạng bài thi</label></div>
                    <select name="cate_tests" id="" class="form-control select2" style="width: 50%">
                        @foreach($cate_tests as $item)
                            <option value="{{$item->id}}" @if( $test->cate_test_id == $item->id ) selected @endif>
                                {{$item->name}}                                
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <div><label for="">Giáo viên ra đề</label></div>
                    <select name="teachers" id="" class="form-control select2" style="width: 50%">
                        @foreach($teachers as $item)
                            <option value="{{$item->id}}" @if($test->teacher_id == $item->id) selected @endif>
                                {{$item->name}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Số câu hỏi trong bài thi</label>
                    <input required type="text" name="number_questions" id="name" class="form-control" style="width: 50%" placeholder="Số câu hỏi" value="{{ $test->number_questions }}">
                </div>

                <div class="form-group">
                    <label for="">Thời gian (số phút)</label>
                    <input required type="text" name="time" id="time" class="form-control" style="width: 50%" placeholder="Thời gian" value="{{ $test->time }}">
                </div>

                <div class="form-group">
                    <label for="">Video chữa đề</label><br>
                    @if($test->video_fix != null)
                        <video width="320" height="240" controls>
                            <source src="{{ asset('uploads/'.$test->video_fix) }}" type="video/mp4">
                        </video>
                    @else
                        <p>Chưa có video chữa đề</p>
                    @endif
                    <input type="file" name="file" accept="video/mp4,video/x-m4v,video/*">
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
