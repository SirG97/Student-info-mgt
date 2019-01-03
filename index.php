<?php
session_start();
// Check if the user is already logged in, if yes then redirect him to 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: admin.php");
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
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
    <style type="text/css">
        body {
          background-color: #DADADA;
        }
        body > .grid {
          height: 100%;
        }
        .column {
          max-width: 450px;
        }
      </style>
</head>
<body>
  <div class="ui middle aligned center aligned grid">
    <div class="column">
      <h2 class="ui black image header">
        <!-- logo goes here -->
        
      </h2>
     
      
      
      <?php 
        if(isset($_SESSION['error'])){
            echo '<div class="ui error message">';
            echo $_SESSION['error'];
            echo '</div>';
           unset($_SESSION['error']);
           }
      ?>
     
        <form class="ui large form" action="process_login.php" method="POST">

      <!-- <div class="ui error message">
      
      </div> -->
        <div class="ui stacked segment">
        <img src="images/logo.jpg" alt="" style="height:80px; width:80px;">
          <div class="field">
            <div class="ui left icon input">
              <i class="user icon"></i>
              <input type="text" name="username" placeholder="Username">
            </div>
          </div>
          <div class="field">
            <div class="ui left icon input">
              <i class="lock icon"></i>
              <input type="password" name="password" placeholder="Password">
            </div>
          </div>
          <div class="ui fluid large black submit button">Login</div>
        </div>
  
        </form>
    </div>
  </div>
<script src="js/jquery.min.js"></script>
<script src="semantic/dist/semantic.min.js"></script>
<script src="js/datepicker.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>