<?php
	session_start();
?>

<html>
	<head>
		<title>
			Burger
		</title>
		<body>
			<center>
				<form action="start.php" method="post">
					<input type="radio" name="burger" value="Single">Single - $2.00<br>
					<input type="radio" name="burger" value="Double">Double - $3.00<br><br>
					<input type="checkbox" name="cheese" value="cheese">Cheese - additional $.50<br><br>
					<input type="submit" value="Return">
				</form>
			</center>
		</body>
	</head>
</html>
