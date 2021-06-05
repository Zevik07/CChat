<?php
    class Request extends DB{
        public function getRequestInfor($email){
            $qr = "SELECT * FROM user where email = '$email'";
            $rows = mysqli_query($this->con, $qr);
            // Get friend list email
            $friendEmailList = array();
            if ($row = mysqli_fetch_array($rows))
            {
                $friendEmailList = explode(',',$row['request']);
            }
            //Get friend infor
            $data = array();
            foreach ($friendEmailList as $friendEmail){
                $qr =  "SELECT * FROM user where email = '$friendEmail'"; 
                $rows = mysqli_query($this->con, $qr);
                if ($row = mysqli_fetch_array($rows))
                {
                    $data[] = $row;
                }
            }
            return json_encode($data);
        }
        //Gửi lời mời kết bạn
        public function sendRequest($email){
            //Mảng trả về
            $data = array();
            $userEmail = $_SESSION['userEmail'];
            //Lấy email người được request
            $qr = "SELECT * FROM user where email = '$email'";
            $rows = mysqli_query($this->con, $qr);
            if (mysqli_num_rows($rows) < 1 ){
                return json_encode(["status"=>"error","message"=>"Email không tồn tại"]);
            }
            // Get request list email
            $requestEmailString = '';
            $friendEmailString = '';
            if ($row = mysqli_fetch_array($rows))
            {
                $requestEmailString = $row['request'];
                $friendEmailString = $row['friend'];
                if(strpos($requestEmailString,$userEmail) !== false){
                    return json_encode(["status"=>"error","message"=>"Bạn đã gửi lời mời rồi !"]);
                }
                if(strpos($friendEmailString,$userEmail) !== false){
                    return json_encode(["status"=>"error","message"=>"Hai bạn đã là bạn bè !"]);
                }
            }

            //Kiểm tra xem nó gửi lời mời cho mình chưa
            $qr2 = "SELECT request FROM user where email = '$userEmail'";
            $rows2 = mysqli_query($this->con, $qr2);
            if ($row2 = mysqli_fetch_array($rows2))
            {
                $requestString = $row2['request'];
                if (strpos($requestString, $email) !== false)
                {
                    return json_encode(["status"=>"error","message"=>"Người này đã gửi lời mời cho bạn"]);
                }
            }
            //Cập nhật lại request
            if ($requestEmailString == '' || $requestEmailString == null){
                $requestEmailString = $userEmail;
            }
            else {
                $requestEmailString = $requestEmailString.",".$userEmail;
            }
            $qr = "UPDATE user
            SET request = '$requestEmailString'
            WHERE email = '$email'";
            // Nếu cập nhật thành công
            if (mysqli_query($this->con, $qr))
            {
                $data = ["status"=>"success","message"=>"Gửi lời mời thành công"];
            }
            return json_encode($data);
        }
    }
?>  