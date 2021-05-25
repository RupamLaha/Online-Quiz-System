<?php
include("classes/users.php");
session_start();
$email=$_SESSION['email'];
$register = new Users();


$class_id = $_GET['class_id'];
$student_id = $_GET['student_id'];
print_r($student_id);

if($register->delete_student($class_id, $student_id)){
    $register->url("teacher_created_class.php?class_id=$class_id#students");
}else{
    $register->url("teacher_created_class.php?class_id=$class_id&run=failed#students");
}


// $query = "INSERT INTO `quizes`(`quiz_name`, `class_id`, `teacher_id`) VALUES ('$quiz_name','$class_id','$teacher_id')";
// if($register->new_quiz_creation($query)){
//     $register->url("teacher_created_class.php?class_id=$class_id");
// }


?>