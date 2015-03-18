<?php
	session_start();
	if ($_POST['burger'])
	{
		$burger = $_POST['burger'];
		if ($burger == "Single")
			$b = 2.00;
		else
			$b = 3.00;
		if(isset($_POST['cheese']))
		{
			$cheese = $_POST['cheese'];
			$c = 0.50;
		}
		else
		{
			$cheese = "no cheese";
			$c = 0.00;
		}
		$_SESSION['burger'] = $burger;
		$_SESSION['cheese'] = $cheese;
		$_SESSION['bTotal'] = $b + $c;
	}
	else if ($_POST['type'])
	{
		$type =$_POST['type'];
		$sz = $_POST['sz'];
		if ($type == "Regular")
		{
			if($sz == "Small")
				$f = 1.00;
			else if ($sz == "Medium")
				$f = 2.00;
			else if ($sz == "Large")
				$f = 3.00;
		}
		else if ($type == "Curly") 
		{
			if($sz == "Small")
				$f = 2.00;
			else if ($sz == "Medium")
				$f = 3.00;
			else if ($sz == "Large")
				$f = 4.00;
		}
		$_SESSION['type'] = $type;
		$_SESSION['sz'] = $sz;
		$_SESSION['fTotal'] = $f;
	}
	else if ($_POST['drink'])
	{
		$drink = $_POST['drink'];
		$size = $_POST['size'];
		if ($drink == "Soda")
		{
			if($size == "Small")
				$d = 2.00;
			else if ($size == "Medium")
				$d = 3.00;
			else if ($size == "Large")
				$d = 4.00;
		}
		else if ($drink == "Water") 
			$d = 0.00;
		$_SESSION['drink'] = $drink;
		$_SESSION['size'] = $size;
		$_SESSION['dTotal'] = $d;
	}
?>

<html>
	<head>
		<title>
			Order Form
		</title>
	</head>
	<body>
		<center>
			<?php
				echo "Welcome!<br><br>";
			?>
			<table>
				<tr>
					<td>
						<form action="burger.php" method="post">
							<input type="submit" value="Burger"/><br>
						</form>
					</td>
					<td>
						<form action="fries.php" method="post">
							<input type="submit" value="Fries"/><br>
						</form>
					</td>
					<td>
						<form action="drink.php" method="post">
							<input type="submit" value="Drink"/><br>
						</form>
					</td>
				</tr>
			</table>
			<form action="finish.php" method="post">
				<input type="submit" value="Finished">
			</form>
		</center>
	</body>
</html>

<?php
	if ($_POST['burger'] || $_POST['type'] || $_POST['drink'])
	{
		echo "<strong>This is your order so far:</strong>".'<br>';
		if ($_SESSION['burger'])
		{
			echo $_SESSION['burger'].' burger<br>';
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;With ".$_SESSION['cheese']."..........".money_format('$%i', $_SESSION['bTotal']).'<br>';
		}
		if ($_SESSION['type'])
		{	
			echo $_SESSION['type'].' fries<br>';
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$_SESSION['sz']."..........".money_format('$%i', $_SESSION['fTotal']).'<br>';
		}
		if ($_SESSION['drink'])
		{
			echo $_SESSION['drink'].'<br>';
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$_SESSION['size']."..........".money_format('$%i', $_SESSION['dTotal']).'<br>';
		}
	}
?>
