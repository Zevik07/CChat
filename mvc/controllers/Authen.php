<?php
class Authen extends Controller{
    public $userModel;
    public function __construct(){
        $this->userModel = $this->model("User");
    }
    public function Login(){
        if (isset($_SESSION['user'])){
            header('Location: ./Home');
            return;
        }
        if (isset($_POST["signupSubmit"])){
            //Get data
            $name = $_POST["signupName"];
            $email = $_POST["signupEmail"];
            $password = $_POST["signupPass"];
            //$password = password_hash($_POST["signupPass"], PASSWORD_DEFAULT);
            //Insert into DB
            $result = $this->userModel->insertNewUser($name, $email, $password);
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Đăng kí thành công']);
            }
            else{
                echo json_encode(['status' => 'error', 'message' => 'Tài khoản đã tồn tại']);
            }
        }
    }
}
?>