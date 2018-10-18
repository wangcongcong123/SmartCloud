<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1"/>

    <title>Smart Cloud Contact</title>


    <link rel="stylesheet" href="asserts/bootstrap.min.css">
    <link rel="stylesheet" href="asserts/css/AdminLTE.min.css">
    <link rel="stylesheet" href="asserts/fbicons/css/font-awesome.min.css">
    <link rel="stylesheet" href="asserts/css/skins/_all-skins.min.css">
    {{--<link rel="stylesheet" href="asserts/plugins/sweetalert/sweetalert.css">--}}
    <link rel="stylesheet" href="asserts/plugins/layui/css/layui.css">

    <style>

        body {
            background: #ecf0f5;
            font-family: Baskerville, "Palatino Linotype", Palatino,
            "Century Schoolbook L", "Times New Roman", serif;
        }

        .main-header{
            background:#4ec7d6;
        }

        .content {
            margin-top:50px;
            min-height: 250px;
            padding: 15px;
            margin-right: auto;
            margin-left: auto;
            padding-left: 15px;
            padding-right: 15px;
        }

        .qrcode{
            position: relative;
            z-index: 2;
        }

        .qrcode:hover{
            z-index: 3;
        }



        .qrcode span{
            display: none;
        }

        .qrcode:hover span{
            display: block;
            position: absolute;
        }


    </style>

</head>
<body>

<!-- header -->
<header class="main-header">
    <!-- Logo -->
    <a href="{{'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]}}" class="logo"> <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-lg"><b>Smart</b>Cloud</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li>
                    <a href="{{route('index')}}" id="sign-in"> <i class="fa fa-sign-in"></i></a>
                </li>


            </ul>
        </div>
    </nav>
</header>




<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><span class="glyphicon glyphicon-file"></span> Share File <a href="{{$file->filepath}}"><span style="color: red">{{$file->filename}}</span></a></h3>

                    <a href="{{$file->filepath}}" class="pull-right"><span class="glyphicon glyphicon-search"></span></a>
                </div>


                <div class="box-body no-padding">

                    <div class="table-responsive"
                         style="overflow-x: auto; overflow-y: auto; height: 400px; width: 100%;">

                        <table class="table table-striped">
                            <tbody>
                            <tr>

                                <th style="width: 10px">ID</th>
                                <th>Download</th>
                                <th>File Name</th>
                                <th>QR Code</th>
                                <th>Period of Validity</th>
                                <th>Shared At</th>
                                <th>Shared By</th>

                            </tr>
                            <tr>

                            <tr>
                                <td>{{$share->file_id}}</td>

                                <td class="download"><a  href="/file/download?filepath={{$file->filepath}}&filename={{$file->filename}}"><i class="fa fa-cloud-download"></i></a></td>

                                <td class="shared-at">
                                    {{$file->filename}}
                                </td>


                                <td class="qrcode"><a href="{{$share->qrcode_path}}"  class="qrcode"><img src="{{$share->qrcode_path}}" width="40px"
                                                                                                         height="40px"><span><img src="{{$share->qrcode_path}}" width="200px" height="200px"></span></a>
                                </td>
                                <td class="valid-time">{{$share->valid_time}}</td>

                                <td class="shared-at">
                                    {{$share->updated_at}}
                                </td>

                                <td>
                                    {{$share->user_account}}
                                </td>

                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
    </div>
</section>


<section class="content-footer" style="color: #666;text-align:center">
    <p>Copyright © 2017. BDIC Group 7 Module Project 2 All rights
        reserved.</p>


    <!-- JiaThis Button BEGIN -->
    <div style="margin-left: 10px">
        <div class="jiathis_style_32x32">
            <a class="jiathis_button_qzone"
               href="http://www.jiathis.com/send/?webid=qzone&url=http://www.baidu.com&title=myhome"></a>
            <a class="jiathis_button_tsina"></a> <a
                    class="jiathis_button_tqq"></a> <a class="jiathis_button_weixin"></a>
            <a class="jiathis_button_renren"></a> <a
                    href="http://www.jiathis.com/share"
                    class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
            <a class="jiathis_counter_style"></a>
        </div>
        <script type="text/javascript"
                src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>

        <!-- JiaThis Button END -->
    </div>





</section>


</body>


<script src="asserts/bootstrap.min.js"></script>
<script src="asserts/plugins/layui/lay/modules/jquery.js"></script>
<script src="asserts/plugins/layui/layui.js"></script>
<script src="asserts/jquery-1.9.1.min.js"></script>


<script>




</script>
</html>