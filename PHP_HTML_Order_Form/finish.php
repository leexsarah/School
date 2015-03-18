<?php
	session_start(); 
	echo "<strong>Here is what you ordered:</strong>".'<br>';
	echo $_SESSION['burger'].' burger<br>';
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;With ".$_SESSION['cheese']."..........".money_format('$%i', $_SESSION['bTotal']).'<br>';
	echo $_SESSION['type'].' fries<br>';
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$_SESSION['sz']."..........".money_format('$%i', $_SESSION['fTotal']).'<br>';
	echo $_SESSION['drink'].'<br>';
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$_SESSION['size']."..........".money_format('$%i', $_SESSION['dTotal']).'<br><br>';
	$total = $_SESSION['bTotal'] + $_SESSION['fTotal'] + $_SESSION['dTotal'];
	echo "Your total is: ".money_format('$%i', $total).'<br>';
	session_destroy();
?>

