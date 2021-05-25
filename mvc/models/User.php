<?php
    class User extends DB{
        public function getUserName($email){
            $qr = "SELECT name FROM user where email = '$email'";
            $rows = mysqli_query($this->con, $qr);
            if ($row = $rows->fetch_assoc()) 
               return $row['name'];
            return 'Cannot find name';
        }
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
        public function insertNewUser($name, $email, $password){
            //check valid user
            if ($this->checkValidUser($email)) return false;
            //new user id
            $rows= mysqli_query($this->con,"SELECT substring(max(userId),5,length(userId)) as MaxId from user");
            $row = $rows->fetch_assoc();
            $newId ='user'.($row['MaxId']+1);
            //insert
            $qr = "INSERT INTO user (userId,name,email,password) VALUES ('$newId','$name','$email','$password')";
            $result = false;
            if (mysqli_query($this->con, $qr)){
                $result = true;
            }
            return ($result);
        }
    }
?>  