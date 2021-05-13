<?php
include("classes/users.php");
session_start();
$email=$_SESSION['email'];
$class_id = $_GET['class_id'];
$quiz_id = $_GET['quiz_id'];
$register = new Users();
// print_r($class_id);
// print_r($quiz_id);

extract($_POST);
$start_datetime = $_POST['start_time'];
$end_datetime = $_POST['end_time'];
$quizDuration = $_POST['duration'];
$sche_start_datetime = date('Y-m-d h:i:s', strtotime($start_datetime));
$sche_end_datetime = date('Y-m-d h:i:s', strtotime($end_datetime));
$quiz_duration = $quizDuration;
// echo date('d/M/Y h:i:s', $date);
// print_r($sche_start_datetime);
// print_r($sche_end_datetime);
// print_r($quiz_duration);
// $student_id = $_POST['student_id'];
// print_r($_POST);

$query = "UPDATE quizes SET sche_start_datetime = '$sche_start_datetime', sche_end_datetime = '$sche_end_datetime', quiz_duration = '$quiz_duration' WHERE id = '$quiz_id' ";

if($register->schedule_quiz_time($query)){
    $register->url("create_new_quiz.php?class_id=$class_id&quiz_id=$quiz_id");
}

  


?>