@extends('backend.master')

@section("title-page", "Quản lý giáo viên")
@section('content')
    <?php $open = "teachers"?>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header" style="border-bottom: 1px solid rgba(0,0,0,.125);">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="box-title">Danh sách giáo viên</h3>
                        </div>
                        <div class="col-sm-6" style="text-align: right;">
                            <a href="{{ route("teachers.get_add") }}">
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
                                <th style="width: 15%;">Tên giáo viên</th>
                                <th style="width: 15%;">Email</th>
                                <th style="text-align: center; width: 15%;">Số điện thoại</th>
                                <th style="text-align: center; width: 10%;">Hồ sơ</th>
                                <th style="text-align: center; width: 15%;">Trạng thái</th>
                                <th style="text-align: center; width: 15%">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teachers as $key => $item)
                            <tr role="row" class="odd">
                                <td style="text-align: center;">{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td style="text-align: center">{{ $item->phone }}</td>
                                <td style="text-align: center">
                                    @if($item->cv != null)
                                        <a target="_blank" href="{{ asset('uploads/cv/'.$item->cv) }}">Xem CV</a>
                                    @endif
                                </td>
                                <td style="text-align: center"> 
                                    @if($item->status == 1)
                                        <span class="label label-success">Đã xét duyệt<span>                                
                                    @else
                                        <span class="label label-warning">Chờ xét<span>                                    
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    @if($item->status != 1)
                                        <a data-toggle="modal" data-target="#approve_{{$item->id}}" href=""  class="btn btn-xs  btn-primary"> 
                                            <i class="fa fa-edit"></i> Xét duyệt
                                        </a>
                                        @include('backend.teachers.approve')
                                    @endif
                                    <a data-toggle="modal" data-target="#delete_{{$item->id}}" href=""  class="btn btn-xs  btn-danger"> 
                                        <i class="fa fa-trash"></i> Xóa
                                    </a>
                                    @include('backend.teachers.delete')
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="text-align: center; width: 5%;">STT</th>
                                <th style="width: 15%;">Tên giáo viên</th>
                                <th style="width: 15%;">Email</th>
                                <th style="text-align: center; width: 15%;">Số điện thoại</th>
                                <th style="text-align: center; width: 10%;">Hồ sơ</th>
                                <th style="text-align: center; width: 15%;">Trạng thái</th>
                                <th style="text-align: center; width: 15%">Hành động</th>
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

