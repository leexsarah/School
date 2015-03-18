<?php
	//Uses the database made with the statements (documented in SQL.txt) to compute 
	//and output the weighted score and the grade. User must input an 9-digit CWID.
	
	class student {
		private $attend = 0;
		private $hw;
		private $project = 0;
		private $midterm = 0;
		private $final = 0;
		private $total = 0;

		//Function  to check if we can connect to MySQL
		function connect() {
			$link = mysqli_connect('mysql', 'username', 'password', 'database');
			if (!$link) 
				die('Not able to connect!'.mysqli_error());
			return $link;
		}

		//Function to calculate the average
		function get_score($cwid, $li) {
			//Gets information of student from CWID and displays it
			$query1 = "select * from student where cwid=".$cwid;
			$result1 = mysqli_query($li, $query1);
			$row = mysqli_num_rows($result1);
			if($row == 0) {
				echo("CWID not found!\n");
				exit();
			}
			echo("====================Grade Report====================\n");
			$a = mysqli_fetch_assoc($result1);
			echo("CWID: ");
			echo stripslashes($a['cwid']."\n");
			echo("Name: ");
			echo stripslashes($a['firstname']." ");
			echo stripslashes($a['lastname']."\n");
			$dob = $a['dob'];
			if ($dob == NULL)
				$dob = "not provided";
			echo("DOB: ".$dob."\n");

			//Gets scores of student and displays it
			$query2 = "select * from course where cwid=".$cwid;
			$result2 = mysqli_query($li, $query2);
			$b = mysqli_fetch_assoc($result2);

			//Course ID to use for homework score
			$courseid = $b['courseid'];

			//Attendance score - Originally out of 100 but now out of 5 since attendance is 5% of grade
			$attend = $b['attendance']/20;
			echo("Attendance Score (out of 5): ".$attend."\n");

			//Homework score - Averaged and now out of 20 since homework is 20% of grade
			$query3 = "select * from homework where cw_id=".$courseid;
			$result3 = mysqli_query($li, $query3);
			$rows = mysqli_num_rows($result3);
			$c = mysqli_fetch_assoc($result3);
			$hw = 0;
			for ($i=0; $i < $rows; $i++) 
				$hw = $hw + $c['score'];
			$hw = ($hw/$rows)/5;
			echo("Average Homework Score (out of 20): ".$hw."\n");

			//Term project score - Originally out of 100 but now out of 20 since project is 20% of grade
			$project = $b['term']/5;
			echo("Term Project Score (out of 20): ".$project."\n");

			//Midterm score - Originally out of 100 but now out of 25 since midterm is 25% of grade
			$midterm = $b['midterm']/4;
			echo("Midterm Exam Score (out of 25): ".$midterm."\n");

			//Final score - Originally out of 100 but now out of 30 since project is 30% of grade
			$final = $b['final']/3.33;
			echo("Final Exam Score (out of 30): ".$final."\n");

			//Get the total score after adding up all the scores
			$total = $attend + $hw + $project + $midterm + $final;
			echo("Total Score (out of 100): ".$total."\n");

			//Determine the grade in the class.
			if ($total>=90)
				echo("Your grade is an A. Good job!\n");
			else if ($total>=80 && $total<90)
				echo("Your grade is a B. Awesome!\n");
			else if ($total>=70 && $total<80)
				echo("Your grade is a C. Not bad!\n");
			else if ($total>=60 && $total<70)
				echo("Your grade is a D. Alright.\n");
			else 
				echo("Your grade is an F. Better luck next time...\n");

			echo("=================End of Grade Report================\n");
		}
	}
	
	$s = new student();
	$li = $s->connect();
	$args = $_SERVER["argc"];
	if ($args == 2) {
		$cwid = $_SERVER["argv"][1];
		$cwid_length = strlen((string)$cwid);
		if ($cwid_length == 9 && is_numeric($cwid)) 
			$s -> get_score($cwid, $li);
		else if ($cwid_length != 9 || !is_numeric($cwid)) {
			echo("Enter a 9-digit CWID. Make sure it is numeric.\n");
			exit();
		}
	}
	else {
		echo("Please enter the following in the command line: php HW3_1.php <9-digit CWID>\n");
	}
	mysqli_close($li);
?>
