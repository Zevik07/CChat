<?php
class Home extends Controller{
    protected $userModel;
    protected $groupModel;
    protected $friendModel;
    protected $requestModel;
    function __construct()
    {
        $this->userModel = $this->model('User');
        $this->groupModel = $this->model('Group');
        $this->friendModel = $this->model('Friend');
        $this->requestModel = $this->model('Request');
    }
    public function Chat(){
        $this->view('Master',[
            'Page'=>"Home",
            'User'=>$this->userModel->getUserInfor($_SESSION['userEmail']),
            'Friend'=>$this->friendModel->getFriendInfor($_SESSION['userEmail']),
            'Request'=>$this->requestModel->getRequestInfor($_SESSION['userEmail']),
            'Group'=>$this->groupModel->getGroupInfor($_SESSION['userEmail'])
        ]);
    }
    //return json msg
    public function getMessage(){
        $messageList = $this->model('Message')->getMessage($_POST['friendEmail']);
        echo $messageList;
    }
    public function getMessageCurrent(){
        $messageList = $this->model('Message')->getMessageCurrent($_POST['friendEmail'],$_POST['lastMessage']);
        echo $messageList;
    }
    public function sendMessage(){
        //Nếu không phải post dữ liệu
        if ($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            echo json_encode(['status'=>'error', 'message'=>'Phải sử dụng phương thức POST']);
            return;
        }

        //Kiểm tra nếu người dùng chưa nhập tin nhắn hoặc ảnh
        if (trim($_POST['message-input']) == '' && $_FILES['message-image']['name'] == '')
        {
            echo json_encode(['status'=>'error', 'message'=>'Bạn chưa nhập nội dung tin nhắn']);
            return;
        }
        $result = $this->model('Message')->sendMessage();
        echo ($result);
    }
    public function addFriend(){
        if ($_POST['emailRequest'] == ''){
            echo json_encode(['status'=>'error', 'message'=>'Chưa nhận được email']);
            return;
        }
        $friendInfor = $this->friendModel->addFriend($_POST['emailRequest']);
        echo $friendInfor;
    }
    public function removeFriendRequest(){
        if ($_POST['emailRequest'] == '')
        {
            echo json_encode(['status'=>'error',"message"=>"Không tồn tại email"]);
        }
        $result = $this->friendModel->removeFriendRequest($_POST['emailRequest'],$_POST['type']);
        echo $result;
    }

    public function sendRequest(){
        $result = $this->requestModel->sendRequest($_POST['emailRequest']);
        echo $result;
    }
    public function createGroup(){
        $result =$this->groupModel->createGroup($_POST['groupName']);
        if ($result)
        {
            echo json_encode(['status'=>'success','Đã thêm nhóm thành công']);
        }
        else{
            echo json_encode(['status'=>'error','Thêm nhóm thất bại !']);
        }
    }
    public function addMember(){
        echo $this->groupModel->addMember($_POST['groupId'],$_POST['friendId']);
    }
    public function deleteMessage(){
        echo $this->model('Message')->deleteMessage($_POST['msgId']);
    }
    public function updateUser(){
        echo $this->model('User')->updateUser();
    }
}
?>