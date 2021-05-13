<?php
include("classes/users.php");
session_start();
$email=$_SESSION['email'];
$register = new Users();
$register->teacher_profile($email);
$arr = $register->data;
$teacher_id = $arr[0]['id'];
extract($_POST);
$name = $_POST['class_name'];
$info = $_POST['class_info'];
// print_r($_POST);
// print_r($teacher_id);
// print_r($name);
// print_r($info);


$query = "INSERT INTO `classes`(`name`, `info`, `teacher_id`) VALUES ('$name','$info','$teacher_id')";
if($register->creating_new_class($query)){
    $register->url("teacher_home.php");
}


?>