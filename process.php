<?php
include "conn.php";
// If the user clicked the "Finish" button, redirect to the winner page
session_start();
$error_message="";

// If the user submitted numbers, store them in the session
if(isset($_POST['submit']) || isset($_POST['finish']) && isset($_POST['numbers']) && isset($_POST['username'])) {
	$selected_numbers = $_POST['numbers'];
	$username = $_POST['username'];
	if($username=="" || empty($username)){
		$error_message = "Please enter your user name!";
		$_SESSION['message']=$error_message;
	header("Location: index.php");
	echo "H1";
	exit();
	}
	if(count($selected_numbers) != 6) {
		$error_message = "You must select exactly 6 numbers.";
		$_SESSION['message']=$error_message;
		/*if(!empty($_SESSION['lottery_numbers']))
		{
			$user_number = count($_SESSION['lottery_numbers'])+1;
			$message = "User $user_number, choose your numbers";
		}*/
		header('Location: index.php');
		exit();
    }
	 else {
		$sql = "SELECT * FROM user_tickets WHERE username = '$username'";
         $result = $conn->query($sql);
         if ($result->num_rows > 0) {
    // Username already exists, show an error message and redirect back to the index page
              $error_message="Username already exists! Please choose another one .";
			  $_SESSION['message']=$error_message;
		//	  echo "prob exist!";
              header('Location: index.php');
              exit();
		 }
		$numbers_string = implode(",", $selected_numbers); 
        $sql = "INSERT INTO user_tickets (username,userTicket) VALUES ('$username','$numbers_string')";
		
		if ($conn->query($sql) === TRUE) {
			$error_message="New record created successfully";
			$_SESSION['message']=$error_message;
			//echo "New record created successfully";
			header('Location: index.php');
			exit();
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error();
		}
		//header('Location: index.php');
		echo "H5";
		exit();
		// Add the selected numbers to the session and redirect to the winner page
		//$_SESSION['lottery_numbers'][] = $selected_numbers;
		
		// Generate a message indicating which user is selecting numbers
//$user_number = count($_SESSION['lottery_numbers']) + 1;
//$message = "User $user_number, choose your numbers";
		
	}
	
}
/*
if(isset($_POST['finish'])) {
	$username = $_POST['username'];
	if ($username == "admin") {
	    header('Location: winner.php');
	    unset($_POST['username']);
	    exit;
 	} else {
	    
	    unset($_POST['username']);
	    header("Location: index.php");
	    exit;
	}
	header("Location: index.php");
}*/
if(isset($_POST['finish'])) {
	$username = $_POST['username'];
	if ($username == "admin") {
	    header('Location: winner.php');
	    unset($_POST['username']);
	    exit;
 	} else {
	    
	    unset($_POST['username']);
	    header("Location: index.php");
		echo "H3";
	    exit;
	}
}
echo "H4";
//header("Location: index.php");

?>

