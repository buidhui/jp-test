<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            @if(Auth::guard('admin')->check())
                <li class="">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fa fa-dashboard"></i> <span>Thống kê</span>
                    </a>
                </li>

                <li class="">
                    <a href="{{ route('admin.feedback') }}">
                        <i class="fa fa-comments"></i> <span>Góp ý của học viên</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('round.list') }}">
                        <i class="ion ion-pie-graph"></i> <span>Quản lý vòng thi</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('categories_tests.list') }}">
                        <i class="fa fa-list-ul"></i> <span>Quản lý dạng bài thi</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('test.list') }}">
                        <i class="fa fa-bar-chart"></i> <span>Quản lý bài thi</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('question.all_list') }}">
                        <i class="fa fa-question"></i> <span>Quản lý câu hỏi thi</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('question_training.list') }}">
                        <i class="fa fa-question"></i> <span>Quản lý câu hỏi thi tự do</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('categories.list') }}">
                        <i class="fa fa-map-o"></i> <span>Quản lý thể loại bài viết</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('posts.list') }}">
                        <i class="fa fa-newspaper-o"></i> <span>Quản lý bài viết</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('users.list') }}">
                        <i class="fa fa-users"></i> <span>Quản lý học viên</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('teachers.list') }}">
                        <i class="fa fa-graduation-cap"></i> <span>Quản lý giáo viên</span>
                        <span class="pull-right-container">
                        <?php  $teachers = DB::table("teachers")->where('status', 0)->count(); ?>
              <small class="label pull-right bg-green">{{ $teachers }}</small>
            </span>
                    </a>
                </li>
            @else
                <li class="">
                    <a href="{{route('teacher-dashboard')}}">
                        <i class="fa fa-dashboard"></i> <span>Thống kê</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('teacher-test-list') }}">
                        <i class="fa fa-table"></i> <span>Bài thi</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('question.all_list') }}">
                        <i class="fa fa-question"></i> <span>Danh sách câu hỏi thi</span>
                    </a>
                </li>
            @endif
        </ul>
    </section>
</aside>
