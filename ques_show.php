<?php
include("classes/users.php");
$email=$_SESSION['email'];
if(isset($email)==true){

}else{
  header("Location: index.php");
}

$class_id = $_GET['class_id'];
$student_id = $_GET['student_id'];

$quiz_id = $_GET['quiz_id'];
// echo "<h1>" . $quiz_id . "</h1>";
$questions = new Users();
$questions->particular_quiz_all_details($quiz_id);
$questions->fetch_quiz_name($quiz_id);
$quiz_duration = $questions->quiz[0]['quiz_duration'];
// $questions->users_profile($email);
// echo $_POST['cat'];
// $cat=$_POST['cat'];
if($questions->check_quiz_attemption($quiz_id, $student_id)==true){
  $questions->url("enter_student_particular_quiz.php?class_id=$class_id&quiz_id=$quiz_id");
}
// enter_student_particular_quiz.php?class_id=1&quiz_id=1

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Questions</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    function timeOut(){
      var minute = checkTime(Math.floor(timeLeft/60));
      var second = checkTime(timeLeft%60);
      if(timeLeft<=0){
        clearTimeout(tm);
        // document.getElementById("form1").submit();
        document.getElementById("clickMe").click();
      }
      else{
        document.getElementById("time").innerHTML=minute + ":" + second;
      }
      timeLeft--;
      var tm = setTimeout(function(){timeOut()},1000);
    }
    
    function checkTime(msg){
      if(msg<10){
        msg = "0"+msg;
      }
      return msg;
    }
    </script>
</head>
<body onload="timeOut()">

<!-- .......NavBar.......... -->

<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
            <a class="navbar-brand" href="#">Online Quiz</a> <strong style="color:white"> (<?php echo $email; ?>) </strong>
            </div>
        </div>
        </nav>
    <!-- .......NavBar.......... -->
 
<div class="container" style="margin-top:70px">
  <h2>Choose the right answer 
  
  <script type="text/javascript">
  var timeLeft = <?php echo $quiz_duration; ?> * 60;

  </script>

  <div id="time" style="float:right">time</div></h2>
  <form action="answer_sub.php?class_id=<?php echo $class_id ;?>&quiz_id=<?php echo $quiz_id ;?>" method="post" id="form1">
  <div class="panel-group">
    <?php
    if(($questions->quiz_ques)==null){
      echo "No Questions.";
    }else{
      // print_r($questions->questions);
    }
    $i=1;
    foreach($questions->quiz_ques as $que){
    ?>
    <div class="panel panel-info">
      <div class="panel-heading"><strong><?php echo $i.'.'; ?>&nbsp;&nbsp;<?php echo $que['question']?></strong></div>
      <div class="panel-body"><br>
      <ul style="list-style-type:none">
        <li><input type="radio" value="1" name="<?php echo $que['id']; ?>"/>&nbsp;&nbsp;<?php echo $que['option1']?></li><br>
        <li><input type="radio" value="2" name="<?php echo $que['id']; ?>"/>&nbsp;&nbsp;<?php echo $que['option2']?></li><br>
        <li><input type="radio" value="3" name="<?php echo $que['id']; ?>"/>&nbsp;&nbsp;<?php echo $que['option3']?></li><br>
        <li><input type="radio" value="4" name="<?php echo $que['id']; ?>"/>&nbsp;&nbsp;<?php echo $que['option4']?></li>
        <li><input type="radio" style="display:none;" value="0" name="<?php echo $que['id']; ?>" checked/></li>
      </ul>
      </div>
    </div>
    <br>
    <?php $i++;} ?>
    <?php
    if(($questions->quiz_ques)==null){
      // echo "No Questions.";
    }else{
      // print_r($questions->questions);
      ?><center><input id="clickMe" type="submit" value="Submit Quiz" class="btn btn-success"></center>
    <?php
    }
    ?>
    <!-- <center><input type="submit" value="Submit Quiz" class="btn btn-success"></center> -->
  </div>
  </form>
</div>

</body>
</html>

