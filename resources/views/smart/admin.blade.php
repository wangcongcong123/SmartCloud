<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1"/>

    <title>Smart Cloud Admin</title>


    <link rel="stylesheet" href="asserts/bootstrap.min.css">
    <link rel="stylesheet" href="asserts/css/AdminLTE.min.css">
    <link rel="stylesheet" href="asserts/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="asserts/fbicons/css/font-awesome.min.css">
    <link rel="stylesheet" href="asserts/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="asserts/plugins/layui/css/layui.css">


    <style>

        body {
            background: #ecf0f5;
            font-family: Baskerville, "Palatino Linotype", Palatino,
            "Century Schoolbook L", "Times New Roman", serif;
        }

        .main-header {
            background: #4ec7d6;
        }

        .content {
            margin-top: 50px;
            min-height: 250px;
            padding: 15px;
            margin-right: auto;
            margin-left: auto;
            padding-left: 15px;
            padding-right: 15px;
        }

        .qrcode {
            position: relative;
            z-index: 2;
        }

        .qrcode:hover {
            z-index: 3;
        }

        .qrcode span {
            display: none;
        }

        .qrcode:hover span {
            display: block;
            position: absolute;
        }


    </style>

</head>
<body>
<?php
// units convertion
function getRealSize($size)
{
    $kb = 1024; // Kilobyte
    $mb = 1024 * $kb; // Megabyte
    $gb = 1024 * $mb; // Gigabyte
    $tb = 1024 * $gb; // Terabyte
    if ($size < $kb) {
        return $size . " B";
    } else if ($size < $mb) {
        return round($size / $kb, 2) . " KB";
    } else if ($size < $gb) {
        return round($size / $mb, 2) . " MB";
    } else if ($size < $tb) {
        return round($size / $gb, 2) . " GB";
    } else {
        return round($size / $tb, 2) . " TB";
    }
}


$totalsize = 0;

foreach ($results as $result) {
    $totalsize += $result->filesize;
}

$totalsize = round($totalsize / (1024 * 1024), 2) . " MB";

?>
<!-- header -->
<header class="main-header">
    <!-- Logo -->
    <a href="{{'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-lg"><b style="color: darkred">Administrator</b> <i class="fa fa-gear"></i></span>
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

                    <h3 class="box-title"><span class="glyphicon glyphicon-file"></span> List of All Files <span
                                class="label label-info" id="filenumber">{{count($results)}}</span> <span
                                class="label label-danger" id="totalsize">{{$totalsize}}</span>
                    </h3>

                    <a class="pull-right" id='searchfile'><span class="glyphicon glyphicon-search"></span></a>
                </div>


                <div class="box-body no-padding">

                    <div class="table-responsive"
                         style="overflow-x: auto; overflow-y: auto; height: 600px; width: 100%;">

                        <table id='filetable' class="table table-striped">
                            <thead>
                            <tr>

                                <th style="width: 10px">ID</th>
                                <th>Download</th>
                                <th>File Name</th>
                                <th>Desc</th>
                                <th>File Type</th>
                                <th>File Size</th>
                                <th>Status</th>
                                <th>ParentID</th>
                                <th>Options</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Uploaded By</th>

                            </tr>
                            </thead>

                            <tbody>
                            @foreach($results as $result)
                                <tr>
                                    <td class="file-id">{{$result->file_id}}</td>

                                    <td class="download"><a
                                                href="/file/download?filepath={{$result->filepath}}&filename={{$result->filename}}"><i
                                                    class="fa fa-cloud-download"></i></a></td>

                                    <td class="file-name">
                                        {{$result->filename}}
                                    </td>


                                    <td class="desc">
                                        {{$result->decs}}
                                    </td>


                                    <td class="file-type">

                                        @if($result->filetype=="folder")
                                            <i class="fa fa-folder"></i>
                                        @else
                                            <i class="fa fa-file-o"></i>
                                        @endif

                                    </td>
                                    <th class="file-size">{{getRealSize($result->filesize)}}</th>


                                    <td class="status">
                                        {{$result->status}}
                                    </td>
                                    <td class="parent-id">
                                        {{$result->parent_id}}
                                    </td>


                                    <td class="options">
                                        <a data-toggle="tooltip" data-placement="left" title="destroy this file"
                                           class="deletefile"><i class="fa fa-trash-o"></i><span class='file-path' style="display: none">{{$result->filepath}}</span></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <a data-toggle="tooltip" data-placement="right"
                                           title="destroy the user and relevant files" class="deleteuser"><i
                                                    class="fa fa-trash"></i></a>
                                    </td>


                                    <td class="created-at">
                                        {{$result->created_at}}
                                    </td>


                                    <td class="updated-at">
                                        {{$result->updated_at}}
                                    </td>


                                    <td class="uploaded-by">{{$result->user_account}}</td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        {{--<div class="col-md-offset-2"></div>--}}
    </div>
</section>


<section class="content-footer" style="color: #666;text-align:center">
    <p>Copyright © 2017. BDIC Group 7 Module Project 2 All rights
        reserved.</p>



</section>







<script src="asserts/jquery.min.js"></script>
<script src="asserts/bootstrap.min.js"></script>
<script src="asserts/app.min.js"></script>
<script src="asserts/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="asserts/plugins/datatables/dataTables.bootstrap.min.js"></script>
{{--<script src="asserts/plugins/layui/lay/modules/jquery.js"></script>--}}
<script src="asserts/plugins/layui/layui.js"></script>
{{--<script src="asserts/jquery-1.9.1.min.js"></script>--}}

<script>


    $(document).ready(function () {

        layui.use('layer', function () {

            layer = layui.layer;


            $("#filetable").dataTable({
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "order": [[9, "desc"]]
            });


            $('.deleteuser').click(function () {

                var account = $(this).parent().siblings('.uploaded-by').text();
                if (account==="admin"){
                    layer.msg('you cannot remove yourself!', {icon: 2,anim:6, time: 1000});
                    return false;
                }

                layer.open({
                    content: 'you are goona delete the user['+ account+'] and all relevant files and folders',
                    title: 'are you sure?',
                    yes: function () {
                        $.ajax({
                            type: 'POST',
                            url: '/deleteuserbyadmin',
                            data: {'user_account': account},
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                            success: function (data) {
                                if (data.msg == 'success') {
                                    window.location.href='/admin';
                                } else {
                                    alert(data.msg);
                                    layer.msg('wrong !', {icon: 2,anim:6, time: 1000});
                                }
                            },
                            error: function (xhr, type) {
                                layer.msg('error !', {icon: 2,anim:6, time: 1000});
                            }
                        });
                    }

                });

            });

            $('.deletefile').click(function () {


                var file_id = $(this).parent().siblings('.file-id').text();

                var filepath = $(this).children('.file-path').text();

                var filesizecolumn = $(this).parent().siblings('.file-size');



                layer.open({
                    content: 'are your sure to destroy the file with id ' + file_id,
                    title: 'are you sure?',
                    yes: function () {
                        $.ajax({
                            type: 'POST',
                            url: '/deletefilebyadmin',
                            data: {'file_id': file_id,'filepath':filepath},
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                            success: function (data) {
                                if (data.msg == 'success') {
                                    window.location.href='/admin';
                                } else {
                                    layer.msg('wrong !', {icon: 2,anim:6, time: 1000});
                                }
                            },
                            error: function (xhr, type) {
                                layer.msg('error !', {icon: 2,anim:6, time: 1000});
                            }
                        });
                    }

                });


            });

        });

    });
</script>


</body>
</html>