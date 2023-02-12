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
                                Danh sách câu hỏi
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 10%;">STT</th>
                                <th style="text-align: center; width: 20%">Dạng câu hỏi</th>
                                <th style="text-align: center; width: 40%;">Nội dung câu hỏi thi</th>
                                <th style="text-align: center; width: 15%">Giáo viên ra đề</th>
                                @if (Auth::guard('admin')->check())
                                    <th style="text-align: center; width: 15%">Bài thi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $key => $item)
                            <tr role="row" class="odd">
                                <td style="vertical-align: inherit; text-align: center;">{{ $key + 1 }}</td>
                                <td style="vertical-align: inherit;">{{ $item->test->cate->name }}</td>
                                <td style="vertical-align: inherit;">{!! $item->name !!}</td>
                                <td style="vertical-align: inherit;">{{ $item->test->teacher->name }}</td>
                                @if (Auth::guard('admin')->check())
                                    <td style="vertical-align: inherit; text-align: center;">
                                        <a href="{{ route("question.list", $item->test->id) }}" target="_blank">
                                            {{ $item->test->name }} - {{ $item->test->round->name }} - N{{ $item->test->round->level }}
                                        </a>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="text-align: center; width: 10%;">STT</th>
                                <th style="text-align: center; width: 20%">Dạng câu hỏi</th>
                                <th style="text-align: center; width: 40%;">Nội dung câu hỏi thi</th>
                                <th style="text-align: center; width: 15%">Giáo viên ra đề</th>
                                @if (Auth::guard('admin')->check())
                                    <th style="text-align: center; width: 15%">Bài thi</th>
                                @endif
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
