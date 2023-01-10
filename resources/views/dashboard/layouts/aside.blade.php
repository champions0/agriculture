<style>
    .nav-link.active {
        background-color: #fff!important;
        color: #4675C0!important;

    }

</style>

<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4" style="background-color: #4675C0!important;">
    <!-- Brand Logo -->
    <a href="{{ env('APP_URL') }}" class="brand-link">
        {{--        <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">--}}
        <span class="brand-text font-weight-light" style="color: #fff!important;">Informa</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a style="color: #fff;" href="{{ route('dashboard') }}" class="nav-link {{Request::segment(2) == '' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Վիճակագրություն
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a style="color: #fff;" href="{{ route('reports.index') }}"
                       class="nav-link {{Request::segment(2) == 'reports' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Դիմումներ
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a style="color: #fff;" href="{{ route('fast-questions.index') }}"
                       class="nav-link {{Request::segment(2) == 'fast-questions' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Շտապ հարցեր
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a style="color: #fff;" href="{{ route('notifications.index') }}"
                       class="nav-link {{Request::segment(2) == 'notifications' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Ծանուցում
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a style="color: #fff;" href="{{ route('statements.index') }}"
                       class="nav-link {{Request::segment(2) == 'statements' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Հայտարարություններ
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a style="color: #fff;" href="{{ route('news.index') }}"
                       class="nav-link {{Request::segment(2) == 'news' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Նորություններ
                        </p>
                    </a>
                </li>

                @if(auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <a style="color: #fff;" href="{{ route('users.index') }}"
                           class="nav-link {{Request::segment(2) == 'users' ? 'active' : ''}}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Օգտատերեր
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a style="color: #fff;" href="{{ route('events.index') }}"
                           class="nav-link {{Request::segment(2) == 'events' ? 'active' : ''}}">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>
                                Միջոցառումներ
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <!-- /.sidebar-custom -->
</aside>
