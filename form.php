<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="semantic/dist/semantic.min.css"/>
    <link rel="stylesheet" href="css/datepicker.min.css">

    <link rel="stylesheet" href="css/style.css">
    <title>SIG</title>
    
</head>
<body>
    <div class="mysidebar">
      <div class="profile">
      <img src="images/logo.jpg" alt="profile picture" style="height:150px; width:150px;">
      </div>

        <a href="admin.php">Dashboard</a>
        <a class="active" href="form.php" >Add new Students</a>
        <a href="jobs.php">Manage Students</a>
        <a href="staff.php">Staffs</a>
        <a href="logout.php">Logout</a>
    </div>
      
<div class="main-content">
    <div class="ui menu">
        <div class="header item">
        Our Company
        </div>
    </div>
    <div class="ui container padding">
        <h2 class="ui header">International students application form</h2>
        <div class="tab">
            <div class="ui attached message panel-color">
                <div class="header header-color">
                    Section 1 - Applicants Details
                </div>
            </div>
    <form enctype="multipart/form-data" id="regForm" action="process_form.php" method="POST">
            <div class="ui form attached fluid segment">
        <div class="three fields">
            <div class="field three wide">
            <label>Title</label>
            <div class="ui form">
                <div class="field">
                  <select name="title">
                    <option value="">Title</option>
                    <option value="Mr">Mr.</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Miss">Miss</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="field eight wide">
            <label>Surname / Family Name</label>
            <input placeholder="Surname" type="text" required name="surname" oninput="this.className = ''">
            </div>
            <div class="field eight wide">
            <label>First / Given Name(s)</label>
            <input placeholder="Last Name" type="text" required name="othername" oninput="this.className = ''">
            </div>
        </div>
        <div class="three fields">
            <div class="field five wide">
                <label>Date of Birth</label>
                <input placeholder="MM/DD/YYYY" type="text" data-toggle="datepicker" required name="dob" oninput="this.className = ''">
            </div>
            <div class="field five wide">
                <label>Country of Permanent residence</label>
                <input placeholder="Country" type="text" name="country" oninput="this.className = ''">
                </div>
        </div>
            </div>
        </div>  
        <!--Section 1 ends-->
        <!--section 2 begins-->
        <div></div>
        <div class="tab">
            <div class="ui attached message panel-color">
                <div class="header header-color">
                    Section 2 - Proposed Course
                </div>
            </div>
            <div class="ui form attached fluid segment course">  
                <div class="bc">
                    <button class="ui primary button add-course-btn">
                            Add more
                    </button>
                </div>  
                    
                <div class="ui message">     
                    <div class="header">
                        Course 
                    </div>
                    <div class="four fields">
                            <div class="field five wide">
                                <label>Course or Subject Choice</label>
                                <input placeholder="Course" type="text" name="course_name[]">
                            </div>
                            <div class="field four wide">
                                <label>Proposed month/year of Entry</label>
                                <input placeholder="Year / Month" type="text" name="course_proposed_entry[]" >
                            </div>
                            <div class="field four wide">
                                <label>Proposed point of Entry(eg. 1,2,3)</label>
                                <input placeholder="Point of Entry" type="text" name="course_proposed_point_entry[]">
                            </div>
                            <div class="field three wide">
                                <label>Level(eg. HND, BSc, PG)</label>
                                <input placeholder="Last Name" type="text" name="course_level[]">
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div></div>
      <!--Section 2 ends-->
      <!--Section 3 starts-->
        <div class="tab">
            <div class="ui attached message panel-color">
                <div class="header header-color">
                    Section 3 - Further Applicants Details
                </div>
            </div> 
            <div class="ui form attached fluid segment">
            <div class="ui message">
                    <div class="two fields">
                            <div class="field fourteen wide">
                                <label>Permanent address of applicant</label>
                                <input placeholder="Course" type="text" name="user_address">
                            </div>
                            <div class="field four wide">
                                <label>Postcode</label>
                                <input placeholder="Postcode" type="text" name="post_code">
                            </div>
                    </div>
            </div>
            <div class="ui message">
                    <div class="two fields">
                            <div class="field fourteen wide">
                                <label>Correspondence address(if different) / Agent address</label>
                                <input placeholder="Course" type="text" name="agent_address">
                            </div>
                            <div class="field four wide">
                                <label>Postcode</label>
                                <input placeholder="Postcode" type="text" name="agent_post_code">
                            </div>
                    </div>
            </div>
            </div>
        </div> 
        <!--Section 3 ends-->
        <!--Section 4 starts here-->
        <div></div>
        <div class="tab">
            <div class="ui attached message panel-color">
                <div class="header header-color">
                    Section 4 - Qualifications
                </div>
            </div>
            <div class="ui form attached fluid segment qualification"> 
                    <button class="ui primary button add-qualification-btn">
                            Add more qualifications
                    </button>
                <div class="ui message">
                <div class="five fields">
                        <div class="field five wide">
                            <label>Name of qualification(including awarding body)</label>
                            <input placeholder="Qualifications" type="text" name="q_name[]">
                        </div>
                        <div class="field four wide">
                            <label>Name of school/college/university</label>
                            <input placeholder="School" type="text" name="q_institution[]">
                        </div>
                        <div class="field three wide">
                            <label>Duration of study</label>
                            <input placeholder="Duration" type="text" name="q_duration[]">
                        </div>
                        <div class="field two wide">
                            <label>Date obtained</label>
                            <input placeholder="Date Obtained" type="text" name="q_date[]">
                        </div>
                        <div class="field two wide">
                            <label>Result</label>
                            <input placeholder="Result" type="text" name="q_result[]">
                        </div>
                </div>
                </div>
            </div> 
        </div>
        <!--Section 4 ends here-->
        <!--Section 5 starts here-->
        <div></div>
        <div class="tab">
            <div class="ui attached message panel-color">
                <div class="header header-color">
                    Section 5 - Working Experience
                </div>
            </div>
            <div class="ui form attached fluid segment work-experience">
                    <button class="ui primary button add-workexperience-btn">
                            Add more work experience
                    </button>
                <div class="ui message">
                <div class="five fields">
                        <div class="field four wide">
                                <label>Name of employer/training body</label>
                                <input placeholder="Employer" type="text" name="e_name[]">
                        </div>
                        <div class="field four wide">
                            <label>Job title & nature of work</label>
                            <input placeholder="job Title" type="text" name="e_job_title[]">
                        </div>
                        <div class="field two wide">
                            <label>From</label>
                            <input placeholder="From" type="text" name="e_from[]">
                        </div>
                        <div class="field two wide">
                            <label>To</label>
                            <input placeholder="To" type="text" name="e_to[]">
                        </div>
                        <div class="field two wide">
                            <label>Full / Part Time</label>
                            <input placeholder="Full or Part Time" type="text" name="e_job_type[]">
                        </div>

                </div>
                </div>
            </div>
        </div>
        <!--Section 5 ends here-->
        <!--Section 6 starts here-->
        <div></div>
        <div class="tab">
            <div class="ui attached message panel-color">
                <div class="header header-color">
                    Section 6 - Funding
                </div>
            </div>
            <div class="ui form attached fluid segment">
                    <div class="ui form">
                        <div class="inline fields" id="append-sponsor" >
                            <label>Who will sponsor your education</label>
                            <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="sponsor" checked id="sponsordetail1" value="Myself">
                                <label>Yourself</label>
                            </div>
                            </div>
                            <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="sponsor" id="sponsordetail2" value="">
                                <label>Sponsor</label>
                            </div>
                            </div>
                            <div class="field" id="sponsordetailcontainer">
                            <label>Please give details</label>
                            <input type="text" placeholder="Sponsor detail" name="sponsordetail"></div>
                        </div>
                    </div>
            </div>
        </div>
        <!--Section 6 ends here-->

        <!--Section 7 starts here-->
        <div></div>
        <div class="tab">
            <div class="ui attached message panel-color">
                <div class="header header-color">
                    Section 7 - English Qualifications
                </div>
            </div>
            <div class="ui form attached fluid segment">
                <div class="two fields">
                    <div class="field eight wide">
                        <label>TOEFL/IELTS/Other score</label>
                        <input placeholder="Score" type="text" name="toefl_score">
                    </div>
                    <div class="field eight wide">
                        <label>Date Obtained</label>
                        <input placeholder="MM/DD/YYY" type="text" data-toggle="datepicker" name="toefl_date">
                    </div>
                </div>
                    
            </div>
        </div>
        <!--Section 7 ends here-->

<!-- Circles which indicates the steps of the form: -->
<div style="text-align:center;margin-top:40px;">
    <span class="step">1</span>
    <span class="step">2</span>
    <span class="step">3</span>
    <span class="step">4</span>
    <span class="step">5</span>
    <span class="step">6</span>
    <span class="step">7</span>

  </div>

<div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" class="ui button grey" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" class="ui button blue" onclick="nextPrev(1)">Next</button>
      <button type="submit" id="submit" class="ui button blue" style="display: none">Submit</button>
    </div>
  </div>
    </div>
</div>


<script src="js/jquery.min.js"></script>
<script src="semantic/dist/semantic.min.js"></script>
<script src="js/datepicker.min.js"></script>
<script src="js/script.js"></script>
<script src="js/validate.js"></script>
<script src="upload.js"></script>
</body>
</html>