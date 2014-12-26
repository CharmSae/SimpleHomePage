<?php
DEFINE ('DB_USER', 'a8132296_basic');
DEFINE ('DB_PASSWORD', 'dudwls23');
DEFINE ('DB_HOST', 'mysql10.000webhost.com');
DEFINE ('DB_NAME', 'a8132296_basic');
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Could not connect to MySQL ' . mysqli_connect_error());

?>