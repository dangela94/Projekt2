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
        <script src="jquery-2.1.4.min.js"></script>
        <script>
            var queue = [];
            function ping(cb){
                jQuery.ajax({
                    url : 'ping.php'
                }).done(function(data){
                    jQuery('#application-status').html('Online');
                    jQuery('#application-status').addClass('online');
                    if(typeof cb == 'function'){
                        cb(true);
                    }
                    runQueue();
                }).fail(function(err){
                    jQuery('#application-status').removeClass('online');
                    jQuery('#application-status').html('Offline');
                    if(typeof cb == 'function'){
                        cb(false);
                    }

                })

            }

            function addToQueue(url){
                queue.push(url);
            }

            function runQueue(){
                var call;
                var length = queue.length;

                var reservationCalled = function(){
                    length--;
                    if(length==0){
                        location.reload();
                    }
                }

                while( (call = queue.shift())  ){
                    jQuery.get(
                        call
                    ).done(function(){
                            reservationCalled();
                    });
                }
            }

            jQuery(document).ready(function(){

                window.setInterval(ping,5000);

            });

        </script>
	</head>
	<body>
		<header id="header">
            <div id="application-status" class="application-status online">
                Online
            </div>
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
