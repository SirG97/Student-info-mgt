<?php 
session_start();
    if(!isset($_SESSION['success']) and !isset($_SESSION['student_id'])){
        header('Location: form.php');
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
        <a class="active" href="form.php" class="">Add new Jobs</a>
        <a href="jobs.php">Manage Jobs</a>
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
        <h2 class="ui header">International students document attachment</h2>
        <h4><?php if(isset($_SESSION['success'])){
                    echo $_SESSION['success']; 
                    unset($_SESSION['success']);
                    echo $_SESSION['student_id'];
                    } ?>
        </h4>
	<div class="ui mini message">
                
    </div>
    <form enctype="multipart/form-data" id="regForm" action="upload_parser.php" method="POST">
            <div class="ui grid">
            <div class="sixteen wide column"> 
                <div class="ui attached message panel-color">
                    <div class="header header-color">
                        Attach documents
                    </div>
                </div>
                <div class="ui form attached fluid segment">
                    <div class="sixteen fields">
                    <div class="field eight wide">
                            <div class="ui placeholder segment">
                                <div class="ui icon">
                                    passport
                                </div>
                                <input type="file" class="ui primary button" name="passport" id="passport" onchange="uploadFile(this.id, 'passport');">
                                <div class="ui small blue progress" id="passport_status">
                                    <div class="bar">
                                        <div class="progress"></div>
                                        <div class="label"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field eight wide">
                            <div class="ui placeholder segment">
                                <div class="ui icon">
                                    Attach personal statement
                                </div>
                                <input type="file" class="ui primary button" name="p_statement" id="p_stmt" onchange="uploadFile(this.id, 'p_statement');">
                                <div class="ui small blue progress" id="p_stmt_status">
                                    <div class="bar">
                                        <div class="progress"></div>
                                        <div class="label"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="field eight wide">
                            <div class="ui placeholder segment">
                                <div class="ui icon">
                                    Reference letter 1
                                </div>
                                <input type="file" class="ui primary button" id="rf1" name="rf_letter1" onchange="uploadFile(this.id, 'rf_letter1');">
                                <div class="ui small blue progress" id="rf1_status">
                                    <div class="bar">
                                        <div class="progress"></div>
                                        <div class="label"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field eight wide">
                                <div class="ui placeholder segment">
                                    <div class="ui icon">
                                        Reference letter 2
                                    </div>
                                    <input type="file" class="ui primary button" id="rf2" name="rf_letter2" onchange="uploadFile(this.id, 'rf_letter2');">
                                    <div class="ui small blue progress" id="rf2_status">
                                    <div class="bar">
                                        <div class="progress"></div>
                                        <div class="label"></div>
                                    </div>
                                </div>
                                </div>
                            </div>
                    </div>
				<div class="sixteen fields">
                    <div class="field eight wide">
                        <div class="ui placeholder segment">
                            <div class="ui icon">
                                International Passport
                            </div>
                            <input type="file" class="ui primary button" name="int_passport" id="int_passport" onchange="uploadFile(this.id, 'int_passport');">
                            <div class="ui small blue progress" id="int_passport_status">
                                    <div class="bar">
                                        <div class="progress"></div>
                                        <div class="label"></div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="field eight wide">
                        <div class="ui placeholder segment">
                            <div class="ui icon">
                                S.S.C.E Result
                            </div>
                            <input type="file" class="ui primary button" name="ssce" id="ssce" onchange="uploadFile(this.id, 'ssce');">
                            <div class="ui small blue progress" id="ssce_status">
                                    <div class="bar">
                                        <div class="progress"></div>
                                        <div class="label"></div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="field eight wide">
                        <div class="ui placeholder segment">
                            <div class="ui icon">
                                Testimonial / Recommendation letter
                            </div>
                            <input type="file" class="ui primary button" id="testimonial" name="testimonial" onchange="uploadFile(this.id, 'testimonial');">
                            <div class="ui small blue progress" id="testimonial_status">
                                    <div class="bar">
                                        <div class="progress"></div>
                                        <div class="label"></div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="field eight wide">
                        <div class="ui placeholder segment">
                            <div class="ui icon">
                                200 words of personal statement
                            </div>
                            <input type="file" class="ui primary button" id="word_of_p_stmt" name="word_of_p_stmt" onchange="uploadFile(this.id,'word_of_p_stmt');">
                            <div class="ui small blue progress" id="word_of_p_stmt_status">
                                    <div class="bar">
                                        <div class="progress"></div>
                                        <div class="label"></div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
				
			<div class="ui mini message red">
                 For post graduate only
            </div>
            <div class="sixteen fields">
            <div class="field eight wide">
                    <div class="ui placeholder segment">
                        <div class="ui icon">
                            Degree Result 
                        </div>
                        <input type="file" class="ui primary button" id="degree" name="degree" onchange="uploadFile(this.id, 'degree');">
                        <div class="ui small blue progress" id="degree_status">
                                    <div class="bar">
                                        <div class="progress"></div>
                                        <div class="label"></div>
                                    </div>
                                </div>
                    </div>
                </div>
                <div class="field eight wide">
                    <div class="ui placeholder segment">
                        <div class="ui icon">
                            Transcript
                        </div>
                        <input type="file" class="ui primary button" id="transcript" name="transcript" onchange="uploadFile(this.id, 'transcript');">
                        <div class="ui small blue progress" id="transcript_status">
                            <div class="bar">
                                <div class="progress"></div>
                                <div class="label"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field eight wide">
                    <div class="ui placeholder segment">
                        <div class="ui icon">
                            Academic recommendation letter
                        </div>
                        <input type="file" class="ui primary button" id="acad" name="acad_r_letter" onchange="uploadFile(this.id, 'acad_r_letter');">
                        <div class="ui small blue progress" id="acad_status">
                            <div class="bar">
                                <div class="progress"></div>
                                <div class="label"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field eight wide">
                        <div class="ui placeholder segment">
                            <div class="ui icon">
                                Professional recommendation letter
                            </div>
                            <input type="file" class="ui primary button" id="prof" name="prof_r_letter" onchange="uploadFile(this.id, 'prof_r_letter');">
                            <div class="ui small blue progress" id="prof_status">
                                    <div class="bar">
                                        <div class="progress"></div>
                                        <div class="label"></div>
                                    </div>
                                </div>
                        </div>
                    </div>
                <div class="field eight wide">
                    <div class="ui placeholder segment">
                        <div class="ui icon">
                            200 words of personal statement
                        </div>
                        <input type="file" class="ui primary button" id="p_word" name="p_word_of_p_stmt" onchange="uploadFile(this.id, 'p_word_of_p_stmt');">
                        <div class="ui small blue progress" id="p_word_status">
                            <div class="bar">
                                <div class="progress"></div>
                                <div class="label"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
				
                </div>
            </div>
    <!--Section 8 ends here-->


    </div>
</div>


<script src="js/jquery.min.js"></script>
<script src="semantic/dist/semantic.min.js"></script>
<script src="js/datepicker.min.js"></script>
<script src="js/script.js"></script>
<script src="upload.js"></script>
</body>
</html>