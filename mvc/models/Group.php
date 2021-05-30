<?php
    class Group extends DB{
        public function getGroupInfor(){
            $userCurrent = $_SESSION['userEmail'];
            $qr = "SELECT * FROM group where member LIKE '%$userCurrent%'";
            $rows = mysqli_query($this->con, $qr);
            $data = array();
            if ($rows){
                while ($row = mysqli_fetch_array($rows))
                {
                    $data[] = $row;
                }
            }
            // //Gui mang cung duoc nhung gui Json sau nay nen tang khac lay du lieu ok hon
            return json_encode($data);
        }
        public function createGroup($name){
            $userEmail = $_SESSION['userEmail'];
             //generete id
             $rows= mysqli_query($this->con,"SELECT substring(max(groupId),6,length(groupId)) as MaxId from group");
             $row = $rows->fetch_assoc();
             $newId ='group'.($row['MaxId']+1);
             $newImg = 'public/image/Group.jpg';
             //set time
             date_default_timezone_set("Asia/Bangkok");
             $datetime = date('Y-m-d H:i:s');
             //insert
             $qr = "INSERT INTO group (groupId,name,date,member,image) VALUES ('$newId','$name','$email','$datetime','$userEmail','$newImg')";
             $result = false;
             if (mysqli_query($this->con, $qr)){
                 $result = true;
             }
             return ($result);
        }
    }
?>  