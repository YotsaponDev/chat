<?php
include_once('dbcon.php');

if(trim($_POST["txtUsername"]) == ""){		
	echo"<body onload=\"window.alert('กรุณาป้อนชื่อผู้ใช้');return history.go(-1)\">";		
	exit();		
}		
if(trim($_POST["txtPassword"]) == ""){	
	echo"<body onload=\"window.alert('กรุณากรอกรหัสผ่าน');return history.go(-1)\">";			
	exit();	
}		
if($_POST["txtPassword"] != $_POST["txtConPassword"]){	
	echo"<body onload=\"window.alert('ยืนยันรหัสผ่านไม่ตรงกัน');return history.go(-1)\">";		
	exit();
}
if(trim($_POST["txtName"]) == ""){
	echo"<body onload=\"window.alert('กรุณาป้อนชื่อ');return history.go(-1)\">";	
	exit();	
}
if(trim($_POST["status"]) == ""){
	echo"<body onload=\"window.alert('กรุณาเลือกสถานะผู้ใช้');return history.go(-1)\">";	
	exit();	
}	
		
$usernameSQL = "SELECT * FROM member WHERE username = '".trim($_POST['txtUsername'])."' ";
$usernameQuery = mysqli_query($con,$usernameSQL);
$usernameResult = mysqli_fetch_array($usernameQuery);
//------------------------------------------------------------------------------
if($usernameResult){		
	echo "มีชื่อผู้ใช้นี้แล้ว";
}else{		
$usernameSQL = "INSERT INTO member (username,password,name,status) VALUES ('".$_POST["txtUsername"]."',
'".$_POST["txtPassword"]."','".$_POST["txtName"]."','".$_POST["status"]."')";

		$usernameQuery = mysqli_query($con,$usernameSQL);
	
	echo"<body onload=\"window.alert('สมัครสมาชิกสำเร็จ');return history.go(-1)\">"; 
		
}

	mysqli_close();
?>
