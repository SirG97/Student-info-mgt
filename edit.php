<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "applications";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>

 <?php
// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

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
      <p style="color: white;">Welcome <strong><?php echo $_SESSION['username']; ?>!</strong> </p>
      </div>

        <a href="admin.php">Dashboard</a>
        <a href="form.php" class="">Add new Jobs</a>
        <a class="active" href="jobs.php">Manage Jobs</a>
        <a href="staff.php">Staff</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="main-content">
    <div class="ui container padding">
        <h2 class="ui header">International students application form</h2>
        <?php
            if(isset($_SESSION['success'])){
                echo '<div class="ui message tiny green"> <i class="close icon"></i>
                <div class="header">Success!</div><p>';
                 echo $_SESSION["success"];
                 echo '</p></div>';
             unset($_SESSION['success']);
        
            }
        ?>
                
        <form id="regForm" action="process_edit.php" method="POST">
            <div class="ui attached message panel-color">
                <div class="header header-color">
                Update Student's information
                </div>
            </div>

            <div class="ui form attached fluid segment">
        <div class="three fields">
            <div class="field three wide">
            <label>Title</label>
            <div class="ui form">
                <div class="field">
                  <select name="title">
                    <option value="Mr" <?php if($title == 'Mr'){ echo 'selected';} ?>>Mr.</option>
                    <option value="Mrs" <?php if($title == 'Mrs'){ echo 'selected';} ?>>Mrs</option>
                    <option value="Miss" <?php if($title == 'Miss'){ echo 'selected';} ?>>Miss</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="field eight wide">
            <label>Surname / Family Name</label>
            <input placeholder="Surname" type="text" required name="surname" value="<?php if($surname){echo $surname;} ?>" >
            </div>
            <div class="field eight wide">
            <label>First / Given Name(s)</label>
            <input placeholder="Last Name" type="text" required name="othername" value="<?php if($othername){echo $othername;} ?>">
            </div>
        </div>
        <div class="three fields">
            <div class="field five wide">
                <label>Date of Birth</label>
                <input placeholder="MM/DD/YYYY" type="text" data-toggle="datepicker" required name="dob" value="<?php if($dob){echo $dob;} ?>">
            </div>
            <div class="field five wide">
                <label>Country of Permanent residence</label>
                <input placeholder="Country" type="text" name="country" value="<?php if($country){echo $country;} ?>">
                </div>
        </div>
            </div>


             <div class="ui form attached fluid segment course">  
                <div class="bc">
                    <button class="ui primary button add-course-btn">
                            Add more course
                    </button>
                </div>  
                <?php
                $coursecount = count($courses);
                    for($i=0; $i < $coursecount; $i++){
                  ?>      
                <div class="ui message"> 
                    <button class="circular right floated ui icon button red close-btn" id="close-c-btn">
                        <i class="icon close"></i>
                    </button>
                    <div class="header"> Course </div>
                    <div class="four fields">
                        <div class="field five wide">
                            <label>Course or Subject Choice</label>
                            <input placeholder="Course" type="text" name="course_name[]" form="regForm" value="<?php echo $courses[$i]['course_name']; ?>">
                        </div>
                        <div class="field four wide">
                            <label>Proposed month/year of Entry</label>
                            <input placeholder="Year / Month" type="text" name="course_proposed_entry[]" form="regForm" value="<?php echo $courses[$i]['course_proposed_entry']; ?>">
                        </div>
                        <div class="field four wide">
                            <label>Proposed point of Entry(eg. 1,2,3)</label>
                            <input placeholder="Point of Entry" type="text" name="course_proposed_point_entry[]" form="regForm" value="<?php echo $courses[$i]['course_proposed_point_entry']; ?>">
                        </div>
                        <div class="field three wide">
                            <label>Level(eg. HND, BSc, PG)</label>
                            <input placeholder="Last Name" type="text" name="course_level[]" form="regForm" value="<?php echo $courses[$i]["course_level"]; ?>">
                        </div>
                        
                    </div>
                </div>
                <?php
                    }
                ?>
        </div>
                
                
                <div class="ui form attached fluid segment">
                <div class="ui message">
                        <div class="two fields">
                                <div class="field fourteen wide">
                                    <label>Permanent address of applicant</label>
                                    <input placeholder="Course" type="text" name="user_address" value="<?php echo $u_address; ?>">
                                </div>
                                <div class="field four wide">
                                    <label>Postcode</label>
                                    <input placeholder="Postcode" type="text" name="post_code" value="<?php echo $post_code; ?>">
                                </div>
                        </div>
                </div>
                <div class="ui message">
                        <div class="two fields">
                                <div class="field fourteen wide">
                                    <label>Correspondence address(if different) / Agent address</label>
                                    <input placeholder="Course" type="text" name="agent_address" value="<?php echo $a_address; ?>">
                                </div>
                                <div class="field four wide">
                                    <label>Postcode</label>
                                    <input placeholder="Postcode" type="text" name="agent_post_code" value="<?php echo $a_post_code; ?>">
                                </div>
                        </div>
                </div>
                </div>

                
                <div class="ui form attached fluid segment qualification">
                    <button class="ui primary button add-qualification-btn">
                            Add more qualifications
                    </button>
                <?php
                    $qualificationcount = count($qualification);
                    for($i=0; $i < $qualificationcount; $i++){
                ?>
                <div class="ui message">
                <button class="circular right floated ui icon button red close-btn" id="close-q-btn">
                    <i class="icon close"></i>
                </button>
                <div class="five fields">
                        <div class="field five wide">
                            <label>Name of qualification(with awarding body)</label>
                            <input placeholder="Qualifications" type="text" name="q_name[]" form="regForm" value="<?php echo $qualification[$i]['Qualification']; ?>">
                        </div>
                        <div class="field four wide">
                            <label>Name of school/college/university</label>
                            <input placeholder="School" type="text" name="q_institution[]" form="regForm" value="<?php echo $qualification[$i]['Institution']; ?>">
                        </div>
                        <div class="field three wide">
                            <label>Duration of study</label>
                            <input placeholder="Duration" type="text" name="q_duration[]" form="regForm" value="<?php echo $qualification[$i]['Duration']; ?>">
                        </div>
                        <div class="field two wide">
                            <label>Date obtained</label>
                            <input placeholder="Date Obtained" type="text" name="q_date[]" form="regForm" value="<?php echo $qualification[$i]["Date"]; ?>">
                        </div>
                        <div class="field two wide">
                            <label>Result</label>
                            <input placeholder="Result" type="text" name="q_result[]" form="regForm" value="<?php echo $qualification[$i]["Result"]; ?>">
                        </div>
                </div>
                </div>
                <?php } ?>
            </div> 


            <div class="ui form attached fluid segment work-experience">
                <button class="ui primary button add-workexperience-btn">
                    Add more Experience
                </button>
                <?php  
                    $experiencecount = count($experience);
                    for($i=0; $i < $experiencecount; $i++){
                ?>
                <div class="ui message">
                    <button class="circular right floated ui icon button red close-btn" id="close-e-btn">
                        <i class="icon close"></i>
                    </button>
                   
                    <div class="five fields">
                            <div class="field four wide">
                                    <label>Name of employer/training body</label>
                                    <input placeholder="Employer" type="text" name="e_name[]" form="regForm" value="<?php echo $experience[$i]['Employer'];?>">
                                </div>
                                <div class="field four wide">
                                <label>Job title & nature of work</label>
                                <input placeholder="Date Obtained" type="text" name="e_job_title[]" form="regForm" value="<?php echo $experience[$i]['Job_Title'];?>">
                            </div>
                            <div class="field two wide">
                                <label>From</label>
                                <input placeholder="From" type="text" name="e_from[]" form="regForm" value="<?php echo $experience[$i]["From"];?>">
                            </div>
                            <div class="field two wide">
                                <label>To</label>
                                <input placeholder="To" type="text" name="e_to[]" form="regForm" value="<?php echo $experience[$i]["To"];?>">
                            </div>
                            <div class="field three wide">
                                <label>Full / Part Time</label>
                                <select name="e_job_type[]" form="regForm">
                                    <option value="Full Time" <?php if($experience[$i]['Job_Type'] == 'Full Time'){echo 'selected';} ?>>Full Time</option>
                                    <option value="Part Time" <?php if($experience[$i]['Job_Type'] == 'Part Time'){echo 'selected';} ?>>Part Time</option>
                                </select>
                                
                            </div>
                    </div>
                </div>
                    <?php
                    }
                    ?>
            </div>
                 <div class="ui form attached fluid segment">
                    <div class="ui form">
                        <div class="inline fields" id="append-sponsor" >
                            <label>Who will sponsor your education</label>
                            <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="sponsor" <?php if($sponsor == 'Myself'){echo 'checked'; } ?> id="sponsordetail1" value="Myself">
                                <label>Yourself</label>
                            </div>
                            </div>
                            <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="sponsor" id="sponsordetail2" <?php if($sponsor != 'Myself'){echo 'checked';}  ?> value="">
                                <label>Sponsor</label>
                            </div>
                            </div>
                            <?php //if($sponsor != 'Myself'//){ ?>
                            <div class="field" id="sponsordetailcontainer">
                                <label>Please give details</label>
                                <input type="text" placeholder="Sponsor detail" name="sponsordetail" value="<?php $sponsor_detail ?>"></div>
                            </div>
                                <?php //} ?>
                    </div>
            </div>
            <div class="ui form attached fluid segment">
                <div class="two fields">
                    <div class="field eight wide">
                        <label>TOEFL/IELTS/Other score</label>
                        <input placeholder="Score" type="text" name="toefl_score" value="<?php echo $toefl_score?>">
                    </div>
                    <div class="field eight wide">
                        <label>Date Obtained</label>
                        <input placeholder="MM/DD/YYY" type="text" data-toggle="datepicker" name="toefl_date" value="<?php echo $toefl_date ?>">
                    </div>
                </div>
                    
            </div>
        <button type="submit" id="submit" class="ui button blue" style="float: right">Update</button>
        </form>
    </div>
<script src="js/jquery.min.js"></script>
<script src="semantic/dist/semantic.min.js"></script>
<script src="js/datepicker.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>