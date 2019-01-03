<?php 
session_start();
require_once 'dbconn.php';
$assign = trim($_POST['assign']);
//get username of the staff you want to assign the student to
$getUsername = "SELECT username FROM staff WHERE id=". $assign;
//update the number of work which you have assigned this staff
$assignedWorkCount = "UPDATE staff SET `no_work_assigned` = `no_work_assigned` + 1 WHERE id=". $assign;

$uResult = $conn->query($getUsername);

if ($uResult->num_rows > 0) {
    while($row = $uResult->fetch_assoc()) {
        $staffusername = $row["username"];
        echo $staffusername;
    }
    if ($conn->query($assignedWorkCount) === TRUE) {
        //Update the table of the student to reflect the staff you have assigned to him.
        $updateStaffForStudent = "UPDATE students SET `status` ='assigned', assigned_to= '". $staffusername ."' WHERE student_id ='" . $_SESSION['student_id'] ."'";
        if ($conn->query($updateStaffForStudent) === TRUE) {
                $_SESSION['success'] = "Student assigned successfully";
               $_SESSION['assigned_status'] = $_SESSION['student_id'];
               header('Location: student.php');
        } else {
            echo "Couldn't update student record with staff assigned to him: " . $conn->error;
        }
    } else {
        echo "Couldn't assign student to this staff: " . $conn->error;
    }
} else {
    echo "Couldn't get staff info: " . $conn->error;
}

$conn->close();

?>