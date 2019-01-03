<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
<?php require_once 'dbconn.php'; ?>

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
      

        <a class="active" href="admin.php">Dashboard</a>
        <a href="form.php" class="">Add new Jobs</a>
        <a href="jobs.php">Manage Jobs</a>
        <a href="staff.php">Staff</a>
        <a href="logout.php">Logout</a>
    </div>
      
      <div class="main-content"> 
            
            <div class="table-container">
            <?php
                 require 'search.php';
                ?>
              <?php
                //   if(!empty($_POST['q'])){
                    $q = htmlspecialchars($_REQUEST['q']);
                      $sql = "SELECT * FROM students WHERE surname LIKE '%" . $q . "%'";
                    //   die('shit happens');
                      $result = $conn->query($sql);
                      if($result == true){
                          //die('success');
                      }else{
                         // die('failure');
                      }
                //   }else{
                      
                //   }
              ?>
               
            <table class="ui celled table">
                <thead>
                  <tr>
                  <th>S/N</th>
                  <th>Name</th>
                  <th>Assigned on</th>
                  <th>Status</th>
                  <th>Action</th>
                  </tr></thead>
                <tbody>
                <?php
                  // Create connection
                
                  function statusColor(){
                    if($row['status'] == 'unassigned'){
                        echo 'red';
                    }elseif($row['status'] == 'pending'){
                      echo 'yellow';
                    }elseif($row['status'] == 'assigned' or $row['status'] == 'completed'){
                        echo 'green';
                   
                    }
                  }
                  if ($result->num_rows > 0) {
                    //echo "<table><tr><th>ID</th><th>Name</th></tr>";
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                      echo "<tr><td>".$row["id"]."</td><td>".$row["surname"]." ".$row["othername"]."</td><td>". $row["dob"] . "</td><td class=\"";
                      if($row['status'] == 'unassigned'){
                        echo 'negative';
                      }elseif($row['status'] == 'pending'){
                        echo 'warning';
                      }elseif($row['status'] == 'assigned' or $row['status'] == 'completed'){
                          echo 'positive';
                    
                      }
                      echo "\">". $row["status"] ."</td><td><a class=\"ui button green\" href='student.php?student_id=" . $row['student_id'] . "' >view more</a></td></tr>";
                    }
                    //echo "</table>";
                  } else {
                    echo "No result found";
                  }
                  $conn->close();
                ?>
                 
              </table>
            </div>
      </div>
<script src="js/jquery.min.js"></script>
<script src="semantic/dist/semantic.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>