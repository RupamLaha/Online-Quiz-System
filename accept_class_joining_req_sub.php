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
// print_r($teacher_id);


$query = "INSERT INTO `class_students`(`class_id`, `student_id`, `teacher_id`) VALUES ('$class_id','$student_id','$teacher_id')";
$query2 = "DELETE FROM `class_joining_req` WHERE class_id = '$class_id' AND student_id = $student_id";

if($register->accept_request($query, $query2)){
    $register->url("teacher_created_class.php?class_id=$class_id#requests");
}

  


?>