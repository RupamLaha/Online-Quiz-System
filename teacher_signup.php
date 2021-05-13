<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Online Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="style.css">
  </head>
  <body>

    <div class="container">
      <div class="row content">

        <!-- Patient SignUp link -->

        <div class="col-12" id="login-doctor">
          <a href="signup.php">Signup as Student</a>
        </div>

        <!-- intro column... -->

        <div class="col-md-6 mb-3">
            <h2><center>Online Quiz</center></h2>
            <img src="quiz.jpg" class="img-fluid" alt="image"><br><br>
            <!-- <center>Now it is very easy to manage your patients appointments using Daktar platform</center> -->
        </div>

        <!-- //form column... -->

        <div class="col-md-6">
          <br>
          <center><h4>Teacher Sign Up</h4></center>
          <br>
          <form action="teacher_signup_sub.php" method="post">

          <?php
          if(isset($_GET['run']) && $_GET['run']=="success"){
            // echo "<h2 style='.'color:blue;'.'>Successfully Registered</h2>";
            echo '<script>alert("Successfully Registered")</script>';
          }
          ?>

            <!-- //name... -->
            <div class="form-group">
              <lable for="name">Name</lable>
              <input type="text" name="name" class="form-control">
              <br>
            </div>
            <!-- //email... -->
            <div class="form-group">
              <lable for="email">Email</lable>
              <input type="email" name="email" class="form-control">
              <br>
            </div>

              <!-- //gender -->

              <!-- <div class="form-group">
                <label for="gender">Gender</label><br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="male">
                <label class="form-check-label" for="inlineRadio1">Male</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="female">
                <label class="form-check-label" for="inlineRadio2">Female</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="others">
                <label class="form-check-label" for="inlineRadio3">Others</label>
              </div>
            </div>
            <br> -->

            <!-- //password... -->
            <div class="form-group">
              <lable for="password">Password</lable>
              <input type="password" name="password" class="form-control">
              <br>
            </div>
            <!-- //confirm password... -->
            <div class="form-group">
              <lable for="confirm_password">Confirm Password</lable>
              <input type="password" name="confirm_password" class="form-control">
            </div>
            <!-- //signup button... -->
            <br>
              <button class="btn btn-class" type="submit">Sign Up</button>
            <div class="signup">
              <!-- //signin link -->
            <br>
              Already have an account?
              <a href="teacher-login.php" class="signup-link">Sign In</a>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </body>
</html>
