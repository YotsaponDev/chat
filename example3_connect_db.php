<?php

$servername = 'localhost';
$db_user='root';
$db_pwd='meroot';
$dbname='myfirstdb';
//`mysql --user=$db_user --password=$db_pwd -e "CREATE DATABASE IF NOT EXISTS $dbname"`;

if (!isset($handle)){ 
		$handle=mysqli_connect($servername, $db_user, $db_pwd,$dbname);
		/* check connection */
		//printf("Connect failed: %s\n", mysqli_connect_error());  //กดenter
			
	
}


?>
