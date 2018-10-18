<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Smart Cloud</title>
</head>
<link rel="stylesheet" href="asserts/bootstrap.min.css">
<link rel="stylesheet" href="mycss/oldindex.css">
<body>

<h1>
    <span class="glyphicon glyphicon-log-in"></span> Login to Smart Cloud
</h1>

<div class="login-box">
    <h4>Welcome to SC</h4>
    <div class="line">
        <span></span>
    </div>
    <div class="image">
        <img src="images/location.png" class="img-responsive"
             alt="no found image">
    </div>


    <form action="{{ route('login') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label class="label pull-left"><span
                        class="glyphicon glyphicon-user"></span> Email</label> <input
                    type="text" class="form-control text" name="accountforlogin"
                    value="Enter your Email" id="auto-complete-email" onfocus="this.value = '';"
                    onblur="if (this.value == '') {this.value = 'Enter your Email';}">
        </div>
        <div class="form-group">
            <label class="label pull-left"><span
                        class="glyphicon glyphicon-eye-open"></span> Password</label> <input
                    type="password" class="form-control" name="passwordforlogin"
                    value="Password" onfocus="this.value = '';"
                    onblur="if (this.value == '') {this.value = 'Password';}"
                    type="password">
        </div>
        <div class="checkbox pull-left">
            <label class="label"> <input type="checkbox" name="remember"
                                         id="remember"> Remember me one week
            </label>
        </div>
        <button type="submit" id="submit" class="btn btn-success btn-block">
            <span class="glyphicon glyphicon-off"></span> Login
        </button>
        <br>
        <div class="new">
            <label class="pull-left"><a id="forget">Forgot password ?</a></label>
            <label class="pull-right"><a href="#" id="signup">New here ? Sign Up</a></label>
        </div>
    </form>
</div>
<div class="copy-right">
    <p>Copyright © 2017. BDIC Group 7 Module Project 2 All rights
        reserved.</p>
</div>

<!-- verification modal -->
<div class="modal fade" id="verificationmodal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    <label><span class="glyphicon glyphicon-pencil"></span> Enter the
                        Verification Code</label>
                </h4>
            </div>
            <div class="modal-body">
                <div id="checkCode" onclick="createCode()"
                     style="background: url(images/code_bg.png); background-size: cover; width: 200px; height: 100px; font-family: Arial; font-style: italic; color: #656564; font-size: 50px;"></div>
                <div class="form-group">
                    <input type="text" class="form-control" id="inputCode"
                           placeholder="Enter VC here">
                </div>

                <button id="submit1" class=" btn btn-success btn-block">
                    <span class="glyphicon glyphicon-off"></span> Confirm
                </button>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-default pull-right"
                        data-dismiss="modal" id="cancelforveri">
                    <span class="glyphicon glyphicon-remove"></span> Cancel
                </button>
            </div>
        </div>
    </div>
</div>


<!-- signup modal -->
<div class="modal fade" id="signupmodal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Register a new Membership</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" id="registerform"
                      action="{{route('register')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label><span class="glyphicon glyphicon-user"></span> Fullname</label>
                        <input type="text" class="form-control" name="username"
                               placeholder="Enter your full name">
                        <div style="color: red; display: none">you need to enter fullname</div>
                    </div>

                    <div class="form-group">
                        <label><span class="glyphicon glyphicon-envelope"></span> Email</label>
                        <input type="email" class="form-control" name="email"
                               placeholder="Enter your E-mail" id="auto-complete-email-register">
                        <div style="color: red; display: none">enter correct email
                            address</div>
                        <div style="color: red; display: none">this email was already
                            registered address</div>
                    </div>

                    <div class="form-group">
                        <label> Password</label> <input type="password"
                                                        class="form-control" name="psw1"
                                                        placeholder="Enter your Password">
                        <div style="color: red; display: none">password should contain
                            both digits and letters with length from 8 to 16</div>
                    </div>

                    <div class="form-group">
                        <label> Password Again</label> <input type="password"
                                                              class="form-control" name="psw2"
                                                              placeholder="Retype your Password">
                        <div style="color: red; display: none">two passwords are
                            different</div>
                    </div>

                    <div class="checkbox">
                        <label> <input type="checkbox" name="agree2" id="agree2" required>
                            I agree relevent items<i><a
                                        style="text-decoration: none; color: #000" href="/"> check
                                    items here</a></i>
                        </label>
                    </div>

                    <button type="submit" id="submit2"
                            class=" btn btn-success btn-block">
                        <span class="glyphicon glyphicon-off"></span> register
                    </button>
                </form>
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

<script src="asserts/jquery.min.js"></script>
<script src="asserts/bootstrap.min.js"></script>
<script src="asserts/plugins/completer.min.js"></script>
<script type="text/javascript">

    $("#auto-complete-email").completer({
        separator: "@",
        source: ["qq.com", "163.com", "126.com", "ucdconnect.ie","emails.bjut.edu.cn", "gmail.com", "icloud.com"]
    });

    /*  jquery codes goes here */
    //TODO
    $("#signup").click(function() {
        $("#signupmodal").modal();
    });

    $("#submit").click(function() {
        /* alert(loginsubmit);
         loginsubmit=$("#loginform");
         createCode();
         $("#verificationmodal").modal();
         return false; */
        /* if($("input[name='accountforlogin']").val()!="admin"){
         return false;
         }else{
         $("#loginform").submit();
         } */
    });

    $("#submit1").click(function() {
        var inputCode = $("#inputCode").val();
        if (validateCode(inputCode)) {
            //use post way to submit data to the server with the help of ajax
            /*  $.post("loginprocess.php", {
             account : $("input[name='accountforlogin']").val(),
             password : $("input[name='passwordforlogin']").val(),
             remember : $("input[name='remember']").is(':checked')
             }, function(data) {
             alert(data);
             if(data=="success"){
             alert("successfully!");
             window.location.href="main.php";
             } else if(data=="wrong"){
             alert("either account or password is wrong");
             }
             }, "text"); */
            alert("correct!");
            //stop here
        } else {
            createCode();
        }
    });

    var isokforname = false;
    var isokforemail = false;
    var isokforpsw1 = false;
    var isokforpsw2 = false;

    $("input[name='username']").blur(function() {
        if ($(this).val().trim() == "") {
            isokforname = false;
            $(this).css('border', "1px solid red");
            $(this).next().show(1000);
        } else {
            isokforname = true;
            $(this).css('border', "1px solid #666");
            $(this).next().hide(1000);
        }
    });
    //    check email
    $("input[name='email']").blur(function(){
        var regforemail = /\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
        if ($(this).val().search(regforemail) == -1) {
            isokforemail = false;
            $(this).css('border', "1px solid red");
            $(this).next().show(1000);
        } else {
            var email=$(this).val();
            $.ajax({
                type: 'POST',
                url: '/emailexisthint',
                data: { "account" : email},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data){
                    if(data.msg=='exist'){
                        isokforemail = false;
                        $("input[name='email']").css('border', "1px solid red");
                        $("input[name='email']").next().next().show(1000);
                    }else{
                        isokforemail = true;
                        $("input[name='email']").css('border', "1px solid #666");
                        $("input[name='email']").next().hide(1000);
                        $("input[name='email']").next().next().hide(1000);
                    }
                },
                error: function(xhr, type){
                    alert("error! ajax");
                }
            });
        }
    });

    $("input[name='psw1']").blur(function() {
        var regforpsw = /^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,16}$/;
        if (!regforpsw.test($(this).val())) {
            isokforpsw1 = false;
            $(this).css('border', "1px solid red");
            $(this).next().show(1000);
        } else {
            isokforpsw1 = true;
            $(this).css('border', "1px solid #666");
            $(this).next().hide(1000);
        }
    });

    $("input[name='psw2']").blur(function() {
        if ($(this).val() != $("input[name='psw1']").val()) {
            isokforpsw2 = false;
            $("input[name='psw1']").css('border', "1px solid red");
            $(this).css('border', "1px solid red");
            $(this).next().show(1000);
        } else {
            isokforpsw2 = true;
            $("input[name='psw1']").css('border', "1px solid #666");
            $(this).css('border', "1px solid #666");
            $(this).next().hide(1000);
        }
    });

    $('#submit2')
            .click(
                    function() {
                        if (isokforname && isokforemail && isokforpsw1
                                && isokforpsw2) {
                            if ($('#agree2').attr('checked')
                                    || $("#agree2").get(0).checked
                                    || $('#agree2').is(':checked')) {
                                $('#registerform').submit();
                            } else {
                                alert("you should agree relevant items");
                                return false;
                            }
                        } else {
                            alert("fill in all information in correct format, please");
                            return false;
                        }
                    });

    var code;
    function createCode() {
        $("#inputCode").val("");
        code = "";
        var codeLength = 4; //the length of code
        var checkCode = $("#checkCode");
        var codeChars = new Array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b',
                'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n',
                'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
                'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L',
                'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X',
                'Y', 'Z');
        for (var i = 0; i < codeLength; i++) {
            var charNum = Math.floor(Math.random() * 52);
            code += codeChars[charNum];
        }
        if (checkCode) {
            checkCode.html(code);
        }
    }

    function validateCode(inputCode) {
        if (inputCode.length <= 0) {
            alert("Enter please");
            return false;
        } else if (inputCode.toUpperCase() != code.toUpperCase()) {
            alert("wrong");
            createCode();
            return false;
        } else {
            return true;
        }
    }
</script>
</body>
</html>