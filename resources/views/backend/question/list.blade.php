@extends('backend.master')

@section("title-page", "Quản lý câu hỏi thi")
@section('content')
    <?php $open = "test"?>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header" style="border-bottom: 1px solid rgba(0,0,0,.125);">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="box-title">
                                Danh sách câu hỏi {{ $test->name }} - {{ $test->round->name }} - N{{ $test->round->level }}
                            </h3>
                        </div>
                        <div class="col-sm-6" style="text-align: right;">
                            @if (count($questions) == $test->number_questions)
                                <a href="" style="cursor: not-allowed! important; color: grey;" onclick="return false;">
                                    <i class="fa fa-plus"></i>
                                </a>
                            @else
                                <a href="{{ route("question.get_add", $id) }}">
                                    <i class="fa fa-plus"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="box-body">
                    <h3 class="box-title" style="font-size: 20px;">Tiến độ ra đề thi: {{count($questions)}} / {{ $test->number_questions}} Câu hỏi</h3>
                    <div class="progress" style="margin-bottom: 30px;">
                        <?php
                            $width = count($questions) / $test->number_questions * 100;
                        ?>
                        @if ($width <= 30)
                            <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: {{ $width }}%"></div>
                        @elseif ($width > 30 && $width <=70)
                            <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: {{ $width }}%"></div>
                        @else
                            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: {{ $width }}%"></div>
                        @endif    
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 10%;">STT</th>
                                <th style="text-align: center; width: 60%;">Nội dung câu hỏi thi</th>
                                <th style="text-align: center; width: 30%">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $key => $item)
                            <tr role="row" class="odd">
                                <td style="vertical-align: inherit; text-align: center;">{{ $key + 1 }}</td>
                                <td style="vertical-align: inherit;">{!! $item->name !!}</td>
                                <td style="vertical-align: inherit; text-align: center;">
                                    <a href="{{ route("question.get_edit", ['id_test' => $id,'id' =>$item->id]) }}" class="btn btn-xs btn-primary">
                                        <i class="fa fa-edit"></i> Sửa
                                    </a>
                                    <a data-toggle="modal" data-target="#delete_{{$item->id}}" href=""  class="btn btn-xs  btn-danger"> 
                                        <i class="fa fa-trash"></i> Xóa
                                    </a>
                                    @include('backend.question.delete')
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="text-align: center; width: 10%;">STT</th>
                                <th style="text-align: center; width: 60%;">Nội dung câu hỏi thi</th>
                                <th style="text-align: center; width: 30%">Hành động</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div> 
@endsection

@section("script")
    <script>
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
