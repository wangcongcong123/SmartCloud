<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>

<link rel="stylesheet" href="asserts/bootstrap.min.css">

<body>


<span style="display: none" id="myaccount">{{$_COOKIE['account']}}</span>

<a class="go-back" style="font-size: 22px"><i class="glyphicon glyphicon-backward"></i></a>

@if(count($users)==0)
    <div class="list-group" id="empty-holder">
        <a href="#" class="list-group-item">
            <h4 class="list-group-item-heading">
                Not Found
            </h4>
            <p class="list-group-item-text">
                The User you Found does not exist
            </p>
        </a>
    </div>

@else
    <div class="list-group" id="holder">

        <a class="list-group-item active">

            <h4 class="list-group-item-heading">
                Find Result <i>[found {{count($users)}} results in total]</i>
            </h4>
        </a>

        @foreach($users as $user)
            @if($user->email!=$_COOKIE['account'])

                <a class="list-group-item item-div">
                    <h4 class="list-group-item-heading">
                         {{$user->name}}
                    </h4>
                    <p class="list-group-item-text">{{$user->email}}</p>
                </a>

            @endif
        @endforeach
    </div>
@endif


</body>

<script src="asserts/bootstrap.min.js"></script>
<script src="asserts/plugins/layui/layui.js"></script>
<script src="asserts/jquery-1.9.1.min.js"></script>
<script>


    $(document).ready(function () {

        layui.use('layer',function () {

            var layer=layui.layer;


            $('.go-back').click(function () {
                history.back();
            });

            $('#holder .item-div').click(function () {

                var name=$(this).children('h4').text();

                var account=$(this).children('p').text();


                layer.open({
                    title:'are you sure?',
                    content:"you will add <span style='color: red'>"+account+"</span> to be your friend",


                    yes:function () {
//                        layer.msg('yes is clicked');
                        var maccount=$('#myaccount').text();
                        $.ajax({
                            type: 'POST',
                            url: '/addafriend',
                            data: {'maccount': maccount, 'faccount': account},
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },

                            success: function (data) {
                                if (data.msg == 'success') {
                                    layer.msg('success',{time:1000,anim:1,icon:1});
                                } else if('exist') {

                                    layer.msg('the user was already your friend',{time:1000,anim:6,icon:2});
                                }
                            },
                            error: function (xhr, type) {
                               layer.msg('error',{time:1000,anim:6,icon:2});
                            }
                        });



                    }
                });

            });




        });

    });



</script>

</html>