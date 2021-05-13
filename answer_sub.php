<?php
include("classes/users.php");
$email=$_SESSION['email'];

$class_id = $_GET['class_id'];

$profile = new Users();
$profile->users_profile($email);
print_r($profile->data);
echo "<br><br><br>";
$student_id = $profile->data[0]['id'];
echo "Student id : ";
print_r($student_id);
echo "<br><br><br>";


$quiz_id = $_GET['quiz_id'];

$ans = new Users();
$ans->particular_quiz_all_details($quiz_id);
print_r($ans->quiz_ques);

echo "<br><br><br>";

$ques_id_arr = array();
$correct_ans_arr = array();

foreach($ans->quiz_ques as $ques){

  echo $ques['id'] . " " . $ques['correct_ans_index'] . "<br>";
  // $arr = array();
  array_push($ques_id_arr, $ques['id']);
  array_push($correct_ans_arr, $ques['correct_ans_index']);
  // array_push($correct_ans_arr, $arr);

}

echo "<br><br><br>";
echo "Ques id arr : ";
print_r($ques_id_arr);

echo "<br><br><br>";
echo "Correct ans : ";
print_r($correct_ans_arr);

// $result=$ans->answers($_POST);
// print_r($result);
echo "<br><br><br>";
echo "User answer. : ";
// print_r($_POST);

$post = array();

foreach($_POST as $x => $x_value) {
  // echo "Key=" . $x . ", Value=" . $x_value;
  // echo "<br>";
  array_push($post, $x_value);
}

print_r($post);

$size = sizeof($ques_id_arr);

for($k = 0; $k < $size; $k++){
    if($post[$k] == 0){
      echo "Inside Null loop <br>";
      // $ques_id_arr[$k];
      // $correct_ans_arr[$k];
      // $post[$k];
      // $mark = NULL;
      $query = "INSERT INTO `quiz_ans_sheet_record`(`quiz_id`, `student_id`, `question_id`, `correct_ans_index`, `student_ans_index`, `marks_for_this_ques`) VALUES ('$quiz_id', '$student_id', '$ques_id_arr[$k]', '$correct_ans_arr[$k]', '$post[$k]', NULL)";

      if($ans->record_quiz_answers($query)){
        echo "Success in storing " . $ques_id_arr[$k] . " the student ans in quiz_ans_sheet_record";
      }else{
        echo "Problem Occured in storing " . $ques_id_arr[$k] . " the student ans in quiz_ans_sheet_record";
      }
    }elseif($post[$k] == $correct_ans_arr[$k]){
      echo "Inside 1 mark loop <br>";
      $mark = 1;
      $mark = (int)$mark;
      $query = "INSERT INTO `quiz_ans_sheet_record`(`quiz_id`, `student_id`, `question_id`, `correct_ans_index`, `student_ans_index`, `marks_for_this_ques`) VALUES ('$quiz_id', '$student_id', '$ques_id_arr[$k]', '$correct_ans_arr[$k]', '$post[$k]', '$mark')";

      if($ans->record_quiz_answers($query)){
        echo "Success in storing " . $ques_id_arr[$k] . " the student ans in quiz_ans_sheet_record";
      }else{
        echo "Problem Occured in storing " . $ques_id_arr[$k] . " the student ans in quiz_ans_sheet_record";
      }
    }elseif($post[$k] != $correct_ans_arr[$k]){
      echo "Inside 0 mark loop <br>";
      $mark = 0;
      $query = "INSERT INTO `quiz_ans_sheet_record`(`quiz_id`, `student_id`, `question_id`, `correct_ans_index`, `student_ans_index`, `marks_for_this_ques`) VALUES ('$quiz_id', '$student_id', '$ques_id_arr[$k]', '$correct_ans_arr[$k]', '$post[$k]', '$mark')";

      if($ans->record_quiz_answers($query)){
        echo "Success in storing " . $ques_id_arr[$k] . " the student ans in quiz_ans_sheet_record";
      }else{
        echo "Problem Occured in storing " . $ques_id_arr[$k] . " the student ans in quiz_ans_sheet_record";
      }
    }else{

    }
}

$ans->record_quiz_attemption($quiz_id, $student_id);


$ans->url("enter_student_particular_quiz.php?class_id=$class_id&quiz_id=$quiz_id");

// "INSERT INTO `quiz_ans_sheet_record`(`quiz_id`, `student_id`, `question_id`, `correct_ans_index`, `student_ans_index`, `marks_for_this_ques`) VALUES ('$quiz_id', '$student_id', '', )"



?>

<?php /*

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Online Quiz System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link type="text/css" rel="stylesheet" href="style_answer.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Quiz Result</h2>

    <div class="panel panel-primary">
      <div class="panel-heading"><h3 class = "panel-title"><center>Analytics</center></h3></div>
      <div class="panel-body" id="tablePanelBody">
      
      <table class="table">
        <tbody>     
            <tr class="success">
                <td>Correct Answers</td>
                <td><?php echo $result['right'];?></td>
            </tr>
            <tr class="danger">
                <td>Wrong Answers</td>
                <td><?php echo $result['wrong'];?></td>
            </tr>
            <tr class="warning">
                <td>Not attempted</td>
                <td><?php echo $result['not_attempted'];?></td>
            </tr>
            <tr class="info">
                <td>Total Score</td>
                <td><?php echo $result['right']."/".($result['right'] + $result['wrong'] + $result['not_attempted']);?></td>
            </tr>
        </tbody>
      </table>

      </div>
    </div>

</div>

</body>
</html>


*/ ?>
