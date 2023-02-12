@extends('frontend.master')
@section("content")
    <div class="ioe-page">
        <div class="container">
            @include('frontend.layouts.menu')

            <div class="row">
                <div class="col-2">
                    <div class="tit-page">
                        <span>Luyện thi tự do</span>
                    </div>
                </div>

                <div class="col-10">
                    <div class="tit-page">
                        <form action="" method="post">
                            @csrf
                            <div class="row" style="margin-bottom:-10px;">        
                                <div class="col-sm-3" style="margin-bottom:10px;">
                                    <div class="box" style="position:initial;top:0;left:0;transform:none;margin-top:0">
                                        <select id="roundlevel" style="width:100%;max-width:100%" name="level" required>
                                            <option value="" style="font-size: 14px;">Chọn cấp độ</option>
                                            <option value="1" style="font-size: 14px;">N1</option>
                                            <option value="2" style="font-size: 14px;">N2</option>
                                            <option value="3" style="font-size: 14px;">N3</option>
                                            <option value="4" style="font-size: 14px;">N4</option>
                                            <option value="5" style="font-size: 14px;">N5</option>
                                        </select>
                                    </div>
                                </div>
            
                                <div class="col-sm-4" style="margin-bottom:10px;">
                                    <div class="box" style="position:initial;top:0;left:0;transform:none;margin-top:0">
                                        <select name="cate_test" id="" style="width:100%;max-width:100%" required>
                                            <option value="" style="font-size: 14px;">Chọn dạng bài thi</option>
                                            @foreach($cate_tests as $item)
                                                <option value="{{$item->id}}" style="font-size: 14px;">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
            
                                <div class="col-sm-3" style="margin-bottom:10px;">
                                    <div class="box" style="position:initial;top:0;left:0;transform:none;margin-top:0">
                                        <select id="block" style="width:100%;max-width:100%" name="qty" required>
                                            <option value="" style="font-size: 14px;">Chọn Số lượng</option>
                                            <option value="5" style="font-size: 14px;">5 câu hỏi</option>
                                            <option value="10" style="font-size: 14px;">10 câu hỏi</option>
                                            <option value="15" style="font-size: 14px;">15 câu hỏi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2" style="margin-bottom:10px; text-align: right;">
                                    <button style="border:none;padding:9px;background-color:#70ac62;color:white; width: 100%;"
                                    onclick="XEMKETQUA();">LUYỆN THI
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ioe-page-container" style="padding:20px 0 100px 0;">
        <div class="container">
            <div class="ioe-news" style="margin-bottom:10px">
                <div class="row">
                    <div class="col-sm-3">

                    </div>
                    <div class="col-sm-6">
                        <?php 
                            $data = Session::get('data');
                        ?>
                        @if ($data != null)
                            <div class="row" style="border: 3px solid grey; padding-top: 10px;">
                                <div class="col-sm-12" id="quiz">
                                    @foreach ($data as $key => $item)
                                        <div data-id="{{ $item->id }}">
                                            <p style="font-size: 20px; margin-bottom: 0"><b>Câu hỏi {{ $key + 1 }}:</b></p>
                                            {!! $item->name !!}
                                            <div class="radio" style="margin-top: 20px">
                                                <div style="display: flex">
                                                    <label style="font-size: 18px;">
                                                        <input type="radio" name="q{{ $key + 1 }}" style="width: 15px; height: 15px; margin-right: 10px;" value="A" data-id="{{ $item->id }}_A">{{ $item->answera }}
                                                    </label>
                                                </div>
                                            </div>                                        
                            
                                            <div class="radio" style="margin-top: 20px">
                                                <div style="display: flex">
                                                    <label style="font-size: 18px;">
                                                        <input type="radio" name="q{{ $key + 1 }}" style="width: 15px; height: 15px; margin-right: 10px;" value="B" data-id="{{ $item->id }}_B">{{ $item->answerb }}
                                                    </label>
                                                </div>
                                            </div>     

                                            <div class="radio" style="margin-top: 20px">
                                                <div style="display: flex">
                                                    <label style="font-size: 18px;">
                                                        <input type="radio" name="q{{ $key + 1 }}" style="width: 15px; height: 15px; margin-right: 10px;" value="C" data-id="{{ $item->id }}_C">{{ $item->answerc }}
                                                    </label>
                                                </div>
                                            </div>     

                                            <div class="radio" style="margin-top: 20px">
                                                <div style="display: flex">
                                                    <label style="font-size: 18px;">
                                                        <input type="radio" name="q{{ $key + 1 }}" style="width: 15px; height: 15px; margin-right: 10px;" value="D" data-id="{{ $item->id }}_D">{{ $item->answerd }}
                                                    </label>
                                                </div>
                                            </div>  

                                            <input class="correct-answer" style="display: none" data-id="{{ $item->id }}" name="{{ $item->id }}_answer" value="{{ $item->answer_true }}">
                                        </div>
                                    @endforeach
                                    <a id="scoreButton" class="btn-result-search" style="width: 35%;
                                    color: white; font-size: 18px; margin: 10px 0 20px 0;">Kiểm tra đáp án</a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </div>
        </div>
    </div>

    <script>  
        $(document).ready(function () {
            var list_answers = [];
            var rads, quiz;

            $('.correct-answer').each(function(){
                a = $(this).val();
                list_answers.push(a); 
            });

            quiz = document.getElementById("quiz");
            rads = quiz.querySelectorAll("input[type=radio]");
            document.getElementById("scoreButton").addEventListener("click",function(e) { 
                for (var i=0; i<rads.length; i++) { 
                    var rad = rads[i];
                    var idx = rad.name.substring(1)-1; 
                    var checked = rad.checked;
                    var correct = rad.value==list_answers[idx];
                    
                    if (correct) {
                        rad.closest("label").classList.toggle("correct");
                    }  
                    else if (checked) {
                        rad.closest("label").classList.toggle("error")
                    }  
                }
            });              
        });
    </script>
@endsection
