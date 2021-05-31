<?php
    class Group extends DB{
        public function getGroupInfor($userEmail){
            $qr = "SELECT * FROM cchat.group where groupMember LIKE '%$userEmail%'";
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
             $rows= mysqli_query($this->con,"SELECT substring(max(groupId),6,length(groupId)) as MaxId from cchat.group");
             $row = $rows->fetch_assoc();
             $newId ='group'.($row['MaxId']+1);
             $newImg = 'public/image/Group.jpg';
             //set time
             date_default_timezone_set("Asia/Bangkok");
             $datetime = date('Y-m-d H:i:s');
             //insert
             $qr = "INSERT INTO cchat.group (groupId,groupName,groupDate,groupMember,groupImage,userCreate) VALUES ('$newId','$name','$datetime','$userEmail','$newImg','$userEmail')";
             $result = false;
             if (mysqli_query($this->con, $qr)){
                 $result = true;
             }
             return ($result);
        }
        public function addMember($groupId, $memAdd){
            $data = ['status'=>'error','message'=>'Lỗi thêm vào CSDL'];
            if ($groupId=='' || $memAdd=='')
            {
                return $data = ['status'=>'error','message'=>'Group và thành viên rỗng !'];
            }
            $qr = "SELECT * FROM cchat.group where groupId = '$groupId'";
            $rows = mysqli_query($this->con, $qr);
            $memString = '';
                if ($row = mysqli_fetch_array($rows))
                {
                    $memString = $row['groupMember'];
                }
            $memString = $memString.','.$memAdd;
            $qr = "UPDATE cchat.group
            SET groupMember = '$memString'
            WHERE groupId = '$groupId'";
            $rows = mysqli_query($this->con, $qr);
            if ($rows)
            {
                $data = ['status'=>'success','message'=>'Thêm thành viên thành công'];
            }
            return json_encode($data);
        }
    }
?>  