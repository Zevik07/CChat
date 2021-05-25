<html>
<head>
	<title>Login</title>
    <link rel="stylesheet" href="public/css/authen.css"> -->
	<link rel="stylesheet" href="./assets/fontawesome/css/all.css">
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
		<div id="header">
			CChat chào bạn 
		</div>
		<div id="wrapper">
			<div class="wrapper__left">
				<h3 class="header__title">Đăng nhập</h3>
				<form id="myform">
					<input type="text" name="email" placeholder="Email của bạn">
					<input type="password" name="password" placeholder="Mật khẩu của bạn">
					<input type="submit" value="Login" id="login_button" >
				</form>
				<div id="error" style="">Error</div>
			</div>
			<div class="wrapper__right">
				<div class="logoBox">
					<i class="far fa-paper-plane"></i>
					<div class="logoBox__slogan">
						Kết nối mọi người
					</div>
				</div>
				<a class="myform__switch" href="signup.php" >
					Chưa có tài khoản ? Đăng ký tại đây
				</a>
			</div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	//Ham de nhan element bang id
	function _(element){

		return document.getElementById(element);
	}

   	var login_button = _("login_button");
   	login_button.addEventListener("click",collect_data);
	//Ham lay du lieu
   	function collect_data(e){

   		e.preventDefault();
   		login_button.disabled = true;
   		login_button.value = "Loading...Please wait..";

   		var myform = _("myform");
   		var inputs = myform.getElementsByTagName("INPUT");

   		var data = {};
		//Nhan tuan tu du lieu
   		for (var i = inputs.length - 1; i >= 0; i--) {

   			var key = inputs[i].name;

   			switch(key){
 
   				case "email":
   					data.email = inputs[i].value;
   					break;
 
   				case "password":
   					data.password = inputs[i].value;
   					break;
 
   			}
   		}

   		send_data(data,"login");

   	}

   	function send_data(data,type){
		// Tạo một request gửi dữ liệu lên server
   		var xml = new XMLHttpRequest();

   		xml.onload = function(){

   			if(xml.readyState == 4 || xml.status == 200){
				// Khi thành công
   				handle_result(xml.responseText);
   				login_button.disabled = false;
   				login_button.value = "Login";
   			}
   		}

		data.data_type = type;
		var data_string = JSON.stringify(data);
		//Gui JSON den server
		xml.open("POST","api.php",true);
		xml.send(data_string);
   	}

   	function handle_result(result){

   		var data = JSON.parse(result);
   		if(data.data_type == "info"){
   			window.location = "index.php";
   		}
		else{
   			var error = _("error");
   			error.innerHTML = data.message;
   			error.style.display = "block";
   		}
   	}

</script>

