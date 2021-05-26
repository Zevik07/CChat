<?php
class Login extends Controller{
    public $userModel;
    public function __construct(){
        $this->userModel = $this->model("User");
    }
    public function Hello(){
        if (isset($_SESSION['userid'])){
            header('Location: ./Home');
            return;
        }
        $this->view('Login',[

        ]);
    }
    public function Auth(){
        if (isset($_POST["login-btn"]))
        {
            $checkValid = $this->userModel->checkValidUser($_POST['login-email'],$_POST['login-pass']);
            if ($checkValid){
                echo json_encode(["status" => "success", "message" => "Đăng kí thành công"]);
            }
            else {
                echo json_encode(["status" => "error", "message" => "Tài khoản hoặc mật khẩu không đúng"]);
            }
        }
    }
}
?>