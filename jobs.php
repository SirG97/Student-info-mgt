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
        <a href="staff.php">Staffs</a>
        <a href="logout.php">Logout</a>
    </div>
      
      <div class="main-content">
          <!-- <div class="ui menu">
              <div class="header item">
                Our Company
              </div>
              <a class="item">
                About Us
              </a>
              <a class="item">
                Jobs
              </a>
              <a class="item">
                Locations
              </a>
          </div> -->
          
		<div class="table-container">
		<?php
			require 'search.php';
		?>

			<table class="ui celled sortable striped table">
				<thead>
				<th>id</th>
				<th>Name</th>
				<th>Date Of Birth</th>
				<th>Country</th>
				<!-- <th>Date Applied</th> -->
				<th>Status</th>
				<th>Action</th>
				<thead>
				<tbody>
				<?php
				// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					} 

					$sql = "SELECT * FROM students";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						//echo "<table><tr><th>ID</th><th>Name</th></tr>";
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<tr><td>".$row["id"]."</td><td>".$row["surname"]." ".$row["othername"]."</td><td>". $row["dob"] . "</td><td>" . $row["country"] . "</td><td class=\"positive\">". $row["status"] ."</td><td><a class=\"ui button green\" href='student.php?student_id=" . $row['student_id'] . "' >view more</a></td></tr>";
						}
						//echo "</table>";
					} else {
						echo "0 results";
					}
					$conn->close();
				?>
					
				</tbody>
			</table>
		</div>
      </div>
<script src="js/jquery.min.js"></script>
<script src="semantic/dist/semantic.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>