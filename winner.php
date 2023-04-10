<?php
session_start();
include 'conn.php';

// Generate an array of six random winning numbers
$winning_numbers = array();
while(count($winning_numbers) < 6) {
	$random_number = rand(1, 42);
	if(!in_array($random_number, $winning_numbers)) {
		$winning_numbers[] = $random_number;
	}
}
$numbers_string = implode(",", $winning_numbers); 
$date=date('Y-m-d H:i:s');
$sql = "INSERT INTO draw (ticket,date) VALUES ('$numbers_string', '$date')";
$result=$conn->query($sql);
$message = "The winning numbers are " .$numbers_string;

// Determine which user(s) chose the winning numbers
$sql = "SELECT username FROM user_tickets WHERE userTicket = '$numbers_string'";

// Execute the query and store the result set
$result = $conn->query($sql);

// Check if there are any results



?>

<!DOCTYPE html>
<html>
<head>
	<title>Lottery Game</title>
</head>
<body>
	<h1><?php echo $message; ?></h1>
	<h2>Numbers Selected by Each User:</h2>
	<?php 
	$sql = "SELECT * FROM user_tickets ";
	$result = $conn->query($sql);
	// Close the connection
	
	if ($result->num_rows > 0) {
		$my_array = array();
		for($i=0;$i<$result->num_rows;$i++){
		$row = mysqli_fetch_assoc($result);
		$userTicket_numbers=explode(",",$row["userTicket"]);
		for($x=0;$x<sizeof($winning_numbers);$x++)
		{
			for($j=0;$j<sizeof($userTicket_numbers);$j++)
			{
				if($winning_numbers[$x]==$userTicket_numbers[$j])
				{
					array_push($my_array,$winning_numbers[$x] );
				}
			}
		  }
		  echo "the user: ".$row["username"]." ".$row["userTicket"]." the winning numbers: ".implode(",",$my_array);
		  echo "<br>" ;
		  if(sizeof($my_array)==6)
		  {
			$ticket=$row["userTicket"];
			echo  $row["username"]. "selected all six numbers and wins the game! <br>";
			$sql = "INSERT INTO user_tickets (username,date,ticket) VALUES ('$username', date('Y-m-d H:i:s'),$ticket)";
		
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error();
		}
		  }
		  $my_array = [];
		}
	}
	//eza bdek tchufiyon b database abel ma ynmho bt3mle comment la satren l tahet 
	$sql = "TRUNCATE TABLE user_tickets";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	?>
   
</body>
</html>

