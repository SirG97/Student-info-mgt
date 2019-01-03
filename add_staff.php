<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "applications";

try{
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //   $staff_username = test_input($_POST["username"]);
    //   $staff_password = test_input($_POST["password"]);
    //   $staff_password = md5($staff_password);
    // }

    // function test_input($data) {
    //     $data = trim($data);
    //     $data = stripslashes($data);
    //     $data = htmlspecialchars($data);
    //     return $data;
    // }
 
// Define variables and initialize with empty values
$username = $password = $email = $name = $level = "";
$username_err = $password_err = $name_err = $level_err = $email_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM staff WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter name";     
    } else{
        $name = trim($_POST["name"]);
    }

    if(empty(trim($_POST["level"]))){
        $level_err = "Please enter name";     
    } else{
        $level = trim($_POST["level"]);
    }

    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email";     
    } else{
        $email = trim($_POST["email"]);
    }


    
    // Validate confirm password
    // if(empty(trim($_POST["confirm_password"]))){
    //     $confirm_password_err = "Please confirm password.";     
    // } else{
    //     $confirm_password = trim($_POST["confirm_password"]);
    //     if(empty($password_err) && ($password != $confirm_password)){
    //         $confirm_password_err = "Password did not match.";
    //     }
    // }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($name_err) && empty($level_err) && empty($email_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO staff (name, username, email, password, level) VALUES (:name, :username, :email, :password, :level)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name, PDO::PARAM_STR);
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":level", $param_level, PDO::PARAM_STR);
            
            // Set parameters
            $param_name = $name;
            $param_username = $username;
            $param_password = md5($password);
            $param_email =$email;
            $param_level = $level;

             // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                $_SESSION['success'] = 'New Staff added successfully';
                header("location: staff.php");
            } else{
                $_SESSION['error'] = "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="semantic/dist/semantic.min.css"/>
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
    <style type="text/css">
        body {
          background-color: #DADADA;
        }
        /* body > .grid {
          height: 100%;
        } */
        .column {
          max-width: 450px;
        }
      </style>
</head>
<body>
<div class="mysidebar">
      <div class="profile">
      <img src="images/logo.jpg" alt="profile picture" style="height:150px; width:150px;">
      <p style="color: white;">Welcome <strong><?php echo $_SESSION['username']; ?>!</strong> </p>
      </div>

        <a href="admin.php">Dashboard</a>
        <a href="form.php" class="">Add new Jobs</a>
        <a href="jobs.php">Manage Jobs</a>
        <a class="active" href="staff.php">Staff</a>
        <a href="logout.php">Logout</a>
    </div>
      
      <div class="main-content">
    <div class="wrapper">

    </div>
    <div class="ui middle aligned center aligned grid">
    <div class="column">
      <h2 class="ui teal image header">
        <!-- logo goes here -->
        <div class="content">
          Sign up new staff
        </div>
      </h2>
      <form class="ui large form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="dberror"></div>
      <div class="ui error message"></div>
        <div class="ui stacked segment">
		<div class="field">
            <div class="ui left icon input">
              <i class="user icon"></i>
              <input type="text" name="name" placeholder="Name" required>
              <div><?php echo $name_err ?></div>
            </div>
          </div>
		  
		  <div class="field">
            <div class="ui left icon input">
              <i class="user icon"></i>
              <input type="text" name="username" placeholder="Username" required>
              <div class="error"><?php echo $username_err ?></div>
            </div>
          </div>

          <div class="field">
            <div class="ui left icon input">
              <i class="user icon"></i>
              <input type="text" name="email" placeholder="Email" required>
              <div class="error"><?php echo $email_err ?></div>
            </div>
          </div>

          <div class="field">
            <div class="ui left icon input">
              <i class="lock icon"></i>
              <input type="password" name="password" placeholder="Password" required>
              <div class="error"><?php echo $password_err ?></div>
            </div>
          </div>
          
          <!-- <div class="ui form"> -->
            <div class="field">
                <select name="level">
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
                </select>
            </div>
          <!-- </div> -->

          <button type="submit" class="ui fluid large blue submit button">Login</button>
        </div>
  
      </form>
    </div>
  </div>  
    </div>
<script src="js/jquery.min.js"></script>
<script src="semantic/dist/semantic.min.js"></script>
<script src="js/script.js"></script>  
</body>
</html>