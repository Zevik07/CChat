<?php
class Message extends DB{
    public function getMessage($email){
        $user = $_SESSION['userEmail'];
        $friend = $email;
        $qr = "SELECT id,sender,receiver,message,files,message.date,seen,received,deleted_sender,deleted_receiver,userName,image 
        FROM message, user WHERE (sender = email) AND 
        (sender = '$user' && receiver = '$friend' || receiver = '$user' && sender = '$friend')
        ORDER BY id";
        $rows = mysqli_query($this->con, $qr);
        $data = array();

        while ($row = mysqli_fetch_array($rows))
        {
            $data[] = $row;
        }
        //Gui mang cung duoc nhung gui Json sau nay nen tang khac lay du lieu ok hon
        return json_encode($data);
    }
    public function getMessageCurrent($friend, $currentMsg){
        $user = $_SESSION['userEmail'];
        $currentMsg = (int) $currentMsg;

        $qr = "SELECT id,sender,receiver,message,files,message.date,seen,received,deleted_sender,deleted_receiver,userName,image 
        FROM message, user WHERE (sender = '$friend' AND receiver = '$user') AND 
        sender = email AND  
        id >  $currentMsg
        ORDER BY id";

        $data = array();
        $rows = mysqli_query($this->con, $qr);
        if ($rows){
            while ($row = mysqli_fetch_array($rows))
            {
                $data[] = $row;
            }
        }
        //Gui mang cung duoc nhung gui Json sau nay nen tang khac lay du lieu ok hon
        return json_encode($data);
    }
    public function sendMessage($email, $text){
        $userEmail = $_SESSION['userEmail'];
        //generate id
        $rows= mysqli_query($this->con,"SELECT max(id) as MaxId from message");
        $row = $rows->fetch_assoc();
        $newId = $row['MaxId']+1;
        //get time
        date_default_timezone_set("Asia/Bangkok");
        $datetime = date('Y-m-d H:i:s');
        //insert
        $qr = "INSERT INTO message (id,sender,receiver,message,date)
        values ($newId,'$userEmail','$email', '$text', '$datetime')";
        $result = false;
        if (mysqli_query($this->con, $qr)){
            $result = true;
        }
        return ($result);
    }
}
?>