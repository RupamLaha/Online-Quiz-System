<?php
include("classes/users.php");
session_start();
$email=$_SESSION['email'];
if(isset($email)==true){

}else{
  header("Location: teacher-login.php");
}
$profile = new Users();
$profile->teacher_profile($email);
$arr = $profile->data;
$profile->classes($arr[0]['id']);
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
            <a class="navbar-brand" href="#">Online Quiz</a>
            </div>
            <div class="navbar-footer">
            <a href="logout.php" class="btn btn-danger" role="button">Logout</a>
            </div>
        </div>
        </nav>
    <!-- .......NavBar.......... -->


<div class="container-fluid" style="margin-top:70px">

  <br>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#classes">Classes</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#profile">Profile</a>
    </li>
    <!-- <li class="nav-item ml-auto">
      <a href="logout.php" class="btn btn-danger">Logout</a>
    </li> -->
    </ul>


  <!-- Tab panes -->
  <div class="tab-content">
    <div id="classes" class="container tab-pane active"><br>
      <h3>Classes 
      <div id="addClass" style="float:right">
      <button type="button" class="btn btn-primary" data-toggle="modal" href="" data-target="#modalLoginForm">Create New Class</button>
      </div>
      </h3>

      <!-- .......Create new class section...... -->
        <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Enter Class Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="new_class_creation_sub.php" method="post">
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                Class Name
                <input id="class_name" name="class_name" class="form-control">
                </div>

                <div class="md-form mb-4">
                Class info
                <input id="class_info" name="class_info" class="form-control">
                </div>

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-primary">Create Class</button>
            </div>
            </form>

            </div>
        </div>
        </div>
        <!-- .......End of Create new class section...... -->
        <br>
        <!-- ........Class lists........ -->
        <div class="container">
                
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Class Code</th>
                <th>Class Name</th>
                <th>Enter Class</th>
            </tr>
            </thead>
            <tbody>

            <?php
            foreach($profile->cls as $class){
            ?>
                <tr>
                    <td><?php echo $class['id']; ?></td>
                    <td><?php echo $class['name']; ?></td>
                    <td><a href="teacher_created_class.php?class_id=<?php echo $class['id']; ?>" class="btn btn-success" role="button">Enter</a></td>
                </tr>
            </tbody>
            <?php } ?>

            </tbody>
        </table>

        </div>
        <!-- ........Class lists ends........ -->

    </div>


    <div id="profile" class="container tab-pane fade"><br>
      <h3>Profile</h3>
      <table class="table">
        <!-- <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead> -->
        <tbody>

        <?php
        foreach($profile->data as $prof){
        ?>
            <tr>
                <th>Id : </th><td><?php echo $prof['id']; ?></td>
            </tr>
            <tr>
                <th>Name : </th><td><?php echo $prof['name']; ?></td>
            </tr>
            <tr>
                <th>Email : </th><td><?php echo $prof['email']; ?></td>
            </tr>
        </tbody>
        <?php } ?>
    </table>
    </div>
    <!-- <div id="logout" class="container tab-pane fade"><br>
      
    </div> -->
  </div>
</div>

</body>
</html>

