<?php
class Home extends Controller{
    protected $userModel;
    protected $groupModel;
    protected $friendModel;
    function __construct()
    {
        $this->userModel = $this->model('User');
        $this->groupModel = $this->model('Group');
        $this->friendModel = $this->model('Friend');
    }
    public function Chat(){
        $this->view('Master',[
            'Page'=>"Home",
            'User'=>$this->userModel->getUserInfor($_SESSION['userEmail']),
            'Friend'=>$this->friendModel->getFriendInfor($_SESSION['userEmail']),
            'Group'=>$this->groupModel->getGroupInfor()
        ]);
    }
    // public function Friend(){
    //     $this->view('Master',[
    //         'Page'=>"Friend",
    //         'User'=>$this->userModel->getUserInfor($_SESSION['userEmail']),
    //         'Friend'=>$this->friendModel->getFriendInfor($_SESSION['userEmail']),
    //         'Group'=>$this->groupModel->getGroupInfor()
    //     ]);
    // }


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
            json_encode(['status'=>'error', 'message'=>'Bạn chưa nhận nội dung tin nhắn']);
            return;
        }
        if ($_POST['friendEmail'] == ''){
            json_encode(['status'=>'error', 'message'=>'Hãy chọn bạn để chat']);
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
}
?>