<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>MECAPP-Login</title>

	<!-- vendor css -->
	<link href="assets/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="assets/lib/Ionicons/css/ionicons.css" rel="stylesheet">
	<link href="assets/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">

	<!-- MEC CSS -->
	<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
	<div class="am-signin-wrapper">
		<div class="am-signin-box">
			<div class="row no-gutters">
				<div class="col-lg-5">
					<div>
						<img src="assets/images/logo.png" height="90">
						<p>MEC internal tool for checks</p>
						<hr>
						<p>Don't have an account? <br> <a href="page-signup.html">Sign up Now</a></p>
					</div>
				</div>
				<div class="col-lg-7">
					<h5 class="tx-gray-800 mg-b-25">Signin to Your Account</h5>
					<?php
					if(isset($_REQUEST['message']))
					{
						$message = base64_decode($_REQUEST['message']);
						?>
						<div class="alert alert-warning" role="alert">
	            			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              				<span aria-hidden="true">&times;</span>
	            			</button>
	        				<div class="d-flex align-items-center justify-content-start">
	              				<i class="icon ion-ios-close alert-icon tx-24"></i>
	              				<span><strong>Error! </strong><?=$message?></span>
	            			</div><!-- d-flex -->
	          			</div>
						<?php
					}

					if(isset($_REQUEST['rmsg']))
					{
						$rmsg = base64_decode($_REQUEST['rmsg'])
						?>
						<div class="alert alert-success" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<div class="d-flex align-items-center justify-content-start">
								<i class="icon ion-ios-checkmark alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
								<span><strong>Well done! </strong><?=$rmsg?></span>
							</div><!-- d-flex -->
						</div><!-- alert -->
						<?php
					}
					?>
					<form name="login" id="login" action="loginValidation" method="POST">
						<div class="form-group">
							<label class="form-control-label">Email:</label>
							<input type="email" id="email" name="email" class="form-control" placeholder="Enter your email address">
						</div><!-- form-group -->

						<div class="form-group">
							<label class="form-control-label">Password:</label>
							<input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
						</div><!-- form-group -->

						<div class="form-group mg-b-20"><input type="checkbox" onclick="showPassword()"> Show Password</div>

						<!-- <div class="form-group mg-b-20"><a href="">Reset password</a></div> -->
						<button type="submit" class="btn btn-block">Sign In</button>
					</form>
					<br>
					<div class="alert alert-warning" role="alert" id="warning" style="display: none;">
            			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
              				<span aria-hidden="true">&times;</span>
            			</button>
        				<div class="d-flex align-items-center justify-content-start">
              				<i class="icon ion-ios-close alert-icon tx-24"></i>
              				<span><strong>Error! </strong>WARNING! Caps lock is ON.</span>
            			</div><!-- d-flex -->
          			</div>
				</div><!-- col-7 -->
			</div><!-- row -->
			<p class="tx-center tx-white-5 tx-12 mg-t-15">Copyright &copy; <?php echo date("Y"); ?>-<?php echo date('Y', strtotime('+1 year'));?>. All Rights Reserved. <a href="http://mobilityecommerce.com/" target="_blank">MobilityeCommerce</a></p>
		</div><!-- signin-box -->
	</div><!-- am-signin-wrapper -->

	<script src="assets/lib/jquery/jquery.js"></script>
	<script src="assets/lib/popper.js/popper.js"></script>
	<script src="assets/lib/bootstrap/bootstrap.js"></script>
	<script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
	<script src="assets/js/script.js"></script>
	<script>
		function showPassword()
		{
			var x = document.getElementById("password");
		    if (x.type === "password")
		    {
		        x.type = "text";
		    }
		    else
		    {
		        x.type = "password";
		    }
		}

		var input = document.getElementById("password");
		var text = document.getElementById("warning");

		input.addEventListener("keyup", function(event)
		{
			if (event.getModifierState("CapsLock"))
			{
			    text.style.display = "block";
		  	}
		  	else
		  	{
			    text.style.display = "none"
		  	}

		  	event.preventDefault();

		  	if (event.keyCode === 13)
		  	{
		  		document.login.submit();
		  	}
		});
	</script>
</body>
</html>