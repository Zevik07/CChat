<?php
    class Group extends DB{
        public function getGroupInfor(){
            if (isset($_SESSION['userEmail'])){
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
        }
    }
?>  