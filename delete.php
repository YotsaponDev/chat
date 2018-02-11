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
	
if(isset($_POST['save'])){	
	$name_save = $_POST['name'];
	$username_save = $_POST['username'];
	$password_save = $_POST['password'];
	$id_save = $_POST['id'];
	 //$id =$_REQUEST['id'];
	 //echo "$id $name_save";
	 
	if(mysqli_query($con,"DELETE FROM member WHERE id = '$id_save'")){ //ทำการลบข้อมูลของสมาชิก
	echo"<body onload=\"window.alert('ท่านได้ทำการลบข้อมูลเรียบร้อยแล้ว'); window.close()\">"; //แจ้งเตือน popup เมื่อได้ทำการลบ

}
		
}
mysqli_close($con);  
?>

<html>
<head>
<meta charset="UTF-8" />
<title>Edit</title>
</head>

<body>
<form method="post" action="delete.php"><br>  <!-- ส่งค่า เมื่อทำการกด /ลบบัญชี -->
	<input type="hidden" name="id" value="<?php echo $id ?>"/>
<table >
	<?php echo "<center>ท่านต้องการลบบัญชีผู้ใช้ $name หรือไม่</center>" ?>
	<br>
		<center><input type="submit" name="save" value="ลบบัญชี" />
		<button type="ิbutton" onclick="javascript:window.close()">ยกเลิก </button>
		</center>
	
</table>

</body>
</html>


