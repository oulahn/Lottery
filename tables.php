<?php
include 'conn.php';
session_start(); 
// Check if the user_tickets table exists
if(!empty($_SESSION['message']))
{
	echo 	$_SESSION['message'];
}
$sql = "SHOW TABLES LIKE 'user_tickets'";
$sql2="SHOW TABLES LIKE 'winners'";
$sql3="SHOW TABLES LIKE 'draw'";
$result = $conn->query($sql);
$result2 = $conn->query($sql2);
$result3 = $conn->query($sql3);
if ($result->num_rows == 0) {
    // MySQL code to create the user_tickets table
    $sql = "CREATE TABLE user_tickets (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            userTicket VARCHAR(255) NOT NULL
            )";
    // Execute the SQL query to create the table
    if ($conn->query($sql) === TRUE) {
       // echo "Table user_tickets created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
} else {
   // echo "Table user_tickets already exists";
}

	if ($result2->num_rows == 0) {
		// MySQL code to create the user_tickets table
		
$sql2 = "CREATE TABLE winners (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	userName VARCHAR(50) NOT NULL,
	date VARCHAR(255) ,
	ticket  VARCHAR(255) NOT NULL
	)";
		// Execute the SQL query to create the table
		if ($conn->query($sql2) === TRUE) {
		   // echo "Table user_tickets created successfully";
		} else {
			echo "Error creating table: " . $conn->error;
		}
	} else {
	   // echo "Table user_tickets already exists";
	}

	if ($result3->num_rows == 0) {
		// MySQL code to create the user_tickets table
		
$sql3 = "CREATE TABLE draw (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	ticket  VARCHAR(255) NOT NULL,
	date  VARCHAR(255) 
	
	)";
		// Execute the SQL query to create the table
		if ($conn->query($sql3) === TRUE) {
		   // echo "Table user_tickets created successfully";
		} else {
			echo "Error creating table: " . $conn->error;
		}
	} else {
	   // echo "Table user_tickets already exists";
	}

// Close the database connection
$conn->close();

// Array of numbers for the user to choose from
$numbers = range(1, 42);
session_destroy();
?>