@extends('layouts.app') @section('mycss')

    <link rel="stylesheet" href="mycss/main.css">
    <style>
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
    <!-- <link rel="stylesheet" href="mycss/upinglist.css"> -->

@endsection @section('content')
    <!-- content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a id="upload" class="btn btn-success btn-block margin-bottom">Upload
                    a file</a>
                {{--<a href="upload.html"--}}
                   {{--class="btn btn-primary btn-block margin-bottom">Upload in Batches</a>--}}
                <div class="box box-solid">

                    <div class="box-header with-border">
                        <h3 class="box-title">Management</h3>
                    </div>

                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked" id="leftuptab">
                            <li><a href="{{route('main')}}"><i class="fa fa-files-o"></i> Files
                                </a></li>
                            {{--						<li><a href="{{route('upinglist')}}"><i class="fa fa-file"></i> Uploading List </a></li>--}}
                            {{--<li><a href="{{route('downinglist')}}"><i class="fa fa-file-o"></i> Downloading List </a></li>--}}
                            <li class="active"><a href="{{route('fileshared')}}"><i class="fa fa-share-alt-square"></i>
                                    File
                                    Shared <span class="label label-warning pull-right">{{count($sharelist)}}</span></a>
                            </li>
                            <li><a href="{{route('trashlist')}}"><i class="fa fa-trash-o"></i> Trash</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Functions</h3>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="{{route('contact')}}"><i class="fa fa-exchange"></i>
                                    Friends</a></li>
                            <li><a href="#"><i class="fa fa-user-plus"></i> Help</a></li>
                            <li><a href="#"><i class="fa fa-smile-o"></i> Contact us</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Share List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">

                        <div class="table-responsive"
                             style="overflow-x: auto; overflow-y: auto; height: 500px; width: 100%;">

                            <table class="table table-striped">
                                <tbody>
                                <tr>

                                    <th style="width: 10px">ID</th>
                                    <th>ShareFile Name</th>
                                    <th>Share Link</th>
                                    <th>Period of Validity</th>
                                    <th>QR Code</th>
                                    <th>Share Password</th>
                                    <th>Options</th>
                                    <th>Share At</th>

                                </tr>
                                <tr>


                                @foreach($sharelist as $share)
                                    <tr>
                                        <td class="share-file-id">{{$share->file_id}}</td>
                                        <td class="share-file-name">{{$share->filename}}<span style="display: none">{{$_SERVER['HTTP_HOST'].'/uploads/'.$_COOKIE['account'].'/ison/'.$share->filename}}</span></td>

                                        <td class="share-link"><a
                                                    href="{{$share->share_link}}">{{$_SERVER['HTTP_HOST'].$share->share_link}}</a>
                                        </td>


                                        <td class="share-valid-time">{{$share->valid_time}}</td>
                                        <td class="share-qrcode">
                                            <div class="qrcode"><a href="{{$share->qrcode_path}}"><img
                                                            src="{{$share->qrcode_path}}" width="40px"
                                                            height="40px"></a><span><img src="{{$share->qrcode_path}}"
                                                                                         width="200px"
                                                                                         height="200px"></span></div>
                                        </td>

                                        <td class="pass-field">
                                            <p>{{$share->share_password}}</p>
                                            <div style="display: none;">
                                                <input type="text" name="passfield" size="10">
                                            </div>
                                        </td>

                                        <td>


                                            @if($share->qrcode_path=="")
                                                <a class="generate-qr" data-toggle="tooltip" data-placement="top"
                                                   title="generate qrcode"><i class="fa fa-plus"></i></a>
                                            @endif
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <a class="delete-share" data-toggle="tooltip" data-placement="right"
                                               title="delete this share"><i class="fa fa-trash-o"></i></a>
                                        </td>


                                        <td>{{$share->updated_at}}</td>

                                    </tr>

                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>
    </section>


    {{--<div id="sharelinkbox" class="box box-default" style="display: none;">--}}

    {{--<div class="box-header with-border">--}}
    {{--<h3 class="box-title" id="share-title">file <span id="share-file-id"></span></h3>--}}
    {{--</div>--}}


    {{--<div class="box-body" style="padding:20px">--}}

    <div id="validtimebox" style="display: none; margin: 20px">
        <div class="form-group">
            <label>Choose period of validity</label>
            <select id="validtime" class="form-control">
                <option value="one hour">one hour</option>
                <option value="one day">one day</option>
                <option value="one week">one week</option>
                <option value="one month">one month</option>
                <option value="forever">forever</option>
            </select>
        </div>

    </div>
    {{--<div class="input-group input-group-sm">--}}
    {{--<label>Do you want to set a password for this link?</label>--}}
    {{--<input class="form-control" type="text" name="link-password" id="link-password"--}}
    {{--placeholder="enter your password and empty for no password">--}}
    {{--</div>--}}

    {{--<br>--}}


    {{--<div class="input-group input-group-sm">--}}


    {{--<input class="form-control" id="share-link-input" type="text"--}}
    {{--placeholder="click generate button to get his file's share link"--}}
    {{--disabled="disabled">--}}

    {{--<h4 id="share-link-input"></h4>--}}

    {{--<span class="input-group-btn">--}}
    {{--<button type="button" id="generate-share-link" class="btn btn-default btn-flat">generate</button>--}}
    {{--</span>--}}


    {{--</div>--}}

    {{--<br>--}}
    {{--<hr>--}}


    {{--<div class="row">--}}

    {{--<a id="generate-qrcode" class="btn btn-default btn-block margin-bottom"> + generate QRCode</a>--}}

    {{--</div>--}}

    {{--<div align="center"><img src="images/admin.jpg" id="qrcode-img" style="display: none;" width="300px"--}}
    {{--height="300px">--}}
    {{--</div>--}}
    {{--</div>--}}


    {{--</div>--}}



@endsection
@section('myjs')
    <script src="asserts/plugins/layui/layui.js"></script>
    <script type="text/javascript">
        layui.use('layer', function () {

            var layer = layui.layer;


            $('.delete-share').click(function () {
                var thisrow = $(this);


                var file_id = $(this).parent().siblings('.share-file-id').text();


                layer.open({
                    title: "sure for deletion",
                    content: 'are you sure to delete it?',
                    yes: function () {
                        var index2 = layer.load(2);
                        $.ajax({
                            type: 'POST',
                            url: '/deleteshare',
                            data: {
                                'file_id': file_id
                            },


                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },

                            success: function (data) {
                                if (data.status == 1) {

                                    layer.msg("link deleted successfully!", {icon: 1, anim: 2, time: 1000});
                                    thisrow.parent().parent().hide();

                                } else {
                                    layer.msg("wrong", {icon: 2, anim: 6, time: 1000});
                                }


                                layer.close(index2);
                            },
                            error: function (xhr, type) {
                                layer.msg("error", {icon: 2, anim: 6, time: 1000});
                                layer.close(index2);
                            }
                        });

                    }
                });

            });

            $("input[name='passfield']").keyup(function (e) {

                if (e.keyCode == 13) {

                    var thisle = $(this);

                    var pele = $(this).parent().parent().children('p');


                    var val = $(this).val().trim();

                    var pre = $(this).parent().parent().children('p').text();

                    var fileid = $(this).parent().parent().siblings('.share-file-id').text();


                    if (val === "" || val === pre) {
                        $(this).parent().hide();
                        return false;
                    }


                    if (val.length != 4) {
                        layer.msg("enter four digits paassword", {icon: 2, anim: 6, time: 1000});
                        return false;
                    }

                    var index = layer.load(2);

                    $.ajax({
                        type: 'POST',
                        url: '/altersharepass',
                        data: {'updated_pass': val, 'file_id': fileid},
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },

                        success: function (data) {

                            if (data.status == 1) {

                                layer.msg('success!', {
                                    icon: 1,
                                    anim: 5,
                                    time: 1000
                                });

                                thisle.parent().hide();
                                pele.text(val);

                            } else {
                                layer.msg("do somehting wrong", {icon: 2, anim: 6, time: 1000});
                            }


                            layer.close(index);
                        },
                        error: function (xhr, type) {
                            layer.msg("error", {icon: 2, anim: 6, time: 1000});
                            layer.close(index);
                        }
                    });


                }


            });


            $('.pass-field').click(function () {

                $(this).children('div').show();
                $(this).children('div').children('input').val($(this).children('p').text());

            });


            $('.generate-qr').click(function () {


                var thisele = $(this);

                var link = $(this).parent().siblings('.share-link').text();

                var filepath = $(this).parent().siblings('.share-file-name').children('span').text();




                if (link === "") {
                    layer.msg("you should first generate share link", {icon: 2, anim: 6, time: 1000});
                    return false;
                }


                var sear = new RegExp('localhost');

                if (sear.test(link)) {
                    link = link.replace('localhost', '172.21.70.83');
                }


                var qrpath = 'http://qr.liantu.com/api.php?text=' + filepath + '&logo=http://congcongxyz.cn/images/admin.jpg&bg=f3f3f3&fg=ff2200&gc=22ff22&w=300&el=l';

                var fileid = $(this).parent().siblings('.share-file-id').text();


                var index = layer.load(2);

                var qrlink = $(this).parent().siblings('.share-qrcode').children('div').children('a');

                var sqrimg = qrlink.children('img');

                var bqrimg = qrlink.siblings('span').children('img');


                $.ajax({
                    type: 'POST',
                    url: '/storeqrpath',
                    data: {
                        'qrpath': qrpath,
                        'fileID': fileid
                    },
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },

                    success: function (data) {
                        if (data.status == 1) {

                            qrlink.attr('href', qrpath);

                            sqrimg.attr('src', qrpath);

                            bqrimg.attr('src', qrpath);

                            layer.msg('success!', {
                                icon: 1,
                                anim: 5,
                                time: 1000
                            });

                            thisele.hide();

                        } else {
                            layer.msg("wrong", {icon: 2, anim: 6, time: 1000});
                        }
                        layer.close(index);
                    },
                    error: function (xhr, type) {
                        swal('Oops...', "Error! ", 'error');
                        layer.close(index);
                    }
                });


            });

            $('.share-valid-time').click(function () {

                var thisele = $(this);

                $("#validtime").val(thisele.text());

                var fileid = thisele.siblings('.share-file-id').text();

                layer.open({
                    type: 1,
                    title: 'pick valid time for file with id <b>' + fileid + "</b>",
                    content: $('#validtimebox'),
                    area: ['300px', '200px'],
                    anim: 2,
                    shade: 0,
                    closeBtn: 2,
                    btn: ['yes', 'no'],
                    yes: function (index2) {
                        var updated = $("#validtime").val();


                        if (thisele.text() === updated) {
                            layer.msg("no change", {icon: 2, anim: 6, time: 1000});
                            return false;
                        }


                        var index = layer.load(2);

                        $.ajax({
                            type: 'POST',
                            url: '/altervalidtime',
                            data: {'updated_time': updated, 'file_id': fileid},
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },

                            success: function (data) {

                                if (data.status == 1) {

                                    layer.msg('success!', {
                                        icon: 1,
                                        anim: 5,
                                        time: 1000
                                    });

                                    thisele.text(updated);
                                    layer.close(index2);


                                } else {
                                    layer.msg("do something wrong", {icon: 2, anim: 6, time: 1000});
                                }


                                layer.close(index);
                            },
                            error: function (xhr, type) {
                                layer.msg("error", {icon: 2, anim: 6, time: 1000});
                                layer.close(index);
                            }
                        });


                    }
                });


            });


            $('.edit-pass').click(function () {

                var file_id = $(this).parent().siblings('.share-file-id').text();
                $("#share-file-id").text(file_id);

                var thisvalidfield = $(this).parent().siblings('.share-valid-time');

                var validtime = thisvalidfield.text();

                $('#validtime').val(validtime);


                var thispassfield = $(this).parent().siblings('.pass-field').children('p');
                var password = thispassfield.text();

                $("input[name='link-password']").val(password);


                var sharelink = $(this).parent().siblings('.share-link').children('a').text();

                $("#share-link-input").text(sharelink);


                var qrcode = $(this).parent().siblings('.share-qrcode').children('div').children('a').attr('href');

                $("#qrcode-img").show();

                $("#qrcode-img").attr('src', qrcode);


                layer.open({
                    type: 1,
                    skin: 'layui-layer-lan',
                    title: 'Generate share link',
                    content: $('#sharelinkbox'),
                    area: ['400px', '500px'],
                    anim: 2,
                    shade: 0,
                    closeBtn: 2,
                    btn: ['confirm to alter'],
                    yes: function () {

                        var index = layer.load(2);

                        var validtime = $('#validtime').val();
                        var password = $("input[name='link-password']").val().trim();

                        if (password != "" && password.length != 4) {
                            layer.msg('enter 4 digits password', {icon: 2, anim: 6, time: 1000});
                            return false;
                        }


                        $.ajax({
                            type: 'POST',
                            url: '/altershare',
                            data: {
                                'file_id': file_id,
                                'validtime': validtime,
                                'linkpassword': password
                            },


                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },

                            success: function (data) {
                                if (data.status == 1) {
                                    thisvalidfield.text(validtime);
                                    thispassfield.text(password);
                                    layer.msg("link generated successfully!", {icon: 1, anim: 2, time: 1000});
                                } else {
                                    layer.msg("do some changes", {icon: 2, anim: 6, time: 1000});
                                }


                                layer.close(index);
                            },
                            error: function (xhr, type) {
                                layer.msg("error", {icon: 2, anim: 6, time: 1000});
                                layer.close(index);
                            }
                        });


                    }

                });


            });

//            $('.qrcode').on('mouseover',function () {
//
//                $(this).children('img').attr({
//                    'width':'100px',
//                    'height':'100px'
//                });
//
//            });
//
//
//
//            $('.qrcode').on('mouseout',function () {
//
//                $(this).children('img').attr({
//                    'width':'40px',
//                    'height':'40px'
//                });
//
//            });


        });


    </script>
@endsection