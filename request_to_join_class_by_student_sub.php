<?php
include("classes/users.php");
session_start();
$email=$_SESSION['email'];
$register = new Users();

extract($_POST);
print_r($_POST);

$class_id = $_POST['class_id'];
$student_id = $_GET['student_id'];
print_r($student_id);

$var = $register->check_student_in_the_class($class_id,$student_id);
echo $var;

$var1 = $register->check_if_student_already_sent_request($class_id,$student_id);
echo $var1;

if($var == "not_present"){
    if($var1 == "request_not_pending"){
        if($register->send_req_to_join_class($class_id,$student_id)){
            $k = "success";
            $register->url("home.php?oper=$k");
        }else{
            $j = "sending_failed";
            $register->url("home.php?oper=$j");
        }
    }else{
        $i = "request_pending";
        $register->url("home.php?oper=$i");
    }
}else{
    $o = "already_present";
    $register->url("home.php?oper=$o");
}



// $query = "INSERT INTO `quizes`(`quiz_name`, `class_id`, `teacher_id`) VALUES ('$quiz_name','$class_id','$teacher_id')";
// if($register->new_quiz_creation($query)){
//     $register->url("teacher_created_class.php?class_id=$class_id");
// }


?>