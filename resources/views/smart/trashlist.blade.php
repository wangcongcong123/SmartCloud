@extends('layouts.app') @section('mycss')

    <link rel="stylesheet" href="mycss/main.css">
    <!-- <link rel="stylesheet" href="mycss/upinglist.css"> -->

@endsection
@section('content')
    <!-- content -->

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
    ?>
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
                            {{--<li><a href="{{route('upinglist')}}"><i class="fa fa-file"></i> Uploading List </a></li>--}}
                            {{--<li><a href="{{route('downinglist')}}"><i class="fa fa-file-o"></i> Downloading List </a></li>--}}
                            <li><a href="{{route('fileshared')}}"><i class="fa fa-share-alt-square"></i> File
                                    Shared</a>
                            </li>
                            <li class="active"><a href="{{route('trashlist')}}"><i class="fa fa-trash-o"></i> Trash<span
                                            class="label label-danger pull-right"
                                            id="filelistnumber">{{count($filesontrash)}}</span></a>
                            </li>
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
                        <h3 class="box-title">Trash List &nbsp;&nbsp;&nbsp;&nbsp;<span
                                    class="total-size label label-success" id="sizeonfilelist">{{$sizeontrash}}</span>
                        </h3>
                        <a class="clear-trash pull-right" rel="popover" data-placement="left"
                           data-content="remove all files permanently in the list"
                           data-original-title="Destroy all files"><span class="glyphicon glyphicon-trash"></span></a>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body no-padding">

                        <div class="table-responsive"
                             style="overflow-x: auto; overflow-y: auto; height: 500px; width: 100%;">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr class="danger">
                                    <th style="width: 10px">ID</th>
                                    <th style="display: none">filepath</th>
                                    <th>Name</th>
                                    <th>Size</th>
                                    <th>Time put here</th>
                                    <th>Options</th>
                                    <th>Type</th>
                                </tr>
                                </thead>

                                <tbody>


                                @foreach ($filesontrash as $fileontrash)
                                    <tr>
                                        <td class="trash-id">{{$fileontrash->file_id}}</td>
                                        <td class="trash-path" style="display: none">{{$fileontrash->filepath}}</td>
                                        <td class="trash-name">
                                            {{$fileontrash->filename}}
                                        </td>
                                        <td class="trash-size">
                                            @if($fileontrash->filetype!='folder')
                                                {{getRealSize($fileontrash->filesize)}}
                                            @endif
                                        </td>
                                        <td class="trash-time">{{$fileontrash->updated_at}}</td>
                                        <td class="trash-time">
                                            <a class="trash-put-back" rel="popover" data-content="Put back"><i
                                                        class="fa fa-reply"></i>&nbsp;&nbsp;&nbsp;</a>
                                            <a class="trash-destroy" rel="popover" data-content="Destroy it"><i
                                                        class="fa fa-trash-o"></i></a>
                                        </td>
                                        <td>
                                            @if($fileontrash->filetype=='folder')
                                                <i class="fa fa-folder"> </i>
                                            @else
                                                <i class="fa fa-file-o"> </i>
                                            @endif
                                        </td>
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
    <!-- verification modal -->
    <div class="modal fade" id="uploadmodal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <label><span class="glyphicon glyphicon-file"></span> Upload Window</label>
                    </h4>
                </div>

                <div class="modal-body">
                    <form enctype="multipart/form-data" role="form" name="form3"
                          id="ff3" method="post" action="#">
                        <div class="form-group">
                            <label><span class="glyphicon glyphicon-file"></span> <font
                                        color="red">*</font>Pick a file</label> <input type="file"
                                                                                       class="form-control"
                                                                                       name="afile">
                        </div>
                        <button type="submit" class=" btn btn-success btn-block">
                            <span class="glyphicon glyphicon-upload"></span> upload
                        </button>
                    </form>

                    <div class="progress progress-striped active"
                         style="margin-top: 20px">
                        <div class="progress-bar progress-bar-info" role="progressbar"
                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                             style="width: 40%">
                            <span>40%</span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-default pull-right"
                            data-dismiss="modal" id="cancelforhost">
                        <span class="glyphicon glyphicon-remove"></span> Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="foldermodal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <label><span class="glyphicon glyphicon-file"></span> Remove File
                            Window</label>
                    </h4>
                </div>

                <div class="modal-body">
                    <div class="zTreeDemoBackground left">
                        <ul id="treeDemo" class="ztree"></ul>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-success pull-right"
                            data-dismiss="modal" id="cancelforhost">
                        <span class="glyphicon glyphicon-share"></span> Confirm
                    </button>

                    <button type="button" class="btn btn-danger pull-left"
                            data-dismiss="modal" id="cancelforhost">
                        <span class="glyphicon glyphicon-remove"></span> Cancel
                    </button>

                </div>
            </div>
        </div>
    </div>


    <!-- create folder modal -->
    <div class="modal fade" id="cfoldermodal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <label><span class="glyphicon glyphicon-file"></span> Create Folder
                            Window</label>
                    </h4>
                </div>

                <div class="modal-body">

                    <form method="post" action="#">
                        <div class="form-group">
                            <label><span class="glyphicon glyphicon-folder"></span> <font
                                        color="red">*</font>Enter folder name</label> <input type="text"
                                                                                             class="form-control"
                                                                                             name="cfoldername">
                        </div>
                    </form>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-success pull-right"
                            data-dismiss="modal" id="cancelforhost">
                        <span class="glyphicon glyphicon-folder"></span> Create
                    </button>

                    <button type="button" class="btn btn-danger pull-left"
                            data-dismiss="modal" id="cancelforhost">
                        <span class="glyphicon glyphicon-remove"></span> Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("myjs")

    <script type="text/javascript">

        $(document).ready(function () {


            layui.use('layer', function () {

                var layer = layui.layer;

                $('.clear-trash').hover(function () {
                    $(this).popover('show');
                }, function () {
                    $(this).popover('hide');
                });
                $('.trash-put-back').hover(function () {
                    $(this).popover('show');
                }, function () {
                    $(this).popover('hide');
                });
                $('.trash-destroy').hover(function () {
                    $(this).popover('show');
                }, function () {
                    $(this).popover('hide');
                });


                $('.clear-trash').click(function () {
                    var fileidarr = [];
                    var ids = $('.trash-id');

                    for (var i = 0; i < ids.length; i++) {
                        fileidarr.push(ids.eq(i).text());
                    }
                    if (fileidarr.length == 0) {
                        swal("now is empty");
                        return false;
                    }

                    var filepatharr = [];
                    var paths = $('.trash-path');
                    for (var i = 0; i < paths.length; i++) {
                        filepatharr.push(paths.eq(i).text());
                    }

                    swal({
                                title: "Are you sure?",
                                text: "You are going to empty all files in the list ",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: '#DD6B55',
                                confirmButtonText: 'Yes, empty',
                                cancelButtonText: "No, cancel!",
                                closeOnConfirm: false
                            },
                            function () {

                                $.ajax({
                                    type: 'POST',
                                    url: '/file/emptytrash',
                                    data: {'fileids': fileidarr, 'filepaths': filepatharr},
                                    dataType: 'json',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                    },
                                    success: function (data) {
                                        if (data.msg == 'success') {
                                            swal({
                                                title: 'Success',
                                                text: "all files were cleared successfully! ",
                                                type: 'success',
                                                closeOnConfirm: false
                                            }, function () {
                                                window.location.href = "/trashlist";
                                            });
                                        } else {
                                            swal('Unkowning', "Error! ", 'error');
                                        }
                                    },
                                    error: function (xhr, type) {
                                        swal('Oops...', "Error! ", 'error');
                                    }
                                });


                            });
                });


                function convertUnitToMB(size) {
                    if (size.indexOf("TB") != -1) {
                        return (parseFloat(size) * 1024 * 1024 * 1024 * 1024).toFixed(2);
                    } else if (size.indexOf("GB") != -1) {
                        return (parseFloat(size) * 1024 * 1024 * 1024).toFixed(2);
                    } else if (size.indexOf("MB") != -1) {
                        return (parseFloat(size)).toFixed(2);
                    } else if (size.indexOf("KB") != -1) {
                        return (parseFloat(size) / 1024).toFixed(2);
                    } else {
                        return (parseFloat(size)/(1024*1024)).toFixed(2);
                    }

                }


                $('.trash-destroy').click(function () {

                    var file_id = $(this).parent().siblings('.trash-id').text();
                    var filepath = $(this).parent().siblings('.trash-path').text();


                    swal({
                                title: "Are you sure?",
                                text: "You are going to remove the file permanently with id = <span style='color:red'> " + file_id + "</span>",
                                type: "warning",
                                showCancelButton: true,
                                html: true,
                                confirmButtonColor: '#DD6B55',
                                confirmButtonText: 'Yes, destroy it!',
                                cancelButtonText: "No, cancel!",
                                closeOnConfirm: false
                            },

                            function () {
                                $.ajax({
                                    type: 'POST',
                                    url: '/file/destroyfile',
                                    data: {'file_id': file_id, 'filepath': filepath},
                                    dataType: 'json',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                    },
                                    success: function (data) {
                                        if (data.msg == 'success') {

                                            window.location.href="/trashlist";

                                        } else {
                                            swal('Unkowning', "Error! ", 'error');
                                        }
                                    },
                                    error: function (xhr, type) {
                                        swal('Oops...', "Error! ", 'error');
                                    }
                                });
                            });

                });


                $('.trash-put-back').click(function () {

                    var file_id = $(this).parent().siblings('.trash-id').text();

                    var thisgrandparent = $(this).parent().parent();

                    var filesizecolumn = $(this).parent().siblings('.trash-size');

                    var thisfilesize = convertUnitToMB(filesizecolumn.text());

                    $.ajax({
                        type: 'POST',
                        url: '/file/putback',
                        data: {'file_id': file_id},
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        success: function (data) {
                            if (data.msg == 'success') {

                                thisgrandparent.hide();
                                layer.msg('put back success', {icon: 1, time: 1000});
                                $('#filelistnumber').text($('#filelistnumber').text() - "1");
                                $("#sizeonfilelist").text(((parseFloat($("#sizeonfilelist").text()) - thisfilesize)).toFixed(2) + ' MB');

                            } else {
                                swal('Unkowning', "Error! ", 'error');
                            }
                        },
                        error: function (xhr, type) {
                            swal('Oops...', "Error! ", 'error');
                        }
                    });
                });
            });

        });
    </script>

@endsection


