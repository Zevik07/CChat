<?php
class Message extends DB{
    public function getMessage($email){
        $user = $_SESSION['userEmail'];
        $friend = $email;

        //Kiểm tra xem đang cần lấy tin nhắn của nhóm hay cá nhân
        if(strpos($friend,'group') >= 0 && strpos($friend,'@') == false){

            $qr = "SELECT groupId,groupName,groupDate,groupMember,groupImage,sender,id,message,files,message.date,userName,image,msgDeleted FROM cchat.group, cchat.message,cchat.user 
            where receiver = groupId and sender = email and receiver='$friend'
            ORDER BY id";
            $rows = mysqli_query($this->con, $qr);
            $data = array();

            if ($rows){
                while ($row = mysqli_fetch_array($rows))
                {
                    $data[] = $row;
                }
            }
            //Gui mang cung duoc nhung gui Json sau nay nen tang khac lay du lieu ok hon
            return json_encode($data);
        }
        else{
            $qr = "SELECT id,sender,receiver,message,files,message.date,seen,received,deleted_sender,deleted_receiver,userName,image,msgDeleted
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
    }
    public function getMessageCurrent($friend, $currentMsg){
        $user = $_SESSION['userEmail'];
        if(strpos($friend,'group') >= 0 && strpos($friend,'@') == false){
            $qr = "SELECT groupId,groupName,groupDate,groupMember,groupImage,sender,id,message,files,message.date,userName,image,msgDeleted FROM cchat.group, cchat.message,cchat.user 
            where receiver = groupId and sender = email and receiver='$friend' and id > $currentMsg
            ORDER BY id";
            $rows = mysqli_query($this->con, $qr);
            $data = array();

            if ($rows){
                while ($row = mysqli_fetch_array($rows))
                {
                    $data[] = $row;
                }
            }
            //Gui mang cung duoc nhung gui Json sau nay nen tang khac lay du lieu ok hon
            return json_encode($data);
        }
        $currentMsg = (int) $currentMsg;
        $qr = "SELECT id,sender,receiver,message,files,message.date,seen,received,deleted_sender,deleted_receiver,userName,image,msgDeleted
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
    public function sendMessage(){
        //Biến lưu đường dẫn ảnh
        $target_file = '';
        //Nếu có gửi ảnh
        if ($_FILES['message-image']['name'] != NULL && $_FILES['message-image']['name'] != '')
        {
             // Kiểm tra dữ liệu có bị lỗi không
            if ($_FILES["message-image"]['error'] != 0)
            {
                return json_encode(['status'=>'error', 'message'=>'Hình ảnh upload bị lỗi']);
            }
             //Thư mục bạn sẽ lưu file upload
            $target_dir    = "public/image/";
            
            //Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
            $target_file   = $target_dir . basename($_FILES["message-image"]["name"]);

            //Lấy phần mở rộng của file (jpg, png, ...)
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

            // Cỡ lớn nhất được upload (bytes)
            $maxfilesize   = 5242880;

            ////Những loại file được phép upload
            $allowtypes    = array('jpg', 'png', 'jpeg', 'gif','JPG', 'PNG', 'JPEG', 'GIF');

            $allowUpload   = true;
            //Kiểm tra xem có phải là ảnh bằng hàm getimagesize
            $check = getimagesize($_FILES["message-image"]["tmp_name"]);
            if ($check == false)
            {
                //Không phải file ảnh
                $allowUpload = false;
                return json_encode(["status"=>"error","message"=>"File upload không phải là file ảnh !!!"]);
            }
            // Kiểm tra nếu file đã tồn tại 
            if (file_exists($target_file))
            {
                $target_file = $target_dir . "1" . basename($_FILES["message-image"]["name"]);
            }
            // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
            if ($_FILES["message-image"]["size"] > $maxfilesize)
            {
                $allowUpload = false;
                return json_encode(["status"=>"error","message"=>"File bạn upload Vượt quá 5MB !!!"]);
            }
            // Kiểm tra kiểu ảnh
            if (!in_array($imageFileType,$allowtypes))
            {
                $allowUpload = false;
                return json_encode(["status"=>"error","message"=>"File ảnh của bạn không phù hợp, chỉ cho phép 'jpg', 'png', 'jpeg', 'gif' !!!"]);
            }

            if ($allowUpload)
            {
                // Xử lý di chuyển file tạm ra thư mục cần lưu trữ, dùng hàm move_uploaded_file
                if (!move_uploaded_file($_FILES["message-image"]["tmp_name"], $target_file))
                {
                    return json_encode(["status"=>"error","message"=>"Không thể di chuyển ra thư mục cần lưu trữ"]);
                }
            }
        }
        $userEmail = $_SESSION['userEmail'];
        $friendEmail = $_POST['friendEmail'];
        $text = $_POST['message-input'];
        //generate id
        $rows= mysqli_query($this->con,"SELECT max(id) as MaxId from message");
        $row = $rows->fetch_assoc();
        $newId = $row['MaxId']+1;
        //get time
        date_default_timezone_set("Asia/Bangkok");
        $datetime = date('Y-m-d H:i:s');
        //insert
        $qr = "INSERT INTO message (id,sender,receiver,message,files,date)
        values ($newId,'$userEmail','$friendEmail','$text','$target_file','$datetime')";
        $data = array();
        if (mysqli_query($this->con, $qr)){

            $qr = "SELECT id,message,files,message.date,msgDeleted
            FROM message WHERE id = '$newId'";
            $rows = mysqli_query($this->con, $qr);
            $data = array();
            if ($row = mysqli_fetch_array($rows))
            {
                $data = $row;
            }
        }
        return json_encode($data);
    }
    public function deleteMessage($msgid){
        $data = ['status'=>'error','message'=>'Không thể thêm vào CSDL'];
        $qr = "UPDATE cchat.message
            SET msgDeleted = 1
            WHERE id = $msgid";
        $rows = mysqli_query($this->con, $qr);
        if ($rows)
        {
            $data = ['status'=>'success','message'=>'Xóa nhóm thành công'];
        }
        return json_encode($data) ;
    }
}
?>