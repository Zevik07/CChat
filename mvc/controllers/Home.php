<?php
class Home extends Controller{
    protected $userModel;
    protected $groupModel;
    protected $friendModel;
    function __construct()
    {
        //unset($_SESSION['userEmail']);
        $this->userModel = $this->model('User');
        $this->groupModel = $this->model('Group');
        //$this->friendModel = $this->model('Friend');
    }
    public function Chat(){
        $this->view('Master',[
            'Page'=>"Home",
            'User'=>$this->userModel->getUserInfor($_SESSION['userEmail']),
            'Group'=>$this->groupModel->getGroupInfor()
        ]);
    }
    public function Friend(){
        $this->view('Master',[
            'Page'=>"Friend",
            'User'=>$this->userModel->getUserInfor($_SESSION['userEmail']),
            //'Friend'=>$this->friendModel->getFriendInfor($_SESSION['userEmail']),
            'Group'=>$this->groupModel->getGroupInfor()
        ]);
    }
}
?>