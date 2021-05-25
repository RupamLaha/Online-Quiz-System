<?php
include("classes/users.php");
$email=$_SESSION['email'];
$class_id = $_GET['class_id'];
$quiz_id = $_GET['quiz_id'];
if(isset($email)==true){

}else{
  header("Location: index.php");
}
$profile = new Users();
$profile->teacher_profile($email);
$profile->particular_class($class_id);
$profile->fetch_quiz_name($quiz_id);
$profile->particular_quiz_all_details($quiz_id);
// echo "<h1>" . $profile->quiz['quiz_name'] . "</h1>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Online Quiz Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <!--  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
  <!--  -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <!--  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
  <!--  -->

</head>

<body>

    <!-- .......NavBar.......... -->

        <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
            <a class="navbar-brand" href="#" style="color:white">Online Quiz</a> <strong style="color:white"> (<?php echo $email; ?>) </strong>
            </div>
            <div class="navbar-footer">
            <a href="logout.php" class="btn btn-danger" role="button" style="float:right">Logout</a>
            <a href="teacher_home.php" class="btn btn-info" role="button" style="float:right">Home</a>
            </div>
        </div>
        </nav>
    <!-- .......NavBar.......... -->

<div class="container mt-3" style="margin-top:80px">
    
    <!-- .........Class Name........... -->
    <div class="alert alert-info">
    <strong><h3><?php echo $profile->cls[0]['name']; ?>
    <div id="addClass" style="float:right">
      <h4>Class Code - <?php echo $profile->cls[0]['id']; ?></h4>
    </div>
    </h3>
    </strong>
    </div>
    <!-- .........Class Name Ends........... -->

    <!-- ..............Page Heading............... -->
    <div class="alert alert-warning">
    <h4><?php echo $profile->quiz[0]['quiz_name']; ?>
        <div id="addClass" style="float:right">
            <button class="btn btn-danger"><a href="teacher_created_class.php?class_id=<?php echo $class_id ;?>" style="color:white">Cancel</a></button>

            <!-- <script>
            function goBack() {
              window.history.back();
            }
            </script> -->
        </div>
    </h4>
    </div>
    <!-- ..............Page Heading............... -->


<!-- .......schedule quiz time starts...... -->

            <!-- Button trigger modal -->
<button class="btn btn-warning btn-lg" data-toggle="modal" data-target="#ScheduleQuizTime">
Schedule Quiz Time
</button>

<!-- Modal -->
<div class="modal fade" id="ScheduleQuizTime" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Schedule Quiz Time
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form class="form-horizontal" role="form" action="schedule_quiz_time_sub.php?class_id=<?php echo $class_id; ?>&quiz_id=<?php echo $quiz_id; ?>" method="post">
          
                  <div class="form-group">
                  <label class="col-sm-4 control-label" for="start_time">Opening Time</label>
                      <div class='col-sm-6 input-group date' id='datetimepicker1'>
                          <input type='text' class="form-control" id="start_time" name="start_time"/>
                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                      </div>
                      <br>

                  <label class="col-sm-4 control-label" for="end_time">Closing Time</label>
                      <div class='col-sm-6 input-group date' id='datetimepicker2'>
                          <input type='text' class="form-control" id="end_time" name="end_time"/>
                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                      </div>
                  </div>

                  <div class="form-group">
                  <label class="col-sm-4 control-label" for="duration">Quiz Duration</label>
                      <div class='col-sm-6 input-group date' id='datetimepicker2'>
                          <input type='text' class="form-control" id="duration" name="duration" placeholder="Enter Duration in Minutes"/>
                      </div>
                  </div>

                  <script type="text/javascript">
                      $(function() {
                          $('#datetimepicker1').datetimepicker();
                      });

                      $(function() {
                          $('#datetimepicker2').datetimepicker();
                      });
                  </script>
                  <br>

                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Schedule</button>
                      </div>
                    </div>
                  </form>
              
            </div>
        </div>
    </div>
</div>

<!-- .......schedule quiz time  ends...... -->


<!-- .......Add new Question starts...... -->


<!-- Button trigger modal -->
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#AddNewQuestion">
Add New Question
</button>

<!-- Modal -->
<div class="modal fade" id="AddNewQuestion" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Enter Question and Options
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form class="form-horizontal" role="form" action="add_new_question_sub.php?class_id=<?php echo $class_id ?>&quiz_id=<?php echo $quiz_id ?>" method="post">


                <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="inputEmail3">Question</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" 
                        id="question" placeholder="Enter Question" name="question"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="inputEmail3">Option 1</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" 
                        id="option1" placeholder="Enter Option 1" name="option1"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="inputEmail3">Option 2</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" 
                        id="option2" placeholder="Enter Option 2" name="option2"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="inputEmail3">Option 3</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" 
                        id="option3" placeholder="Enter Option 3" name="option3"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="inputEmail3">Option 4</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" 
                        id="option4" placeholder="Enter Option 4" name="option4"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="inputEmail3">Correct Option Index</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" 
                        id="correctOptionIndex" placeholder="Correct Option Index" name="correctOptionIndex"/>
                    </div>
                  </div>


                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Set Question</button>
                      </div>
                    </div>
                  </form>
              
            </div>
        </div>
    </div>
</div>


    <!-- ...........Quiz Creation Form...............-->

    <!-- ........Date and time Picker........... -->
    <!-- <br>
    <strong style="color:red">Schedule Time</strong>
    <br>
    <div class="form-group">
    <label for="start_time">Opening Time</label>
        <div class='col-xs-4 input-group date' id='datetimepicker1'>
            <input type='text' class="form-control" id="start_time"/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
        <br>

    <label for="end_time">Closing Time</label>
        <div class='col-xs-4 input-group date' id='datetimepicker2'>
            <input type='text' class="form-control" id="end_time"/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>

    <div class="form-group">
    <label for="duration">Quiz Duration</label>
        <div class='col-xs-4 input-group date' id='datetimepicker2'>
            <input type='text' class="form-control" id="duration" placeholder="Enter Duration in Minutes"/>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {
            $('#datetimepicker1').datetimepicker();
        });

        $(function() {
            $('#datetimepicker2').datetimepicker();
        });
    </script>
    <br> -->
    <!-- ........Date and time Picker Ends............ -->


<?php 

if($profile->quiz[0]['sche_start_datetime']== NULL){
  echo "<h4> Scheduled Start Date & Time : Not Set </h4>";   
}else{
  echo "<h4> Scheduled Start Date & Time : ". $profile->quiz[0]['sche_start_datetime'] ."</h4>";   
}

if($profile->quiz[0]['sche_end_datetime']== NULL){
  echo "<h4> Scheduled End Date & Time : Not Set </h4>";   
}else{
  echo "<h4> Scheduled End Date & Time : ". $profile->quiz[0]['sche_end_datetime'] ."</h4>";   
}

if($profile->quiz[0]['quiz_duration']== NULL){
  echo "<h4> Quiz Duration : Not Set </h4>";   
}else{
  echo "<h4> Quiz Duration : ". $profile->quiz[0]['quiz_duration'] ." min</h4>";   
}

?>

<br>

<!-- ###################################################################################################### -->

<!-- .......Edit Question starts...... -->

              <!-- Modal -->
              <div class="modal fade" id="EditQuestion" tabindex="-1" role="dialog" 
                  aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <!-- Modal Header -->
                          <div class="modal-header">
                              <button type="button" class="close" 
                                data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel">
                                  Edit Question 
                              </h4>
                          </div>
                          
                          <!-- Modal Body -->
                          <div class="modal-body">
                              
                              <form class="form-horizontal editForm" role="form" action="" method="post">


                              <div class="form-group">
                                  <label  class="col-sm-2 control-label"
                                            for="inputEmail3">Question</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control question" 
                                      id="question" placeholder="Enter Question" name="question" value=""/>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label  class="col-sm-2 control-label"
                                            for="inputEmail3">Option 1</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control option1" 
                                      id="option1" placeholder="Enter Option 1" name="option1" value=""/>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label  class="col-sm-2 control-label"
                                            for="inputEmail3">Option 2</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control option2" 
                                      id="option2" placeholder="Enter Option 2" name="option2"/>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label  class="col-sm-2 control-label"
                                            for="inputEmail3">Option 3</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control option3" 
                                      id="option3" placeholder="Enter Option 3" name="option3"/>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label  class="col-sm-2 control-label"
                                            for="inputEmail3">Option 4</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control option4" 
                                      id="option4" placeholder="Enter Option 4" name="option4"/>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label  class="col-sm-2 control-label"
                                            for="inputEmail3">Correct Option Index</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control correctOptionIndex" 
                                      id="correctOptionIndex" placeholder="Correct Option Index" name="correctOptionIndex" value=""/>
                                  </div>
                                </div>


                                  <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" class="btn btn-success">Save Edit</button>
                                    </div>
                                  </div>
                                </form>
                            
                          </div>
                      </div>
                  </div>
              </div>

              <!-- .......Edit Question starts...... -->


<!-- ###################################################################################################### -->


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
      <div class="panel-heading"><strong><?php echo $i.'.'; ?>&nbsp;&nbsp;<b class="ques-<?php echo $que['id'];?>"><?php echo $que['question']?></b></strong>
        <div>
          <!-- Button delete question -->
          <a href="delete_ques_for_teacher_sub.php?ques_id=<?php echo $que['id'];?>&class_id=<?php echo $class_id;?>&quiz_id=<?php echo $quiz_id;?>" class="btn btn-danger" role="button" style="float:right">Delete</a>
          <!-- Button trigger modal -->
          <!-- <button id="edit" class="btn btn-warning" data-toggle="modal" data-target="#EditQuestion" style="float:right">Edit</button> -->
          <button class="btn btn-warning editbtn" data-id="<?php echo $que['id'];?>" data-class-id="<?php echo $class_id;?>" data-quiz-id="<?php echo $quiz_id;?>" style="float:right">Edit</button>
        </div>

      </div>
      <div class="panel-body"><br>
      <ol>
        <li class="option1-<?php echo $que['id'];?>"><?php echo $que['option1']?></li><br>
        <li class="option2-<?php echo $que['id'];?>"><?php echo $que['option2']?></li><br>
        <li class="option3-<?php echo $que['id'];?>"><?php echo $que['option3']?></li><br>
        <li class="option4-<?php echo $que['id'];?>"><?php echo $que['option4']?></li><br>
      </ol>
      Correct Option Index : <b class="currect-option-index-<?php echo $que['id'];?>"> <?php echo $que['correct_ans_index']?></b>
      </div>
    </div>
    <br>
    <?php $i++;} ?>

</div>


              <script type="text/javascript">
                $(document).ready(function (){
                  $('.editbtn').on('click',function (){
                    $('#EditQuestion').modal('show');

                        var curId = $(this).data('id');
                        var classId = $(this).data('class-id');
                        var quizId = $(this).data('quiz-id');
                        var ques = $('.ques-'+curId).text();
                        var opt1 = $('.option1-'+curId).text();
                        var opt2 = $('.option2-'+curId).text();
                        var opt3 = $('.option3-'+curId).text();
                        var opt4 = $('.option4-'+curId).text();
                        var currectOptionIndex = $('.currect-option-index-'+curId).text();

                      var url = "update_ques_for_teacher_sub.php?ques_id="+curId+"&class_id="+classId+"&quiz_id="+quizId;

                      $('.editForm').attr("action",url);

                      $('.question').val(ques);
                      $('.option1').val(opt1);
                      $('.option2').val(opt2);
                      $('.option3').val(opt3);
                      $('.option4').val(opt4);
                      $('.correctOptionIndex').val(currectOptionIndex);


                  });
                });
              </script>


</body>
</html>

