@extends('frontend.master')
@section("content")
    <div class="ioe-page">
        <div class="container">
            @include('frontend.layouts.menu')

            <div class="row">
                <div class="col-12">
                    <div class="tit-page">
                        <span>Video chữa đề</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ioe-page-container" style="padding:30px 0 100px 0;">
        <div class="container">
            <div class="row">
                @foreach($pass_videos as $item)
                    <div class="col-3 mb-5">
                        <p style="color: #4978bc; font-size: 19px; font-weight: 700; margin-bottom: -15px; text-align: center">{{ $item->round->name }} - {{ $item->name }}</p>
                        <video width="275" height="200" controls muted loop onmouseover="this.play()" onmouseout="this.pause();">
                            <source src="{{ asset('uploads/'.$item->video_fix) }}" type="video/mp4">
                        </video>
                    </div>
                @endforeach
                @foreach($not_pass_videos as $item)
                    <div class="col-3 mb-5">
                        <p style="color: #4978bc; font-size: 19px; font-weight: 700; margin-bottom: -15px; text-align: center">{{ $item->round->name }} - {{ $item->name }}</p>
                        <div style="display: grid; grid-template-columns: 1fr;">
                            <video width="275" height="200" style="position: absolute;" controls muted loop onmouseover="this.play()" onmouseout="this.pause();">
                                <source src="{{ asset('uploads/'.$item->video_fix) }}" type="video/mp4">
                            </video>
                            <div style="width: 275px; height: 178px; z-index: 1; background: grey; margin-top: 22px; background-color: rgb(194 190 190 / 40%); cursor: not-allowed;"></div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mb-5"></div>     
        </div>
    </div>
@endsection
