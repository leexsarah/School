<?php
	$file=$_POST['filename'];
	$pos=$_POST['position'];
	$fh=fopen($file, 'r');
	$counter=1;
	while (!feof($fh))
	{
		$arr[$counter]=fgets($fh);
		$counter++;
	}
	echo "Hello ".htmlspecialchars($_POST['username'])."<br/>";
	echo "The value in ".htmlspecialchars($file);
	echo " at position ".(int)$pos;
	echo " is ".$arr[$pos];
?>
