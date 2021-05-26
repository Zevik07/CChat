$(document).ready(function(){
    $("#login-form").validate({
		rules: {
            "login-email" : {
                email: true,
                required: true,
                maxlength: 100
            },
			"login-pass": {
				required: true,
				maxlength:64
			}
		},
		messages: {
            "login-email" : {
                email: 'Email của bạn chưa đúng định dạng',
                required: 'Vui lòng nhập email'
            },
			"login-pass": {
				required: 'Vui lòng nhập mật khẩu'
			}
		},
        submitHandler: function(form) {
            $.ajax({
                type:"POST",
                url: './Login/Auth',
                data:  $(form).serialize(),
                dataType: "JSON",
                success:function(feedback){
                    if (feedback.status == 'success')
                    {
                        window.location = './Home';
                    }
                    else{
                        $('#error-form').removeClass('shake error-form').html('');
                        setTimeout(function(){ 
                            $('#error-form').addClass('shake error-form').html(feedback.message);
                        }, 10);
                    }
                },
                error: function(feedback) {
                    alert('Lỗi gửi dữ liệu lên server');
                 }
            });
        }
    })
    $("#register-form").validate({
		rules: {
            "register-email" : {
                email: true,
                required: true,
                maxlength: 100
            },
			"register-pass": {
				required: true,
                minlength:6,
				maxlength:64
			},
            "register-repass": {
				equalTo: "#register-pass",
			}
		},
		messages: {
            "register-email" : {
                email: 'Email của bạn chưa đúng định dạng',
                required: 'Vui lòng nhập email'
            },
			"register-pass": {
				required: 'Vui lòng nhập mật khẩu',
                minlength: 'Mật khẩu ít nhất 6 kí tự'
			},
            "register-repass": {
				equalTo: 'Mật khẩu nhập lại chưa đúng'
			}
		},
        submitHandler: function(form) {
            $.ajax({
                type:"POST",
                url: './Register/Auth',
                data:  $(form).serialize(),
                dataType: "JSON",
                success:function(feedback){
                    if (feedback.status == 'success')
                    {
                        window.location = './Home';
                    }
                    else{
                        $('#error-form').removeClass('shake error-form').html('');
                        setTimeout(function(){ 
                            $('#error-form').addClass('shake error-form').html(feedback.message);
                        }, 10);
                    }
                },
                error: function(feedback) {
                    alert('Lỗi gửi dữ liệu lên server');
                 }
            });
        }
    })
})