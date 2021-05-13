<?php
include("classes/users.php");
$email=$_SESSION['email'];
if(isset($email)==true){

}else{
  header("Location: index.php");
}

$class_id = $_GET['class_id'];
$quiz_id = $_GET['quiz_id'];

$profile = new Users();
$profile->particular_class($class_id);
$profile->users_profile($email);
$student_id = $profile->data[0]['id'];

$profile->fetch_quiz_name($quiz_id);
$start_time = $profile->quiz[0]['sche_start_datetime'];
$end_time = $profile->quiz[0]['sche_end_datetime'];

// $profile->users_profile($email);
// // print_r($profile->data);
// $student_id = $profile->data[0]['id'];
// $profile->categories();
// // print_r($profile->cat);
// $profile->all_classes($student_id);
// echo "<br><br><br><br>";
// print_r($profile->all_cls[0]); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Online Quiz Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>


<!-- .......NavBar.......... -->

<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
            <a class="navbar-brand" href="#">Online Quiz</a> <strong style="color:white"> (<?php echo $email; ?>) </strong>
            </div>
            <div class="navbar-footer">
            <a href="home.php" class="btn btn-info" role="button">Home</a>
            <a href="logout.php" class="btn btn-danger" role="button">Logout</a>
            </div>
        </div>
        </nav>
    <!-- .......NavBar.......... -->


<div class="container-fluid" style="margin-top:70px">

    <div class="alert alert-primary">
    <strong><h3><?php echo $profile->cls[0]['name']; ?>
    <div id="addClass" style="float:right">
      <h4>Class Code - <?php echo $profile->cls[0]['id']; ?></h4>
    </div>
    </h3>
    </strong>
    </div>

    <?php echo "<h2>" . $profile->quiz[0]['quiz_name'] . "</h2>"; ?> 

    <br>

    <?php echo "<h5> Start Time : " . $start_time . "</h5>"; ?>
    <?php echo "<h5> End Time : " . $end_time . "</h5>"; ?>
    <?php echo "<h5> Quiz Duration : " . $profile->quiz[0]['quiz_duration'] . " min</h5>"; ?> 

    <br>

    <?php
    if (strtotime($start_time) < time() && strtotime($end_time) > time() && $profile->check_quiz_attemption($quiz_id, $student_id)==false) {
        //echo '<a href="enter_student_particular_quiz.php?class_id="' . $class_id . '&quiz_id=' . $quiz["id"] . ' class="btn btn-success" role="button">Attempt</a>';
        echo '<button id="btn_link" class="btn btn-primary"> <a href="ques_show.php?class_id=' . $class_id . '&quiz_id='. $quiz_id .'&student_id=' . $student_id . '" style="color:white"> Attempt </a> </button>';
    }elseif(strtotime($end_time) < time() && $profile->check_quiz_attemption($quiz_id, $student_id)==false){
      echo "<strong style='color:red'>Quiz has ended </strong> <br> <strong style='color:red'>You have not attempted </strong> ";
    }
    else{
      echo "<strong style='color:red'>Quiz has ended <br>";
    }
    ?>

    <?php 
    if($profile->check_quiz_attemption($quiz_id, $student_id)==true){
      echo '<button id="btn_link" class="btn btn-success"> <a href="result.php?class_id=' . $class_id . '&quiz_id=' . $quiz_id . '&student_id=' . $student_id . '" style="color:white"> See Your Score </a> </button>';
    }
    ?>



    <?php /*
    <a href="enter_student_particular_quiz.php?class_id=<?php echo $class_id; ?>&quiz_id=<?php echo $quiz['id']; ?>" class="btn btn-success" role="button">Attempt</a>
    */ ?>



</div>

</body>
</html>