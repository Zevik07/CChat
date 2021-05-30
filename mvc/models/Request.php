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
    }
?>  