<?php
include("classes/users.php");
session_start();
$email=$_SESSION['email'];
$class_id = $_GET['class_id'];
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
$profile->particular_class($class_id);
$profile->particular_class_quizes_for_teachers($class_id);
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
    <div class="alert alert-warning">
    <p><?php echo $profile->cls[0]['info']; ?></p>
    </div>
  <!-- <br> -->
  <!-- Nav tabs -->
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#quizes">Quizes</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#students">Students</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#requests">Requests</a>
    </li>
    <!-- <li class="nav-item ml-auto">
      <a href="teacher_home.php" class="btn btn-danger">Go to Home</a>
    </li> -->
    </ul>


  <!-- Tab panes -->
  <div class="tab-content">
    <div id="quizes" class="container tab-pane active"><br>
      <h3>Quizes 
      <div id="addClass" style="float:right">
      <button type="button" class="btn btn-primary" data-toggle="modal" href="" data-target="#modalAddNewQuiz">Create New Quiz</button>
      </div>
      </h3>


        <!-- .......create new quiz starts...... -->
        <div class="modal fade" id="modalAddNewQuiz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Enter Quiz Name</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="create_new_quiz_sub.php?class_id=<?php echo $class_id; ?>" method="post">
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                Quiz Name
                <input id="quiz_name" class="form-control" name="quiz_name">
                </div>

                <!-- <div class="md-form mb-4">
                Class info
                <input type="password" id="defaultForm-pass" class="form-control validate">
                </div> -->

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-primary">Create Quiz</button>
            </div>
            </form>
            </div>
        </div>
        </div>
        <!-- .......create new quiz ends...... -->


        <br>
        <!-- ........Quiz lists........ -->
        <div class="container">
                
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Quiz Name</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>

            <?php
            foreach($profile->quizes as $quiz){
            ?>

            <tr>
                <td><?php echo $quiz['quiz_name']; ?></td>
                <td><a href="create_new_quiz.php?class_id=<?php echo $class_id; ?>&quiz_id=<?php echo $quiz['id']; ?>" class="btn btn-warning" role="button">Edit</a> 
                <a href="quiz_result_for_teachers.php?class_id=<?php echo $class_id; ?>&quiz_id=<?php echo $quiz['id']; ?>" class="btn btn-success" role="button">See Results</a></td>
                
            </tr>

            <?php } ?>

            </tbody>
        </table>

        </div>
        <!-- ........Quiz lists ends........ -->

    </div>


    <div id="students" class="container tab-pane fade"><br>
      <h3>All Students
      <div id="addClass" style="float:right">
      <button type="button" class="btn btn-primary" data-toggle="modal" href="" data-target="#modalAddStudent">Add New Student</button>
      </div>
      </h3>
      <br>

        <!-- .......Add new Student...... -->
        <div class="modal fade" id="modalAddStudent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Enter Student Id</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="add_new_student_sub.php?class_id=<?php echo $class_id; ?>" method="post">
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                Student Id
                <input id="student_id" class="form-control" name="student_id">
                </div>

                <!-- <div class="md-form mb-4">
                Class info
                <input type="password" id="defaultForm-pass" class="form-control validate">
                </div> -->

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-primary">Add Student</button>
            </div>
            </form>
            </div>
        </div>
        </div>
        <!-- .......End of Add new Student...... -->

      <!-- Student List Starts -->
      <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Remove Student</th>
            </tr>
        </thead>
        <tbody>

        <?php
        foreach($profile->students as $student){
        ?>
            <tr>
                <td><?php echo $student['id']; ?></td>
                <td><?php echo $student['name']; ?></td>
                <td><?php echo $student['email']; ?></td>
                <td><a href="remove_student_from_class_sub.php?class_id=<?php echo $class_id; ?>&student_id=<?php echo $student['id']; ?>" class="btn btn-danger" role="button">Remove</a></td>
            </tr>
        </tbody>
        <?php } ?>
    </table>
    <!-- Student List Starts -->

    </div>
    <!-- <div id="logout" class="container tab-pane fade"><br>
      
    </div> -->


    <div id="requests" class="container tab-pane fade"><br>
      <h3>Requests
      </h3>
      <br>

      <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        <?php
        foreach($profile->req as $student){
        ?>
            <tr>
                <td><?php echo $student['id']; ?></td>
                <td><?php echo $student['name']; ?></td>
                <td><?php echo $student['email']; ?></td>
                <td><a href="accept_class_joining_req_sub.php?class_id=<?php echo $class_id; ?>&student_id=<?php echo $student['id']; ?>" class="btn btn-primary" role="button">Accept</a> 
                <a href="decline_class_joining_req_sub.php?class_id=<?php echo $class_id; ?>&student_id=<?php echo $student['id']; ?>" class="btn btn-danger" role="button">Decline</a></td>
            </tr>
        </tbody>
        <?php } ?>
    </table>
    
    </div>


  </div>
</div>

<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>

