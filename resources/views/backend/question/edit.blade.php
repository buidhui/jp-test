@extends('backend.master')

@section("title-page", "Sửa thông tin câu hỏi")
<?php $open = "test"?>

@section('content')
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
        <form action="{{ route("question.get_edit", ['id_test'=> $id_test, 'id'=>$question->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-9">
                <div class="form-group">
                    <label for="">Nội dung câu hỏi</label>
                    <textarea required type="text" name="name" id="name" class="form-control" placeholder="Tiêu đề câu hỏi" value="{{$question['name']}}"> {{ $question['name'] }}</textarea>
                    <script>
                        // Replace the <textarea id="editor1"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace('name', options);
                    </script>
                </div>

                <div class="form-group">
                    <label for="">Đáp án A</label>
                    <input type="text" class="form-control"  oninvalid="this.setCustomValidity('Đáp án không được bỏ trống')" oninput="setCustomValidity('')" name="answera" placeholder="Đáp án A" value="{{$question['answera']}}" required>
                </div>

                <div class="form-group">
                    <label for="">Đáp án B</label>
                    <input type="text" class="form-control"  oninvalid="this.setCustomValidity('Đáp án không được bỏ trống')"  oninput="setCustomValidity('')" name="answerb" placeholder="Đáp án B" value="{{$question['answerb']}}" required>
                </div>

                <div class="form-group">
                    <label for="">Đáp án C</label>
                    <input type="text" class="form-control"  oninvalid="this.setCustomValidity('Đáp án không được bỏ trống')" oninput="setCustomValidity('')" name="answerc" placeholder="Đáp án C" value="{{$question['answerc']}}" required>
                </div>

                <div class="form-group">
                    <label for="">Đáp án D</label>
                    <input type="text" class="form-control"  oninvalid="this.setCustomValidity('Đáp án không được bỏ trống')"  oninput="setCustomValidity('')" name="answerd" placeholder="Đáp án D" value="{{$question['answerd']}}" required>
                </div>

                <div class="form-group">
                    <label for="">Đáp án đúng</label>
                    <select name="answer_true" id="" class="form-control">
                        <option value="A" @if($question['answer_true'] == 'A') selected @endif>A</option>
                        <option value="B" @if($question['answer_true'] == 'B') selected @endif>B</option>
                        <option value="C" @if($question['answer_true'] == 'C') selected @endif>C</option>
                        <option value="D" @if($question['answer_true'] == 'D') selected @endif>D</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Lưu</button>
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
