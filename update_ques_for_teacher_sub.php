<?php
include("classes/users.php");
session_start();
$email=$_SESSION['email'];
$register = new Users();

$question_id = $_GET['ques_id'];
echo $question_id;
echo "<br>";
$class_id = $_GET['class_id'];
echo $class_id;
echo "<br>";
$quiz_id = $_GET['quiz_id'];
echo $quiz_id;
echo "<br>";

print_r($_POST);
$ques = $_POST['question'];
$option1 = $_POST['option1'];
$option2 = $_POST['option2'];
$option3 = $_POST['option3'];
$option4 = $_POST['option4'];
$correctOptionIndex = $_POST['correctOptionIndex'];


if($register->update_question($question_id,$ques,$option1,$option2,$option3,$option4,$correctOptionIndex)){
    $register->url("create_new_quiz.php?class_id=$class_id&quiz_id=$quiz_id&run=success");
}else{
    $register->url("create_new_quiz.php?class_id=$class_id&quiz_id=$quiz_id&run=failed");
}


// $query = "INSERT INTO `quizes`(`quiz_name`, `class_id`, `teacher_id`) VALUES ('$quiz_name','$class_id','$teacher_id')";
// if($register->new_quiz_creation($query)){
//     $register->url("teacher_created_class.php?class_id=$class_id");
// }


?>