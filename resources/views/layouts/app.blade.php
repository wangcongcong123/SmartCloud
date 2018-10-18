<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1"/>
    <title>Smart Cloud</title>
    <link rel="stylesheet" href="asserts/bootstrap.min.css">
    <link rel="stylesheet" href="asserts/css/AdminLTE.min.css">
    <link rel="stylesheet" href="asserts/fbicons/css/font-awesome.min.css">
    <link rel="stylesheet" href="asserts/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="asserts/plugins/sweetalert/sweetalert.css">
    <link rel="stylesheet" href="asserts/plugins/layui/css/layui.css">
    {{--<link rel="stylesheet" href="asserts/css/zTreeStyle/zTreeStyle.css">--}}

    @yield('mycss')

</head>

<body>

<!-- header -->
<header class="main-header">
    <!-- Logo -->
    <a href="{{route('main')}}" class="logo"> <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span> <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Smart</b>Cloud</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Notifications: style can be found in dropdown.less -->
                <li>
                    <a href="{{route('contact')}}">
                        <i class="fa fa-wechat"></i>
                    </a>
                </li>

                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu"><a href="#"
                                                       class="dropdown-toggle" data-toggle="dropdown"> <img
                                src="images/admin.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{$_COOKIE['fullname']}} at Smart Cloud</span>
                    </a>

                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header"><img src="images/admin.jpg"
                                                     class="img-circle" alt="User Image">
                            <p></p>
                            <span id="user-email"
                                  style="color: #53d15d;font-size: 12px">User Email [account]: {{$_COOKIE['account']}}</span>

                            <div class="progress-group">
                                <span class="progress-text">Your Storage Capacity</span> <span
                                        class="progress-number"><b>{{$_COOKIE['used']}}</b>/{{$_COOKIE['total']}}M</span>

                                <p></p>
                                <br>

                                <div class="progress sm">
                                    <div class="progress-bar progress-bar-aqua"
                                         style="width: {{(int)$_COOKIE['used']*100/$_COOKIE['total']}}%"></div>
                                </div>

                            </div>
                        </li>

                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <a>Profile</a>
                                </div>

                                <div class="col-xs-4 text-center">
                                    <a href="{{route('contact')}}">Friends</a>
                                </div>

                                <div class="col-xs-4 text-center">
                                    @if($_COOKIE['account']=='admin')
                                        <a href="{{route('admin')}}" style="color: darkred" data-toggle="tooltip" data-placement="top"
                                           title="you are admin, so this is available">Management</a>
                                    @endif
                                </div>


                            </div> <!-- /.row -->
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="{{route('signout')}}" class="btn btn-default btn-flat">Sign
                                    out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

@yield('content')
<section class="content-footer" style="color: #666;text-align:center">
    <p>Copyright © 2017. BDIC Group 7 Module Project 2 All rights
        reserved.</p>
</section>

<script src="asserts/jquery.min.js"></script>
<script src="asserts/bootstrap.min.js"></script>
<script src="asserts/app.min.js"></script>
{{--<script src="asserts/plugins/jquery.ztree.core.js"></script>--}}
<script src="asserts/plugins/sweetalert/sweetalert-dev.js"></script>
<script src="asserts/plugins/layui/layui.js"></script>


@yield('myjs')

</body>
</html>
