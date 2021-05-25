<!DOCTYPE html>
<html lang="en">
  <head>

  <script type="text/javascript">
  window.history.forward();
  </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Online Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="style.css">
  </head>
  <body>

    <div class="container">
      <div class="row content">
        <div class="col-12" id="login-doctor">
          <a href="teacher-login.php">Login as Teacher</a>
        </div>
        <div class="col-md-6 mb-3">
            <h2><center>Online Quiz</center></h2>
            <img src="quiz.jpg" class="img-fluid" alt="image"><br><br>
            <!-- <center>Now book your Doctor's appointment hasstle free in just a click</center> -->
        </div>
        <div class="col-md-6">
          <br>
          <center><h4>Student Sign In</h4></center>
          <br>
          <form action="signin_sub.php" method="post">
          <?php
          if(isset($_GET['run']) && $_GET['run']=="failed"){
            echo 'Login Failed';
          }
          ?>
            <div class="form-group">
              <lable for="email">Email</lable>
              <input type="email" name="email" class="form-control">
              <br>
            </div>
              <div class="form-group">
                <lable for="password">Password</lable>
                <input type="password" name="password" class="form-control">
              </div>
              <br>
                <button class="btn btn-class">Log In</button>
              <div class="signup">
                <br>
                New to Online Quiz?
                <a href="signup.php" class="signup-link">Sign Up</a>
              </div>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </body>
</html>
