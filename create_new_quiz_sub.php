<?php
include("classes/users.php");
session_start();
$email=$_SESSION['email'];
$register = new Users();
$register->teacher_profile($email);
$arr = $register->data;
$teacher_id = $arr[0]['id'];
$class_id = $_GET['class_id'];
extract($_POST);
$quiz_name = $_POST['quiz_name'];
// print_r($quiz_name);
// print_r($student_id);
// print_r($teacher_id);
// print_r($class_id);

$query = "INSERT INTO `quizes`(`quiz_name`, `class_id`, `teacher_id`) VALUES ('$quiz_name','$class_id','$teacher_id')";
if($register->new_quiz_creation($query)){
    $register->url("teacher_created_class.php?class_id=$class_id");
}


?>