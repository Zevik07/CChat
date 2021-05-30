<?php
    class Friend extends DB{
        public function getFriendInfor($email){
            $qr = "SELECT * FROM user where email = '$email'";
            $rows = mysqli_query($this->con, $qr);
            // Get friend list email
            $friendEmailList = array();
            if ($row = mysqli_fetch_array($rows))
            {
                $friendEmailList = explode(',',$row['friend']);
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
    

        public function addFriend($email){
            $userEmail = $_SESSION['userEmail'];
            $qr = "SELECT * FROM user where email = '$userEmail'";
            $rows = mysqli_query($this->con, $qr);
            //Loại bỏ email ra khỏi request
            $friendEmailList = array();
            if ($row = mysqli_fetch_array($rows))
            {
                $friendEmailList = explode(',',$row['request']);
                $key = array_search($email, $friendEmailList);
                unset($friendEmailList[$key]);
            }
            // Cập nhật lại request
            $friendEmailString = implode(',',$friendEmailList);
            $qr = "UPDATE cchat.user
            SET request='$friendEmailString'
            WHERE email = '$userEmail'";
            $data = array();
            $rows = mysqli_query($this->con, $qr);
            //Nếu cập nhật thành công
            if ($rows)
            {

                $qr = "SELECT * FROM user where email = '$email'";
                $rows2 = mysqli_query($this->con, $qr);
                if ($row = mysqli_fetch_array($rows2))
                {
                    $data = $row;
                }
            }
            //Lấy danh sách bạn
            $qr = "SELECT friend FROM user where email = '$userEmail'";
            $rows = mysqli_query($this->con, $qr);
            $friendStr = mysqli_fetch_array($rows)['friend'];
            $friendStr = $friendStr.",".$email;
            //Cập nhật lại danh sách bạn
            $qr = "UPDATE cchat.user
            SET friend='$friendStr'
            WHERE email = '$userEmail'";
            $rows = mysqli_query($this->con, $qr);

            return json_encode($data);
        }
    }
?>  