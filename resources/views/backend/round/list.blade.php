@extends('backend.master')

@section("title-page", "Quản lý vòng thi")
@section('content')
    <?php $open = "round"?>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header" style="border-bottom: 1px solid rgba(0,0,0,.125);">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="box-title">Danh sách vòng thi</h3>
                        </div>
                        <div class="col-sm-6" style="text-align: right;">
                            <a href="{{ route("round.get_add") }}">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 5%;">STT</th>
                                <th style="text-align: center; width: 25%;">Tên vòng thi</th>
                                <th style="text-align: center; width: 15%;">Trình độ</th>
                                <th style="text-align: center; width: 40%;">Thời gian mở vòng thi</th>
                                <th style="text-align: center; width: 25%;">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($round as $key => $item)
                            <tr role="row" class="odd">
                                <td style="text-align: center;">{{ $key + 1 }}</td>
                                <td style="text-align: center;">{{ $item->name }}</td>
                                <td style="text-align: center;">N{{ $item->level }}</td>
                                <td style="text-align: center;">{{  date('d/m/Y', strtotime($item->starting_time))}}</td>
                                <td style="text-align: center;">
                                    <a href="{{ route("round.get_edit", $item->id) }}" class="btn btn-xs btn-primary">
                                        <i class="fa fa-edit"></i> Sửa
                                    </a>
                                    <a data-toggle="modal" data-target="#delete_{{$item->id}}" href=""  class="btn btn-xs  btn-danger"> 
                                        <i class="fa fa-trash"></i> Xóa
                                    </a>
                                    @include('backend.round.delete')
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="text-align: center; width: 5%;">STT</th>
                                <th style="text-align: center; width: 25%;">Tên vòng thi</th>
                                <th style="text-align: center; width: 15%;">Trình độ</th>
                                <th style="text-align: center; width: 40%;">Thời gian mở vòng thi</th>
                                <th style="text-align: center; width: 25%;">Hành động</th>
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
