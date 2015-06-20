<?php
/*if($_SERVER["HTTPS"] != "on") {
header("HTTP/1.1 301 Moved Permanently");
header("Location: https://". $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);
exit();
}*/
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
		<title>Book store</title>
		<?php $_contr->skorka() ?>
	</head>
	<body>
		<header id="header">
			<a href="index.php">Book store</a>
		</header>
		<nav id="menu">
			<?php $_contr->menu(); ?>
		</nav>
		<section id="content">	
			<?php $_contr->laduj(); ?>
		</section>
		<footer id="stopka">
			<?php $_contr->styles() ?>
    <p>No animal was harmed in the process of creating this website.<br/> 
    Also the energy needed for my rig to create it came from my homemade generator 
    out of an old bike so the site itself is eco friendly as hell. <br/>
    If there is anything You'd like to ask - go for it at i1mazurkiewicz@fatcat.ftj.agh.edu.pl
        <br/>
    COPYLEFT 
    <span style="-moz-transform: scaleX(-1); -o-transform: scaleX(-1); -webkit-transform: scaleX(-1); transform: scaleX(-1); display: inline-block;">
    &copy;</span> by Krzysztof Mazurkiewicz, all wrongs reserved.</p>
		</footer>
	</body>
</html>
