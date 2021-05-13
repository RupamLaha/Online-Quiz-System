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
$student_id = $_POST['student_id'];
// print_r($_POST);
// echo "<br>";
// print_r($student_id);
// echo "<br>";
// print_r($teacher_id);
// echo "<br>";
// print_r($class_id);

// $query1 = "SELECT * FROM 'class_students'";

$query = "INSERT INTO `class_students`(`class_id`, `student_id`, `teacher_id`) VALUES ('$class_id','$student_id','$teacher_id')";
if($register->add_particular_class_student($query)){
    $register->url("teacher_created_class.php?class_id=$class_id&run=success#students");
}

  


?>