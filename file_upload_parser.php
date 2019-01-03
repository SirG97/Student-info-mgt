<?php
session_start();

if(isset($_POST['submit'])){
	
	
    //personal statement
    $p_stmt = $_FILES['p_statement']['name'];
    $p_stmt_tmp = $_FILES['p_statement']['tmp_name'];
    $p_stmt_type = $_FILES['p_statement']['type'];
    $p_stmt_size = $_FILES['p_statement']['size'];

    //reference letter
    $rf_letter1 = $_FILES['rf_letter1']['name'];
    $rf_letter1_tmp = $_FILES['rf_letter1']['tmp_name'];
    $rf_letter1_type = $_FILES['rf_letter1']['type'];
    $rf_letter1_size = $_FILES['rf_letter1']['size'];

    $rf_letter2 = $_FILES['rf_letter2']['name'];
    $rf_letter2 = $_FILES['rf_letter2']['tmp_name'];
    $rf_letter2 = $_FILES['rf_letter2']['type'];
    $rf_letter2_size = $_FILES['rf_letter2']['size'];

    $ssce = $_FILES['ssce']['name'];
    $ssce_tmp = $_FILES['ssce']['tmp_name'];
    $ssce_type = $_FILES['ssce']['type'];
    $ssce_size = $_FILES['ssce']['size'];

    $testimonial = $_FILES['testimonial']['name'];
    $testimonial_tmp = $_FILES['testimonial']['tmp_name'];
    $testimonial_type = $_FILES['testimonial']['type'];
    $testimonial_size = $_FILES['testimonial']['size'];

    $word_of_p_stmt = $_FILES['word_of_p_stmt']['name'];
    $word_of_p_stmt_tmp = $_FILES['word_of_p_stmt']['tmp_name'];
    $word_of_p_stmt_type = $_FILES['word_of_p_stmt']['type'];
    $word_of_p_stmt_size = $_FILES['word_of_p_stmt']['size'];

    $transcript = $_FILES['transcript']['name'];
    $transcript_tmp = $_FILES['transcript']['tmp_name'];
    $transcript_type = $_FILES['transcript']['type'];
    $transcript_size = $_FILES['transcript']['size'];
    
    $acad_r_letter = $_FILES['acad_r_letter']['name'];
    $acad_r_letter_tmp = $_FILES['acad_r_letter']['tmp_name'];
    $acad_r_letter_type = $_FILES['acad_r_letter']['type'];
    $acad_r_letter_size = $_FILES['acad_r_letter']['size'];

    $prof_r_letter = $_FILES['prof_r_letter']['name'];
    $prof_r_letter_tmp = $_FILES['prof_r_letter']['tmp_name'];
    $prof_r_letter_type = $_FILES['prof_r_letter']['type'];
    $prof_r_letter_size = $_FILES['prof_r_letter']['size'];

    $p_word_of_personal_stmt = $_FILES['p_word_of_personal_stmt']['name'];
    $p_word_of_personal_stmt_tmp = $_FILES['p_word_of_personal_stmt']['tmp_name'];
    $p_word_of_personal_stmt_type = $_FILES['p_word_of_personal_stmt']['type'];
    $p_word_of_personal_stmt_size = $_FILES['p_word_of_personal_stmt']['size'];
	
	function checkerror(){
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($name);
		$uploadOk = 1;
		$type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		//if(isset($_POST["submit"])) {
			$check = getimagesize($tmp);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo $name . " is not an image.";
				$uploadOk = 0;
				return false;
			}
		//}
		// Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry," . $name ." file already exists.";
			$uploadOk = 0;
			return false;
		}
		// Check file size
		if ($size > 2000000) {
			echo "Sorry, ". $name ." is too large.";
			$uploadOk = 0;
			return false;
		}
		// Allow certain file formats
		if($type != "jpg" && $type != "png" && $type != "jpeg" && $type != "gif" ) {
			echo "Sorry, ". $name ." is not a JPG, JPEG, PNG file";
			$uploadOk = 0;
			return false;
		}
		
		return true;
	}
	
	function upload(){
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			$get_file_extension = explode(".", $target_file);
			$random = substr(md5(mt_rand()), 0, 25);
			$target_file = $random . '.' . end($get_file_extension);
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $target_file)) {
				echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br>";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}
	
	$check_p_stmt = checkerror($p_stmt, $p_stmt_tmp, $p_stmt_type, $p_stmt_size);
	$check_rf1 = checkerror($rf_letter1, $rf_letter1_tmp, $rf_letter1_type, $rf_letter1_size);
	$check_rf2 = checkerror($rf_letter2_stmt, $rf_letter2_tmp, $rf_letter2_type, $rf_letter2_size);
	$check_ssce = checkerror($ssce, $ssce_tmp, $ssce_type, $ssce_size);
	$check_testimonial = checkerror($testimonial, $testimonial_tmp, $testimonial_type, $testimonial_size);
	$check_p_stmt = checkerror($word_of_p_stmt, $word_of_p_stmt_tmp, $word_of_p_stmt_type, $word_of_p_stmt_size);
	$check_transcript = checkerror($transcript, $transcript_tmp, $transcript_type, $transcript_size);
	$check_acad_letter = checkerror($acad_r_letter, $acad_r_letter_tmp, $acad_r_letter_type, $acad_r_letter_size);
	$check_r_letter = checkerror($prof_r_letter, $prof_r_letter_tmp, $prof_r_letter_type, $prof_r_letter_size);
	$check_p_word_of_p_stmt = checkerror($p_word_of_personal_stmt, $p_stmt_tmp, $p_stmt_type, $p_stmt_size);
	
}

?>