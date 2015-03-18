<?php
	session_start();
?>

<html>
	<head>
		<title>
			Drink
		</title>
		<body>
			<center>
				<form action="start.php" method="post">
					<input type="radio" name="drink" value="Soda">Soda - Small: $2.00, Medium: $3.00, Large: $4.00<br>
					<input type="radio" name="drink" value="Water">Water - $0.00 all sizes<br><br>
					<input type="radio" name="size" value="Small">Small<br>
					<input type="radio" name="size" value="Medium">Medium<br>
					<input type="radio" name="size" value="Large">Large<br><br>
					<input type="submit" value="Return">
				</form>
			</center>
		</body>
	</head>
</html>
