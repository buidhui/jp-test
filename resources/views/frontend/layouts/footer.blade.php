<div class="ioe-container">
    <div class="container">
        <div class="footer-menu">
            <div class="row">
                <div class="col-6 col-sm-2">
                    <div class="ioe-f-logo">
                        <a href="{{ asset('/')}}">
                            <img style="width: 150px;" src={{ asset("Themes/v1/images/logo_jpt.png") }} alt="">
                        </a>
                    </div>
                </div>

                <div class="col-6 col-sm-2">
                    <span class="f-menu-tit">Tin tức</span>
                    <ul class="f-menu-items">
                        <?php $cates = DB::table('cate_news')->get() ?>
                        @foreach($cates as $item)
                            <li><a href="{{ route('tin-tuc', $item->id) }}">{{ $item->name }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-6 col-sm-2">
                    <span class="f-menu-tit">Học viên</span>
                    <ul class="f-menu-items">
                        <li><a href="{{ route('self-training') }}">Luyện thi</a></li>
                        <li><a href="{{ route('results') }}">Kết quả thi</a></li>
                    </ul>
                </div>

                <div class="col-6 col-sm-2">
                    <span class="f-menu-tit">Bảng xếp hạng</span>
                    <ul class="f-menu-items">
                        <li><a href="">N1</a></li>
                        <li><a href="">N2</a></li>
                        <li><a href="">N3</a></li>
                        <li><a href="">N4</a></li>
                        <li><a href="">N5</a></li>
                    </ul>
                </div>

                <div class="col-6 col-sm-2">
                    <span class="f-menu-tit">Dành cho quản trị</span>
                    <ul class="f-menu-items">
                        <li><span>Bạn là quản trị viên?</span></li>
                        <li><a href="{{ route('admin.login') }}" class="f-btn-admin">Quản trị viên</a></li>
                        <li><span>Bạn là quản giáo viên?</span></li>
                        <li><a href="{{ route('teacher.login') }}" class="f-btn-admin">Giáo viên</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ioe-footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <span>Copyright © 2022</span>
            </div>
            <div class="col-sm-6">
                <span>Địa chỉ: Đại học Bách khoa Hà Nội</span>
            </div>
        </div>
    </div>

</div>

<script src="{{ asset('Themes/v1/js/ioeHeader1954.js') }}"></script>
<script src="{{ asset('Themes/v1/js/ioecv20ce.js') }}"></script>
<script src="{{ asset('Themes/v1/js/ioeFooter1824.js') }}"></script>
<script src="{{ asset('Themes/v1/js/wow.min.js') }}"></script>

</body>

@yield('script')
</html>
