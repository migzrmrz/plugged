<!DOCTYPE html>
<html lang="en">
<head>
	<title>Plugged Board Game Cafe and Gaming Lounge</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/plugged-covers.jpg');">
     
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Account Login
				</span>
              <font color="white">
				{!! Form::open(['url'=>'/login']) !!}
                    <div class="container-login100-form-btn  m-t-40{{ $errors->has('username') ? ' has-error' : '' }}">
                        
                        <font size="5" style="font-family:timesnewroman;">{!! Form::label("username","Username&nbsp;") !!}</font>
                        {!! Form::text("username",null,["class"=>"form-control","placeholder"=>"Username"]) !!}
                        {!! $errors->first('username','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="container-login100-form-btn m-t-40{{ $errors->has('password') ? ' has-error' : '' }}">
                    <font size="5" style="font-family:timesnewroman;">{!! Form::label("password","Password&nbsp;&nbsp;") !!}</font>
                        {!! Form::password("password",["class"=>"form-control","placeholder"=>"Password"]) !!}
                        {!! $errors->first('password','<span class="help-block">:message</span>') !!}
                    </div>
                  
                    <div class="container-login100-form-btn m-t-30">
                    <input type="hidden" name="active" value="1"/>
                    <button class="login100-form-btn m-t-32">
                    Login
                    {!! Form::submit("",["class"=>"btn btn-primary"]) !!}
                    </div>
                    </button>
                    {!! Form::close() !!}
                   
                  
                    </div></font>
                   
			</div>
		</div>
	</div>
    
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>