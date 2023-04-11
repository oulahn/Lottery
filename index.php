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

<!DOCTYPE html>
<html>
<head>
	<title>Lottery Game</title>
	<script>
		// Function to show a popup dialog box to ask for the user's name
		function askForName() {
			if (sessionStorage.getItem('message') !== null) {
                // The 'username' session variable is set
                 var message = sessionStorage.getItem('message');
				 console.log("already exists");
				 alert('Username already exists,please use another username');
                  } else {
                         // The 'username' session variable is not set
                     console.log('Please set the username session variable');
                   }
			var name = prompt("Please enter your name:", "");
			if (name != null && name !="") {
				// Set the value of the hidden input field to the user's name
				document.getElementById("username").value = name;
				var heading = document.getElementById("theName");
		        heading.innerText = name;
				
			
			} else {
				askForName(); // Ask for the name again if it's empty or null
			}
		}
	
      function copyToHeader() {
        var input = document.getElementById("username").value; // Get the value of the input field
        document.getElementById("myHeader").innerText = input; // Set the header text to the input value
	  }
	  
	</script>
</head>
<body >
<h1 id="title">Hello <p id="myHeader" style="display:inline" ></p> ,Choose six numbers to start the game</h1>

	<form method="POST" action="process.php">
		<!-- Hidden input field to store the user's name -->
		<input type="textbox" name="username" id="username" onkeyup="copyToHeader()" placeholder="Enter Your Username">
		<table>
			<?php 
			// Generate a table of numbers for the user to select from
			$numbers = range(1, 42);
			//shuffle($numbers);
			$chunks = array_chunk($numbers, 10);
			foreach($chunks as $chunk) {
				echo "<tr>";
				foreach($chunk as $number) {
					echo "<td><label><input type='checkbox' name='numbers[]' value='$number'>$number</label></td>";
				}
				echo "</tr>";
			}
			
	      ?>
	   </table>
	   <br>
	   <input type="submit" name="submit" value="Next User" >
	   <input type="submit" name="finish" value="Finish">
	   
	   </script>
	</form>
</body>
</html>

