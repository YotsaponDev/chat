<?php
		session_start(); //เปิด session
		include("dbcon.php");
		$ses_id =$_SESSION['ses_id'];                 //สร้าง session สำหรับเก็บค่า ID
		$ses_username = $_SESSION['ses_username'];         //สร้าง session สำหรับเก็บค่า username
		$ses_name = $_SESSION['ses_name'];
		
		if($ses_id <> session_id() or  $ses_username ==""){  //ตรวจสอบว่าทำการ Login เข้าสู่ระบบมารึยัง
			header("location:index.php");
		} 
		
	?>


<!DOCTYPE html>
<html>
<head >
	<meta charset="UTF-8" />
	<title>.::Admin-Management::.</title>
<link rel="stylesheet" type="text/css" href="css/manage.css" />

	<div align="center">
	
	<a href="logout.php" class="button">ออกจากระบบ</a>  
	</div>

		<script>function editWin(e) {
window.open('management_edit.php?id='+e,'','height=200, width=600, top=100, left=400, scrollable=no, menubar=no', '');
}; </script>

<script>function deleteWin(e) {
window.open('delete.php?id='+e,'','height=160, width=420, top=100, left=400, scrollable=no, menubar=no', '');
}; </script>

</head>

<body style="background-color:#2E2E2E;">


<table align="center">


<td>
	<div class="regis">
  <form method="post" action="register.php">
    <label for="username">ชื่อผู้ใช้</label>
    <input type="text" id="txtUsername" name="txtUsername">

    <label for="password">รหัสผ่าน</label>
    <input type="password" id="txtPassword" name="txtPassword">
    
    <label for="password">ป้อนรหัสผ่านอีกครั้ง</label>
    <input type="password" id="txtConPassword" name="txtConPassword">
	
	<label for="name">ชื่อ</label>
    <input type="text" id="txtName" name="txtName">
	
	<label for="status">สถานะ</label>
	 <select type="select" id="status" name="status">	
      <option value="user">สมาชิก</option>
      <option value="admin">แอดมิน</option>
    </select>
	
    <input type="submit" name="Submit" value="สมัครสมาชิก">
    <input type="reset" name="Reset" value="ยกเลิก"> 
  </form>
</div>
</td>
<td>
<div class="box">
<table class="table1">
<?php
include("dbcon2.php");

$sql = "SELECT * FROM member";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    echo "รายชื่อสมาชิกทั้งหมดในขณะนี้ <br>"; 
    echo "<tr>";
    echo "<th>ชื่อที่ใช้แสดง</th>";
    echo "<th>ชื่อผู้ใช้</th>";
    echo "<th>รหัสผ่าน</th>";
    echo "<th>แก้ไข</th>";
    echo "<th>ลบข้อมูล</th>";
  //  echo  "    setTimeout('getdata()',1000);\n"; // 3 sec.
    echo "</tr>";
    while($row = $result->fetch_assoc()) {
      //  echo "Username: " . $row["username"]. ";  Name: " . $row["name"]. "<br>";
		$id = $row["id"];
		$username = $row["username"];
		
        echo "<tr align='center'>";	
    //    echo"<td><font color='black'>" .$row["id"]."</font></td>";
		
		echo"<td><font color='black'>" .$row["name"]."</font></td>";
		echo"<td><font color='black'>". $row["username"]. "</font></td>";
		echo"<td><font color='black'>". $row["password"]. "</font></td>";
	//	echo"<td> <a href ='view.php?BookID=$id'>Edit</a>";
		
		echo "<td><a href='#' id=$id onclick='javascript:editWin(this.id); return(false);'>Edit</a></td>";
		echo "<td><a href='#' id=$id onclick='javascript:deleteWin(this.id); return(false);'>Delete</a></td>";
		echo "</tr>";
		
    }
} else {
    echo "0 results";
}
$conn->close();
?>
</table>
</div>
</td>
</table><br>
<center><font color="white" >แชทรูม มอนิเตอร์<center>
<br>
<center><iframe src="http://localhost/download/group2/chatroom.php" width="820px" height="460px" scrolling="no"></iframe></center>
<br>
</body>
</html>
