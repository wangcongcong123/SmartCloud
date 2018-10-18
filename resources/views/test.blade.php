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

<!-- header -->
<header class="main-header">
    <!-- Logo -->
    <a class="logo"> <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span> <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Smart</b>Cloud</span>
    </a>


    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Notifications: style can be found in dropdown.less -->
                <li>
                    <a href="{{route('localtest')}}">
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
                                src="images/admin.jpg" class="user-image" alt="User Image">
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


{{--<div id='hideallfiles' style="display: none">{{json_encode($sendfiles)}}</div>--}}
{{--<div id='hideallfolders' style="display: none">{{json_encode($sendfolders)}}</div>--}}


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

//                            var socket = new WebSocket('ws://localhost:8080');
//
//                            socket.send('Hi Server, I am LayIM!');
//
//                            //连接成功时触发
//                            socket.onopen = function(){
//                                socket.send('XXX连接成功');
//                                alert("握手成功");
//                            };
//
//
//                            //监听收到的消息
//                            socket.onmessage = function(res){
//                                //res为接受到的值，如 {"emit": "messageName", "data": {}}
//
//                                var data = $.parseJSON( res.data);
//
//                                alert(data);
//
//                                //emit即为发出的事件名，用于区分不同的消息
//                            };

//                            另外还有onclose、onerror，分别是在链接关闭和出错时触发。

//
//
//                            socket.send(JSON.stringify({
//                                type: '' //随便定义，用于在服务端区分消息类型
//                                ,data: {}
//                            }));


                            var autoReplay = [
                                '您好，我现在有事不在，一会再和您联系。',
                                '你没发错吧？face[微笑] ',
                                '洗澡中，请勿打扰，偷窥请购票，个体四十，团体八折，订票电话：一般人我不告诉他！face[哈哈] ',
                                '你好，我是主人的美女秘书，有什么事就跟我说吧，等他回来我会转告他的。face[心] face[心] face[心] ',
                                'face[威武] face[威武] face[威武] face[威武] ',
                                '<（@￣︶￣@）>',
                                '你要和我说话？你真的要和我说话？你确定自己想说吗？你一定非说不可吗？那你说吧，这是自动回复。',
                                'face[黑线]  你慢慢说，别急……',
                                '(*^__^*) face[嘻嘻] ，是贤心吗？'];

                            var myaccount = $("#my-account").text();

                            layim.config({

                                init: {
                                    url: '/getBaseInfo?mine=' + myaccount + ''
                                },

                                title: 'Share File With Friends'
                                , right: '70%'
                                , initSkin: '5.jpg'
                                , isgroup: false
                                , notice: true
                                ,
                                tool: [{
                                    alias: 'sharefile',
                                    title: 'share file',
                                    icon: '&#xe609;'
                                }]
                                ,
                                msgbox: layui.cache.dir
                                + 'css/modules/layim/html/msgbox.html' //消息盒子页面地址，若不开启，剔除该项即可
                                ,
                                find: layui.cache.dir
                                + 'css/modules/layim/html/find.html' //发现页面地址，若不开启，剔除该项即可
                                ,
                                chatLog: layui.cache.dir
                                + 'css/modules/layim/html/chatLog.html'//聊天记录页面地址，若不开启，剔除该项即可

                            });

                            layim.msgbox(5);

                            //监听在线状态的切换事件
                            layim.on('online', function (data) {
                                //console.log(data);
                                layer.msg('online event');
                            });

                            //监听签名修改
                            layim.on('sign', function (value) {
                                layer.msg('sign event');
                                //console.log(value);
                            });

                            //监听自定义工具栏点击，以添加代码为例
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


                                layui.use('tree', function () {

//									var allfiles = $.parseJSON($('#hideallfiles').text());
//									var allfolders = $.parseJSON($('#hideallfolders').text());
//									var nodes = getNodes(0, allfiles, allfolders);

                                    var nodes = [{
                                        id: 0,
                                        name: 'root',
                                        alias: 'folder',
                                        spread: true
                                    }];

//									children:nodes

                                    layui.tree({
                                        elem: '#treeDemo' //传入元素选择器
                                        , nodes: nodes,
                                        click: function (node) {
                                            layer.title("your choice is: " + node.id + "=>" + node.alias + "=>" + node.name, index2);
                                            $('input[name="movefolder"]').val(node.id + "=>" + node.alias + "=>" + node.name);
                                            insert("your choice is: " + node.id + "=>" + node.alias + "=>" + node.name, index2);

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

                            //监听layim建立就绪
                            layim
                                    .on(
                                            'ready',
                                            function (res) {
                                                //console.log(res.mine);
//                                                layim.msgbox(5); //模拟消息盒子有新消息，实际使用时，一般是动态获得
                                                //添加好友（如果检测到该socket）
//                                                layim
//                                                        .addList({
//                                                            type: 'group',
//                                                            avatar: "http://tva3.sinaimg.cn/crop.64.106.361.361.50/7181dbb3jw8evfbtem8edj20ci0dpq3a.jpg",
//                                                            groupname: 'Angular开发',
//                                                            id: "12333333",
//                                                            members: 0
//                                                        });
                                                layim
                                                        .addList({
                                                            type: 'friend',
                                                            avatar: "http://tp2.sinaimg.cn/2386568184/180/40050524279/0",
                                                            username: '冲田杏梨',
                                                            groupid: 2,
                                                            id: "1233333312121212",
                                                            remark: "本人冲田杏梨将结束AV女优的工作"
                                                        });

//												setTimeout(
//														function () {
//															//接受消息（如果检测到该socket）
//															layim
//																	.getMessage({
//																		username: "Hi",
//																		avatar: "http://qzapp.qlogo.cn/qzapp/100280987/56ADC83E78CEC046F8DF2C5D0DD63CDE/100",
//																		id: "10000111",
//																		type: "friend",
//																		content: "临时："
//																		+ new Date()
//																				.getTime()
//																	});
//
//															layim.getMessage({
//																username: "贤心"
//																,
//																avatar: "http://tp1.sinaimg.cn/1571889140/180/40030060651/1"
//																,
//																id: "100001"
//																,
//																type: "friend"
//																,
//																content: "嗨，你好！欢迎体验LayIM。演示标记：" + new Date().getTime()
//															});
//
//														}, 3000);
                                            });

                            //监听发送消息
                            layim
                                    .on(
                                            'sendMessage',
                                            function (data) {
                                                var To = data.to;
                                                //console.log(data);

                                                if (To.type === 'friend') {
                                                    layim
                                                            .setChatStatus('<span style="color:#FF5722;">对方正在输入。。。</span>');
                                                }

                                                //演示自动回复
                                                setTimeout(
                                                        function () {
                                                            var obj = {};
                                                            if (To.type === 'group') {
                                                                obj = {
                                                                    username: '模拟群员'
                                                                    + (Math
                                                                            .random() * 100 | 0),
                                                                    avatar: layui.cache.dir
                                                                    + 'images/face/'
                                                                    + (Math
                                                                            .random() * 72 | 0)
                                                                    + '.gif',
                                                                    id: To.id,
                                                                    type: To.type,
                                                                    content: autoReplay[Math
                                                                            .random() * 9 | 0]
                                                                }
                                                            } else {
                                                                obj = {
                                                                    username: To.name,
                                                                    avatar: To.avatar,
                                                                    id: To.id,
                                                                    type: To.type,
                                                                    content: autoReplay[Math
                                                                            .random() * 9 | 0]
                                                                }
                                                                layim
                                                                        .setChatStatus('<span style="color:#FF5722;">在线</span>');
                                                            }
                                                            layim
                                                                    .getMessage(obj);
                                                        }, 1000);
                                            });

                            //监听查看群员
                            layim.on('members', function (data) {
                                //console.log(data);
                            });

                            //监听聊天窗口的切换
                            layim.on('chatChange', function (res) {
                                var type = res.data.type;
                                console.log(res.data.id)
                                if (type === 'friend') {
                                    //模拟标注好友状态
                                    //layim.setChatStatus('<span style="color:#FF5722;">在线</span>');
                                } else if (type === 'group') {
                                    //模拟系统消息
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