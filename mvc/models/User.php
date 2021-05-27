<?php
    class User extends DB{
        public function checkValidUser($email, $pass = false ){
            $qr = "SELECT * FROM user where email = '$email'";
            $result = false;
            if ($pass == false)
            {
                $rows = mysqli_query($this->con, $qr);
                if ($rows->fetch_assoc() > 0) $result = true;
            }
            else {
                $rows = mysqli_query($this->con, $qr." and password = '$pass'");
                if ($rows->fetch_assoc() > 0) $result = true;
            }
            return $result;
        }
        public function getUserName($email){
            $qr = "SELECT name FROM user where email = '$email'";
            $rows = mysqli_query($this->con, $qr);
            if ($row = $rows->fetch_assoc()) 
               return $row['name'];
            return 'Cannot find name';
        }
        public function insertUser($email, $password, $gender){
            //generate id
            $rows= mysqli_query($this->con,"SELECT max(userId) as MaxId from user");
            $row = $rows->fetch_assoc();
            $newId =$row['MaxId']+1;
            //set time
            date_default_timezone_set("Asia/Bangkok");
            $datetime = date('Y-m-d H:i:s');
            //insert
            $qr = "INSERT INTO user (userId,userName,email,gender,password,date) VALUES ('$newId','User name','$email','$gender','$password','$datetime')";
            $result = false;
            if (mysqli_query($this->con, $qr)){
                $result = true;
            }
            return ($result);
        }
        public function getUserInfor($email){
            $qr = "SELECT * FROM user where email = '$email'";
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