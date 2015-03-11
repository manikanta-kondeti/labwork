<?php
	define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASSWORD', '321_lab');
       define('DB_DATABASE', 'login');
        $link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
echo $link;
echo "Manikanta\n";
?>
