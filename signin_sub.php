<?php

include("classes/users.php");
$signin = new Users();
extract($_POST);

// $signin->signin($email,$password);

if($signin->signin($email,$password)){
    $signin->url("home.php");
}else{
    $signin->url("index.php?run=failed");
}

?>