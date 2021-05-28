<?php
class Message extends DB{
    public function getMessage($email){
        $user = $_SESSION['userEmail'];
        $friend = $email;
        $qr = "SELECT * FROM message WHERE sender = '$user' && receiver = '$friend' || receiver = '$user' && sender = '$friend'";
        $rows = mysqli_query($this->con, $qr);
        $data = array();
       
        if ($row = mysqli_fetch_array($rows))
        {
            $data[] = $row;
        }
        //Gui mang cung duoc nhung gui Json sau nay nen tang khac lay du lieu ok hon
        return json_encode($data);
    }

}
?>