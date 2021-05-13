<?php
include("classes/users.php");
$register = new Users();
extract($_POST);

$query = "INSERT INTO `teacher_signup`(`name`, `pass`, `email`) VALUES ('$name','$password','$email')";
if($register->signup($query)){
    $register->url("teacher_signup.php?run=success");
}

// print_r($_POST);


?>