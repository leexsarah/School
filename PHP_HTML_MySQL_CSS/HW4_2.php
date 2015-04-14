<html>
	<link href="style.css" rel="stylesheet" type="type/css">
	<head>
		<title>Homework 4</title>
	</head>
	<body>
		<div class="two">
		<?php
		class student {
			private $attend = 0;
			private $hw;
			private $project = 0;
			private $midterm = 0;
			private $final = 0;
			private $total = 0;

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
			function get_score($cwid, $li) {
				//Gets information of student from CWID and displays it
				$query1 = "select * from student where cwid=".$cwid;
				$result1 = mysqli_query($li, $query1);
				$row = mysqli_num_rows($result1);
				if($row == 0) {
					echo("CWID not found. Please enter it again. Redirecting in 3 seconds...\n");				
					echo '<meta http-equiv="refresh" content="3;url=index.php" />';
					exit();
				}
				$a = mysqli_fetch_assoc($result1);
				echo("CWID: ");
				echo stripslashes($a['cwid']."<br>");
				echo("Name: ");
				echo stripslashes($a['firstname']." ");
				echo stripslashes($a['lastname']."<br>");
				$dob = $a['dob'];
				if ($dob == NULL)
					$dob = "not provided";
				echo("DOB: ".$dob."<br>");
	
				//Gets scores of student and displays it
				$query2 = "select * from course where cwid=".$cwid;
				$result2 = mysqli_query($li, $query2);
				$b = mysqli_fetch_assoc($result2);

				//Course ID to use for homework score
				$courseid = $b['courseid'];

				//Attendance score - Originally out of 100 but now out of 5 since attendance is 5% of grade
				$attend = $b['attendance']/20;
				echo("Attendance Score (out of 5): ".$attend."<br>");

				//Homework score - Averaged and now out of 20 since homework is 20% of grade
				$query3 = "select * from homework where cw_id=".$courseid;
				$result3 = mysqli_query($li, $query3);
				$rows = mysqli_num_rows($result3);
				$c = mysqli_fetch_assoc($result3);
				$hw = 0;
				for ($i=0; $i < $rows; $i++) 
					$hw = $hw + $c['score'];
				$hw = ($hw/$rows)/5;
				echo("Average Homework Score (out of 20): ".$hw."<br>");

				//Term project score - Originally out of 100 but now out of 20 since project is 20% of grade
				$project = $b['term']/5;
				echo("Term Project Score (out of 20): ".$project."<br>");

				//Midterm score - Originally out of 100 but now out of 25 since midterm is 25% of grade
				$midterm = $b['midterm']/4;
				echo("Midterm Exam Score (out of 25): ".$midterm."<br>");

				//Final score - Originally out of 100 but now out of 30 since project is 30% of grade
				$final = $b['final']/3.33;
				echo("Final Exam Score (out of 30): ".$final."<br>");

				//Get the total score after adding up all the scores
				$total = $attend + $hw + $project + $midterm + $final;
				echo("Total Score (out of 100): ".$total."<br>");

				//Determine the grade in the class.
				if ($total>=90)
					echo("Your grade is an A. Good job!<br>");
				else if ($total>=80 && $total<90)
					echo("Your grade is a B. Awesome!<br>");
				else if ($total>=70 && $total<80)
					echo("Your grade is a C. Not bad!<br>");
				else if ($total>=60 && $total<70)
					echo("Your grade is a D. Alright.<br>");
				else 
					echo("Your grade is an F. Better luck next time...<br><br>");

				echo("Redirecting in 20 seconds...");
				echo '<meta http-equiv="refresh" content="20;url=index.php" />';
				exit();
			}
		}
	
		$s = new student();
		$li = $s->connect();
		$cwid = $_POST['cwid'];
		$cwid_length = strlen((string)$cwid);
		if ($cwid_length == 9 && is_numeric($cwid)) 
			$s -> get_score($cwid, $li);
		else if ($cwid_length != 9 || !is_numeric($cwid)) {
			echo("Enter a 9-digit CWID. Make sure it is numeric. Redirecting in 3 seconds...\n");
			echo '<meta http-equiv="refresh" content="3;url=index.php" />';
			exit();
		}
		mysqli_close($li);
		?>
		</div>
	</body>
</html>