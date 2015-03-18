<?php
	session_start();
?>

<html>
	<head>
		<title>
			Fries
		</title>
		<body>
			<center>
				<form action="start.php" method="post">
					<input type="radio" name="type" value="Regular">Regular - Small: $1.00, Medium: $2.00, Large: $3.00<br>
					<input type="radio" name="type" value="Curly">Curly - Small: $2.00, Medium: $3.00, Large: $4.00<br><br>
					<input type="radio" name="sz" value="Small">Small<br>
					<input type="radio" name="sz" value="Medium">Medium<br>
					<input type="radio" name="sz" value="Large">Large<br><br>
					<input type="submit" value="Return">
				</form>
			</center>
		</body>
	</head>
</html>
