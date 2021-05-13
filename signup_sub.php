<?php
include("classes/users.php");
$register = new Users();
extract($_POST);

$query = "INSERT INTO `signup`(`name`, `email`, `pass`) VALUES ('$name','$email','$password')";
if($register->signup($query)){
    $register->url("signup.php?run=success");
}

  


?>