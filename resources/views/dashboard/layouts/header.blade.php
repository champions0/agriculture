<header class="main-header">

    <!-- Logo -->
{{--    <a href="/" class="logo">--}}
{{--        <!-- mini logo for sidebar mini 50x50 pixels -->--}}
{{--        <span class="logo-mini"><b>4</b></span>--}}
{{--        <!-- logo for regular state and mobile devices -->--}}
{{--        <span class="logo-lg"><b>4OVER4</b></span>--}}
{{--    </a>--}}

<!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar-expand navbar-white navbar-light flex row justify-content-between mr-0">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            {{-- <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
            </li> --}}
        </ul>
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            @if(isset(Auth::user()->avatar))
                                <img src="{{Auth::user()->avatar }}" class="user-image" alt="User Image">
{{--                            @else--}}
{{--                                <img--}}
{{--                                    src="https://secure.gravatar.com/avatar/55e20e28bf9078a7b3833d58d8407b2f?s=96&d=mm&r=g"--}}
{{--                                    class="user-image" alt="User Image">--}}
                            @endif
                            <span class="hidden-xs">{{Auth::user()->first_name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                @if(Auth::user()->avatar)
                                    <img src="{{Auth::user()->avatar }}" class="img-circle" alt="User Image">
{{--                                @else--}}
{{--                                    <img--}}
{{--                                        src="https://secure.gravatar.com/avatar/55e20e28bf9078a7b3833d58d8407b2f?s=96&d=mm&r=g"--}}
{{--                                        class="img-circle" alt="User Image">--}}
                                @endif

                                <p>
                                    {{ Auth::user()->full_name }}
                                    <small>Member since: {{ date('M Y', strtotime(Auth::user()->created_at)) }}</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
{{--                            <li class="user-body">--}}
{{--                                <div class="flex col-xs-12">--}}
{{--                                    <div class="col-xs-4 text-center">--}}
{{--                                        <a href="#">Followers</a>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xs-4 text-center">--}}
{{--                                        <a href="#">Sales</a>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xs-4 text-center">--}}
{{--                                        <a href="#">Friends</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- /.row -->--}}
{{--                            </li>--}}
                            <!-- Menu Footer-->
                            <li class="user-footer">
{{--                                <div class="pull-left">--}}
{{--                                    <a href="#" class="btn btn-default btn-flat">Profile</a>--}}
{{--                                </div>--}}

                                <div class="pull-right">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Sign out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>


                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>

        </nav>

    </nav>

</header>
