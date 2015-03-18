<?php
	//Uses the database made with the statements (documented in SQL.txt) to compute 
	//and output the average and standard deviation of the midterm and the final scores.
	
	class student {
		private $midterm_ave = 0;
		private $final_ave = 0;
		private $midterm_sd = 0;
		private $final_sd = 0;

		//Function  to check if we can connect to MySQL
		function connect() {
			$link = mysqli_connect('mysql', 'username', 'password', 'database');
			if (!$link) 
				die('Not able to connect!'.mysqli_error());
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
			echo("Average Midterm Exam Score (out of 100): ".$midterm_ave."\n");

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
			echo "Standard deviation of Midterm Exam: ".$midterm_sd."\n";

			//Gets final scores
			$query3 = "select final from course";
			$result3 = mysqli_query($li, $query3);
			
			//Compute average for final
			$final = 0;
			while($c = mysqli_fetch_assoc($result3)) { 
				$final = $final + $c['final'];
			}
			$final_ave = $final/$noOfStudents;
			echo("Average Final Exam Score (out of 100): ".$final_ave."\n");

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
			echo "Standard deviation of Final Exam: ".$final_sd."\n";
		}
	}

	$s = new student();
	$li = $s->connect();
	$args = $_SERVER["argc"];
	if ($args == 1) {
		$s -> get_average($li);
	}
	else {
		echo("Please enter the following in the command line: php HW3_2.php\n");
	}
	mysqli_close($li);
?>
