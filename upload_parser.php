<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "applications";

		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

		$tmp = $_FILES["fileToUpload"]["tmp_name"];
		$type = $_FILES["fileToUpload"]["type"];
		$size = $_FILES["fileToUpload"]["size"];
		$columnToUpdate = $_POST['fname'];
		$student_id = $_SESSION['student_id'];
		$uploadOk = 1;
		$type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		//if(isset($_POST["submit"])) {
			if($type == "image/jpg" && $type == "image/png" && $type == "image/jpeg"){
				$check = getimagesize($tmp);
				if($check !== false) {
					//echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					echo "This is not an image.";
					$uploadOk = 0;
					
				}
			}

		//}
		// Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
			return false;
		}
		// Check file size
		if ($size > 200000) {
			echo "Sorry,the file is too large.";
			$uploadOk = 0;
			return false;
		}
		//Allow certain file formats
		if($type != "jpg" && $type != "png" && $type != "jpeg" && $type != "application/pdf" && $type != "doc" && $type!= "docx" ) {
			echo "Sorry, this file type is not supported";
			$uploadOk = 0;
			return false;
		}
		
				if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			$get_file_extension = explode(".", $target_file);
			$random = substr(md5(mt_rand()), 0, 25);
			$target_file = $random . '.' . end($get_file_extension);
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $target_file)) {
				try{
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					// set the PDO error mode to exception
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$stmt = $conn->prepare("SELECT * FROM documents WHERE student_id=:student_id LIMIT 1");
					// Parameterize the query 
					$stmt->bindValue(':student_id', $student_id, PDO::PARAM_STR); 

					// Execute the query and return the results into $row 
					$stmt->execute(); 
					$row = $stmt->fetch(PDO::FETCH_ASSOC);

					// Ensure that a row was returned 
					if ($row) { 
						// $sql = "UPDATE documents SET " . $columnToUpdate . "='" . $target_file . "' WHERE student_id=" . $student_id . "";

						try {
							$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
							// set the PDO error mode to exception
							$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						
							$sql = "UPDATE documents SET " . $columnToUpdate . "='" . $target_file . "' WHERE id=". $row['id'];
							// Prepare state
							$stmt = $conn->prepare($sql);
						
							// execute the query
							$stmt->execute();
						
							// echo a message to say the UPDATE succeeded
							 //echo $stmt->rowCount() . " records UPDATED successfully";
							//echo "The " .  $_POST["fname"] . " file ". basename( $_FILES["fileToUpload"]["name"]). " has been updated .<br>";
							echo "upload successful!";

							}
						catch(PDOException $e){
							//echo $sql . "<br>" . $e->getMessage();
							echo 'Upload failed!';
							}

					
					
					} else { 
						// Invalid username 
						$sql = "INSERT INTO documents (student_id," . $_POST['fname'] . ") VALUES(:student_id, :columndata)";
						$stmt = $conn->prepare($sql);
						$stmt->bindParam(':student_id', $student_id);
						$stmt->bindParam(':columndata', $target_file);
						$stmt->execute();
						//echo "The " .  $_POST["fname"] . " file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded .<br>";
						echo 'Upload Successful';
					}

					

				}catch(PDOException $e){

				}
				
				
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
		

?>