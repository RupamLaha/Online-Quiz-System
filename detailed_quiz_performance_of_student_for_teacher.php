<?php  

include("classes/users.php");
$email=$_SESSION['email'];

$class_id = $_GET['class_id'];
$quiz_id = $_GET['quiz_id'];
$student_id = $_GET['student_id'];

$profile = new Users();
$profile->fetch_quiz_name($quiz_id);
$profile->particular_quiz_all_details($quiz_id);
$profile->particular_class($class_id);
// $profile->users_profile($email);
// $student_name = $profile->data[0]['name'];

// echo $quiz_id . "<br>" . $student_id . "<br>";

$res = $profile->fetch_result($quiz_id, $student_id);

// print_r($profile->res[0]['COUNT(marks_for_this_ques)']);
// print_r($profile->res);
// print_r($res);




?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Online Quiz System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link type="text/css" rel="stylesheet" href="style_answer.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<!-- .......NavBar.......... -->

<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
            <a class="navbar-brand" href="#">Online Quiz</a>
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

    <div class="panel panel-primary">
      <div class="panel-heading"><h3><center>Result</center></h3></div>
      <div class="panel-body" id="tablePanelBody">
      
      <table class="table">
        <tbody>     
            <tr class="table-success">
                <td>Correct Answers</td>
                <td><?php echo $res[0];?></td>
            </tr>
            <tr class="table-danger">
                <td>Wrong Answers</td>
                <td><?php echo $res[1];?></td>
            </tr>
            <tr class="table-warning">
                <td>Not attempted</td>
                <td><?php echo $res[2];?></td>
            </tr>
            <tr class="table-info">
                <td>Total Score</td>
                <td><?php echo $res[0]."/".($res[0] + $res[1] + $res[2]);?></td>
            </tr>
        </tbody>
      </table>

      </div>
    </div>
    
    
    
    
    <?php
    if(($profile->quiz_ques)==null){
      echo "No Questions.";
    }else{
      // print_r($questions->questions);
    }
    $i=1;
    foreach($profile->quiz_ques as $que){
    ?>
    <div class="panel panel-info">
      <div class="panel-heading"><strong><?php echo $i.'.'; ?>&nbsp;&nbsp;<?php echo $que['question']?></strong></div>
      <div class="panel-body"><br>
      <ol>
        <li><?php echo $que['option1']?></li><br>
        <li><?php echo $que['option2']?></li><br>
        <li><?php echo $que['option3']?></li><br>
        <li><?php echo $que['option4']?></li><br>
      </ol>
      <strong style='color:green'> Correct Option Index : <?php echo "<strong style='color:green'>" . $que['correct_ans_index'] . "</strong>" ?> </strong><br>
      
      <?php if($profile->fetch_particular_ques_student_ans($quiz_id, $student_id, $que['id'])==0){
        echo "<strong style='color:red'> Not Attempted </strong>";
      }else{
        if ($profile->fetch_particular_ques_student_ans($quiz_id, $student_id, $que['id']) == $que['correct_ans_index']){
          echo "<strong style='color:green'> Your Answer : " . $profile->fetch_particular_ques_student_ans($quiz_id, $student_id, $que['id']) . "</strong>" ;
        }else{
          echo "<strong style='color:red'> Student's Answer : " . $profile->fetch_particular_ques_student_ans($quiz_id, $student_id, $que['id']) . "</strong>" ;
        }
      } ; ?>
      </div>
    </div>
    <br>
    <?php $i++;} ?>





</div>

</body>
</html>
