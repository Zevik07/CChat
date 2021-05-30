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
        if (trim($_POST['MsgText']) == ''){
            echo json_encode(['status'=>'error', 'message'=>'Bạn chưa nhận nội dung tin nhắn']);
            return;
        }
        if ($_POST['friendEmail'] == ''){
            echo json_encode(['status'=>'error', 'message'=>'Hãy chọn bạn để chat']);
            return;
        }
        $result = $this->model('Message')->sendMessage($_POST['friendEmail'],$_POST['MsgText']);
        if ($result)
        {
            date_default_timezone_set("Asia/Bangkok");
            $datetime = date('Y-m-d H:i:s');
            echo json_encode(['status'=>'success', 'date'=>$datetime]);
        }
        else {
            echo json_encode(['status'=>'error', 'message'=>'Không thể thêm vào CSDL']);
        }
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
}
?>