<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <title>login page</title>

    <meta name="description" content="User login page"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    {{--<link rel="stylesheet" href="again/assets/login/css/bootstrap.min.css"/>--}}
    <link rel="stylesheet" href="again/assets/login/font-awesome/4.2.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="again/assets/login/css/ace.min.css"/>
    <link rel="stylesheet" href="asserts/bootstrap.min.css">
    <link rel="stylesheet" href="asserts/plugins/sweetalert/sweetalert.css">
    {{--<link rel="stylesheet" href="asserts/plugins/layui/css/layui.css">--}}
    <link rel="stylesheet" href="mycss/index.css">


</head>


<body class="login-layout light-login">
<div class="main-container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="login-container">
                    <div class="center">
                        <h1>
                            <i class="fa fa-cloud-download green"></i>
                            <span class="white" id="id-text2">Smart Cloud</span>
                        </h1>
                    </div>

                    <div class="space-6"></div>

                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header blue bigger">
                                        <i class="fa fa-user green"></i>
                                        Fill your info to login
                                    </h4>

                                    <div class="space-6"></div>


                                    <form action="{{ route('login') }}" id="loginform" method="post">
                                        {{ csrf_field() }}
                                        <fieldset>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control"
                                                                   id="auto-complete-email" name="accountforlogin"
                                                                   placeholder="Email"/>
															<i class="ace-icon fa fa-user"></i>
														</span>
                                            </label>

                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control"
                                                                   name="passwordforlogin"
                                                                   placeholder="Password"/>
															<i class="ace-icon fa fa-lock"></i>
														</span>
                                            </label>

                                            <div class="space"></div>

                                            <div class="clearfix">
                                                <label class="inline">
                                                    <input type="checkbox" class="ace"/>
                                                    <span class="lbl" name="remember">remember me one week</span>
                                                </label>

                                                <button type="button" id="submit1"
                                                        class="width-35 pull-right btn btn-sm btn-primary">
                                                    <i class="ace-icon fa fa-key"></i>
                                                    <span class="bigger-110">Login</span>
                                                </button>
                                            </div>

                                            <div class="space-4"></div>
                                        </fieldset>
                                    </form>

                                    <div class="social-or-login center">
                                        <span class="bigger-110">login via social sites</span>
                                    </div>

                                    <div class="space-6"></div>

                                    <div class="social-login center">
                                        <a class="btn btn-primary"
                                           href="javascript:swal('Notice','this function is building now and wait for good news','info')">
                                            <i class="ace-icon fa fa-wechat"></i>
                                        </a>

                                        <a class="btn btn-info"
                                           href="javascript:swal('Notice','this function is building now and wait for good news','info')">
                                            <i class="ace-icon fa fa-weibo"></i>
                                        </a>

                                        <a class="btn btn-danger"
                                           href="javascript:swal('Notice','this function is building now and wait for good news','info')">
                                            <i class="ace-icon fa fa-renren"></i>
                                        </a>
                                    </div>
                                </div><!-- /.widget-main -->

                                <div class="toolbar clearfix">
                                    <div>
                                        <a href="#" data-target="#forgot-box" class="forgot-password-link">
                                            <i class="ace-icon fa fa-arrow-left"></i>
                                            forget password
                                        </a>
                                    </div>

                                    <div>
                                        <a href="#" data-target="#signup-box" class="user-signup-link">
                                            go to register
                                            <i class="ace-icon fa fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div><!-- /.widget-body -->
                        </div><!-- /.login-box -->

                        <div id="forgot-box" class="forgot-box widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header red lighter bigger">
                                        <i class="ace-icon fa fa-key"></i>
                                        find password back
                                    </h4>

                                    <div class="space-6"></div>
                                    <p>
                                        input your email address for verification
                                    </p>

                                    <form>
                                        <fieldset>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" name="findemail" class="form-control"
                                                                   placeholder="Email"/>
															<i class="ace-icon fa fa-envelope"></i>
														</span>
                                            </label>

                                            <div class="clearfix">
                                                <button type="button"
                                                        class="width-35 pull-right btn btn-sm btn-danger" id="findpass">
                                                    <i class="ace-icon fa fa-lightbulb-o"></i>
                                                    <span class="bigger-110">send email</span>
                                                </button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div><!-- /.widget-main -->

                                <div class="toolbar center">
                                    <a href="#" data-target="#login-box" class="back-to-login-link">
                                        back to login
                                        <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div><!-- /.widget-body -->
                        </div><!-- /.forgot-box -->

                        <div id="signup-box" class="signup-box widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header green lighter bigger">
                                        <i class="ace-icon fa fa-users blue"></i>
                                        user register
                                    </h4>

                                    <div class="space-6"></div>
                                    <p style="color: #666;">Fill all info below: </p>

                                    <form role="form" method="post" id="registerform"
                                          action="{{route('register')}}">
                                        {{ csrf_field() }}
                                        <fieldset>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" name="email"
                                                                   placeholder="Email"/>
															<i class="ace-icon fa fa-envelope"></i>
                                                            <div style="color: red; display: none">enter correct email address</div>
                                                            <div style="color: red; display: none">this email was already registered address</div>
														</span>
                                            </label>

                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="username"
                                                                   placeholder="Username"/>
															<i class="ace-icon fa fa-user"></i>
                                                            <div style="color: red; display: none">you need to enter fullname</div>
														</span>
                                            </label>

                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" name="psw1"
                                                                   placeholder="Password"/>
															<i class="ace-icon fa fa-lock"></i>
                                                            <div style="color: red; display: none">password should contain both digits and letters with length from 8 to 16</div>

														</span>

                                            </label>

                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" name="psw2"
                                                                   placeholder="Password again"/>
															<i class="ace-icon fa fa-retweet"></i>
                                                            <div style="color: red; display: none">two passwords are different</div>
														</span>
                                            </label>

                                            <label class="block">
                                                <input type="checkbox" name="agree2" id="agree2" class="ace"/>
                                                <span class="lbl">
															Accept relevant Items
															<a href="/"> click here to check</a>
														</span>
                                            </label>

                                            <div class="space-24"></div>

                                            <div class="clearfix">
                                                <button type="reset" class="width-30 pull-left btn btn-sm">
                                                    <i class="ace-icon fa fa-refresh"></i>
                                                    <span class="bigger-110">reset</span>
                                                </button>

                                                <button type="button" id="submit2"
                                                        class="width-65 pull-right btn btn-sm btn-success">
                                                    <span class="bigger-110">register</span>

                                                    <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                                </button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>

                                <div class="toolbar center">
                                    <a href="#" data-target="#login-box" class="back-to-login-link">
                                        <i class="ace-icon fa fa-arrow-left"></i>
                                        back to login
                                    </a>
                                </div>
                            </div><!-- /.widget-body -->
                        </div><!-- /.signup-box -->
                    </div><!-- /.position-relative -->
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.main-content -->
</div><!-- /.main-container -->

<div style="text-align:center;color: #666;margin:10px">
    <p>Copyright © 2017 Group 7 BDIC.
        reserved.</p>
</div>


<script src="asserts/jquery.min.js"></script>
<script src="asserts/bootstrap.min.js"></script>
<script src="asserts/plugins/completer.min.js"></script>
<script src="asserts/plugins/sweetalert/sweetalert-dev.js"></script>
<script src="asserts/plugins/layui/layui.js"></script>

<script type="text/javascript">

    layui.use('layer', function () {

        var layer = layui.layer;
//		layer.msg("hello,world!");
//		layer.open({
//			title:"nihao",
//			content:'i am fine'
//		});


        $("#auto-complete-email").completer({
            separator: "@",
            source: ["qq.com", "163.com", "126.com", "ucdconnect.ie", "emails.bjut.edu.cn", "gmail.com", "icloud.com"]
        });


        $(document).on('click', '.toolbar a[data-target]', function (e) {
            e.preventDefault();
            var target = $(this).data('target');
            $('.widget-box.visible').removeClass('visible');//hide others
            $(target).addClass('visible');//show target
        });

        var isokforname = false;
        var isokforemail = false;
        var isokforpsw1 = false;
        var isokforpsw2 = false;

        $("input[name='username']").blur(function () {
            if ($(this).val().trim() == "") {
                isokforname = false;
                $(this).css('border', "1px solid red");
                $(this).next().next().show(1000);
            } else {
                isokforname = true;
                $(this).css('border', "1px solid #666");
                $(this).next().next().hide(1000);
            }
        });
        //    check email
        $("input[name='email']").blur(function () {
            var regforemail = /\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
            if ($(this).val().search(regforemail) == -1) {
                isokforemail = false;
                $(this).css('border', "1px solid red");
                $(this).next().next().show(1000);
            } else {
                var email = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: '/emailexisthint',
                    data: {"account": email},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: function (data) {
                        if (data.msg == 'exist') {
                            isokforemail = false;
                            $("input[name='email']").css('border', "1px solid red");
                            $("input[name='email']").next().next().next().show(1000);
                        } else {
                            isokforemail = true;
                            $("input[name='email']").css('border', "1px solid #666");
                            $("input[name='email']").next().next().hide(1000);
                            $("input[name='email']").next().next().next().hide(1000);
                        }
                    },
                    error: function (xhr, type) {
                        swal("Opps", "error! ajax", 'error');
                    }
                });
            }
        });

        $("input[name='psw1']").blur(function () {
            var regforpsw = /^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,16}$/;
            if (!regforpsw.test($(this).val())) {
                isokforpsw1 = false;
                $(this).css('border', "1px solid red");
                $(this).next().next().show(1000);
            } else {
                isokforpsw1 = true;
                $(this).css('border', "1px solid #666");
                $(this).next().next().hide(1000);
            }
        });

        $("input[name='psw2']").blur(function () {
            if ($(this).val() != $("input[name='psw1']").val()) {
                isokforpsw2 = false;
                $("input[name='psw1']").css('border', "1px solid red");
                $(this).css('border', "1px solid red");
                $(this).next().next().show(1000);
            } else {
                isokforpsw2 = true;
                $("input[name='psw1']").css('border', "1px solid #666");
                $(this).css('border', "1px solid #666");
                $(this).next().next().hide(1000);
            }
        });

        $("#findpass").click(function () {
            var findemail = $("input[name='findemail']").val();

            var regforemail = /\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;

            if ($("input[name='findemail']").val().search(regforemail) == -1) {
                layer.msg('enter correct email', {icon: 2, anim: 6, time: 1000});
                return false;
            }

            var index = layer.load(1);
            $.ajax({
                type: 'POST',
                url: '/findpassword',
                data: {'email': findemail},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function (data) {
                    if (data.msg == "illegal") {
                        layer.msg('this email is invalid', {icon: 2, anim: 6, time: 1000});
                    } else if (data.msg == "wrongemail") {
                        layer.msg('the email is wrong', {icon: 2, anim: 6});
                    } else {

                        swal({
                            title: "Success",
                            text: "the message was sent to your email, check it within 5 minutes",
                            html: true,
                            type: "success"
                        });


                    }
                    layer.close(index);
                },
                error: function (xhr, type) {
                    layer.msg('server error', {icon: 2, anim: 6, time: 1000});
                    layer.close(index);
                }
            });


        });
        $('#submit2')
                .click(
                        function () {
                            if (isokforname && isokforemail && isokforpsw1
                                    && isokforpsw2) {
                                if ($('#agree2').attr('checked')
                                        || $("#agree2").get(0).checked
                                        || $('#agree2').is(':checked')) {
//                                    swal('Success', "register successfully!", 'success');

//									$('#registerform').submit();


                                    var email = $("input[name='email']").val();
                                    var username = $("input[name='username']").val();
                                    var psw1 = $("input[name='psw1']").val();
                                    var index = layer.load(1);

                                    $.ajax({
                                        type: 'POST',
                                        url: '/register',
                                        data: {'email': email, 'username': username, 'psw1': psw1},
                                        dataType: 'json',
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                        },

                                        success: function (data) {
                                            if (data.msg == 'success') {
                                                swal({
                                                    title: "Success",
                                                    text: "register successfully!<br><a href='/index'>click here to login</a>",
                                                    html: true,
                                                    type: "success"
                                                });
                                                $("input[name='email']").val("");
                                                $("input[name='username']").val("");
                                                $("input[name='psw1']").val("");
                                                $("input[name='psw2']").val("");
                                            } else {
                                                layer.msg("server wrong", {icon: 2, anim: 6});
                                            }
                                            layer.close(index);
                                        },
                                        error: function (xhr, type) {
                                            layer.msg("error", {icon: 2, anim: 6});
                                            layer.close(index);
                                        }
                                    });

                                    return false;
                                } else {
                                    swal('Oops', "you should agree relevant items", 'warning');
                                    return false;
                                }
                            } else {
                                swal("Oops", "fill in all information in correct format, please", 'warning');
                                return false;
                            }
                        });


        $("input[name='passwordforlogin']").keyup(function (e) {
            if (e.keyCode==13){
                $('#submit1').trigger('click');
            }
        });


        $('#submit1')
                .click(
                        function () {
                            var accountforlogin = $("input[name='accountforlogin']").val();

                            if (accountforlogin.trim() == "") {
                                layer.msg("enter your email", {icon: 3, anim: 6, time: 1000, offset: ['100px']});
                                return false;
                            }
                            var passforlogin = $("input[name='passwordforlogin']").val();

                            if (passforlogin.trim() == "") {
                                layer.msg("enter your password", {icon: 3, anim: 6, time: 1000, offset: ['100px']});
                                return false;
                            }


                            var email = $("input[name='accountforlogin']").val();
                            var password = $("input[name='passwordforlogin']").val();
                            var index = layer.load(1);

                            $.ajax({
                                type: 'POST',
                                url: '/login',
                                data: {'accountforlogin': email, 'passwordforlogin': password},
                                dataType: 'json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                },

                                success: function (data) {
                                    if (data.msg == 'success') {
                                        layer.close(index);
                                        window.location.href = "/main";
                                    } else {
                                        layer.msg("password or account is wrong", {
                                            icon: 2,
                                            anim: 6,
                                            time: 1000,
                                            offset: ['100px']
                                        });
                                        $("input[name='passwordforlogin']").val("");
                                        layer.close(index);
                                    }

                                },
                                error: function (xhr, type) {
                                    layer.msg("error", {icon: 2, anim: 6});
                                    layer.close(index);
                                }
                            });

                            return false;


                        });

    });


</script>

</body>
</html>
