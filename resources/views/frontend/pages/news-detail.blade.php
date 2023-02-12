@extends('frontend.master')
@section("content")
    <div class="ioe-page">
        <div class="container">
            @include('frontend.layouts.menu')
    
            <div class="row">
                <div class="col-12">
                    <div class="tit-page">
                        @switch( $news->cate_id )
                            @case(1)
                                <span>Thông báo từ hệ thống</span>
                                @break
                            @case(2)
                                <span>Kinh nghiệm học tiếng Nhật</span>
                                @break
                            @case(3)
                                <span>Báo NHK</span>
                                @break
                            @default
                                <span>Tin tức muôn nơi</span>
                        @endswitch
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
                        <div class="ioe-news-detail">
                            <span class="news-detail-tit">{{ $news->name }}</span>
                            <div class="l-news-sub-tit">
                                <span>{{ $news->created_at->format('d/m/Y')}} </span>
                            </div>
                            <div class="ioe-news-content">
                                {!! $news->content !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4" style="height: auto !important;">
                        <div class="ioe-news-right" style="height: auto !important;">
                            <div class="right-news-list">
                                <?php $news_new = DB::table('news')->orderBy('id', 'DESC')->limit(5)->get(); ?>

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
