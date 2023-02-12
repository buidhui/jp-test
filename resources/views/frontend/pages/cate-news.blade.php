@extends('frontend.master')
@section("content")
    <div class="ioe-page">
        <div class="container">
            @include('frontend.layouts.menu')
    
            <div class="row">
                <div class="col-12">
                    <div class="tit-page">
                        <span>{{ $cate->name }}</span>
                        <ul class="ioe-page-link mt-2">
                            <?php $cates = DB::table('cate_news')->get() ?>
                            @foreach($cates as $item)
                                <li><a href="{{ route('tin-tuc', $item->id) }}">{{ $item->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ioe-page-container" style="height: auto !important;">
        <div class="container" style="height: auto !important;">
            <div class="ioe-news" style="height: auto !important;">
                <div class="row" style="height: auto !important;">
                    <div class="col-sm-8">
                        <div class="ioe-news-left">
                            @foreach($news as $key => $item)
                                @if($key == 0)
                                    <div class="l-news-hot">
                                        <a href="{{ route('news-detail', $item->id) }}">
                                            <div class="l-hot-img">
                                                <img
                                                    src="{{ asset('uploads/posts/'. $item->images) }}"
                                                    alt="{{ $item->name }}">
                                            </div>
                                            <div class="l-hot-tit">
                                                <div class="l-hot-info">
                                                    <span>{{ $item->created_at->format('d/m/Y')}}</span>
                                                </div>
                                                <span class="l-hot-tit-content">{{ $item->name }}</span>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                            <div class="l-news-list">
                                <ul>
                                    @foreach($news as $key => $item)
                                        @if($key > 0)
                                            <li>
                                                <a href="{{ route('news-detail', $item->id) }}">
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <div class="l-news-thumb">
                                                        <span><img
                                                                src="{{ asset('uploads/posts/'. $item->images) }}"
                                                                alt="{{ $item->name }}"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <div class="l-news-content">
                                                                <span class="l-news-tit">{{ $item->name }}</span>
                                                                <div class="l-news-sub-tit">
                                                                    <span>{{ $item->created_at->format('d/m/Y')}} </span>
                                                                </div>
                                                                <p class="l-news-description"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mt-5" style="float: right">
                                {{$news->links() }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4" style="height: auto !important;">
                        <div class="ioe-news-right" style="height: auto !important;">
                            <div class="right-news-list">
                                <?php $news_new = DB::table('news')->orderBy('id', 'DESC')->limit(6)->get(); ?>
                                <div class="tit-border-left-blue"><span>Tin mới nhất</span></div>
                                <ul>
                                    @foreach($news_new as $item)
                                        <li>
                                            <a href="{{ route('news-detail', $item->id) }}">
                                                {{$item->name}}
                                                <span>{{ date('d/m/Y', strtotime($item->created_at)) }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <br><br>
                            <div class="right-news-list">
                                <?php $jp_news = DB::table('news')->where('cate_id', config('const.kinh_nghiem_hoc_tieng_nhat'))->inRandomOrder()->limit(6)->get(); ?>
                                <div class="tit-border-left-pink"><span>Kinh nghiệm học tiếng Nhật</span></div>
                                <ul>
                                    @foreach($jp_news as $item)
                                        <li>
                                            <a href="{{ route('news-detail', $item->id) }}">
                                                {{$item->name}}
                                                <span>{{ date('d/m/Y', strtotime($item->created_at)) }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ioe-news-col">
                <div class="tit-border-left-blue">
                    <span>Có thể bạn quan tâm</span>
                </div>

                <?php $news_care = DB::table('news')->where('cate_id', config('const.bao_nhk'))->inRandomOrder()->limit(3)->get(); ?>
                <div class="row">
                    @foreach($news_care as $item)
                        <div class="col-sm-4">
                            <a href="{{ route('news-detail', $item->id) }}"
                               class="news-col-items">
                                <div class="news-col-img">
                                <span><img
                                        src="{{ asset('uploads/posts/'. $item->images) }}"
                                        alt=""></span>
                                </div>
                                <span class="news-col-items-tit">{{ $item->name }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
