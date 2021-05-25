<?php
session_start();
class Users{
    // public $host = "localhost";
    // public $username = "root";
    // public $pass = "root";
    // public $db_name = "online_quiz";
    public $conn;
    public $data;
    public $cat;
    public $questions;

    // function __construct(){
    //     echo "Constructor called<br>";
    //     $conn = mysqli_connect('localhost','root','root','online_quiz');
    //     // $conn = new mysqli('localhost','root','root','online_quiz');
    //     if(!$conn){
    //         die ("database connection failed ".mysqli_connect_error());
    //     } 
    // }

    // .......Student Signup Function Starts.............
    function signup($data){

        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $run = mysqli_query($conn,$data);

        if($run){
            echo "New record created successfully";
            return true;
        }else {
            echo "Error: " . $data . "<br>" . mysqli_error($conn);
            return false;
        }

        // mysqli_close($conn);
    }
    // .......Student Signup Function Ends.............

    // .......Teacher Signup Function Starts.............
    function teacher_signup($data){

        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $run = mysqli_query($conn,$data);

        if($run){
            echo "New record created successfully";
            return true;
        }else {
            echo "Error: " . $data . "<br>" . mysqli_error($conn);
            return false;
        }

        // mysqli_close($conn);
    }
    // .......Teacher Signup Function Ends.............

    function url($url){
        header("location:".$url);
    }

    // .......Student Signin Function Starts.............
    function signin($email,$password){

        // echo $email;
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $query = "SELECT * FROM `signup` WHERE email = '$email' and pass = '$password'";
        $run = mysqli_query($conn,$query);
        $run->fetch_array(MYSQLI_ASSOC);
        if($run->num_rows>0){
            $_SESSION['email']=$email;
            return true;
        }else{
            return false;
        }
    }
    // .......Student Signin Function Ends.............


    // .......Teacher Signin Function Starts.............
    function teacher_signin($email,$password){

        // echo $email;
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $query = "SELECT * FROM `teacher_signup` WHERE email = '$email' and pass = '$password'";
        $run = mysqli_query($conn,$query);
        $run->fetch_array(MYSQLI_ASSOC);
        if($run->num_rows>0){
            $_SESSION['email']=$email;
            return true;
        }else{
            return false;
        }
    }
    // .......Teacher Signin Function Ends.............


    //..........Student Profile Starts.............
    function users_profile($email){
        // echo $email;
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $query = "SELECT * FROM `signup` WHERE email = '$email'";
        $run = mysqli_query($conn,$query);
        $row = $run->fetch_array(MYSQLI_ASSOC);

        if($run->num_rows>0){
            $this->data[] = $row;
        }
        return $this->data;
    }
    //..........Student Profile Ends.............


    //..........Teacher Profile Starts.............
    function teacher_profile($email){
        // echo $email;
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $query = "SELECT * FROM `teacher_signup` WHERE email = '$email'";
        $run = mysqli_query($conn,$query);
        $row = $run->fetch_array(MYSQLI_ASSOC);

        if($run->num_rows>0){
            $this->data[] = $row;
        }
        return $this->data;
    }
    //..........Teacher Profile Ends.............



    function categories(){

        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $query = "SELECT * FROM `category`";
        $run = mysqli_query($conn,$query);
        // $row = $run->fetch_array(MYSQLI_ASSOC);

        while($row = $run->fetch_array(MYSQLI_ASSOC)){
            $this->cat[] = $row;
        }
        return $this->cat;
    }



    //..........fetch all classes for particular student starts.............

    function all_classes($student_id){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $query = "SELECT classes.id AS class_id, classes.name AS class_name, teacher_signup.id AS teacher_id, teacher_signup.name AS teacher_name, teacher_signup.email AS teacher_email FROM class_students, classes, teacher_signup WHERE class_students.teacher_id = classes.teacher_id AND class_students.class_id=classes.id AND class_students.teacher_id = teacher_signup.id AND class_students.student_id = '$student_id'";
        // SELECT classes.id, classes.name, teacher_signup.id, teacher_signup.name, teacher_signup.email FROM class_students, classes, teacher_signup WHERE class_students.teacher_id = classes.teacher_id AND class_students.class_id=classes.id AND class_students.teacher_id = teacher_signup.id AND class_students.student_id = $student_id;
        $run = mysqli_query($conn,$query);
        // $row = $run->fetch_array(MYSQLI_ASSOC);

        while($row = $run->fetch_array(MYSQLI_ASSOC)){
            $this->all_cls[] = $row;
        }
        return $this->all_cls;
    }

    //..........fetch all classes for particular student ends.............



    //.............Check if the student has already joined the class or not starts................

    function check_student_in_the_class($class_id,$student_id){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $query = "SELECT * FROM class_students WHERE class_id = '$class_id' AND student_id = '$student_id'";
        $run = mysqli_query($conn,$query);
        // $row = $run->fetch_array(MYSQLI_ASSOC);

        // $res = "not_present";

        if($run->num_rows>0){
            // $this->data[] = $row;
            $res = "already_present";
        }else{
            $res = "not_present";
        }
        // return $this->data;
        return $res;
    }

    //.............Check if the student has already joined the class or not ends................ 



    //.............Check if the student has already sent a request to join the class starts................

      function check_if_student_already_sent_request($class_id,$student_id){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $query = "SELECT * FROM class_joining_req WHERE class_id = '$class_id' AND student_id = '$student_id'";
        $run = mysqli_query($conn,$query);
        // $row = $run->fetch_array(MYSQLI_ASSOC);


        if($run->num_rows>0){
            // $this->data[] = $row;
            $res = "request_pending";
        }else{
            $res = "request_not_pending";
        }
        // return $this->data;
        return $res;
    }

    //.............Check if the student has already sent a request to join the class ends................



    //................send request to join the class starts.....................

    function send_req_to_join_class($class_id,$student_id){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $query = "INSERT INTO `class_joining_req`(`class_id`, `student_id`) VALUES ('$class_id','$student_id')";
        $run = mysqli_query($conn,$query);

        if($run){
            echo "New record created successfully";
            return true;
        }else {
            echo "Error: " . $data . "<br>" . mysqli_error($conn);
            return false;
        }
    }

    //................send request to join the class ends.....................



    //..........fetch all classes for particular teacher starts.............

    function classes($id){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $query = "SELECT * FROM `classes` WHERE teacher_id = '$id'";
        $run = mysqli_query($conn,$query);
        // $row = $run->fetch_array(MYSQLI_ASSOC);

        while($row = $run->fetch_array(MYSQLI_ASSOC)){
            $this->cls[] = $row;
        }
        return $this->cls;
    }

    //..........fetch all classes for particular teacher ends.............


    //..........Creation of new classes by teacher starts.............

    function creating_new_class($query){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        // $query = "INSERT INTO `classes`(`name`, `info`, `teacher_id`) VALUES ('$name','$info','$teacher_id')";
        $run = mysqli_query($conn,$query);

        if($run){
            echo "New record created successfully";
            return true;
        }else {
            echo "Error: " . $data . "<br>" . mysqli_error($conn);
            return false;
        }
    }

    //..........Creation of new classes by teacher ends.............


    //..........fetch particular class details starts.............

    function particular_class($class_id){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $query = "SELECT * FROM `classes` WHERE id = '$class_id'";
        $run = mysqli_query($conn,$query);
        // $row = $run->fetch_array(MYSQLI_ASSOC);

        while($row = $run->fetch_array(MYSQLI_ASSOC)){
            $this->cls[] = $row;
        }
        return $this->cls;
    }

    //..........fetch particular class details ends.............



    //..........create new quiz in particular class starts.............

    function new_quiz_creation($query){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        // $query = "INSERT INTO `classes`(`name`, `info`, `teacher_id`) VALUES ('$name','$info','$teacher_id')";
        $run = mysqli_query($conn,$query);

        if($run){
            echo "New record created successfully";
            return true;
        }else {
            echo "Error: " . $data . "<br>" . mysqli_error($conn);
            return false;
        }
    }

    //..........create new quiz in particular class ends.............


    //..........fetch Quizes of particular class for students starts.............

    function particular_class_quizes_for_students($class_id){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $query = "SELECT * FROM `quizes` WHERE class_id = '$class_id' AND sche_start_datetime IS NOT NULL";
        $run = mysqli_query($conn,$query);
        // $row = $run->fetch_array(MYSQLI_ASSOC);

        while($row = $run->fetch_array(MYSQLI_ASSOC)){
            $this->quizes[] = $row;
        }
        return $this->quizes;
    }

    //..........fetch Quizes particular class for students ends.............




    //..........fetch Quizes of particular class for teachers starts.............

    function particular_class_quizes_for_teachers($class_id){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $query = "SELECT * FROM `quizes` WHERE class_id = '$class_id'";
        $run = mysqli_query($conn,$query);
        // $row = $run->fetch_array(MYSQLI_ASSOC);

        while($row = $run->fetch_array(MYSQLI_ASSOC)){
            $this->quizes[] = $row;
        }
        return $this->quizes;
    }

    //..........fetch Quizes particular class for teachers ends.............


    
    //..........delete student from particular class starts.............

    function delete_student($class_id, $student_id){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $query = "DELETE FROM `class_students` WHERE class_id = '$class_id' AND student_id = '$student_id'";
        $run = mysqli_query($conn,$query);

        if($run){
            echo "Student deleted from the class successfully";
            return true;
        }else {
            echo "Error: " . $data . "<br>" . mysqli_error($conn);
            return false;
        }
    }

    //..........delete student from particular class ends.............



    //..........fetch particular quiz name when id is given starts.............

    function fetch_quiz_name($quiz_id){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        // DATE_FORMAT("2017-06-15 12:30:00", "%d %M %Y %r")

        $query = "SELECT quiz_name, DATE_FORMAT(sche_start_datetime, '%d %M %Y %r') AS sche_start_datetime, DATE_FORMAT(sche_end_datetime, '%d %M %Y %r') AS sche_end_datetime, quiz_duration FROM `quizes` WHERE id = '$quiz_id'";
        $run = mysqli_query($conn,$query);
        // $row = $run->fetch_array(MYSQLI_ASSOC);

        while($row = $run->fetch_array(MYSQLI_ASSOC)){
            $this->quiz[] = $row;
        }
        return $this->quiz;
    }

    //..........fetch particular quiz name when id is given ends.............

    //............Schedule particular quiz time starts..............

    function schedule_quiz_time($query){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        // UPDATE quizes SET sche_start_datetime = '$sche_start_datetime', sche_end_datetime = '$sche_end_datetime', quiz_duration = '$quiz_duration' WHERE id = '$quiz_id' 
        $run = mysqli_query($conn,$query);

        if($run){
            echo "New record created successfully";
            return true;
        }else {
            echo "Error: " . $data . "<br>" . mysqli_error($conn);
            return false;
        }        
    }

    //............Schedule particular quiz time ends..............

    //..........fetch particular quiz all details starts.............
    // SELECT quiz_questions.id, quiz_questions.quiz_id, quiz_questions.class_id, quiz_questions.teacher_id, quiz_questions.question, quiz_questions.option1, quiz_questions.option2, quiz_questions.option3, quiz_questions.option4, quiz_questions.correct_ans_index FROM quiz_questions JOIN quizes WHERE quiz_questions.quiz_id = quizes.id AND quiz_questions.quiz_id=3;
    
    function particular_quiz_all_details($quiz_id){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $query = "SELECT quiz_questions.id, quiz_questions.quiz_id, quiz_questions.class_id, quiz_questions.teacher_id, quiz_questions.question, quiz_questions.option1, quiz_questions.option2, quiz_questions.option3, quiz_questions.option4, quiz_questions.correct_ans_index FROM quiz_questions JOIN quizes WHERE quiz_questions.quiz_id = quizes.id AND quiz_questions.quiz_id='$quiz_id'";
        $run = mysqli_query($conn,$query);

        while($row = $run->fetch_array(MYSQLI_ASSOC)){
            $this->quiz_ques[] = $row;
        }
        return $this->quiz_ques;
    }

    //..........fetch particular quiz all details ends.............



    //..........Delete particular question from a quiz for teachers starts.............

    function delete_question($question_id){

        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $query = "DELETE FROM `quiz_questions` WHERE id = '$question_id'";
        $run = mysqli_query($conn,$query);

        if($run){
            echo "Question deleted successfully";
            return true;
        }else {
            echo "Error: " . $data . "<br>" . mysqli_error($conn);
            return false;
        }

    }

    //..........Delete particular question from a quiz for teachers ends.............



    //..........Update particular question from a quiz for teachers starts.............

       function update_question($question_id,$ques,$option1,$option2,$option3,$option4,$correct_ans_index){

        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $query = "UPDATE `quiz_questions` SET `question`='$ques',`option1`='$option1',`option2`='$option2',`option3`='$option3',`option4`='$option4',`correct_ans_index`='$correct_ans_index' WHERE `id`='$question_id'";
        $run = mysqli_query($conn,$query);

        if($run){
            echo "Question edited successfully";
            return true;
        }else {
            echo "Error: " . $data . "<br>" . mysqli_error($conn);
            return false;
        }

    }
    //..........Update particular question from a quiz for teachers ends.............



    //............add new question to particular quiz starts.................
    
    function add_new_ques($query){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $run = mysqli_query($conn,$query);

        if($run){
            echo "New record created successfully";
            return true;
        }else {
            echo "Error: " . $data . "<br>" . mysqli_error($conn);
            return false;
        }  
    }

    //............add new question to particular quiz ends.................


    //..........fetch students of particular class starts.............

    function particular_class_students($class_id){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $query = "SELECT signup.id, signup.name, signup.email FROM signup JOIN class_students ON signup.id = class_students.student_id AND class_students.class_id = '$class_id'";
        $run = mysqli_query($conn,$query);
        // $row = $run->fetch_array(MYSQLI_ASSOC);

        while($row = $run->fetch_array(MYSQLI_ASSOC)){
            $this->students[] = $row;
        }
        return $this->students;
    }

    //..........fetch students particular class ends.............


    //..........add new student to a particular class starts.............

    function add_particular_class_student($query){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        // $query = "INSERT INTO `class_students`(`class_id`, `student_id`, `teacher_id`) VALUES ('$class_id','$student_id','$teacher_id')";
        $run = mysqli_query($conn,$query);

        if($run){
            echo "New record created successfully";
            return true;
        }else {
            echo "Error: " . $data . "<br>" . mysqli_error($conn);
            return false;
        }
    }

    //..........add new student to a particular class ends.............



    //................check for any class joining requests starts...............

    function fetch_class_joining_req($class_id){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $query = "SELECT signup.id, signup.name, signup.email FROM signup JOIN class_joining_req WHERE signup.id = class_joining_req.student_id AND class_joining_req.class_id = '$class_id'";
        
        $run = mysqli_query($conn,$query);
        // $row = $run->fetch_array(MYSQLI_ASSOC);

        while($row = $run->fetch_array(MYSQLI_ASSOC)){
            $this->req[] = $row;
        }
        return $this->req;
    }

    //................check for any class joining requests ends...............


    //..................accept student's request to join the class starts...............

    function accept_request($query, $query1){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $run = mysqli_query($conn,$query);

        if($run){
            echo "New student inserted in class_student successfully";
            $run1 = mysqli_query($conn,$query1);

            if($run1){
                // echo "But deletion request from class_joining_req failed";

                return true;
            }else {
                echo "Error: " . $data . "<br>" . mysqli_error($conn);
                return false;
            }

            // return true;
        }else {
            echo "Error: " . $data . "<br>" . mysqli_error($conn);
            return false;
        }
    }

    //..................accept student's request to join the class ends...............



    //....................decline student's request to join the class starts....................

    function decline_request($query){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $run = mysqli_query($conn,$query);

        if($run){
            echo "Student request declined successfully";

            return true;
        }else {
            echo "Error: " . $data . "<br>" . mysqli_error($conn);
            return false;
        }
    }

    //....................decline student's request to join the class ends....................
 


    //..................record student quiz attempt starts.......................

    function record_quiz_attemption($quiz_id, $student_id){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $query = "INSERT INTO `quiz_attemption_record`(`quiz_id`, `student_id`) VALUES ('$quiz_id', '$student_id')";

        $run = mysqli_query($conn,$query);

        if($run){
            echo "Student attemption recorded successfully";

            return true;
        }else {
            echo "Error: " . $data . "<br>" . mysqli_error($conn);
            return false;
        }
    }

    //..................record student quiz attempt ends.......................


    //..................check the quiz_attemption_record starts.....................

    function check_quiz_attemption($quiz_id, $student_id){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        }

        $query = "SELECT * FROM `quiz_attemption_record` WHERE quiz_id = '$quiz_id' AND student_id = '$student_id'";
        // SELECT * FROM `quiz_attemption_record` WHERE quiz_id = '$quiz_id' AND student_id = '$student_id'
        $run = mysqli_query($conn,$query);

        $run->fetch_array(MYSQLI_ASSOC);

        if($run->num_rows>0){
            return true;
        }else{
            return false;
        }

    }

    //..................check the quiz_attemption_record ends.....................


    //....................Record students' quiz answers starts...........................

    function record_quiz_answers($query){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        }

        $run = mysqli_query($conn,$query);

        if($run){
            echo "Student ans recorded successfully";

            return true;
        }else {
            echo "Error: " . $data . "<br>" . mysqli_error($conn);
            return false;
        }
    }

    //....................Record students' quiz answers ends...........................

    

    //..............fetch particular student result starts.......................


    function fetch_result($quiz_id, $student_id){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        }

        // SELECT COUNT(marks_for_this_ques) FROM quiz_ans_sheet_record WHERE marks_for_this_ques = 1;
        // SELECT COUNT(marks_for_this_ques) FROM quiz_ans_sheet_record WHERE marks_for_this_ques = 0;
        // SELECT COUNT(marks_for_this_ques) FROM quiz_ans_sheet_record WHERE marks_for_this_ques = NULL;

        $query_correct_ans = "SELECT COUNT(marks_for_this_ques) FROM quiz_ans_sheet_record WHERE quiz_id = $quiz_id AND student_id = $student_id AND marks_for_this_ques = 1";
        $query_wrong_ans = "SELECT COUNT(marks_for_this_ques) FROM quiz_ans_sheet_record WHERE quiz_id = $quiz_id AND student_id = $student_id AND marks_for_this_ques = 0";
        $query_null_ans = "SELECT COUNT(IF(marks_for_this_ques IS NULL,1,0)) FROM quiz_ans_sheet_record WHERE quiz_id = $quiz_id AND student_id = $student_id AND marks_for_this_ques IS NULL";

        $run = mysqli_query($conn,$query_correct_ans);
        $run1 = mysqli_query($conn,$query_wrong_ans);
        $run2 = mysqli_query($conn,$query_null_ans);

        $arr = array();

        while($row = $run->fetch_array(MYSQLI_ASSOC)){
            array_push($arr, $row['COUNT(marks_for_this_ques)']);
        }

        while($row1 = $run1->fetch_array(MYSQLI_ASSOC)){
            array_push($arr, $row1['COUNT(marks_for_this_ques)']);
        }

        while($row2 = $run2->fetch_array(MYSQLI_ASSOC)){
            array_push($arr, $row2['COUNT(IF(marks_for_this_ques IS NULL,1,0))']);
        }


        return $arr;
    }


    //..............fetch particular student result ends.......................



    //................fetch particular question's student answer starts....................


    function fetch_particular_ques_student_ans($quiz_id, $student_id, $question_id){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        }

        $query = "SELECT student_ans_index FROM quiz_ans_sheet_record WHERE quiz_id = '$quiz_id' AND student_id = '$student_id' AND question_id = '$question_id'";
        $run = mysqli_query($conn,$query);

        while($row = $run->fetch_array(MYSQLI_ASSOC)){
            $ans = $row['student_ans_index'];
        }

        return $ans;
    }


    //................fetch particular question's student answer ends....................



    function show_questions($cat_id){
        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $query = "SELECT * FROM `questions` WHERE cat_id = '$cat_id'";
        $run = mysqli_query($conn,$query);
        // $row = $run->fetch_array(MYSQLI_ASSOC);

        while($row = $run->fetch_array(MYSQLI_ASSOC)){
            $this->questions[] = $row;
        }
        return $this->questions;
    }

    function answers($data){
        // print_r($data);

        $conn = mysqli_connect('localhost','root','root','online_quiz');
        if(!$conn){
            die ("database connection failed ".mysqli_connect_error());
        } 

        $ans = implode("",$data);

        // print_r($ans);

        $right=0;
        $wrong=0;
        $not_attemped=0;

        $query = "SELECT id,ans FROM `questions` WHERE cat_id = '".$_SESSION['cat']."'";
        $run = mysqli_query($conn,$query);
        // $row = $run->fetch_array(MYSQLI_ASSOC);

        while($qust = $run->fetch_array(MYSQLI_ASSOC)){
            if($qust['ans']==$_POST[$qust['id']]){
                $right++;
            }elseif($_POST[$qust['id']]=="not_attemped"){
                $not_attemped++;
            }
            else{
                $wrong++;
            }
            // print_r($qust);
        }
        
        // echo "Right answers - ". $right."<br>";
        // echo "Wrong answers - ". $wrong."<br>";
        // echo "Not Attemped - ". $not_attemped."<br>";
        $array = array("right"=>$right,"wrong"=>$wrong,"not_attempted"=>$not_attemped);
        return $array;
    }
}


?>