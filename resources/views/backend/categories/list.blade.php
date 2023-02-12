@extends('backend.master')

@section("title-page", "Quản lý thể loại bài viết")
@section('content')
    <?php $open = "categories"?>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header" style="border-bottom: 1px solid rgba(0,0,0,.125);">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="box-title">Danh sách thể loại tin tức</h3>
                        </div>
                        <div class="col-sm-6" style="text-align: right;">
                            <a href="{{ route("categories.get_add") }}">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 15%;">STT</th>
                                <th style="text-align: center; width: 55%;">Tên thể loại tin tức</th>
                                <th style="text-align: center; width: 30%;">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $key => $item)
                            <tr role="row" class="odd">
                                <td style="vertical-align: inherit; text-align: center">{{ $key + 1 }}</td>
                                <td style="vertical-align: inherit;">{{ $item->name }}</td>
                                <td style="text-align: center; vertical-align: inherit;">
                                    <a href="{{ route("categories.get_edit", $item->id) }}" class="btn btn-xs btn-primary">
                                        <i class="fa fa-edit"></i> Sửa
                                    </a>
                                    <a data-toggle="modal" data-target="#delete_{{$item->id}}" href=""  class="btn btn-xs  btn-danger"> 
                                        <i class="fa fa-trash"></i> Xóa
                                    </a>
                                    @include('backend.categories.delete')
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="text-align: center; width: 15%;">STT</th>
                                <th style="text-align: center; width: 55%;">Tên thể loại tin tức</th>
                                <th style="text-align: center; width: 30%;">Hành động</th>
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
