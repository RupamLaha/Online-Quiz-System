<?php
include("classes/users.php");
session_start();
$email=$_SESSION['email'];
$quiz_id = $_GET['quiz_id'];
$register = new Users();
$register->teacher_profile($email);
$arr = $register->data;
$teacher_id = $arr[0]['id'];
$class_id = $_GET['class_id'];
extract($_POST);
print_r($_POST);
$question = $_POST['question'];
$option1 = $_POST['option1'];
$option2 = $_POST['option2'];
$option3 = $_POST['option3'];
$option4 = $_POST['option4'];
$correct_ans_index = $_POST['correctOptionIndex']; 
// print_r($quiz_name);
// print_r($student_id);
// print_r($teacher_id);
// print_r($class_id);

$query = "INSERT INTO `quiz_questions`(`quiz_id`, `class_id`, `teacher_id`, `question`, `option1`, `option2`, `option3`, `option4`, `correct_ans_index`) VALUES ('$quiz_id','$class_id','$teacher_id', '$question', '$option1', '$option2', '$option3', '$option4', '$correct_ans_index')";
if($register->add_new_ques($query)){
    $register->url("create_new_quiz.php?class_id=$class_id&quiz_id=$quiz_id");
}


?>