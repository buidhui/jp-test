@extends('backend.master')

@section("title-page", "Góp ý của học viên")
@section('content')
    <?php $open = "categories"?>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header" style="border-bottom: 1px solid rgba(0,0,0,.125);">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="box-title">Danh sách góp ý của học viên tới hệ thống</h3>
                        </div>
                    </div>
                </div>

                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 5%;">STT</th>
                                <th style="width: 25%;">Tên học viên</th>
                                <th style="text-align: center; width: 35%;">Nội dung góp ý</th>
                                <th style="text-align: center; width: 15%;">Trạng thái</th>
                                <th style="text-align: center; width: 20%;">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($feedback as $key => $item)
                            <tr role="row" class="odd">
                                <td style="vertical-align: inherit; text-align: center">{{ $key + 1 }}</td>
                                <td style="vertical-align: inherit;">{{ $item->user->name }}</td>
                                <td style="vertical-align: inherit;">{{ $item->content }}</td>
                                <td style="vertical-align: inherit; text-align: center"> 
                                    @if($item->status == 1)
                                        <span class="label label-success">Đã xem<span>                                
                                    @else
                                        <span class="label label-warning">Chưa xem<span>                                    
                                    @endif
                                </td>
                                <td style="text-align: center; vertical-align: inherit;">
                                    @if ($item->status == 0)
                                        <a href="{{ route("feedback.saw", $item->id) }}" class="btn btn-xs btn-primary">
                                            <i class="fa fa-edit"></i> Đã xem xong
                                        </a>
                                    @endif
                                    <a data-toggle="modal" data-target="#delete_{{$item->id}}" href=""  class="btn btn-xs  btn-danger"> 
                                        <i class="fa fa-trash"></i> Xóa
                                    </a>
                                    @include('backend.feedback.delete')
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="text-align: center; width: 5%;">STT</th>
                                <th style="width: 25%;">Tên học viên</th>
                                <th style="text-align: center; width: 35%;">Nội dung góp ý</th>
                                <th style="text-align: center; width: 15%;">Trạng thái</th>
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
