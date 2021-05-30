<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Đăng ký</title>
    <base href="http://<?php echo $_SERVER['HTTP_HOST']?>/CChat/"/>
	<link rel="stylesheet" href="public/fontawesome/css/all.css">
    <link rel="stylesheet" href="public/css/authen.css">
</head>
<body>
	<div class="backgroundBox">
		<div class="ripple-background">
			<div class="circle xxlarge shade1"></div>
			<div class="circle xlarge shade2"></div>
			<div class="circle large shade3"></div>
			<div class="circle medium shade4"></div>
			<div class="circle small shade5"></div>
		</div>
	</div>
	<div class="content">
		<h2 class="header">
			CChat chào bạn 
		</h2>
		<div class="wrapper">
			<div class="wrapper__left">
				<h3 class="wrapper__title">Đăng ký</h3>
				<form id="register-form" name="register-form" accept-charset="UTF-8">
					<input id="register-email" type="email" name="register-email" placeholder="Email của bạn">
					<input id="register-pass" type="password" name="register-pass" placeholder="Mật khẩu của bạn">
                    <input id="register-repass" type="password" name="register-repass" placeholder="Nhập lại mật khẩu của bạn">
                    <div class="genderBox">
                        <label for="gender">Giới tính: </label>
                        <input type="radio" value="Male" name="gender" checked>Nam
                        <input type="radio" value="Female" name="gender">Nữ
                    </div>
					<input id="register-btn" type="submit" name="register-btn" value="Đăng ký">
				</form>
				<p id="error-form"></p>
			</div>
			<div class="wrapper__right">
				<div class="logoBox">
					<i class="far fa-paper-plane"></i>
					<h5 class="logoBox__slogan">
						Kết nối mọi người
					</h5>
				</div>
				<span>Đã có tài khoản ?</span>
				<a class="myform__switch" href="./Login/Hello" >
					Đăng nhập tại đây
				</a>
			</div>
		</div>
	</div>
    <script type="text/javascript" src="public/js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="public/js/jquery.validate.js"></script>
	<script type="text/javascript" src="public/js/authen.js"></script>
</body>
</html>