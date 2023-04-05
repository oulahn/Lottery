<?php
session_start();

// Array of numbers for the user to choose from
$numbers = range(1, 42);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Lottery Game</title>
</head>
<body>
<h1>Choose six numbers to start the game</h1>
	<form method="post" action="process.php">
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
	   <input type="submit" name="submit" value="Next User">
	   <input type="submit" name="finish" value="Finish">
	</form>
</body>
</html>
