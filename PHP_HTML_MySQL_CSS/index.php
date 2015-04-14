<html>
	<link href="style.css" rel="stylesheet" type="type/css">
	<head>
		<title>Homework 4</title>
	</head>
	<body>
		<h2>Sarah Lee<br>
		CPSC 431 - MW 5:30 PM</h2>
		<div class="request1">
		<p>
			<a href="HW4_1.php">Average and Standard Deviation</a><br>
			Click the link above to calculate the average and standard deviation of midterm and final scores. <br><br>
		</p>
		</div>
		<div class="request2">
			Enter one of the following CWIDs to calculate the average score of a student:<br>
			<ul>
			<?php
				class student {
					function connect() {
						$link = mysqli_connect("ecsmysql", "cs431s23", "xohhinog", "cs431s23");
						if(mysqli_connect_errno()){
							echo "Not able to connect!".mysqli_connect_error();
							exit();
						}
						return $link;
					}

					function display_cwid($li){
						$query = "select cwid from student";
						$result = mysqli_query($li, $query);
						while($id = mysqli_fetch_assoc($result)) {
							echo("<li>".$id['cwid']."</li>");
						}
					}
				}
		
				$s = new student();
				$li = $s->connect();
				$s -> display_cwid($li);
				mysqli_close($li);
			?>
			</ul>
		<form action="HW4_2.php" method="post">
			CWID: <input type="text" name="cwid" maxlength="9"/><br><br>
			<input type="submit">
		</form>
		</p>
		</div>
	</body>
</html>