<?php
session_start();
require 'dbconn.php';
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>

 <?php

    if(isset($_GET['student_id'])){
        $_SESSION['student_id'] = $_GET['student_id'];
    }
    
    $sql = "SELECT * FROM students WHERE student_id='" . $_SESSION["student_id"] . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        //echo "<table><tr><th>ID</th><th>Name</th></tr>";
        // output data of each row
        
        while($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $title = $row['title'];
            $surname = $row["surname"];
            $othername = $row["othername"];
            $dob = $row["dob"];
            $row["country"];
            $status = $row["status"];
            $student_id = $row['student_id'];
            $country = $row['country'];
            $courses = unserialize($row['courses']);
            $u_address = $row['u_address'];
            $post_code = $row['post_code'];
            $a_address = $row['a_address'];
            $a_post_code = $row['a_post_code'];
            $qualification = unserialize($row['qualification']);
            $experience = unserialize($row['experience']);
            $sponsor = $row['sponsor'];
            $sponsor_detail = $row['sponsor_detail'];
            $toefl_score = $row['toefl_score'];
            $toefl_date = $row['toefl_date'];
            $assigned_to = $row['assigned_to'];
            

        }
        
    } else {
        echo "There seems to be a problem with this students. try again";
        die();
    }
    $conn->close();
?>

 <?php
// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "SELECT * FROM documents WHERE student_id='" . $_SESSION['student_id'] ."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        
        //echo "<table><tr><th>ID</th><th>Name</th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $ssce = $row["ssce"];
            $p_statement = $row['p_statement'];
            $word_of_p_stmt = $row["word_of_p_stmt"];
            $transcript = $row["transcript"];
            $testimonial = $row["testimonial"];
            $rf_letter1 = $row["rf_letter1"];
            $rf_letter2 = $row["rf_letter2"];
            $acad_r_letter = $row['acad_r_letter'];
            $passport = $row['passport'];
            $int_passport = $row['int_passport'];
            $prof_r_letter = $row['prof_r_letter'];
        }

        
    } else {
        $_SESSION['warning'] = "It seems you've not uploaded any files, click <a href='upload.php'>here</a> to upload";
    }
    $conn->close();

?>

 <?php
// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "SELECT * FROM  staff";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        //echo "<table><tr><th>ID</th><th>Name</th></tr>";
        // output data of each row
        // while($row = $result->fetch_assoc()) {
        //     echo "<tr><td>".$row["id"]."</td><td>".$row["surname"]." ".$row["othername"]."</td><td>". $row["dob"] . "</td><td>" . $row["country"] . "</td><td class=\"positive\">". $row["status"] ."</td><td><a class=\"ui button green\" href='student.php?student_id=" . $row['student_id'] . "' >view more</a></td></tr>";
        // }
        
    } else {
        $staff_err = "There seems to be a problem with this staff. try again";
        
    }
    function checkFileType($fileToCheck){
        if(empty($fileToCheck)){
            return;
        }
        $ext = pathinfo($fileToCheck, PATHINFO_EXTENSION);
        if($ext =='jpg' || $ext == 'png' || $ext == 'jpeg'){
            $resource ='<img src="uploads/' .  $fileToCheck . '" style="max-width: 100%" alt="">';
            echo $resource;
            return;
        }
        $resource = '<a href="uploads/' . $fileToCheck . '" class="">View Document in Browser</a>';
        echo $resource;
        return;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="semantic/dist/semantic.min.css"/>

    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>

</head>
<body>
    <div class="mysidebar">
      <div class="profile">
      <img src="images/logo.jpg" alt="profile picture" style="height:150px; width:150px;">
      </div>

        <a href="admin.php">Dashboard</a>
        <a href="form.php" class="">Add new Jobs</a>
        <a class="active" href="jobs.php">Manage Jobs</a>
        <a href="staff.php">Staff</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="main-content">
    <div class="ui container padding">
        <h2 class="ui header"> Student's application info</h2>
        <?php
            if(isset($_SESSION['success'])){
                echo '<div class="ui message tiny green"> <i class="close icon"></i>
                <div class="header">Success!</div><p>';
                 echo $_SESSION["success"];
                 echo '</p></div>';
             unset($_SESSION['success']);
        
            }
        ?>
                
             <div class="ui message yellow tiny">
                <i class="close icon"></i>
                <p>If you have any corrections to make in the student info <a href="edit.php" class="mini ui button blue">Click Here</a>. You missed a file or made a mistake in the upload <a href="upload.php" class="mini ui button blue">Click Here</a></p>
              </div>
            <div class="ui attached message panel-color">
                <div class="header header-color">
                    Section 1 - Applicants Details
                </div>
            </div>

            <div class="ui form attached fluid segment">
            <table class="ui table celled">
                <thead>
                    <tr><th class="three wide">Name</th>
                    <th class="thirteen wide">Status</th>
                </tr></thead> 
                <tbody>
                    <tr>
                        <td>Passport: </td>
                        <td><img src="uploads/<?php echo $passport; ?>" style="height:230px;width:180px;" alt="passport"> </td>
                    </tr>
                    <tr>
                    <td>Title: </td>
                    <td>  <?php echo $title; ?></td>
                    </tr>
                    <tr>
                    <td>Surname: </td>
                    <td><?php echo $surname; ?></td>
                    </tr>
                    <tr>
                    <td>First / Given Name(s): </td>
                    <td><?php echo $othername; ?></td>
                    </tr>
                    <tr>
                        <td>Date of Birth: </td>
                        <td><?php echo $dob; ?></td>
                    </tr>
                    <tr>
                        <td>Country: </td>
                        <td> <?php echo $country; ?></td>
                    </tr>
                     <tr>
                        <td>Courses: </td>
                        <td>
                            <?php
                            echo "<table class=\"ui table\">
                            <thead>
                                <th>Course</th>
                                <th>Proposed year/ month of entry</th>
                                <th>proposed point of Entry</th>
                                <th>Level</th>
                            </thead>
                            <tbody>";
                            $coursecount = count($courses);
                                for($i=0; $i < $coursecount; $i++){
                                    echo "<tr><td>" . $courses[$i]['course_name'] . "</td><td>" . $courses[$i]['course_proposed_entry'] . "</td><td>" . $courses[$i]['course_proposed_point_entry'] . "</td><td>" . $courses[$i]["course_level"] . "</td></tr>";
                                }
                            ?>
                            </tbody>
                           </table> 
                        </td>
                    </tr>
                    <tr>
                        <td>Address: </td>
                        <td>
                            <table class="ui table">
                            <thead>
                                <th>Address</th>
                                <th>Post code</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $a_address; ?></td>
                                    <td><?php echo $a_post_code ?></td>
                                </tr>
                            </tbody>
                             </td>
                            </table>
                    </tr>
                    <tr>
                        <td>Agent Address: </td>
                        <td>
                            <table class="ui table">
                            <thead>
                                <th>Address</th>
                                <th>Post code</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $u_address; ?></td>
                                    <td><?php echo $a_post_code ?></td>
                                </tr>
                            </tbody>
                             </td>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>Qualification: </td>
                        <td>
                        <?php
                            echo "<table class=\"ui table\">
                            <thead>
                                <th>Qualification Name</th>
                                <th>School Name</th>
                                <th>Duration of Study</th>
                                <th>Date Obatained</th>
                                <th>Result</th>
                            </thead>
                            <tbody>";
                            $qualificationcount = count($qualification);
                                for($i=0; $i < $qualificationcount; $i++){
                                    echo "<tr><td>" . $qualification[$i]['Qualification'] . "</td><td>" . $qualification[$i]['Institution'] . "</td><td>" . $qualification[$i]['Duration'] . "</td><td>" . $qualification[$i]["Date"] . "</td><td>" . $qualification[$i]["Result"] ."</td></tr>";
                                }
                        ?>
                         </tbody>
                        </table> 
                        </td>
                    </tr>
                    <tr>
                         <td>Experience: </td>
                         <td>
                         <?php
                            echo "<table class=\"ui table\">
                            <thead>
                                <th>Employer's Name</th>
                                <th>Job Title</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Full or Part Time</th>
                            </thead>
                            <tbody>";
                            $experiencecount = count($experience);
                                for($i=0; $i < $experiencecount; $i++){
                                    echo "<tr><td>" . $experience[$i]['Employer'] . "</td><td>" . $experience[$i]['Job_Title'] . "</td><td>" . $experience[$i]["From"] . "</td><td>" . $experience[$i]["To"] ."</td><td>" . $experience[$i]['Job_Type'] . "</td></tr>";
                                }
                        ?>
                         </tbody>
                        </table> 
                         </td>
                    </tr>
                    <tr>
                        <td>Sponsor: </td>
                        <td><?php echo $sponsor; ?></td>
                    </tr>
                    <tr>
                        <td>Sponso Detail: </td>
                        <td><?php echo $sponsor_detail; ?></td>
                    </tr>
                    <tr>
                        <td>Toefl Score: </td>
                        <td><?php echo $toefl_score; ?></td>
                    </tr>
                    <tr>
                        <td>Date Obtained: </td>
                        <td> <?php echo $toefl_date; ?></td>
                    </tr>
                    <tr>
                        <td>International passport: </td>

                        <td><?php if(!empty($int_passport)){ checkFileType($int_passport);} ?></td>
                    </tr>
                    <tr>
                        <td>Personal Statement: </td>
                        <td><?php if(!empty($p_statement)){ checkFileType($p_statement);} ?></td>
                    </tr>
                    <tr>
                        <td>Degree: </td>
                        <td><?php if(!empty($transcript)){ checkFileType($transcript);} ?></td>
                    </tr>
                    <tr>
                        <td>Reference Letter 1: </td>
                        <td><?php if(!empty($rf_letter1)){ checkFileType($rf_letter1);} ?></td>
                    </tr>
                    <tr>
                        <td>Reference Letter 2: </td>
                        <td><?php if(!empty($rf_letter2)){checkFileType($rf_letter2);} ?></td>
                    </tr>
                    <tr>
                        <td>Testimonial/ Recommendation Letter: </td>
                        <td><?php if(!empty($testimonial)){ checkFileType($testimonial);} ?></td>
                    </tr>
                    <tr>
                        <td>200 words of personal statement: </td>
                        <td><?php if(!empty($word_of_p_stmt)) {checkFileType($word_of_p_stmt);} ?></td>
                    </tr>
                    <tr>
                        <td>Academic recommendation letter: </td>
                        <td><?php if(!empty($acad_r_letter)) {checkFileType($acad_r_letter);} ?></td>
                    </tr>
                    <tr>
                        <td>Professional recommendation letter: </td>
                        <td><?php if(!empty($prof_r_letter)) {checkFileType($prof_r_letter);}?></td>
                    </tr>
                </tbody>
            </table>
       
            </div>
            
    <?php
        if($assigned_to == FALSE and $_SESSION['level'] == 'admin'){
          //  if($_SESSION['assigned_status'] == $_SESSION['student_id']){
               // echo '<br>This student has been assigned to a staff';
           // }else{
                echo "<h3>Assign to a staff</h3>";
                if ($result->num_rows > 0) {
                    echo "<table class=\"ui celled table\"><thead><tr><th>Username</th><th>Email</th><th>No Work Assigned</th><th>Assign</th></tr><thead>";
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row["username"]. "</td><td>".$row["email"]."</td><td>".$row["no_work_assigned"]."</td><td><form action=\"assign.php\" method=\"POST\"><input type=\"hidden\" name=\"assign\" value=\"" . $row["id"] . "\"><button class=\"ui button\" type=\"submit\">Assign</button></td></form></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No staff yet";
            }
            
        }else{
            echo "<br>This student has been assigned to a staff";
            
        }

    
    if($status != 'completed'){
    ?>
        <div class="ui message blue">
    <div class="ui stackable eight column grid">
        <div class="eight wide column">
            <form action="status.php" method="POST">
            <p>If you are through with this student mark as 
            <input type="hidden" name="complete" value="completed">
                <button type="submit" class="ui right button green"> Completed</button>
            </p>
            </form>
        </div>
        <div class="eight wide column">
        <form action="status.php" method="POST">
            <p>You have any difficulties set the status to
            <input type="hidden" name="pending" value="pending"> 
            <button type="submit" class="ui right button blue">Pending</button></p>
        </form>
        </div>
    </div>
     
    </div>
    <?php
    }
    ?>

    
   
    </div>
<script src="js/jquery.min.js"></script>
<script src="semantic/dist/semantic.min.js"></script>
<script src="js/datepicker.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>