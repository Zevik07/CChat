<?php 

session_start();
//Nhan tat ca du lieu tu request cua client
$DATA_RAW = file_get_contents("php://input");
//Decode thanh JSON
$DATA_OBJ = json_decode($DATA_RAW);

if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "signup")
{
	//signup
	include("Authensignup.php");
}
// $info = (object)[];

// if(!isset($_SESSION['userid']))
// {
// 	//Neu du lieu decode trường data_type không phải là login hoặc signup thì out
// 	if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type != "login" && $DATA_OBJ->data_type != "signup")
// 	{
// 		$info->logged_in = false;
// 		echo json_encode($info);
// 		die;	
// 	}
	
// }
// //Load các hàm cần thiết và tạo mới DB
// require_once("classes/autoload.php");
// $DB = new Database();

// $Error = "";

// //proccess the data
// if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "signup")
// {
// 	//signup
// 	include("includes/signup.php");

// }elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "login")
// {
// 	//login
// 	include("includes/login.php");

// }elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "logout")
// {
// 	include("includes/logout.php");
// }elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "user_info")
// {

// 	//user info
// 	include("includes/user_info.php");
// }elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "contacts")
// {
// 	//user info
// 	include("includes/contacts.php");
// }elseif(isset($DATA_OBJ->data_type) && ($DATA_OBJ->data_type == "chats" || $DATA_OBJ->data_type == "chats_refresh"))
// {
// 	//user info
// 	include("includes/chats.php");
// }elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "settings")
// {
// 	//user info
// 	include("includes/settings.php");
// }elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "save_settings")
// {
// 	//user info
// 	include("includes/save_settings.php");
// }elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "send_message")
// {
// 	 //send message
// 	include("includes/send_message.php");
// }elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "delete_message")
// {
// 	 //send message
// 	include("includes/delete_message.php");
// }elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "delete_thread")
// {
// 	 //send message
// 	include("includes/delete_thread.php");
// }
