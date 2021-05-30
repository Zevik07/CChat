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
    
        //Chấp nhận yêu cầu kết bạn
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
            $rows = mysqli_query($this->con, $qr);
            // //Nếu cập nhật thành công
            // if ($rows)
            // {

            //     $qr = "SELECT * FROM user where email = '$email'";
            //     $rows2 = mysqli_query($this->con, $qr);
            //     if ($row = mysqli_fetch_array($rows2))
            //     {
            //         $data = $row;
            //     }
            // }


            //Lấy danh sách bạn
            $qr = "SELECT friend FROM user where email = '$userEmail'";
            $rows = mysqli_query($this->con, $qr);
            $row = mysqli_fetch_array($rows);
            $friendStr = $row['friend'];
            if ($friendStr == '' || $friendStr == null){
                $friendStr = $email;
            }
            else {
                $friendStr = $friendStr.",".$email;
            }
            //Cập nhật lại danh sách bạn
            $qr = "UPDATE cchat.user
            SET friend = '$friendStr'
            WHERE email = '$userEmail'";
            $rows = mysqli_query($this->con, $qr);


            //Cập nhật lại danh sách bạn của thằng gửi request
                //Lấy danh sách bạn
                $qr = "SELECT friend FROM user where email = '$email'";
                $rows = mysqli_query($this->con, $qr);
                $row = mysqli_fetch_array($rows);
                $friendStr = $row['friend'];
                if ($friendStr == '' || $friendStr == null){
                    $friendStr = $userEmail;
                }
                else {
                    $friendStr = $friendStr.",".$userEmail;
                }
                //Cập nhật lại danh sách bạn
                $qr = "UPDATE cchat.user
                SET friend = '$friendStr'
                WHERE email = '$email'";
                $rows = mysqli_query($this->con, $qr);

            return json_encode(['status'=>'success','message'=>'Đã chấp nhận lời mời kết bạn']);
        }


        //Hủy bạn hoặc yêu cầu
        public function removeFriendRequest($email, $type){

            $userEmail = $_SESSION['userEmail'];
            $qr = "SELECT * FROM user where email = '$userEmail'";
            $rows = mysqli_query($this->con, $qr);
            

            //Nếu là xóa bạn
            $data = array();
            if ($type == 'friend')
            {
                $friendEmailList = array();
                if ($row = mysqli_fetch_array($rows))
                {
                    $friendEmailList = explode(',',$row['friend']);
                    $key = array_search($email, $friendEmailList);
                    unset($friendEmailList[$key]);
                }

                //Cập nhập lại friend
                $friendEmailString = implode(',',$friendEmailList);
                $qr = "UPDATE cchat.user
                SET friend = '$friendEmailString'
                WHERE email = '$userEmail'";
                $rows = mysqli_query($this->con, $qr);

                //Cập nhật friend cho người bị xóa
                    $qr2 = "SELECT * FROM user where email = '$email'";
                    $rows2 = mysqli_query($this->con, $qr2);
                    $friendEmailList2 = array();
                    if ($row2 = mysqli_fetch_array($rows2))
                    {
                        $friendEmailList2 = explode(',',$row2['friend']);
                        $key = array_search($userEmail, $friendEmailList2);
                        unset($friendEmailList2[$key]);
                    }

                    //Cập nhập lại friend
                    $friendEmailString2 = implode(',',$friendEmailList2);
                    $qr3 = "UPDATE cchat.user
                    SET friend = '$friendEmailString2'
                    WHERE email = '$email'";
                    $rows3 = mysqli_query($this->con, $qr3);

                $data = ['status'=>'success','message'=>'Xóa bạn thành công'];

            }
            elseif($type == 'request'){
                $requestEmailList = array();
                if ($row = mysqli_fetch_array($rows))
                {
                    $requestEmailList = explode(',',$row['request']);
                    $key = array_search($email, $requestEmailList);
                    unset($requestEmailList[$key]);
                }

                //Cập nhập lại request
                $requestEmailString = implode(',',$requestEmailList);
                $qr = "UPDATE cchat.user
                SET request='$requestEmailString'
                WHERE email = '$userEmail'";
                $data = array();
                $rows = mysqli_query($this->con, $qr);
                if ($rows)
                {
                    $data = ['status'=>'success','message'=>'Xóa yêu cầu thành công'];
                }
            }
            return json_encode($data);
        }
    }
?>  