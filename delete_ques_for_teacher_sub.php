<?php
include("classes/users.php");
session_start();
$email=$_SESSION['email'];
$register = new Users();

$question_id = $_GET['ques_id'];
echo $question_id;
$class_id = $_GET['class_id'];
$quiz_id = $_GET['quiz_id'];


if($register->delete_question($question_id)){
    $register->url("create_new_quiz.php?class_id=$class_id&quiz_id=$quiz_id&run=success");
}else{
    $register->url("create_new_quiz.php?class_id=$class_id&quiz_id=$quiz_id&run=failed");
}


// $query = "INSERT INTO `quizes`(`quiz_name`, `class_id`, `teacher_id`) VALUES ('$quiz_name','$class_id','$teacher_id')";
// if($register->new_quiz_creation($query)){
//     $register->url("teacher_created_class.php?class_id=$class_id");
// }


?>