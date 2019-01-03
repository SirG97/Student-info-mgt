<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "applications";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
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
        <a href="jobs.php">Manage Jobs</a>
        <a class="active" href="staff.php">Staffs</a>
        <a href="logout.php">Logout</a>
    </div>
      
      <div class="main-content">
          
      <div class="staff-container">
      <h2>Staffs</h2>
      <?php
        $sql = "SELECT * FROM staff";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class=\"ui celled table\"><thead><tr><th>Name</th><th>Username</th><th>Email</th><th>Level</th></tr><thead>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["name"]."</td><td>".$row["username"]. "</td><td>".$row["email"]."</td><td>".$row["level"]."</td></tr>";
            }
            echo "<tfoot class=\"full-width\"><tr><th colspan=\"4\"><a class=\"ui right floated small primary icon button\" href=\"add_staff.php\">Add New Staff</a></th></tr></tfoot></table>";
        } else {
            echo "0 results";
        }
        $conn->close();
      ?>
      <!-- <table class="ui celled table">
        <thead>
          <tr><th>Name</th>
          <th>Age</th>
          <th>Job</th>
        </tr></thead>
        <tbody>
          <tr>
            <td data-label="Name">James</td>
            <td data-label="Age">24</td>
            <td data-label="Job">Engineer</td>
          </tr>
          <tr>
            <td data-label="Name">Jill</td>
            <td data-label="Age">26</td>
            <td data-label="Job">Engineer</td>
          </tr>
          <tr>
            <td data-label="Name">Elyse</td>
            <td data-label="Age">24</td>
            <td data-label="Job">Designer</td>
          </tr>
        </tbody>
        <tfoot class="full-width">
          <tr>
            
            <th colspan="4">
                <a class="ui right floated small primary icon button" href="add_staff.php">Add New Staff</a>
            </th>
          </tr>
        </tfoot>
      </table> -->
    </div>
  </div>
<script src="js/jquery.min.js"></script>
<script src="semantic/dist/semantic.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
