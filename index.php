<?php
if($_SERVER["HTTPS"] != "on") {
header("HTTP/1.1 301 Moved Permanently");
header("Location: https://". $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);
exit();
}
?>
<?php

	include ('controller/controller.php');
	
	$_contr = new controller();
	session_start();
	
	$_SESSION['strona'] = $_GET['strona'];
?>
<!doctype html>
<html>
	<head>
		<meta charset="ISO-8859-2">
		<title>Wypozyczalnia przedmiotow</title>
		<?php $_contr->skorka() ?>
	</head>
	<body>
		<header id="header">
			<a href="index.php">Wypozyczalnia przedmiotow</a>
		</header>
		<nav id="menu">
			<?php $_contr->menu(); ?>
		</nav>
		<section id="content">	
			<?php $_contr->laduj(); ?>
		</section>
		<footer id="stopka">
			<br />Author: Krzysztof Mazurkiewicz<br />
			Wszystkie prawa zastrzezone.
		</footer>
	</body>
</html>
