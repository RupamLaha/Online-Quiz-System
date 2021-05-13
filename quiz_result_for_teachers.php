<?php
include("classes/users.php");
session_start();
$email=$_SESSION['email'];
$class_id = $_GET['class_id'];
$quiz_id = $_GET['quiz_id'];
// echo "<br><br><br><br><h1>" . $class_id . "</h1><br>" ;
if(isset($email)==true){

}else{
  header("Location: index.php");
}
$profile = new Users();
// $profile->users_profile($email);
// print_r($profile->data);
// $profile->categories();
// print_r($profile->cat);
$profile->fetch_quiz_name($quiz_id);
$profile->particular_class($class_id);
$profile->particular_class_quizes($class_id);
$profile->particular_class_students($class_id);
$profile->fetch_class_joining_req($class_id);
// echo "<h1>" . $profile->req[0]['id'] . "</h1>" ;
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
            <a href="teacher_home.php" class="btn btn-info" role="button">Home</a>
            <a href="logout.php" class="btn btn-danger" role="button">Logout</a>
            </div>
        </div>
        </nav>
    <!-- .......NavBar.......... -->


<div class="container-fluid" style="margin-top:70px">

    <!-- <br> -->
    <div class="alert alert-primary">
    <strong><h3><?php echo $profile->cls[0]['name']; ?>
    <div id="addClass" style="float:right">
      <h4>Class Code - <?php echo $profile->cls[0]['id']; ?></h4>
    </div>
    </h3>
    </strong>
    </div>

    <h2><?php echo $profile->quiz[0]['quiz_name']; ?></h2>
    
    <br>
    
    <h3>Students Scores</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Right Answer</th>
                <th>Wrong Answer</th>
                <th>Not Answered</th>
                <th>Total Score</th>
                <th>Detailed</th>
            </tr>
        </thead>
        <tbody>

        <?php
        foreach($profile->students as $student){
            $arr = $profile->fetch_result($quiz_id, $student['id']);
        ?>
            <tr>
                <td><?php echo $student['id']; ?></td>
                <td><?php echo $student['name']; ?></td>
                <td><?php echo $student['email']; ?></td>
                <td><?php echo $arr[0]; ?></td>
                <td><?php echo $arr[1]; ?></td>
                <td><?php echo $arr[2]; ?></td>
                <?php if(($arr[0] + $arr[1] + $arr[2])!=0){  ?>
                <td><?php echo $arr[0]."/".($arr[0] + $arr[1] + $arr[2]); ?></td>
                <td><a href="detailed_quiz_performance_of_student_for_teacher.php?class_id=<?php echo $class_id ; ?>&quiz_id=<?php echo $quiz_id ; ?>&student_id=<?php echo $student['id'] ; ?>" class="btn btn-info" role="button">Enter</a></td>
                <?php }else{ ?>
                    <td style="color:red">Not attempted</td>
                    <td style="color:red">Not attempted</td>
                <?php } ?>
                <?php /*
                <td><a href="detailed_quiz_performance_of_student_for_teacher.php?class_id=<?php echo $class_id ; ?>&quiz_id=<?php echo $quiz_id ; ?>&student_id=<?php echo $student['id'] ; ?>" class="btn btn-info" role="button">Enter</a></td>
                */ ?>
            </tr>
        </tbody>
        <?php } ?>
    </table>






</div>

<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>