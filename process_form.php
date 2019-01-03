<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "applications";

try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("INSERT INTO students (student_id, title, surname, othername, dob, country, courses, u_address, post_code, a_address, a_post_code, qualification, experience, sponsor, sponsor_detail, toefl_score, toefl_date) VALUES(:student_id, :title, :surname, :othername, :dob, :country, :courses, :u_address, :post_code, :a_address, :a_post_code, :qualification, :experience, :sponsor, :sponsor_d, :toefl_score, :toefl_date)");
    $stmt->bindParam(':student_id', $student_id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':othername', $othername);
    $stmt->bindParam('dob', $dob);
    $stmt->bindParam(':country', $country);
    $stmt->bindParam(':courses', $coursestore);
    $stmt->bindParam(':u_address', $u_address);
    $stmt->bindParam(':post_code', $post_code);
    $stmt->bindParam(':a_address', $a_address);
    $stmt->bindParam(':a_post_code', $a_post_code);
    $stmt->bindParam(':qualification', $qualification);
    $stmt->bindParam(':experience', $experience);
    $stmt->bindParam(':sponsor', $sponsor);
    $stmt->bindParam(':sponsor_d', $sponsor_d);
    $stmt->bindParam(':toefl_score', $toefl_score);
    $stmt->bindParam(':toefl_date',$toefl_date);

    $student_id = uniqid();
    $title = $_POST['title'];
    $surname = $_POST['surname'];
    $othername = $_POST['othername'];
    $dob = $_POST['dob'];
    $country = $_POST['country'];
    $u_address = $_POST['user_address'];
    $post_code = $_POST['post_code'];
    $a_address = $_POST['agent_address'];
    $a_post_code = $_POST['agent_post_code'];
    //count the number of courses submitted by the student and loop through to get all the data
    $courses = count($_POST["course_name"]);
    $proposed = count($_POST["course_proposed_entry"]);
    $entry = count($_POST["course_proposed_point_entry"]);
    $level = count($_POST["course_level"]);
    $coursestore = array();
    if($courses > 0){
        for($i=0; $i < $courses; $i++){
            $coursestore[$i]["course_name"] = $_POST["course_name"][$i];
        }
    }
    
    if($proposed > 0){
        for($i=0; $i < $proposed; $i++){
            $coursestore[$i]["course_proposed_entry"] = $_POST["course_proposed_entry"][$i];
        }
    }
    
    if($entry > 0){
        for($i=0; $i < $entry; $i++){
            $coursestore[$i]["course_proposed_point_entry"] = $_POST["course_proposed_point_entry"][$i];
        }
    }
    
    if($level > 0){
        for($i=0; $i < $courses; $i++){
            $coursestore[$i]["course_level"] = $_POST["course_level"][$i];
        }
    }
    
    $coursestore = serialize($coursestore);
    
    //count the qualification and loop throuh to get all the data
    $qualification = array();
    $q_name = count($_POST["q_name"]);
    $q_institution = count($_POST["q_institution"]);
    $q_duration = count($_POST["q_duration"]);
    $q_date = count($_POST["q_date"]);
    $q_result = count($_POST["q_result"]);
    
    if($q_name > 0){
        for($i = 0; $i < $q_name; $i++){
            $qualification[$i]["Qualification"] = $_POST["q_name"][$i];
        }
    }
    
    if($q_institution > 0){
        for($i = 0; $i < $q_institution; $i++){
            $qualification[$i]["Institution"] = $_POST["q_institution"][$i];
        }
    }
    
    if($q_duration > 0){
        for($i = 0; $i < $q_duration; $i++){
            $qualification[$i]["Duration"] = $_POST["q_duration"][$i];
        }
    }
    
    if($q_date > 0){
        for($i = 0; $i < $q_date; $i++){
            $qualification[$i]["Date"] = $_POST["q_date"][$i];
        }
    }
    
    if($q_result > 0){
        for($i = 0; $i < $q_result; $i++){
            $qualification[$i]["Result"] = $_POST["q_result"][$i];
        }
    }
    
    $qualification = serialize($qualification);
    
    
    //count the number of work experience input by the user
    $experience = array();
    $e_name = count($_POST["e_name"]);
    
    $e_job_title = count($_POST["e_job_title"]);
    
    $e_from = count($_POST["e_from"]);
    
    $e_to = count($_POST["e_to"]);
    
    $e_job_type = count($_POST["e_job_type"]);
    
    
    if($e_name > 0){
        for($i=0; $i < $e_name; $i++){
            $experience[$i]["Employer"] = $_POST['e_name'][$i];
        }
        
    }
    
    
    if($e_job_title > 0){
        for($i=0; $i < $e_job_title; $i++){
            $experience[$i]["Job_Title"] = $_POST['e_job_title'][$i];
        }
    }
    
    if($e_job_type > 0){
        for($i=0; $i < $e_job_type; $i++){
            $experience[$i]["Job_Type"] = $_POST['e_job_type'][$i];
        }
    }
    
    if($e_from > 0){
        for($i=0; $i < $e_from; $i++){
            $experience[$i]["From"] = $_POST['e_from'][$i];
        }
    }
    
    if($e_to > 0){
        for($i=0; $i < $e_to; $i++){
            $experience[$i]["To"] = $_POST['e_to'][$i];
        }
    }
    
    $experience = serialize($experience);
    
    $sponsor = $_POST['sponsor'];
    
    if(isset($_POST['sponsordetail'])){
        $sponsor_d = $_POST["sponsordetail"];
    }else{ 
        $sponsor_d = '';
    }  
    $toefl_score = $_POST['toefl_score'];
    $toefl_date = $_POST['toefl_date'];

    $stmt->execute();
    $_SESSION['success'] = 'Data saved sucessfully';
    $_SESSION['student_id'] =  $student_id;
    header('Location: upload.php');
    
    

}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}


