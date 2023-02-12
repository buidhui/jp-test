@extends("backend.master")
@section("title-page", "Số liệu thống kê")
@section("content")
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <?php $users= DB::table("users")->count(); ?>
                <div class="inner">
                    <h3>{{ $users }}</h3>
                    <p>Học viên</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('users.list') }}" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <?php $teachers= DB::table("teachers")->where('status', 1)->count(); ?>
                <div class="inner">
                    <h3>{{ $teachers }}</h3>
                    <p>Giáo viên</p>
                </div>
                <div class="icon">
                    <i class="fa fa-graduation-cap"></i>
                </div>
                <a href="{{ route('teachers.list') }}" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <?php $questions= DB::table("question")->count(); ?>
                <div class="inner">
                    <h3>{{ $questions }}</h3>
                    <p>Câu hỏi thi</p>
                </div>
                <div class="icon">
                    <i class="fa fa-question"></i>
                </div>
                <a href="{{ route('question.all_list') }}" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-orange">
                <?php $results= DB::table("result")->count(); ?>
                <div class="inner">
                    <h3>{{ $results }}</h3>
                    <p>Số lượt thi</p>
                </div>
                <div class="icon">
                    <i class="fa  fa-pencil-square-o"></i>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <?php $news = DB::table("news")->count(); ?>
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $news }}</h3>
                    <p>Bài viết</p>
                </div>
                <div class="icon">
                    <i class="fa fa-newspaper-o"></i>
                </div>
                <a href="{{ route('posts.list') }}" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-purple">
                <?php $round = DB::table("round")->count(); ?>
                <div class="inner">
                    <h3>{{ $round }}</h3>
                    <p>Vòng thi</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('round.list') }}" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <?php $test= DB::table("test")->count(); ?>
                <div class="inner">
                    <h3>{{ $test }}</h3>
                    <p>Bài thi</p>
                </div>
                <div class="icon">
                    <i class="fa fa-bar-chart"></i>
                </div>
                <a href="{{ route('test.list') }}" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-primary">
                <?php $cate_tests = DB::table("cate_tests")->count(); ?>
                <div class="inner">
                    <h3>{{ $cate_tests }}</h3>
                    <p>Dạng bài thi</p>
                </div>
                <div class="icon">
                    <i class="fa fa-list-ul"></i>
                </div>
                <a href="{{ route('categories_tests.list') }}" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <?php $cate_count = DB::table("cate_news")->count(); ?>
                <div class="inner">
                    <h3>{{ $cate_count }}</h3>
                    <p>Thể loại tin tức</p>
                </div>
                <div class="icon">
                    <i class="fa fa-map-o"></i>
                </div>
                <a href="{{ route('categories.list') }}" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@endsection
