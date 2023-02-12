@extends('backend.master')

@section("title-page", "Quản lý bài thi")
@section('content')
    <?php $open = "tests"?>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header" style="border-bottom: 1px solid rgba(0,0,0,.125);">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="box-title">Danh sách bài thi được phân công</h3>
                        </div>
                    </div>
                </div>

                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 5%;">STT</th>
                                <th style="width: 12%;">Tên bài thi</th>
                                <th style="width: 28%;">Dạng bài thi</th>
                                <th style="text-align: center; width: 10%;">Vòng thi</th>
                                <th style="text-align: center; width: 25%;">Tiến độ</th>
                                <th style="text-align: center; width: 20%">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tests as $key => $item)
                            <tr role="row" class="odd">
                                <td style="vertical-align: inherit; text-align: center;">{{ $key + 1 }}</td>
                                <td style="vertical-align: inherit;">{{ $item->name }}</td>
                                <td style="vertical-align: inherit">{{ $item->cate->name }}</td>
                                <td style="vertical-align: inherit;">{{ $item->round->name }} - N{{ $item->round->level }}</td>
                                <td style="vertical-align: inherit; text-align: center;">
                                    <div class="progress progress-sm active">
                                        <?php
                                            $questions = DB::table('question')->where('test_id', $item->id)->get();
                                            $width = count($questions) / $item->number_questions * 100;
                                        ?>      
                                        @if ($width <= 30)
                                            <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: {{ $width }}%"></div>
                                        @elseif ($width > 30 && $width <=70)
                                            <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: {{ $width }}%"></div>
                                        @else
                                            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: {{ $width }}%"></div>
                                        @endif                   
                                    </div>
                                </td>
                                <td style="vertical-align: inherit; text-align: center;">
                                    <a href="{{ route("question.list", $item->id) }}" class="btn btn-xs btn-warning">
                                        <i class="fa fa-question"></i> Câu hỏi
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="text-align: center; width: 5%;">STT</th>
                                <th style="width: 12%;">Tên bài thi</th>
                                <th style="width: 28%;">Dạng bài thi</th>
                                <th style="text-align: center; width: 10%;">Vòng thi</th>
                                <th style="text-align: center; width: 25%;">Tiến độ</th>
                                <th style="text-align: center; width: 20%">Hành động</th>
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
