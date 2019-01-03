<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: admin.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "applications";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $staff_username = test_input($_POST["username"]);
      $staff_password = test_input($_POST["password"]);
      $staff_password = md5($staff_password);
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }



try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM staff WHERE username=:staff_username LIMIT 1");
    // Parameterize the query 
    $stmt->bindValue(':staff_username', $staff_username, PDO::PARAM_STR); 

    // Execute the query and return the results into $row 
    $stmt->execute(); 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Ensure that a row was returned 
    if ($row) { 
        // Confirm that the hashed username matches input as well 
        if($staff_password === $row['password']) { 
             // Successful login 
            $_SESSION['success'] = 'Log in successful';
            $_SESSION['loggedin'] = true;
            $_SESSION['level'] = $row['level'];
            $_SESSION['username'] = $row['username'];
            // echo $_SESSION['loggedIn'];
            header('Location: admin.php');

        } else { 
            // Invalid password 
            $_SESSION['error'] = 'Password does not match';
           // echo $_SESSION['error'];
            header('Location: index.php');
            exit();
        } 
    } else { 
        // Invalid username 
        $_SESSION['error'] = 'Username does not exist';
        //$_SESSION['error']);
       header('Location: index.php');
       exit();
    }

}catch(PDOExeception $e){
        // debug mode, simply echo the exception 
        echo $ex->getMessage(); 
}
