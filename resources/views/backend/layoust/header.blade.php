<header class="main-header">
    <a href="{{ route('admin.dashboard') }}" class="logo">
        <span class="logo-mini">
            <b>JPT</b>         
        </span>    
        <span class="logo-lg"><b>JPT</b></span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li>
                    <a target="_blank" href="{{ route('home_page') }}">
                        <span>View Website</span>
                    </a>
                <li>
                @if(Auth::guard('teachers')->check())
                    <?php $test = \App\Test::where('teacher_id', Auth::guard('teachers')->user()->id)->get(); ?>
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">{{ count($test) }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have {{ count($test) }} notifications</li>
                        <li>
                            <ul class="menu">
                                @foreach($test as $item)
                                    <li>
                                        <a href="{{ route('teacher-test-list') }}">
                                            <i class="fa fa-bell-o text-aqua"></i>
                                            Bạn được giao {{ $item->name }} - {{ $item->round->name }}
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </li>
                        <li class="footer"><a href="{{ route('teacher-test-list') }}">View all</a></li>
                    </ul>
                </li>
                @endif
                <li class="dropdown user user-menu" style="margin-right: 25px;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('/Themes/v1/images/admin.png') }}" class="user-image" alt="User Image">
                        @if(Auth::guard('admin')->check())
                            <span class="hidden-xs">{{ Auth::guard('admin')->user()->name }}</span>
                        @elseif(Auth::guard('teachers')->check())
                            <span class="hidden-xs">{{ Auth::guard('teachers')->user()->name }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ asset('/Themes/v1/images/admin.png') }}" class="img-circle" alt="User Image">
                            @if(Auth::guard('admin')->check())
                                <p>
                                    {{ Auth::guard('admin')->user()->name }}
                                    <small>Quản lý hệ thống JPT</small>
                                </p>
                            @elseif(Auth::guard('teachers')->check())
                                <p>
                                    {{ Auth::guard('teachers')->user()->name }}
                                    <small>Giáo viên hệ thống JPT</small>
                                </p>
                            @endif
                          </li>
                        <li class="user-footer">
                            <div class="pull-right">
                                @if(Auth::guard('admin')->check())
                                    <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                @else
                                    <a href="{{ route('teacher.logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                @endif
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
