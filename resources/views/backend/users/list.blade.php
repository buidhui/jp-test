@extends('backend.master')

@section("title-page", "Quản lý học viên")
@section('content')
    <?php $open = "users"?>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header" style="border-bottom: 1px solid rgba(0,0,0,.125);">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="box-title">Danh sách học viên</h3>
                        </div>
                        <div class="col-sm-6" style="text-align: right;">
                            <a href="{{ route("users.get_add") }}">
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
                                <th style="width: 20%;">Tên học viên</th>
                                <th style="text-align: center; width: 10%;">Trình độ</th>
                                <th style="width: 20%;">Email</th>
                                <th style="width: 30%;">Địa chỉ</th>
                                <th style="text-align: center; width: 15%">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $item)
                            <tr role="row" class="odd">
                                <td style="text-align: center;">{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td style="text-align: center;">N{{ $item->level }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->address }}</td>
                                <td style="text-align: center;">
                                    <a data-toggle="modal" data-target="#delete_{{$item->id}}" href=""  class="btn btn-xs  btn-danger"> 
                                        <i class="fa fa-trash"></i> Xóa
                                    </a>
                                    @include('backend.users.delete')
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Tên học viên</th>
                                <th>Trình độ</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                <th style="text-align: center;">Hành động</th>
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
