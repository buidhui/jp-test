@extends('frontend.master')
@section("content")
    <div class="ioe-page">
        <div class="container">
            @include('frontend.layouts.menu')

            <div class="row">
                <div class="col-12">
                    <div class="tit-page">
                        <span>Bảng xếp hạng JPT</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ioe-page-container" style="padding:20px 0 100px 0;">
        <div class="container">
            <form action="" method="post">
                @csrf
                <div class="row" style="margin-bottom:-10px;">
                    <div class="col-sm-12">
                        <span class="tit-24">Kết quả các vòng luyện thi JPT</span>
                        <p>
                            <b>Lưu ý:</b> Bảng xếp hạng kết quả các vòng luyện thi được thống kê theo dữ liệu có trong
                            cơ sở dữ liệu. Những học viên đang trong quá trình làm bài thi chưa được cập nhật vào cơ sở
                            dữ liệu sẽ không có tên trong danh sách này.
                        </p>
                    </div>
                    <div class="col-sm-1" style="margin-bottom:10px;">&nbsp;</div>

                    <div class="col-sm-3" style="margin-bottom:10px;">
                        <div class="box" style="position:initial;top:0;left:0;transform:none;margin-top:0">
                            <select id="roundlevel" style="width:100%;max-width:100%" name="level" required>
                                <option value="">Chọn cấp độ</option>
                                <option value="1">N1</option>
                                <option value="2">N2</option>
                                <option value="3">N3</option>
                                <option value="4">N4</option>
                                <option value="5">N5</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3" style="margin-bottom:10px;">
                        <?php
                            $dt = Carbon\Carbon::now('Asia/Ho_Chi_Minh');
                            $round = DB::table('round')->where('level', 1)->where('starting_time', '<=', $dt->toDateString())->get();
                        ?>
                        <div class="box" style="position:initial;top:0;left:0;transform:none;margin-top:0">
                            <select id="block" style="width:100%;max-width:100%" name="round" required>
                                <option value="">Chọn Vòng thi</option>
                                <option value="total">Tổng điểm</option>
                                @foreach($round as $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3" style="margin-bottom:10px;">
                        <div class="box" style="position:initial;top:0;left:0;transform:none;margin-top:0">
                            <select id="block" style="width:100%;max-width:100%" name="qty" required>
                                <option value="">Chọn Số lượng</option>
                                <option value="10">10 người</option>
                                <option value="15">15 người</option>
                                <option value="20">20 người</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2" style="margin-bottom:10px;">
                        <button style="border:none;padding:9px;background-color:#70ac62;color:white"
                                onclick="XEMKETQUA();">XEM KẾT QUẢ THI
                        </button>
                    </div>

                </div>
            </form>

            <div class="ioe-news" style="margin-bottom:10px">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php 
                                    $i = 0;
                                    $data = Session::get('data');
                                    $round = Session::get('round');
                                    $data_total = Session::get('data_total');
                                ?>
                                @if ($data_total != null)
                                    <p style="text-align: center; text-transform: uppercase; margin: 30px 0; font-size: 26px; font-weight: bold;">Bảng xếp hạng tổng điểm Trình độ N{{ $data_total->first()->user->level }}</p>
                                    <div class="ioe-tbl-static">
                                        <div class="ioe-tbl-static" style="overflow-x:auto;margin-top:15px;">
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <th>Xếp hạng</th>
                                                    <th>ID</th>
                                                    <th>Họ và tên</th>
                                                    <th>Trình độ</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Điểm</th>
                                                    <th>Thời gian thi</th>
                                                </tr>
                                                    @foreach($data_total as $item)
                                                        <?php $i++; ?>
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $item->user_id }}</td>
                                                            <td style="text-transform: uppercase;">{{ $item->user->name }}</td>
                                                            <td>N{{ $item->user->level }}</td>
                                                            <td>{{ $item->user->address }}</td>
                                                            <td>{{ $item->sum }}</td>
                                                            <?php 
                                                                $hours = floor($item->sum_time / 3600);
                                                                $minutes = floor(($item->sum_time / 60) % 60);
                                                                $seconds = $item->sum_time % 60;
                                                            ?>
                                                            @if ($hours > 0)
                                                                <td>{{ $hours }} giờ {{ $minutes }} phút {{ $seconds }} giây</td>
                                                            @else
                                                                <td>{{ $minutes }} phút {{ $seconds }} giây</td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                                @if ($round != null)
                                    <p style="text-align: center; text-transform: uppercase; margin: 30px 0; font-size: 26px; font-weight: bold;">Bảng xếp hạng luyện thi {{ $data->first()->round->name }} - Trình độ N{{ $data->first()->round->level }}</p>
                                    <div class="ioe-tbl-static">
                                        <div class="ioe-tbl-static" style="overflow-x:auto;margin-top:15px;">
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <th>Xếp hạng</th>
                                                    <th>ID</th>
                                                    <th>Họ và tên</th>
                                                    <th>Trình độ</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Điểm</th>
                                                    <th>Thời gian thi</th>
                                                </tr>
                                                @if($data != null)
                                                    @foreach($data as $item)
                                                        <?php $i++; ?>
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $item->id }}</td>
                                                            <td style="text-transform: uppercase;">{{ $item->name }}</td>
                                                            <td>N{{ $item->level }}</td>
                                                            <td>{{ $item->user->address }}</td>
                                                            <td>{{ $item->point }}</td>
                                                            <?php 
                                                                $hours = floor($item->time / 3600);
                                                                $minutes = floor(($item->time / 60) % 60);
                                                                $seconds = $item->time % 60;
                                                            ?>
                                                            @if ($hours > 0)
                                                                <td>{{ $hours }} giờ {{ $minutes }} phút {{ $seconds }} giây</td>
                                                            @else
                                                                <td>{{ $minutes }} phút {{ $seconds }} giây</td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
