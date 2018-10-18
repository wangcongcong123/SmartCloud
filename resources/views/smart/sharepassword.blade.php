<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <title>share password page</title>
</head>


<body style="background: #ecf0f5;">
<p style="display: none">{{$_GET['fileid']}}</p>
</body>

<script src="asserts/jquery.min.js"></script>
<script src="asserts/plugins/layui/layui.js"></script>

<script>


    layui.use('layer', function () {

        var browser = {
            versions: function () {
                var u = navigator.userAgent, app = navigator.appVersion;
                return {
                    trident: u.indexOf('Trident') > -1,
                    presto: u.indexOf('Presto') > -1,
                    webKit: u.indexOf('AppleWebKit') > -1,
                    gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1,
                    mobile: !!u.match(/AppleWebKit.*Mobile.*/) || !!u.match(/AppleWebKit/),
                    ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/),
                    android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1,
                    iPhone: u.indexOf('iPhone') > -1 || u.indexOf('Mac') > -1,
                    iPad: u.indexOf('iPad') > -1,
                    webApp: u.indexOf('Safari') == -1
                };
            }()
        }


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
            title: 'enter password of this file sharing please',
            area: ['400px', '350px'],
        }, function (value, index, elem) {

            var password = value;
            var file_id = $('p').text();

            $.ajax({
                type: 'POST',
                url: '/checksharepass',
                data: {
                    'file_id': file_id,
                    'pass': password
                },

                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },

                success: function (data) {
                    if (data.status == 1) {
                        window.location.href = data.msg;
                    } else {
                        layer.msg("password wrong", {icon: 2, anim: 6, time: 1000});
                    }

                },
                error: function (xhr, type) {
                    layer.msg("error", {icon: 2, anim: 6, time: 1000});
                }
            });




            {{--var regforpsw = /^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,16}$/;--}}
            {{--if (!regforpsw.test(value)) {--}}
            {{--layer.msg('password with both digits and letters between 8 and 16', {icon: 2, anim: 6, time: 1000});--}}
            {{--return false;--}}
            {{--}--}}
            {{--var emailpre = $("p").text();--}}
            {{--var emailpost = $("span").text();--}}
            {{--var email = emailpre + "@" + emailpost;--}}
            {{--var token2 = $("a").text();--}}
            {{--window.location.href='/resetbyemail?email='+email+'&token='+token2+'&newpass='+value;--}}
        });
    })
    ;


</script>
</html>



