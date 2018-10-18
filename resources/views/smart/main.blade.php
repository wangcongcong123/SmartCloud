@extends('layouts.app') @section('mycss')


    <link rel="stylesheet" href="asserts/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="mycss/main.css">

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
    <input type="file" id="uploadface" style="display: none">


    <div id='hideallfiles' style="display: none">{{json_encode($sendfiles)}}</div>
    <div id='hideallfolders' style="display: none">{{json_encode($sendfolders)}}</div>

    <section class="content">

        <div class="progressdiv">
            <div class="progress progress-striped active">
                <div class="progress-bar progress-bar-info" role="progressbar"
                     aria-valuenow="60" aria-valuemin="0" aria-valuemax="50"
                     style="width: 100%">
                    <span class="progresslabel"><label>100% </label></span>
                </div>
            </div>
            <a class="removebar">&nbsp;</a> <a class="removebar pull-right"><i
                        class="fa fa-remove"></i></a>
        </div>

        <div class="row">
            <div class="col-md-3">
                <a id="upload" class="btn btn-success btn-block margin-bottom">Upload a file</a>
                {{--<a href="javascript:swal({title:'Notice',text:'<h4>this function is building now</h4>',html:true,imageUrl: 'images/admin.jpg'});"--}}
                {{--class="btn btn-primary btn-block margin-bottom">Upload in Batches</a>--}}

                <div class="box box-solid">

                    <div class="box-header with-border">
                        <h3 class="box-title">Management</h3>
                    </div>

                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked" id="leftuptab">
                            <li class="active"><a href="{{route('main')}}"><i
                                            class="fa fa-files-o"></i> Files <span
                                            class="label label-danger pull-right"
                                            id="filelistnumber">{{count($sendfiles)+count($sendfolders)}}</span></a>
                            </li>
                            {{--href="{{route('upinglist')}}"--}}
                            <li><a id="showuplist"><i class="fa fa-file"></i>
                                    Uploading List </a></li>
                            {{--<li><a href="{{route('downinglist')}}"><i class="fa fa-file-o"></i>--}}
                            {{--Downloading List </a></li>--}}
                            <li><a href="{{route('fileshared')}}"><i
                                            class="fa fa-share-alt-square"></i> File Shared</a></li>
                            <li><a href="{{route('trashlist')}}"><i class="fa fa-trash-o"></i>
                                    Trash</a></li>
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


                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Others</h3>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#" id="userimage" data-toggle="tooltip" data-placement="top" data-title="click to upload user face icon"><i class="fa fa-user-o"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cloud"></i> Expand Storage</a></li>
                            <li><a href="#"><i class="fa fa-backward"></i> Log out</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">File List&nbsp;&nbsp;&nbsp;&nbsp;<span
                                    class="total-size label label-success"
                                    id="sizeonfilelist">{{str_replace('B','',$sizeonfilelist)}}</span></h3>
                        <div class="box-tools pull-right">
                            <div class="has-feedback">


                                <input id="nope" name="nope" class="form-control input-sm"
                                       placeholder="Search File Globally"
                                       type="text">

                                {{--<div class="field">--}}

                                {{--<div class="icon"></div>--}}

                                {{--<input type="text" name="nope" id="nope" placeholder="Crayola colors" maxlength="40" />--}}

                                {{--</div>--}}

                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                            </div>
                        </div>

                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="file-controls">
                            <!-- Check all button -->
                            <button type="button"
                                    class="btn btn-default btn-sm checkbox-toggle">
                                <i class="fa fa-square-o"></i>
                            </button>

                            <div class="btn-group">

                                <button type="button" class="btn btn-default btn-sm"
                                        id="downloadf">
                                    <i class="fa fa-download"></i>
                                </button>

                                <button type="button" class="btn btn-default btn-sm" id="cfolder">
                                    <i class="fa fa-folder-open"></i>
                                </button>

                                <button type="button" class="btn btn-default btn-sm"
                                        id="movefile">
                                    <i class="fa fa-share"></i>
                                </button>

                            </div>

                            <!-- /.btn-group -->
                            <button type="button" id="deleteselected" class="btn btn-default btn-sm pull-right">
                                <i class="fa fa-trash-o"></i>
                            </button>

                            <p></p>
                            <div>
                                <span style="float: left" id="navigator"><a id="mainnav"
                                                                            href="#">All files | </a> </span>

                                {{--<ul style="display: none; list-style: none" id="foldernav">--}}
                                {{----}}
                                {{--<li><a href="#">Back</a><span--}}
                                {{--class="historylistmanager-separator">|</span></li>--}}
                                {{----}}
                                {{--<li><a href="#">All files</a> <span--}}
                                {{--class="historylistmanager-separator-gt"> &gt; </span>--}}
                                {{--<span>placeholder</span>--}}
                                {{--</li>--}}
                                {{--</ul>--}}

                                <p style="clear: both"></p>
                            </div>
                            <div class="table-responsive file-messages"
                                 style="overflow-x: auto; overflow-y: auto; height: 600px; width: 100%;">


                                <table id="filetable" class="table table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>FileID</th>
                                        <th>Select</th>
                                        <th>Download</th>
                                        <th>Icon</th>
                                        <th>Name</th>
                                        <th style="width: 120px">Size</th>
                                        <th style="width: 120px">Description</th>
                                        <th>Options</th>
                                        <th style="width: 160px">Time</th>
                                    </tr>
                                    </thead>


                                    <tbody id="filetbody">

                                    @foreach($sendfolders as $folder)
                                        @if($folder->parent_id==0)
                                            <tr>
                                                <td class="folder-id">{{$folder->file_id}}</td>
                                                <td><a><i class="fa fa-search-plus"></i></a></td>
                                                <td class="folder-download"><a><i class="fa fa-search"></i></a></td>
                                                <td><a class="expandfolder"><i class="fa fa-folder"></i></a></td>

                                                <td class="folder-name">

                                                    <a class="alterfoldername"
                                                       data-toggle="tooltip" data-placement="right"
                                                       title="update name">{{$folder->filename}}</a>

                                                    <div style="display: none;">
                                                        <input type="text" name="foldername" size="4"> <a
                                                                class="yestoalter"><i class="fa fa-check"></i></a> <a
                                                                class="notoalter"><i class="fa fa-close"></i></a>
                                                    </div>
                                                </td>

                                                <td class="folder-size"></td>
                                                {{--<span class="label label-success pull-right"></span>--}}
                                                <td class="folder-desc"><b>folder</b></td>
                                                <td class="folder-option"><a class="deletefolder" data-toggle="tooltip"
                                                                             data-placement="right"
                                                                             title="put into trash"><i
                                                                class="fa fa-trash-o"></i></a></td>
                                                <td class="folder-date">{{$folder->updated_at}}</td>
                                            </tr>
                                        @endif

                                    @endforeach


                                    @foreach ($sendfiles as $file)
                                        @if($file->parent_id==0)
                                            <tr>
                                                <td class="file-id">{{$file->file_id}}</td>
                                                <td><input type="checkbox"></td>
                                                <td class="file-download"><a
                                                            href="/file/download?filepath={{$file->filepath}}&filename={{$file->filename}}"><i
                                                                class="fa fa-cloud-download"></i></a></td>

                                                <td><i class="fa fa-file-image-o"></i></td>

                                                <td class="file-name"><a
                                                            href="{{$file->filepath}}">{{$file->filename}}</a>
                                                </td>

                                                <td class="file-size"><b> {{getRealSize($file->filesize)}}</b></td>

                                                <td class="file-desc"><p>{{$file->desc}}</p>
                                                    <div style="display: none;">
                                                        <input type="text" name="desc" size="10">
                                                    </div>
                                                </td>
                                                <td class="file-options"><a class="adddesc" data-toggle="tooltip"
                                                                            data-placement="left"
                                                                            title="add description">

                                                        <i class=" fa fa-pencil-square-o"></i></a> <a class="sharelink"><i
                                                                class="fa fa-paperclip" data-toggle="tooltip"
                                                                data-placement="top"
                                                                title="generate share link"></i></a> <a
                                                            class="deletefile"
                                                            data-toggle="tooltip" data-placement="right"
                                                            title="put into trash"><i
                                                                class="fa fa-trash-o"></i></a></td>
                                                <td class="file-date">{{$file->updated_at}}</td>
                                            </tr>
                                        @endif
                                    @endforeach


                                    </tbody>
                                </table>
                                <!-- /.table -->
                            </div>
                            <!-- /.mail-box-messages -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /. box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
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
                    <form id="myupload" enctype="multipart/form-data" method="post"
                          action="{{route('files.store')}}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label><span class="glyphicon glyphicon-file"></span> <font
                                        color="red">*</font>Pick a file</label> <input type="file"
                                                                                       class="form-control" name="file">
                        </div>

                        <input type="password" name="dirid" id="diridinput" value="0" hidden>


                        <button type="submit" id="uploadfile"
                                class=" btn btn-success btn-block">
                            <span class="glyphicon glyphicon-upload"></span> upload
                        </button>

                        {{--<button type="submit" style="display: none" id="realuploadfile"--}}
                        {{--class=" btn btn-success btn-block">--}}
                        {{--<span class="glyphicon glyphicon-upload"></span> upload--}}
                        {{--</button>--}}

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-default pull-right"
                            data-dismiss="modal" id="cancelforupload">
                        <span class="glyphicon glyphicon-remove"></span> Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>



    <div id="treeDemoDiv" style="display: none;">
        <div><input type="text" name="movefolder" class="form-control"></div>
        <ul id="treeDemo" style="margin: 20px"></ul>

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

                    <div class="form-group">
                        <label>
                            <span class="glyphicon glyphicon-folder"></span>
                            <span color="red">*</span>
                            Enter folder name
                        </label>

                        <input type="text" class="form-control" name="foldername">

                        <button type="button" style="margin-top: 20px" class="btn btn-success btn-block"
                                id="createfolder">
                            <span class="glyphicon glyphicon-folder-open"></span> Create
                        </button>
                    </div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-danger btn-default pull-right"
                            data-dismiss="modal" id="cfoldercancel">
                        <span class="glyphicon glyphicon-remove"></span> Cancel
                    </button>

                </div>
            </div>
        </div>
    </div>


    <div class="table-responsive2"
         style="display: none">

        <table class="table table-striped table-hover">
            <thead>
            <tr class="success">
                <th>Upload at</th>
                <th>Name</th>
                <th>Progress</th>
                <th>Label</th>
                <th>Status</th>
                <th>Speed</th>
                <th>Expect</th>
                <th>Options&nbsp; <a id="clearuplist"><i class="fa fa-trash-o"></i></a>
                </th>
            </tr>
            </thead>

            <tbody id="uplingtbody">


            @foreach($uplist as $upling)
                <tr>
                    @if($upling->error==0)
                        <td class="upling-id">{{$upling->time}}</td>
                        <td class="upling-name">{{$upling->name}}</td>

                        <td class="upling-progress">
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-info"
                                     style="width: 100%"></div>
                            </div>
                        </td>

                        <td class="upling-label"><span class="badge bg-green">100%</span></td>
                        <td class="upling-status"><a class="status-uploading">finished
                            </a></td>
                        <td class="upling-speed"><span class="badge bg-green">Done</span></td>
                        <td class="upling-expect"><span class="badge bg-green">Done</span></td>
                        <td class="uplingoptions"><a
                                    href="/file/download?filepath={{$upling->filepath}}&filename={{$upling->name}}"
                                    class="downloadinuplist"><i
                                        class="fa fa-cloud-download"></i>&nbsp;&nbsp;&nbsp;</a> <a
                                    class="refreshinuplist"
                                    href="/main"><i class="fa fa-refresh"></i></a></td>

                    @else
                        <td style="color: #ff5500" class="upling-id">{{$upling->time}}</td>
                        <td style="color: #ff5500" class="upling-name">{{$upling->name}}</td>

                        <td class="upling-progress">
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-red"
                                     style="width: 40%"></div>
                            </div>
                        </td>

                        <td class="upling-label"><span class="badge bg-red">err</span></td>
                        <td class="upling-status"><a style="color: #ff5500" class="status-uploading">error</a></td>
                        <td class="upling-speed"><span class="badge bg-red">err</span></td>
                        <td class="upling-expect"><span class="badge bg-red">err</span></td>
                        <td class="uplingoptions">&nbsp;&nbsp;&nbsp;</td>
                    @endif

                </tr>

            @endforeach

            </tbody>
        </table>
    </div>



    <div id="sharelinkbox" class="box box-default" style="display: none;">

        <div class="box-header with-border">
            <h3 class="box-title" id="share-title">file <span id="share-file-id"></span>&nbsp;&nbsp;<span id="share-file-name"></span></h3>
        </div>


        <div class="box-body" style="padding:20px">
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

            <div class="input-group input-group-sm">
                <label>Do you want to set a password for this link?</label>
                <input class="form-control" type="text" name="link-password" id="link-password"
                       placeholder="enter your password and empty for no password">
            </div>

            <br>


            <div class="input-group input-group-sm">


                <input class="form-control" id="share-link-input" type="text"
                       placeholder="click generate button to get his file's share link"
                       disabled="disabled">
                <span style="display: none"></span>

                <span class="input-group-btn">
                      <button type="button" id="generate-share-link" class="btn btn-default btn-flat">generate</button>
                    </span>
            </div>

            <br>
            <hr>


            <div class="row">

                <a id="generate-qrcode" class="btn btn-default btn-block margin-bottom"> + generate QRCode</a>

            </div>

            <div align="center"><img src="images/admin.jpg" id="qrcode-img" style="display: none;" width="300px"
                                     height="300px">
            </div>
        </div>


    </div>

@endsection @section('myjs')

    <script src="asserts/jquery.form.js"></script>
    <script src="asserts/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="asserts/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="asserts/plugins/autocompleter/jquery.autocompleter.min.js"></script>

    {{--<script src="asserts/plugins/highlight/jquery.ba-each2.min.js"></script>--}}
    {{--<script src="asserts/plugins/highlight/jquery.highlight.min.js"></script>--}}

    <script type="text/javascript">


        $(document).ready(function () {

            layui.use('layer', function () {
                layer = layui.layer;
//                layer.msg('dsasda');

                var index2 = null;

                $('#showuplist').click(function () {


                    if (index2 == null) {
                        index2 = layer.open({
                            type: 1,
                            skin: 'layui-layer-molv',
                            anim: 2,
                            title: 'upload list',
                            content: $('.table-responsive2'),
                            closeBtn: 1,
                            offset: 'rb',
                            area: ["650px", '400px'],
                            maxmin: true,
                            shadeClose: true,
                            shade: 0,
                            end: function () {
                                layer.close(index2);
                                index2 = null;
                                return false;
                            },
                            min: function (layero) {

                            }
                        });

                    }
                });


                $("#clearuplist").click(function () {
                    layer.open({
                        title: "are you sure",
                        content: 'are you sure to empty the list?',
                        yes: function (index) {

                            $.ajax({
                                type: 'POST',
                                url: '/file/clearuplist',
                                data: {'placeholder': 'placeholder'},
                                dataType: 'json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                },

                                success: function (data) {
                                    if (data.msg == 'success') {
                                        layer.msg("success", {icon: 1, anim: 2, time: 1000});
                                        $('#uplingtbody').empty();

                                    } else {

                                        layer.msg("wrong!", {icon: 2, anim: 6, time: 1000});
                                    }

                                },
                                error: function (xhr, type) {
                                    layer.msg("error", {icon: 2, anim: 6, time: 1000});
                                }
                            });


                        }

                    });

                });


            });


//            $('input[name="foldername"]').focus();

            $("#userimage").click(function () {
                $("#uploadface").trigger('click');

            });


            $("#createfolder").click(function () {

                var foldername = $(this).prev().val();

                var dirid = $('#diridinput').val();

                if (dirid === null) {
                    dirid = 0;
                }


                $.ajax({
                    type: 'POST',
                    url: '/file/createfolder',
                    data: {'folder_name': foldername, 'parent_id': dirid},//here 0 is defacult value, later on it will be a variable
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },

                    success: function (data) {

                        if (data.msg == 'success') {
//
//                            swal({
//                                title: 'Success',
//                                text: "the folder named <span style='color:red'>[" + foldername + "]</span> was created on the current directory successfully! ",
//                                type: 'success',
//                                closeOnConfirm: false,
//                                html: true
//                            }, function () {
//                                window.location.href = "/main";
//                            });


                            var folder = $.parseJSON(data.folder);
//                        alert(folder.file_id);


                            // $('#uplingtbody').children('tr:first-child').children('.upling-options').children('a').attr('href', file.filepath);

//
                            var newfolderrow = '<tr>';

                            newfolderrow += '<td class="folder-id">' + folder.file_id + '</td>';

                            newfolderrow += '<td><a><i class="fa fa-search-plus"></i></a></td>';
                            newfolderrow += '<td class="folder-download"><a><i class="fa fa-search"></i></a></td>';

                            newfolderrow += '<td><a class="expandfolder"><i class="fa fa-folder"></i></a></td>';

                            newfolderrow += '<td class="folder-name">';
                            newfolderrow += '<a class="alterfoldername" data-toggle="tooltip" data-placement="right" title="update name">' + folder.filename + '</a>';
                            newfolderrow += '<div style="display: none;"><input type="text" name="foldername" size="4"> <a class="yestoalter"><i class="fa fa-check"></i></a><a class="notoalter"><i class="fa fa-close"></i></a> </div> ';
                            newfolderrow += '</td>';
                            newfolderrow += '<td class="folder-size"></td>';

                            newfolderrow += '<td class="folder-desc"><b>folder</b></td>';
                            newfolderrow += ' <td class="folder-option"><a class="deletefolder" data-toggle="tooltip" data-placement="right" title="put into trash"><i class="fa fa-trash-o"></i></a></td>';

                            newfolderrow += '<td class="folder-date">' + folder.updated_at + '</td>';

                            newfolderrow += '</tr>';

                            $('#filetbody').prepend(newfolderrow);

                            layer.msg('success', {icon: 1, anim: 2, time: 1000});

                            $("#cfoldercancel").trigger('click');
//
//                       $('#filetbody').html(newfolderrow + $('#filetbody').html());


                        } else {
                            swal('Unkowning', "Error! ", 'error');
                        }
                    },
                    error: function (xhr, type) {
                        swal('Oops...', "Error! ", 'error');
                    }
                });

            });

            $('#nope').keyup(function (e) {

                if (e.keyCode == 13) {
                    var text = $(this).val();
                    $('body').highlight(text, {
                        className: 'marker',
                        onlyFirst: false,
                        ignoredChars: /\r/,
                        ignorePrevFounds: true,
                        ignoredTags: /(script|style|iframe|object|embed)/i
                    });
//                    $('body').highlight();
//                    var addCustom = function(element){
//
//                        $(element).append($("<div class='custom' />").html("Custom Data"));
//
//                    }
//
//                    $('body').highlight(text, {className : 'marker', callback : addCustom});
                }

            });


            var data = [
                {'value': 'one', 'label': 'one'},
                {'value': 'two', 'label': 'two'},
                {'value': 'three', 'label': 'three'},
                {'value': 'one', 'label': 'one'},
                {'value': 'two', 'label': 'two'},
                {'value': 'three', 'label': 'three'}
            ];

            $('#nope').autocompleter({
                source: data, limit: 4, callback: function (value, index) {
                    swal('hello', value + " is selected", 'success');
                }
            });

            $("#filetable").dataTable({
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "order": [[8, "desc"]]

            });

            var qrpath = null;

            $("#generate-qrcode").click(function () {


                var link = $('#share-link-input').val().trim();

                var filepath= $("#share-link-input").next().text().trim();


                if (link == "") {
                    layer.msg("you should first generate share link", {icon: 2, anim: 6, time: 1000});
                    return false;
                }


                var sear = new RegExp('localhost');

                if (sear.test(link)) {
                    link = link.replace('localhost', '172.21.70.83');
                }


                qrpath = 'http://qr.liantu.com/api.php?text=' + filepath + '&logo=http://congcongxyz.cn/images/admin.jpg&bg=f3f3f3&fg=ff2200&gc=22ff22&w=300&el=l';


                var fileID = $("#share-file-id").text();
                var indexl2 = layer.load(2);


                $.ajax({
                    type: 'POST',
                    url: '/storeqrpath',
                    data: {
                        'qrpath': qrpath,
                        'fileID': fileID
                    },
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },

                    success: function (data) {
                        if (data.status == 1) {

                            $('#qrcode-img').attr('src', qrpath);
                            $('#qrcode-img').show(1000);

                        } else {
                            layer.msg("wrong", {icon: 2, anim: 6, time: 1000});
                        }
                        layer.close(indexl2);
                    },
                    error: function (xhr, type) {
                        swal('Oops...', "Error! ", 'error');
                        layer.close(indexl2);
                    }
                });


            });

            $("#generate-share-link").click(function () {

                var validtime = $("#validtime").val();

                var linkpassword = $("#link-password").val().trim();

                if (linkpassword != "" && linkpassword.length != 4) {
                    layer.msg('enter 4 digits password', {icon: 2, anim: 6, time: 1000});
                    return false;
                }

                var fileID = $("#share-file-id").text();
                var filename = $("#share-file-name").text();


                var userEmail = $("#user-email").text();

                var indexl1 = layer.load();

                $.ajax({
                    type: 'POST',
                    url: '/sharelink',
                    data: {
                        'validtime': validtime,
                        'linkpassword': linkpassword,
                        'fileID': fileID,
                        'userEmail': userEmail
                    },
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },

                    success: function (data) {
                        if (data.status == 1) {
                            var curWwwPath = window.document.location.href;
                            var pathName = window.document.location.pathname;
                            var pos = curWwwPath.indexOf(pathName);
                            var localhostPaht = curWwwPath.substring(0, pos);

                            $("#share-link-input").val(localhostPaht + data.msg);
                            $("#share-link-input").next().text(localhostPaht+data.filedir+filename);
//
                            layer.msg("link generated successfully!", {icon: 1, anim: 2, time: 1000});
                        } else {
                            layer.msg("wrong", {icon: 2, anim: 6, time: 1000});
                        }
                        layer.close(indexl1);
                    },
                    error: function (xhr, type) {
                        swal('Oops...', "Error! ", 'error');
                        layer.close(indexl1);
                    }
                });
            });


            $('#filetbody').on('click', '.sharelink', function () {

                var file_id = $(this).parent().siblings('.file-id').text();
                var file_name = $(this).parent().siblings('.file-name').children('a').text();
                $("#share-file-id").text(file_id);

                $("#share-file-name").text(file_name);

                layer.open({
                    type: 1,
                    skin: 'layui-layer-lan',
                    title: 'Generate share link',
                    content: $('#sharelinkbox'),
                    area: ['400px', '500px'],
                    anim: 2,
                    shade: 0,
                    closeBtn: 2,
                    btn: ['getQRCode'],
                    yes: function () {
                        if (qrpath == null) {
                            layer.msg("not found qrcode", {anim: 6, icon: 2, time: 1000});
                            return false;
                        }
                        window.location.href = qrpath;
                    }

                });


            });


            $(".removebar").click(function () {
                $(".progressdiv").hide(1000);
            });


            function getNowFormatDate() {
                var date = new Date();

                var seperator1 = "-";
                var seperator2 = ":";

                var month = date.getMonth() + 1;
                var strDate = date.getDate();

                var hours = date.getHours();
                var minutes = date.getMinutes();
                var seconds = date.getSeconds();

                if (month >= 1 && month <= 9) {
                    month = "0" + month;
                }
                if (strDate >= 0 && strDate <= 9) {
                    strDate = "0" + strDate;
                }
                if (hours >= 1 && hours <= 9) {
                    hours = "0" + month;
                }
                if (minutes >= 0 && minutes <= 9) {
                    minutes = "0" + minutes;
                }
                if (seconds >= 0 && seconds <= 9) {
                    seconds = "0" + seconds;
                }

                var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate
                        + " " + hours + seperator2 + minutes
                        + seperator2 + seconds;
                return currentdate;
            }

//            layer.tips('download this file', '.downloadinuplist');
//            layer.tips('refresh', '.refreshinuplist');
            $("#uploadfile").click(function () {

                if ($("input[name='file']").val() == "") {
                    layer.msg('pick a file, please', {icon: 2, anim: 6, time: 1000});
                    return false;
                }

                if (uploadstatus != 'accessible') {
                    layer.msg('there is a file uplaoding', {icon: 2, anim: 6, time: 1000});
                    return false;
                }

                $('#cancelforupload').trigger('click');

//                ;


//                setTimeout($('#realuploadfile').trigger('click'), 1000);

            });


            var starttime = 0;

            var uploadstatus = 'accessible';

            $("#myupload").ajaxForm({
                dataType: 'json',
                beforeSend: function () {
                    uploadstatus = 'beforeSend';
                    $('#showuplist').trigger('click');
                    var upname = $('input[name="file"]').val();
                    var upname = upname.split('\\')[2];

                    var nowtime = getNowFormatDate();
                    var newuplingrow = '<tr>';

                    newuplingrow += '<td class="upling-id">' + nowtime + '</td>';

                    newuplingrow += '<td class="upling-name">' + upname + '</td>';

                    newuplingrow += '<td class="upling-progress">';
                    newuplingrow += '<div class="progress progress-xs">';
                    newuplingrow += '<div class="progress-bar progress-bar-info" style="width: 0%"></div>';
                    newuplingrow += '</div>';
                    newuplingrow += '</td>';

                    newuplingrow += '<td class="upling-label"><span class="badge bg-green">0%</span></td>';

                    newuplingrow += '<td class="upling-status">';
                    newuplingrow += '<a class="status-uploading">start<i class="status-icon fa fa-hourglass"></i></a>';
                    newuplingrow += '</td>';

                    newuplingrow += '<td class="upling-speed"><span class="badge bg-green">0 k/s</span></td>';

                    newuplingrow += '<td class="upling-expect"><span class="badge bg-green">...</span></td>';

                    newuplingrow += '<td class="upling-options"><a class="upling-search">&nbsp;&nbsp;&nbsp;&nbsp;<i></i></a></td>';

                    newuplingrow += '</tr>';
                    $('#uplingtbody').prepend(newuplingrow);

//                    $('#uplingtbody').html(newuplingrow + $('#uplingtbody').html());


                    starttime = new Date().getTime();
                },


                uploadProgress: function (event, position, total, percentComplete) {

                    uploadstatus = 'uploadProgress';

                    $('#uplingtbody').children('tr:first-child').children('.upling-progress').children('.progress').children('.progress-bar').width(percentComplete + '%');
                    $('#uplingtbody').children('tr:first-child').children('.upling-label').children('span').text(percentComplete + '%');

                    var status = $('#uplingtbody').children('tr:first-child').children('.upling-status').children('.status-uploading');
                    status.text("uploading");

//                    status.children('i').removeClass('fa fa-hourglass-o').addClass('fa fa-spinner');

                    var currenttime = new Date().getTime();

                    var interval = (currenttime - starttime)/1000;


                    var speed = 0;
                    var expectime = 0;

                    var percentComplete = (percentComplete / 100).toFixed(1);

                    if (total * percentComplete < 1024) {
                        speed = (total * percentComplete / interval).toFixed(1) + " b/s";  //unit is b/s
                        expectime = ((1 - percentComplete) * total / speed).toFixed(1);
                    } else if (total * percentComplete < 1024 * 1024) {
                        speed = (total * percentComplete / (interval * 1024)).toFixed(1) + " kb/s"//unit is kb/s
                        expectime = ((1 - percentComplete) * total / (speed * 1024)).toFixed(1);
                    } else {
                        speed = (total * percentComplete / (interval * 1024 * 1024)).toFixed(1) + " mb/s"//unit is mb/s
                        expectime = ( (1 - percentComplete) * total / (speed * 1024 * 1024) ).toFixed(1);
                    }

                    //unit if expect time is seconds, we need to convert to appropriate one
                    if (expectime < 60) {
                        expectime = expectime + " s";
                    } else if (expectime < 60 * 60) {
                        expectime = (expectime / 60).toFixed(1) + ' m';
                    } else {
                        expectime = (expectime / (60 * 60)).toFixed(1) + ' h';
                    }

                    $('#uplingtbody').children('tr:first-child').children('.upling-speed').children('span').text(speed);
                    $('#uplingtbody').children('tr:first-child').children('.upling-expect').children('span').text(1-percentComplete);

                },
                success: function (data) {


                    if (data.msg == 'success') {

                        var file = $.parseJSON(data.file);
                        $('#uplingtbody').children('tr:first-child').children('.upling-progress').children('.progress').children('.progress-bar').width('100%');
                        $('#uplingtbody').children('tr:first-child').children('.upling-label').children('span').text('100%');
                        var status = $('#uplingtbody').children('tr:first-child').children('.upling-status').children('.status-uploading');
                        status.text("finished");
                        $('#uplingtbody').children('tr:first-child').children('.upling-speed').children('span').text('Done');
                        $('#uplingtbody').children('tr:first-child').children('.upling-expect').children('span').text('Done');

                        var upopts = $('#uplingtbody').children('tr:first-child').children('.upling-options');

                        upopts.html('<a href="/file/download?filepath=' + file.filepath + '&filename=' + file.filename + '" class="downloadinuplist"><i class="fa fa-cloud-download"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;');

                        upopts.html(upopts.html() + '<a href="/main" class="refreshinuplist"><i class="fa fa-refresh"></i></a>');


//                    upopts.append('<a data-toggle="tooltip" data-placement="right" title="refresh">click</a>');
//                    $('#uplingtbody').children('tr:first-child').children('.upling-options').children('a').children('i').addClass('fa fa-cloud-download');


//                    $('#uplingtbody').children('tr:first-child').children('.upling-options').children('a').attr('href', file.filepath);

////
                        var newfilerow = '<tr>';
                        newfilerow += '<td class="file-id">' + file.file_id + '</td>';

                        newfilerow += '<td><input type="checkbox"></td>';
                        newfilerow += '<td class="file-download"><a href="/file/download?filepath=' + file.filepath + '&filename=' + file.filename + '"><i class="fa fa-cloud-download"></i></a></td>';

                        newfilerow += '<td><i class="fa fa-file-image-o"></i></td>';

                        newfilerow += '<td class="file-name"><a href="' + file.filepath + '">' + file.filename + '</a></td>';

                        newfilerow += '<td class="file-size"><b> ' + getProperSize(file.filesize) + '</b></td>';

                        newfilerow += '<td class="file-desc"><p></p> <div style = "display: none;"> <input type = "text" name = "desc" size = "10"> </div > </td>';

                        newfilerow += ' <td class="file-options"><a class="adddesc" data-toggle="tooltip" data-placement="left" title="add description"> <i class=" fa fa-pencil-square-o"></i></a> <a class="sharelink"><i class="fa fa-paperclip" data-toggle="tooltip" data-placement="top" title="generate share link"></i></a> <a class="deletefile"data-toggle="tooltip" data-placement="right" title="put into trash"><i class="fa fa-trash-o"></i></a></td>';

                        newfilerow += '<td class="file-date">' + file.updated_at + '</td>';

                        newfilerow += '</tr>';

                        $('#filetbody').prepend(newfilerow);


//                        var thisfilesize = convertUnitToMB(getProperSize(file.filesize));

//                        alert(file.filesize);

//                        $('#filelistnumber').text($('#filelistnumber').text() +'1');
//
//                        $("#sizeonfilelist").text(((parseFloat($("#sizeonfilelist").text())+thisfilesize)).toFixed(2) + ' MB');


                        layer.msg("uploaded successfully", {icon: 1, anim: 1, time: 1000});
                        uploadstatus = 'accessible';




                    } else if(data.msg==="exist"){
                        layer.msg("the file was already in your file list!", {icon: 2, anim: 6, time: 1000});
                    } else {
                        $('#uplingtbody').children('tr:first-child').remove();
                        layer.msg("wrong!", {icon: 2, anim: 6, time: 1000});
                    }

                },
                error: function () {
                    layer.msg("maybe you have already had this file in your file list!", {
                        icon: 2,
                        anim: 6,
                        time: 1000
                    });
                    $('#uplingtbody').children('tr:first-child').remove();
                }
            });

            $("#movefile").click(function () {


                var checkboxes = $(":checkbox");
                var selectedfileids = [];

                var selectedrows = new Array();

                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes.eq(i).attr("checked") || checkboxes.eq(i).get(0).checked || checkboxes.eq(i).is(":checked")) {
                        selectedrows.push(checkboxes.eq(i).parent().parent());
                        selectedfileids.push(checkboxes.eq(i).parent().prev().text());
                    }
                }

                if (selectedfileids.length == 0) {
                    swal('select at least one file');
                    return false;
                }


                var allfiles = $.parseJSON($('#hideallfiles').text());
                var allfolders = $.parseJSON($('#hideallfolders').text());

                var nodes = getNodes(0, allfiles, allfolders);

                var nodes=[{
                    id:0,
                    name:'root',
                    alias:'folder',
                    spread:true,
                    children:nodes
                }];

                $('#treeDemo').empty();
                layui.use('tree', function () {

                    layui.tree({
                        elem: '#treeDemo' //传入元素选择器
                        ,
                        nodes: nodes,
                        click: function (node) {
                            layer.title('move files with id ' + selectedfileids + " your choice is: " + node.id + "=>" + node.alias + "=>" + node.name, index1);
                            nodeselected=node;
                            $('input[name="movefolder"]').val(node.id + "=>" + node.alias + "=>" + node.name);
                        }
                    });
                });

                var nodeselected;
                var index1 = layer.open({
                    type: 1,
                    skin: 'layui-layer-lan',
                    title: 'move files with id ' + selectedfileids,
                    content: $('#treeDemoDiv'),
                    closeBtn: 2,
                    area: ["650px", '400px'],
                    maxmin: true,
                    shadeClose: true,
                    shade: 0.7
                    , btn: ['confirm']
                    , yes: function (index, layero) {

                        if(nodeselected.alias!=='folder'){
                            layer.msg('choose a folder, please',{icon:2,anim:6,time:1000});
                            return false;
                        }

                        $.ajax({
                            type: 'POST',
                            url: '/file/movetofolders',
                            data: {'fileids': selectedfileids,'parent_id':nodeselected.id},
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                            success: function (data) {
                                if (data.msg == 'success') {
                                    for(var i=0;i<selectedrows.length;i++){
                                        selectedrows[i].hide();
                                    }
                                    layer.msg('success',{icon:1,anim:2,time:1000});

                                } else {
                                    swal('Unkowning', "Error! ", 'error');
                                }
                            },
                            error: function (xhr, type) {
                                swal('Oops...', "Error! ", 'error');
                            }
                        });


                        layer.close(index);


                    }

                });


//                $("#foldermodal").modal();

            });


            function getNodes(id, files, folders) {

                var curfiles = new Array();

                for (var i = 0; i < files.length; i++) {
                    if (files[i].parent_id == id) {
                        curfiles.push(files[i]);
                    }
                }

                var curfolders = new Array();

                for (var i = 0; i < folders.length; i++) {
                    if (folders[i].parent_id == id) {
                        curfolders.push(folders[i]);
                    }
                }


                if (curfiles.length == 0 && curfolders.length == 0) {
                    var emptyholder = new Array();
                    var tempholder = {};
                    tempholder.name = 'empty';
                    emptyholder.push(tempholder);
                    return emptyholder;
                }

                var nodes = new Array();
                for (var i = 0; i < curfolders.length; i++) {
                    var tempnode = {};
                    tempnode.name = curfolders[i].filename;
                    tempnode.id = curfolders[i].file_id;
                    tempnode.alias = "folder";
                    tempnode.spread=true;
                    tempnode.children = getNodes(curfolders[i].file_id, files, folders);
                    nodes.push(tempnode);
                }

                for (var j = 0; j < curfiles.length; j++) {
                    var tempnode = {};
                    tempnode.name = curfiles[j].filename;
                    tempnode.id = curfiles[j].file_id;
                    tempnode.alias = "file";
                    nodes.push(tempnode);
                }
                return nodes;
            }


            $('body').on('click', '.expandfolder', function () {


                var thisfodlerid = $(this).parent().siblings('.folder-id').text();
                var thisfodlername = $(this).parent().siblings('.folder-name').children('a').text();

                if (thisfodlerid === "" || thisfodlername === "") {
                    thisfodlerid = $(this).children('b').children('.dirid').text();
                    thisfodlername = $(this).children('b').text().split('(')[0];
//                    alert(thisfodlerid);
                    $(this).nextAll().hide();
                } else {
                    $('#navigator').children('#mainnav').attr('href', '/main');
                    $('#navigator').append('<a class="expandfolder"><b>' + thisfodlername + '(<i class="dirid">' + thisfodlerid + '</i>)></b></a>');
                }


                $('#diridinput').val(thisfodlerid);


                $("#filetbody").empty();

                var allfiles = $.parseJSON($('#hideallfiles').text());
                var allfolders = $.parseJSON($('#hideallfolders').text());

                for (var i = 0; i < allfolders.length; i++) {

                    if (allfolders[i].parent_id == thisfodlerid) {

                        var newfolderrow = '<tr>';
                        newfolderrow += '<td class="folder-id">' + allfolders[i].file_id + '</td>';
                        newfolderrow += '<td><a><i class="fa fa-search-plus"></i></a></td>';
                        newfolderrow += '<td class="folder-download"><a><i class="fa fa-search"></i></a></td>';
                        newfolderrow += '<td><a class="expandfolder"><i class="fa fa-folder"></i></a></td>';
                        newfolderrow += '<td class="folder-name">';
                        newfolderrow += '<a class="alterfoldername" data-toggle="tooltip" data-placement="right" title="update name">' + allfolders[i].filename + '</a>';
                        newfolderrow += '<div style="display: none;"><input type="text" name="foldername" size="4"> <a class="yestoalter"><i class="fa fa-check"></i></a><a class="notoalter"><i class="fa fa-close"></i></a> </div> ';
                        newfolderrow += '</td>';
                        newfolderrow += '<td class="folder-size"></td>';
                        newfolderrow += '<td class="folder-desc"><b>folder</b></td>';
                        newfolderrow += ' <td class="folder-option"><a class="deletefolder" data-toggle="tooltip" data-placement="right" title="put into trash"><i class="fa fa-trash-o"></i></a></td>';
                        newfolderrow += '<td class="folder-date">' + allfolders[i].updated_at + '</td>';
                        newfolderrow += '</tr>';
                        $('#filetbody').prepend(newfolderrow);

                    }

                }


                for (var i = 0; i < allfiles.length; i++) {

                    if (allfiles[i].parent_id == thisfodlerid) {

                        var newfilerow = '<tr>';

                        newfilerow += '<td class="file-id">' + allfiles[i].file_id + '</td>';

                        newfilerow += '<td><input type="checkbox"></td>';
                        newfilerow += '<td class="file-download"><a href="/file/download?filepath=' + allfiles[i].filepath + '&filename=' + allfiles[i].filename + '"><i class="fa fa-cloud-download"></i></a></td>';

                        newfilerow += '<td><i class="fa fa-file-image-o"></i></td>';

                        newfilerow += '<td class="file-name"><a href="' + allfiles[i].filepath + '">' + allfiles[i].filename + '</a></td>';

                        newfilerow += '<td class="file-size"><b> ' + getProperSize(allfiles[i].filesize) + '</b></td>';

                        newfilerow += '<td class="file-desc"><p></p> <div style = "display: none;"> <input type = "text" name = "desc" size = "10"> </div > </td>';

                        newfilerow += ' <td class="file-options"><a class="adddesc" data-toggle="tooltip" data-placement="left" title="add description"> <i class=" fa fa-pencil-square-o"></i></a> <a class="sharelink"><i class="fa fa-paperclip" data-toggle="tooltip" data-placement="top" title="generate share link"></i></a> <a class="deletefile"data-toggle="tooltip" data-placement="right" title="put into trash"><i class="fa fa-trash-o"></i></a></td>';

                        newfilerow += '<td class="file-date">' + allfiles[i].updated_at + '</td>';

                        newfilerow += '</tr>';

                        $('#filetbody').prepend(newfilerow);


                    }
                }


            });


            $("#upload").click(function () {
                $("#uploadmodal").modal();
            });


            $('#filetbody').on('click', '.alterfoldername', function () {
                $(this).hide();
                $(this).next().show();
                $(this).next().find('input[name=foldername]').val($(this).text());
            });

//            $('.alterfoldername').click(function () {
//                $(this).hide();
//                $(this).next().show();
//                $(this).next().find('input[name=foldername]').val($(this).text());
//            });


            $('#filetbody').on('click', '.notoalter', function () {
                $(this).parent().prev().show();
                $(this).parent().hide();
            });


            $('#filetbody').on('click', '.yestoalter', function () {

                if ($(this).prev().val().trim() != "") {

                    var thisparent = $(this).parent();
                    var thisprev = $(this).prev();
                    var folderid = $(this).parent().parent().siblings('.folder-id').text();

                    if (thisprev.val() === thisparent.prev().text()) {
                        thisparent.prev().text(thisprev.val());
                        thisparent.prev().show();
                        thisparent.hide();
                    } else {


                        $.ajax({
                            type: 'POST',
                            url: '/file/alterfoldername',
                            data: {'updated_name': thisprev.val(), 'folder_id': folderid},
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },

                            success: function (data) {
                                if (data.msg == 'success') {
                                    swal({
                                        title: 'Success',
                                        text: "the folder name was updated into <span style='color:red'>[" + thisprev.val() + "]</span> successfully! ",
                                        type: 'success',
                                        html: true
                                    });

                                    thisparent.prev().text(thisprev.val());
                                    thisparent.prev().show();
                                    thisparent.hide();

                                } else {
                                    swal('Unkowning', "Error! ", 'error');
                                }
                            },
                            error: function (xhr, type) {
                                swal('Oops...', "Error! ", 'error');
                            }
                        });


                    }

                } else {
                    swal('Oops', 'empty is not allowed', 'warning');
                }

            });


            $(":checkbox").click(function () {
                var currentselected = 0;
                var checkboxes = $(":checkbox");
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes.eq(i).attr("checked") || checkboxes.eq(i).get(0).checked || checkboxes.eq(i).is(":checked")) {
                        currentselected++;
                    }
                }

                if (currentselected == 0) {
                    if ($(".checkbox-toggle").find('i').hasClass("fa-check-square-o")) {
                        $(".checkbox-toggle").find('i').removeClass("fa fa-check-square-o").addClass('fa fa-square-o');
                    }
                } else if (currentselected == checkboxes.length) {
                    if ($(".checkbox-toggle").find('i').hasClass("fa-square-o")) {
                        $(".checkbox-toggle").find('i').removeClass("fa fa-square-o").addClass('fa fa-check-square-o');
                    }
                }
            });


            $(".checkbox-toggle").click(function () {

                if ($(this).find('i').hasClass("fa-square-o")) {

                    $(this).find('i').removeClass("fa fa-square-o").addClass('fa fa-check-square-o');

                    var checkboxes = $(":checkbox");
                    for (var i = 0; i < checkboxes.length; i++) {
                        if (!(checkboxes.eq(i).attr("checked") || checkboxes.eq(i).get(0).checked || checkboxes.eq(i).is(":checked"))) {
                            checkboxes.eq(i).get(0).checked = true;
                        }
                    }


                } else {

                    $(this).find('i').removeClass("fa fa-check-square-o").addClass('fa fa-square-o');
                    var checkboxes = $(":checkbox");
                    for (var i = 0; i < checkboxes.length; i++) {
                        if (checkboxes.eq(i).attr("checked") || checkboxes.eq(i).get(0).checked || checkboxes.eq(i).is(":checked")) {
                            checkboxes.eq(i).get(0).checked = false;
                        }
                    }
                }

            });

            $("#cfolder").click(function () {
                $("#cfoldermodal").modal();

            });


            $("#downloadf").click(function () {
                swal("download file button clicked");
            });


            $("#deleteselected").click(function () {
//                swal("delete  button clicked");


                var checkboxes = $(":checkbox");

                var selectedfileids = [];

                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes.eq(i).attr("checked") || checkboxes.eq(i).get(0).checked || checkboxes.eq(i).is(":checked")) {
                        selectedfileids.push(checkboxes.eq(i).parent().prev().text());
                    }
                }

                if (selectedfileids.length == 0) {
                    swal('select at least one file');
                    return false;
                }


                swal({
                            title: "Are you sure?",
                            text: "You are going to put all selected files into trash ",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: '#DD6B55',
                            confirmButtonText: 'Yes, put',
                            cancelButtonText: "No, cancel!",
                            closeOnConfirm: false
                        },
                        function () {
                            $.ajax({
                                type: 'POST',
                                url: '/file/allintotrash',
                                data: {'fileids': selectedfileids},
                                dataType: 'json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                },
                                success: function (data) {
                                    if (data.msg == 'success') {
                                        swal({
                                            title: 'Success',
                                            text: "all files were put into trash successfully! ",
                                            type: 'success',
                                            closeOnConfirm: false
                                        }, function () {
                                            window.location.href = "/main";
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


//                alert(selectedfileids);


            });


            $('#filetbody').on('click', '.deletefolder', function () {
                var folder_id = $(this).parent().siblings('.folder-id').text();
                var thistr = $(this).parent().parent();

                var folder_name = $(this).parent().siblings('.folder-name').find(".alterfoldername").text();

                $.ajax({
                    type: 'POST',
                    url: '/file/delete',
                    data: {'file_id': folder_id},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: function (data) {
                        if (data.msg == 'success') {

                            layer.msg('put into trash successfully!', {icon: 1, time: 1000});
                            thistr.hide();

                            $('#filelistnumber').text($('#filelistnumber').text() - "1");


                        } else {
                            swal('Failure', "deletion failure! ", 'error');
                        }
                    },
                    error: function (xhr, type) {
                        swal('Oops...', "Error! ", 'error');
                    }
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
                    return (parseFloat(size) / (1024 * 1024)).toFixed(2);
                }

            }


            function getProperSize(size) {
                var kb = 1024; // Kilobyte
                var mb = 1024 * kb; // Megabyte
                var gb = 1024 * mb; // Gigabyte
                var tb = 1024 * gb; // Terabyte
                if (size < kb) {
                    return size + " B";
                } else if (size < mb) {
                    return (size / kb).toFixed(2) + " KB";
                } else if (size < gb) {
                    return (size / mb).toFixed(2) + " MB";
                } else if (size < tb) {
                    return (size / gb).toFixed(2) + " GB";
                } else {
                    return (size / tb).toFixed(2) + " TB";
                }
            }

            $('#filetbody').on('click', '.deletefile', function () {
                var file_id = $(this).parent().siblings('.file-id').text();
                var thistr = $(this).parent().parent();

                var filesizecolumn = $(this).parent().siblings('.file-size').find('b');

                var thisfilesize = convertUnitToMB(filesizecolumn.text());

                $.ajax({
                    type: 'POST',
                    url: '/file/delete',
                    data: {'file_id': file_id},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: function (data) {
                        if (data.msg == 'success') {
                            layer.msg('put into trash successfully!', {icon: 1, time: 1000});
                            thistr.hide();

                            $('#filelistnumber').text($('#filelistnumber').text() - "1");
                            $("#sizeonfilelist").text(((parseFloat($("#sizeonfilelist").text()) - thisfilesize)).toFixed(2) + ' MB');

                        } else {
                            swal('Failure', "deletion failure! ", 'error');
                        }
                    },
                    error: function (xhr, type) {
                        swal('Oops...', "Error! ", 'error');
                    }
                });

            });


            $('#filetbody').on('click', '.adddesc', function () {
                $(this).parent().siblings('.file-desc').children('div').toggle();
                $("input[name='desc']").val($(this).parent().siblings('.file-desc').children('p').text());
            });


            $('#filetbody').on('keyup', "input[name='desc']", function (e) {
                if (e.keyCode == 13) {
                    var thisinput = $(this);
                    var desc = $(this).val().trim();
                    var file_id = $(this).parent().parent().siblings('.file-id').text();
                    if (desc != "") {
                        $.ajax({
                            type: 'POST',
                            url: '/file/update/desc',
                            data: {"desc": desc, 'file_id': file_id},
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                            success: function (data) {
                                if (data.msg == 'success') {
                                    thisinput.parent().prev().text(thisinput.val().trim());
                                    thisinput.parent().hide();
                                    swal(
                                            {
                                                title: 'Information',
                                                text: "description was changed into <span style='color:red'>" + thisinput.val().trim() + "</span> ",
                                                type: "info",
                                                html: true,
                                                closeOnConfirm: false
                                            },
                                            function () {
                                                window.location.href = "/main";
                                            });
                                } else {
                                    swal('Unkowning', "Error! ", 'error');
                                }
                            },
                            error: function (xhr, type) {
                                swal('Oops...', "Error! ", 'error');
                            }
                        });

                    } else {
                        swal('Notice', "empty is not allowed ", 'error');
                    }
                }
            });

        });

    </script>
@endsection
