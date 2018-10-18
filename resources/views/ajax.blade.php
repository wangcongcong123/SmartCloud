<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="_token" content="{{ csrf_token() }}"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome to Smart Cloud</title>
</head>
<link rel="stylesheet" href="asserts/bootstrap.min.css">
<body>


	<form role="form" method="post" id="registerform"
	action="{{route('register')}}">
	{{ csrf_field() }}
	<div class="form-group">
		<label><span class="glyphicon glyphicon-user"></span>
			Fullname</label> <input type="text" class="form-control" name="username"
			placeholder="Enter your full name">
			<div style="color: red; display: none">you need to enter
				fullname</div>
			</div>

			<div class="form-group">
				<label><span class="glyphicon glyphicon-envelope"></span>
					Email</label> <input type="email" class="form-control" name="email"
					placeholder="Enter your E-mail">
					<div style="color: red; display: none">enter correct email
						address</div>
						<div style="color: red; display: none">this email was
							already registered address</div>
						</div>

						<div class="form-group">
							<label> Password</label> <input type="password"
							class="form-control" name="psw1"
							placeholder="Enter your Password">
							<div style="color: red; display: none">password should
								contain both digits and letters with length from 8 to 16</div>
							</div>

							<div class="form-group">
								<label> Password Again</label> <input type="password"
								class="form-control" name="psw2"
								placeholder="Retype your Password">
								<div style="color: red; display: none">two passwords are
									different</div>
								</div>

								<div class="checkbox">
									<label> <input type="checkbox" name="agree2" id="agree2"
										required> I agree relevent items<i><a
										style="text-decoration: none; color: #000" href="/"> check
										items here</a></i>
									</label>
								</div>

								<button type="submit" id="submit2"
								class=" btn btn-success btn-block">
								<span class="glyphicon glyphicon-off"></span> register
							</button>
						</form>

						<script src="asserts/jquery.min.js"></script>
						<script src="asserts/bootstrap.min.js"></script>
						<script type="text/javascript"> 

							$("input[name='email']").blur(function(){
								var email=$(this).val();
								$.ajax({
									type: 'POST',
									url: '/ajax/create',
									data: { "account" : email},
									dataType: 'json',
									headers: {
										'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
									},
									success: function(data){
										alert(data.msg);
									},
									error: function(xhr, type){
										alert("error! ajax");

									}
								});



							});
						</script>
					</body>
					</html>