<div class="ioe-menu">
    <div class="row align-items-center">
        <div class="col-2 col-sm-9">
            <div class="ioe-menu-items">
                <nav class="navbar navbar-expand-md">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#collapsibleNavbar">
                        <span class="navbar-toggler-icon"><i class="material-icons">list</i></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavbar">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="ioe-nav-link" href="{{ route('self-training') }}">Vào thi</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="ioe-nav-link" href="{{ route('training') }}">Luyện thi tự do</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="ioe-nav-link" href="{{ route('results') }}">Kết quả thi</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="ioe-nav-link" href="{{ route('lists.video')  }}">Video chữa đề thi</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="ioe-nav-link" href="{{ route('get.ranking') }}">Bảng xếp hạng</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="ioe-nav-link" href="javascript:;" id="navbardrop4"
                                   data-toggle="dropdown">
                                    Tin tức<i class="material-icons-round">arrow_drop_down</i>
                                </a>

                                <?php $cates = DB::table('cate_news')->get() ?>
                                <div class="dropdown-menu">
                                    @foreach($cates as $item)
                                    <a class="dropdown-item" href="{{ route('tin-tuc', $item->id) }}">{{ $item->name }}</a>
                                    @endforeach
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="ioe-nav-link" href="{{ route('user.get_feedback') }}">Góp ý</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
