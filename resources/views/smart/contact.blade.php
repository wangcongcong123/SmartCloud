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
    <link rel="stylesheet" href="mycss/sharewithfriends.css">

</head>
<body>
<span style="display: none" id="my-account">{{$_COOKIE['account']}}</span>
<span style="display: none" id="data">{{$data}}</span>

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
                        <i class="fa fa-refresh"></i>
                    </a>
                </li>

                <li>
                    <a href="{{route('main')}}">
                        <i class="fa fa-reply"></i>
                    </a>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li class="user user-menu">
                    <a href="{{route('main')}}"> <img
                                src="images/admin.jpg" id="face" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{$_COOKIE['fullname']}}</span>
                    </a>
                </li>


                <li>
                    <a href="{{route('signout')}}" id="sign-out"> <i class="fa fa-sign-out"></i></a>
                </li>


            </ul>
        </div>
    </nav>
</header>


<div id='hideallfiles' style="display: none">{{json_encode($sendfiles)}}</div>
<div id='hideallfolders' style="display: none">{{json_encode($sendfolders)}}</div>


<div style="margin-top: 600px" id="temp"></div>
<div id="treeDemoDiv" style="display:none">
    <div><input type="text" name="movefolder" class="form-control"></div>
    <ul id="treeDemo"></ul>
</div>

<section class="content-footer" style="color: #666;text-align:center">
    <p>Copyright © 2017. BDIC Group 7 Module Project 2 All rights
        reserved.</p>
</section>


</body>


<script src="asserts/bootstrap.min.js"></script>
<script src="asserts/plugins/layui/lay/modules/jquery.js"></script>
<script src="asserts/plugins/layui/layui.js"></script>
<script src="asserts/jquery-1.9.1.min.js"></script>


<script type=text/javascript>

    layui.use('layer', function () {

        var layer = layui.layer;

        $('#sign-out').on('click', function () {
            layer.open({
                title: 'sign-out',
                content: 'are you sure to sign out?',
                yes: function (index) {
                    layer.close(index);
                    window.location.href = '/signout';
                }
            });

            return false;
        });


        layui
                .use(
                        'layim',
                        function (layim) {

                            var myaccount = $("#my-account").text();

                            var content = $("#data").text();
                            var content2 = $.parseJSON(content);

                            $('#face').attr('src',content2.data.mine.avatar);

                            layim.config({
                                init: content2.data,
                                tool: [{
                                    alias: 'sharefile',
                                    title: 'share file',
                                    icon: '&#xe609;'
                                }, {
                                    alias: 'delete',
                                    title: 'delte file',
                                    icon: '&#xe640;'
                                }]
                                , title: 'Share File With Friends'
                                , right: '70%'
                                , initSkin: '4.jpg'
                                , isgroup: false
                                , notice: true,
                                isAudio: false,
                                maxLength: 1000
                                ,
                                msgbox: layui.cache.dir
                                + 'css/modules/layim/html/msgbox.html'
                                ,
                                find: layui.cache.dir
                                + 'css/modules/layim/html/find.html'
                                ,
                                chatLog: layui.cache.dir
                                + 'css/modules/layim/html/chatLog.html'
                            });

//                            layim.msgbox(5);

                            layim.on('online', function (data) {
                                //console.log(data);
                                layer.msg('online event');
                            });

                            layim.on('sign', function (value) {
                                layer.msg('sign event');

                            });

                            layim.on('tool(delete)', function (insert) {

                                layer.open({
                                    title: 'are you sure?',
                                    content: "are sure delete the friend id = <span style='color: red;'>" + currenfid + "</span>",
                                    yes: function () {
                                        var myaccount = $('#my-account').text();

                                        $.ajax({
                                            type: 'POST',
                                            url: '/deletefriend',
                                            data: {'accountforlogin': myaccount, 'deletename': currentusername},
                                            dataType: 'json',
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                            },
                                            success: function (data) {

                                                if (data.state == 'success') {

                                                    layim.removeList({
                                                        type: 'friend',
                                                        id: currenfid
                                                    });
                                                    removedfriends.push(currenfid);
                                                    layer.msg('success', {icon: 1, anim: 2, time: 1000});
//                                                    layim.setChatMin();

                                                } else {
                                                    layer.msg('wrong', {icon: 2, anim: 6, time: 1000});
                                                }
                                            },
                                            error: function (xhr, type) {
                                                layer.msg('error', {icon: 2, anim: 6, time: 1000});
                                            }
                                        });
                                    }
                                });

                            });

                            var currenfid;
                            var currentusername;
                            var removedfriends = new Array();


                            layim.on('tool(sharefile)', function (insert) {

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
                                        tempnode.spread = true;
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

                                $('#treeDemo').empty();
                                layui.use('tree', function () {

                                    var allfiles = $.parseJSON($('#hideallfiles').text());
                                    var allfolders = $.parseJSON($('#hideallfolders').text());
                                    var nodes = getNodes(0, allfiles, allfolders);

                                    var nodes = [{
                                        id: 0,
                                        name: 'root',
                                        alias: 'folder',
                                        spread: true,
                                        children: nodes
                                    }];


                                    layui.tree({
                                        elem: '#treeDemo'
                                        , nodes: nodes,
                                        click: function (node) {

                                            if (node.alias==="folder"||node.name==="empty"){
                                                layer.msg("pick a file, please",{icon:2,anim:6,time:1000});
                                                return;
                                            }
                                            insert("",index2);

                                            layer.title("your choice is: " + node.id + "=>" + node.alias + "=>" + node.name, index2);

                                            $('input[name="movefolder"]').val(node.id + "=>" + node.alias + "=>" + node.name);

                                            var account1=myaccount.split('@')[0];
                                            var account2=myaccount.split('@')[1];

                                            insert("file(http://"+document.location.host+"/contact/download?filename="+node.name+"&account1="+account1+"&account2="+account2+")["+node.name+"]", index2);

                                        }
                                    });
                                });

//
                                var index2 = layer.open({
                                    type: 1,
                                    skin: 'layui-layer-lan',
                                    title: 'change list',
                                    content: $('#treeDemoDiv'),
                                    closeBtn: 2,
                                    area: ["650px", '400px'],
                                    maxmin: true,
                                    shadeClose: true,
                                    shade: 0
                                    , btn: ['confirm']
                                    , yes: function (index, layero) {
                                        layer.close(index);
                                    }

                                });

                            });


                            var ws = new WebSocket("ws://123.207.171.254:62222");

                            ws.onopen = function () {
                                var data = "System：connect successfully!";
                                layim.getMessage({
                                    content: data
                                });



                            };

                            ws.onerror = function () {
                                var data = "System : error, exit to try again.";
                                layim.getMessage({
                                    content: data
                                });
                            };


                            var uname = $('#my-account').text();

                            ws.onmessage = function (e) {

                                //interperate data from server

                                var msg = JSON.parse(e.data);

                                var sender, user_name, name_list, change_type;

                                switch (msg.type) {
                                    case 'system':
                                        sender = 'System: ';
                                        break;
                                    case 'user':
                                        sender = msg.from + ': ';
                                        break;
                                    case 'handshake':
                                        var user_info = {'type': 'login', 'content': uname};
                                        sendMsg(user_info);
                                        return;
                                    case 'login':
                                    case 'logout':
                                        user_name = msg.content;
                                        name_list = msg.user_list;
                                        change_type = msg.type;
                                        dealUser(user_name, change_type, name_list);
                                        return;
                                }

                                var data = sender + msg.content;


                                if (msg.touname == myaccount) {
                                    var obj = {
                                        username: msg.from,
                                        avatar: msg.fromava,
                                        id: msg.fromid,
                                        type: 'friend',
                                        content: msg.content
                                    };
                                    layim.getMessage(obj);
                                }


                            };


                            function dealUser(user_name, type, name_list) {
                                var change = type == 'login' ? 'online' : 'offline';
                                var data = 'From System: ' + user_name + ' already ' + change;
                                if (user_name != myaccount) {
                                    layim.getMessage({
                                        content: data
                                    });


                                }
                            }


                            function sendMsg(msg) {
                                var data = JSON.stringify(msg);
                                ws.send(data);
                            }

                            layim
                                    .on(
                                            'sendMessage',
                                            function (data) {

//                                               alert(JSON.stringify(data));

                                                var To = data.to;

                                                for (var i = 0; i < removedfriends.length; i++) {
                                                    if (removedfriends[i] === To.id) {
                                                        layer.msg('the friend does not exist', {
                                                            icon: 2,
                                                            anim: 6,
                                                            time: 1000
                                                        });
                                                        return;
                                                    }
                                                }


                                                var msg = {
                                                    'content': data.mine.content,
                                                    'type': 'user',
                                                    'touname': data.to.name,
                                                    'toid': data.to.id,
                                                    'fromid':data.mine.id,
                                                    'fromava':data.mine.avatar
                                                };

                                                sendMsg(msg);

                                            });

                            layim.on('members', function (data) {
                                //console.log(data);
                            });


                            layim.on('chatChange', function (res) {
                                var type = res.data.type;
                                console.log(res.data.id);
                                if (type === 'friend') {
//                                  layer.msg('chatChange' + res.data.id);
                                    currenfid = res.data.id;
                                    currentusername = res.data.username;
//                                  layer.msg('chatChange' + res.data.username);

                                } else if (type === 'group') {
                                    layim.getMessage({
                                        system: true,
                                        id: res.data.id,
                                        type: "group",
                                        content: '模拟群员'
                                        + (Math.random() * 100 | 0)
                                        + '加入群聊'
                                    });
                                }
                            });


                        });
    });

</script>
</html>