<?php
session_start();
require 'dbconn.php';

if(isset($_POST['complete'])){
    $setToCompleted  = "UPDATE students SET `status` ='completed' WHERE student_id ='" . $_SESSION['student_id'] ."'";
    if($conn->query($setToCompleted) === TRUE){
        $_SESSION['success'] = 'Congrats on completing this students application';
        //echo $_SESSION['success'];
        header('Location: student.php');
        exit();
    }else{
        $_SESSION['error'] = 'Sorry, we could\'nt complete this action right now. Please try again';
        header('Location: student.php');
        exit();
    }
    

}elseif(isset($_POST['pending'])){
    $setToPending = "UPDATE students SET `status` ='pending' WHERE student_id ='" . $_SESSION['student_id'] ."'";
    if($conn->query($setToPending) === TRUE){
        $_SESSION['success'] = 'This student\'s application has been marked as pending';
        header('Location: student.php');
        exit();
    }else{
        $_SESSION['error'] = 'Sorry, we could\'nt complete this action right now. Please try again';
        header('Location: student.php');
        exit();
    }
}