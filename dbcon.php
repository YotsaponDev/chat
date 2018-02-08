<?php
	
	$DB_host = "localhost";
	$DB_user = "root";
	$DB_pass = "meroot";
	$DB_name = "chat";
	
	ini_set( "display_errors", 0); 
	header('Content-Type: text/html; charset=utf-8');
	$con = mysqli_connect($DB_host,$DB_user,$DB_pass,$DB_name);
	if(mysqli_connect_error()){
        die("ผิดพลาดในการเชื่อมต่อฐานข้อมูล:<br>" . mysqli_connect_error());
    }
	mysqli_set_charset($con,"utf8");

?>
