@extends('backend.master')

@section("title-page", "Quản lý bài viết")
@section('content')
    <?php $open = "posts"?>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header" style="border-bottom: 1px solid rgba(0,0,0,.125);">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="box-title">Danh sách bài viết</h3>
                        </div>
                        <div class="col-sm-6" style="text-align: right;">
                            <a href="{{ route("posts.get_add") }}">
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
                                <th style="width: 20%;">Tiêu đề bài viết</th>
                                <th style="width: 20%;">Thể loại bài viết</th>
                                <th style="text-align: center; width: 20%;">Hình ảnh</th>
                                <th style="text-align: center; width: 15%;">Ngày viết</th>
                                <th style="text-align: center; width: 20%;">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $key => $item)
                            <tr role="row" class="odd">
                                <td style="vertical-align: inherit; text-align: center">{{ $key + 1 }}</td>
                                <td style="vertical-align: inherit;">{{ $item->name }}</td>
                                <td style="vertical-align: inherit;">{{ $item->cate->name }}</td>
                                <td style="vertical-align: inherit; text-align: center">
                                    <img class="img-fluid" src="{{ asset("uploads/posts/".$item->images) }}" alt="" style="width: 100px; height: 80px">
                                </td>
                                <td style="vertical-align: inherit; text-align: center">
                                    {{  date('d/m/Y', strtotime($item->created_at))}}
                                </td>
                                <td style="text-align: center; vertical-align: inherit;">
                                    <a href="{{ route("posts.get_edit", $item->id) }}" class="btn btn-xs btn-primary">
                                        <i class="fa fa-edit"></i> Sửa
                                    </a>
                                    <a data-toggle="modal" data-target="#delete_{{$item->id}}" href=""  class="btn btn-xs  btn-danger"> 
                                        <i class="fa fa-trash"></i> Xóa
                                    </a>
                                    @include('backend.posts.delete')
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="text-align: center; width: 5%;">STT</th>
                                <th style="width: 20%;">Tiêu đề bài viết</th>
                                <th style="width: 20%;">Thể loại bài viết</th>
                                <th style="text-align: center; width: 20%;">Hình ảnh</th>
                                <th style="text-align: center; width: 15%;">Ngày viết</th>
                                <th style="text-align: center; width: 20%;">Hành động</th>
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
