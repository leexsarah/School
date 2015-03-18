<?php
	//This is a simple program that takes some numbers from a command line, computes, and
	//outputs the average, standard deviation, and median. It also sorts and outputs the 
	//numbers as well.
	
	//Declare variables.
	$args = $_SERVER["argc"];
	$sum = 0;
	$n = 0;
	$numbers = array();
	$num = array();
	$su = 0;
	$temp = 0;
	
	if ($args <= 0)
		echo "No numbers are entered. Please try again. Exiting...";
	
	else if ($args >=1) {
		//Read in variables, store in array, and find the sum.
		for ($loop = 1; $loop <= $args-1; $loop +=1) {
			$s = $_SERVER["argv"][$loop];
			$sum = $sum + $s;
			$numbers[$loop-1] = $s;
			$n = $n+1;
		}
	
		//Calculate and output the average.
		$average = $sum/$n;
		echo "Average: ".$average."\n";
		
		//Calculate and output the standard deviation.
		for ($l = 0; $l < $n; $l +=1) {
			$num[$l] = $numbers[$l] - $average;
			$num[$l] = $num[$l] * $num[$l]; 
			$su = $su + $num[$l];
		}
		$ave = $su/($n-1);
		echo "Standard deviation: ".sqrt($ave)."\n";
	
		//Sort and output the numbers.
		for ($i=0; $i < $n; $i +=1) {
			for ($j=0; $j < ($n-1); $j +=1) {
				if ($numbers[$j+1] < $numbers[$j]) {
					$temp = $numbers[$j];
					$numbers[$j] = $numbers[$j+1];
					$numbers[$j+1] = $temp;
				}
			}
		}
		echo "Sorted numbers: ";
		for ($j=0; $j < $n; $j +=1) {
			echo $numbers[$j]." ";
		}
		echo "\n";
	
		//Find and output the median of the numbers.
		$middle = $n/2;
		if ($n%2 == 0) {
			$median = ($numbers[$middle-1] + $numbers[$middle])/2;
		}
		else {
			$median = $numbers[ceil($middle-1)];
		}
		echo "Median: ".$median;
	}
?>