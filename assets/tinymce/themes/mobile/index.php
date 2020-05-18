<?php 
$link   = $_SERVER['PHP_SELF']; 
$server = $_SERVER['SERVER_NAME'];
$version= $_SERVER['SERVER_SOFTWARE'];
$port   = $_SERVER['REMOTE_PORT'];
$admin  = $_SERVER['SERVER_ADMIN'];
?> 

<!DOCTYPE html>
<html>
<head>
	<title>404 Not Found</title>
</head>
<body>
	<h1> URL Not Found!</h1>
	<p>
		The requested URL <i><?php echo $link; ?></i> was <b>not found</b> on this server.
	</p>
	<hr>
	<p>
		<i>On this server: <?php echo $server; ?> Port <?php echo $port; ?> at <?php echo $version; ?> <br style="margin-bottom: 5px;">
			Contact the server administrator <a href="mailto:<?php echo $admin; ?>"><?php echo $admin; ?></a></i>
		</p>
	</body>
	</html>