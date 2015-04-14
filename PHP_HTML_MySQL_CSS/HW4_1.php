<html>
	<link href="style.css" rel="stylesheet" type="type/css">
	<head>
		<title>Homework 4</title>
	</head>
	<body>
		<div class="one">
		<?php
		class student {
			private $midterm_ave = 0;
			private $final_ave = 0;
			private $midterm_sd = 0;
			private $final_sd = 0;
	
			//Function  to check if we can connect to MySQL
			function connect() {
				$link = mysqli_connect("ecsmysql", "username", "password", "database");
				if(mysqli_connect_errno()){
					echo "Not able to connect!".mysqli_connect_error();
					exit();
				}
				return $link;
			}

			//Function to calculate the average
			function get_average($li) {
				//Gets midterm scores
				$query1 = "select midterm from course";
				$result1 = mysqli_query($li, $query1);
			
				//The number of rows will indicate number of students.
				$noOfStudents = mysqli_num_rows($result1);

				//Compute average for midterm
				$midterm = 0;
				while($a = mysqli_fetch_assoc($result1)) {
					$midterm = $midterm + $a['midterm'];
				}	
				$midterm_ave = $midterm/$noOfStudents;
				echo("Average Midterm Exam Score (out of 100): ".$midterm_ave."<br>");
	
				//Calculate and output the standard deviation for midterm scores.
				$query2 = "select midterm from course";
				$result2 = mysqli_query($li, $query2);
				$m = 0;
				$mid = 0;
				while($b = mysqli_fetch_assoc($result2)) {
					$mid = $b['midterm'] - $midterm_ave;
					$mid = $mid * $mid; 
					$m = $m + $mid;
				}
				$midterm_sd = sqrt($m/$noOfStudents);
				echo("Standard deviation of Midterm Exam: ".$midterm_sd."<br>");

				//Gets final scores
				$query3 = "select final from course";
				$result3 = mysqli_query($li, $query3);
				
				//Compute average for final
				$final = 0;
				while($c = mysqli_fetch_assoc($result3)) { 
					$final = $final + $c['final'];
				}
				$final_ave = $final/$noOfStudents;
				echo("Average Final Exam Score (out of 100): ".$final_ave."<br>");
	
				//Calculate and output the standard deviation for final scores.
				$query4 = "select final from course";
				$result4 = mysqli_query($li, $query4);
				$f = 0;
				$fin = 0;
				while($d = mysqli_fetch_assoc($result4)) {
					$fin = $d['final'] - $final_ave;
					$fin = $fin * $fin; 
					$f = $f + $fin;
				}
				$final_sd = sqrt($f/$noOfStudents);
				echo ("Standard deviation of Final Exam: ".$final_sd."<br><br>");

				echo ("Redirecting in 10 seconds...");
				echo '<meta http-equiv="refresh" content="10;url=index.php" />';
			}
		}

		$s = new student();
		$li = $s->connect();
		$s -> get_average($li);
		mysqli_close($li);
		?>
		</div>
	</body>
</html>