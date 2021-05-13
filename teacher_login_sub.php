<?php

include("classes/users.php");
$signin = new Users();
extract($_POST);

// $signin->signin($email,$password);

if($signin->teacher_signin($email,$password)){
    $signin->url("teacher_home.php");
}else{
    $signin->url("teacher_login.php?run=failed");
}

?>