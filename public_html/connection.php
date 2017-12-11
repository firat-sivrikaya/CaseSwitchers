<?php
define ('MYSQL_HOSTNAME', 'localhost');
define ('MYSQL_USERNAME', 'root');
define ('MYSQL_PASSWORD', '');
define ('MYSQL_DATABASE', 'caseswitchers');

$db = @mysqli_connect(MYSQL_HOSTNAME, MYSQL_USERNAME, MYSQL_PASSWORD,MYSQL_DATABASE)
OR die('Could not connect to MySQL' . mysqli_connect_error());

?> 