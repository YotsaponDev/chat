<?php
include("dbcon.php");
$id =$_REQUEST['id'];
$result = mysqli_query($con,"SELECT * FROM member WHERE id = '$id'");
$test = mysqli_fetch_array($result);

if (!$result) 
		{
		die("Error: Data not found..");
		}
				$name= $test['name'] ;					
				$username=$test['username'] ;
				$password=$test['password'] ;
	
	
if(isset($_POST['save'])){	
	$name_save = $_POST['name'];  //รับข้อมูลมาจากการป้อนค่า *##
	$username_save = $_POST['username'];
	$password_save = $_POST['password'];
	$id_save = $_POST['id'];
	 //$id =$_REQUEST['id'];
	 //echo "$id $name_save";
	 
	 //ทำการอัพเดทข้อมูลในฐานข้อมูล
	if(mysqli_query($con,"UPDATE member SET name = '$name_save' ,  
	username = '$username_save' , password = '$password_save' WHERE id = '$id_save'")){
		//ถ้าแก้ไขเสร็จแล้วให้ popup แจ้งเตือน
		echo"<body onload=\"window.alert('แก้ไขข้อมูลสำเร็จ');return location.href='management_edit.php?id=$id_save'\">";
}
//	header("Location: management.php");			
}
mysqli_close($con);  
?>

<html>
<head>
<meta charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="css/manage_edit.css" />
<title>Edit</title>
</head>

<body style="background-color:#2E2E2E;">

<form method="post" action="management_edit.php">
	<input type="hidden" name="id" value="<?php echo $id ?>"/>


<table align="center" >
	<div class = "bg">
	<tr class = "color">
		
			<td>ชื่อที่ใช้แสดง</td>
			<td>ชื่อผู้ใช้</td>
			<td>รหัสผ่าน</td>
	</tr>
	<tr>
		<td><input type="text" name="name" id="name" value="<?php echo $name ?>"/></td>   <!-- *## ตาราง แก้ไขข้อมูล  -->
		<td><input type="text" name="username" id="username" value="<?php echo $username ?>"/></td>
		<td><input type="text" name="password" id="password" value="<?php echo $password ?>"/></td>
	</tr>
		<tr>
	</tr>
	</div>
</table><br>
<center><input type="submit" name="save" value="save" /></center>


</body>
</html>
