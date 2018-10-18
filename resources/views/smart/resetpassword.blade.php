<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <title> page</title>
</head>


<body style="background: #ecf0f5;">


<?php
$email = $_GET['emailpre'] . "@" . $_GET['emailpost'];
?>

<p hidden>{{$_GET['emailpre']}}</p>

<span hidden>{{$_GET['emailpost']}}</span>

<a hidden id="token">{{$_GET['token']}}</a>


</body>

<script src="asserts/jquery.min.js"></script>
<script src="asserts/plugins/layui/layui.js"></script>

<script>


    layui.use('layer', function () {
        var layer = layui.layer;


        var width='40%';
//        alert(navigator.userAgent);

        if (navigator.userAgent.indexOf('Mobile')>-1){
            var width='5%';
        }

        layer.prompt({
            closeBtn: 2,
            formType: 1,
            offset: ['40%', width],
            value: '',
            shade: 0,
            title: 'reset your password please',
            area: ['800px', '350px']
        }, function (value, index, elem) {
            var regforpsw = /^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,16}$/;
            if (!regforpsw.test(value)) {
                layer.msg('password with both digits and letters between 8 and 16', {icon: 2, anim: 6, time: 1000});
                return false;
            }
            var emailpre = $("p").text();
            var emailpost = $("span").text();
            var email = emailpre + "@" + emailpost;
            var token2 = $("#token").text();
            window.location.href='/resetbyemail?email='+email+'&token='+token2+'&newpass='+value;
        });
    });


</script>
</html>



