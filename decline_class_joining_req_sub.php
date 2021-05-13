<?php
include("classes/users.php");
session_start();
$email=$_SESSION['email'];
$class_id = $_GET['class_id'];
$student_id = $_GET['student_id'];
$register = new Users();
$register->teacher_profile($email);
$teacher_id = $register->data[0]['id'];
// print_r($register->data[0]['id']);
// print_r($class_id);
// print_r($student_id);

$query = "DELETE FROM `class_joining_req` WHERE class_id = '$class_id' AND student_id = $student_id";

if($register->decline_request($query)){
    $register->url("teacher_created_class.php?class_id=$class_id#requests");
}

  


?>