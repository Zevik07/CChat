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
            $newId = $row['MaxId']+1;
            $imgDefault = $gender == 'Male' ? 'public/image/male.jpg' : 'public/image/female.jpg';
            //set time
            date_default_timezone_set("Asia/Bangkok");
            $datetime = date('Y-m-d H:i:s');
            //insert
            $qr = "INSERT INTO user (userId,userName,email,gender,password,date,image) VALUES ('$newId','User name','$email','$gender','$password','$datetime','$imgDefault')";
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
                $data = $row;
            }
            //Gui mang cung duoc nhung gui Json sau nay nen tang khac lay du lieu ok hon
            return json_encode($data);
        }
        public function updateUser(){
            //Biến lưu đường dẫn ảnh
            $target_file = '';
            //Nếu có gửi ảnh
            if ($_FILES['setting-image']['name'] != NULL && $_FILES['setting-image']['name'] != '')
            {
                // Kiểm tra dữ liệu có bị lỗi không
                if ($_FILES["setting-image"]['error'] != 0)
                {
                    return json_encode(['status'=>'error', 'message'=>'Hình ảnh upload bị lỗi']);
                }
                //Thư mục bạn sẽ lưu file upload
                $target_dir    = "public/image/";
                
                //Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
                $target_file   = $target_dir . basename($_FILES["setting-image"]["name"]);

                //Lấy phần mở rộng của file (jpg, png, ...)
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                // Cỡ lớn nhất được upload (bytes)
                $maxfilesize   = 5242880;

                ////Những loại file được phép upload
                $allowtypes    = array('jpg', 'png', 'jpeg', 'gif','JPG', 'PNG', 'JPEG', 'GIF');

                $allowUpload   = true;
                //Kiểm tra xem có phải là ảnh bằng hàm getimagesize
                $check = getimagesize($_FILES["setting-image"]["tmp_name"]);
                if ($check == false)
                {
                    //Không phải file ảnh
                    $allowUpload = false;
                    return json_encode(["status"=>"error","message"=>"File upload không phải là file ảnh !!!"]);
                }
                // Kiểm tra nếu file đã tồn tại 
                if (file_exists($target_file))
                {
                    $target_file = $target_file . "-1";
                }
                // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
                if ($_FILES["setting-image"]["size"] > $maxfilesize)
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
                    if (!move_uploaded_file($_FILES["setting-image"]["tmp_name"], $target_file))
                    {
                        return json_encode(["status"=>"error","message"=>"Không thể di chuyển ra thư mục cần lưu trữ"]);
                    }
                }
            }

            $userEmail = $_SESSION['userEmail'];
            $name = $_POST['setting-name'];
            $gender =  $_POST['gender'];
            $pass = $_POST['setting-pass'];
            $qr = "UPDATE user SET userName = '$name',gender = '$gender'";
            if ($pass != '')
            {
                $qr = $qr." ,password = "."'$pass'";
            }
            if ($target_file != ''){
                $qr = $qr." ,image = "."'$target_file'";
            }

            $qr = $qr." WHERE email='$userEmail'";
            $rows = mysqli_query($this->con, $qr);
            $data = array (['status'=>'error','message'=>'Cập nhật không thành công, lỗi update CSDL']);
            if ($rows)
            {
                $data = ['status'=>'success','message'=>'Cập nhật thành công'];
            }
            return json_encode($data) ;
            }
        
    }
?>  