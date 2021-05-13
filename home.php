<?php
include("classes/users.php");
$email=$_SESSION['email'];
if(isset($email)==true){

}else{
  header("Location: index.php");
}
$profile = new Users();
$profile->users_profile($email);
// print_r($profile->data);
$student_id = $profile->data[0]['id'];

$profile->all_classes($student_id);
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

      <?php
          if(isset($_GET['oper']) && $_GET['oper']=="already_present"){
            
            echo '<script type="text/javascript">'
                  . '$( document ).ready(function() {'
                  . '$("#modalBody").html("You are already in the class.");'
                  . '$("#myModal").modal("show");'
                  . '});'
                  . '</script>';
          }
          if(isset($_GET['oper']) && $_GET['oper']=="request_pending"){
            
            echo '<script type="text/javascript">'
                  . '$( document ).ready(function() {'
                  . '$("#modalBody").html("Your previous request pending.");'
                  . '$("#myModal").modal("show");'
                  . '});'
                  . '</script>';
          }
          if(isset($_GET['oper']) && $_GET['oper']=="sending_failed"){
            
            echo '<script type="text/javascript">'
                  . '$( document ).ready(function() {'
                  . '$("#modalBody").html("Sending Request Failed.");'
                  . '$("#myModal").modal("show");'
                  . '});'
                  . '</script>';
          }
          if(isset($_GET['oper']) && $_GET['oper']=="success"){
            
            echo '<script type="text/javascript">'
                  . '$( document ).ready(function() {'
                  . '$("#modalBody").html("Request Sent. <br> Waiting for teacher to accept your request.");'
                  . '$("#myModal").modal("show");'
                  . '});'
                  . '</script>';
          }
          ?>

          <!-- Modal Alert Starts -->
          <div class="modal" id="myModal">
              <div class="modal-dialog">
                <div class="modal-content">
                
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Alert</h4>
                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                  </div>
                  
                  <!-- Modal body -->
                  <div class="modal-body" id="modalBody">
                    <!-- You are already in the class. -->
                  </div>
                  
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
                    <a href="home.php" class="btn btn-danger" role="button">Close</a>
                  </div>
                  
                </div>
              </div>
            </div>
            <!-- Modal Alert Ends -->


      
      <div id="addClass" style="float:right">

      <form action="request_to_join_class_by_student_sub.php?student_id=<?php echo $student_id; ?>" method="post">

          <div class="input-group">
            <input type="text" class="form-control" placeholder="Enter Class Code" name="class_id">
            <div class="input-group-append">
              <button class="btn btn-secondary" type="submit">Send Request</button>
            </div>
          </div>
        
      </form>

      </div>

      </h3>

              <br>
        <!-- ............Check for all the classes particular student registered starts............. -->

        <div class="container">
                
           <table class="table table-bordered">
              <thead>
                <tr>
                    <th>Class Code</th>
                    <th>Class Name</th>
                    <th>Professor</th>
                    <th>Enter Class</th>
                </tr>
              </thead>
              <tbody>
        
                <?php
                foreach($profile->all_cls as $class){
                ?>
                    <tr>
                      <td><?php echo $class['class_id']; ?></td>
                      <td><?php echo $class['class_name']; ?></td>
                      <td><?php echo $class['teacher_name']; ?></td>
                      <td><a href="student_particular_class.php?class_id=<?php echo $class['class_id']; ?>" class="btn btn-success" role="button">Enter</a></td>
                    </tr>
              </tbody>
                
                <?php } ?>
        
              </tbody>
          </table>
        
        </div>

        <!-- ............Check for all the classes particular student registered ends............. -->


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
