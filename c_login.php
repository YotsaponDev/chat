<?php

	session_start(); //เปิด seesion เพื่อทำงาน
	$username = $_POST['txtUsername']; //ประกาศซตัวแปรชื่อ username โดยการรับค่ามาจากกล่อง username ที่หน้า Login
	$password = $_POST['txtPassword']; //ประกาศซตัวแปรชื่อ password โดยการรับค่ามาจากกล่อง password ที่หน้า Login
if($username == "") {                    //ถ้ายังไม่ได้กรอกข้อมูลที่ชื่อผู้ใช้ให้ทำงานดังต่อไปนี้
	//header("Location: login.php");
        echo"<body onload=\"window.alert('คุณยังไม่ได้ป้อนชื่อผู้ใช้');return location.href='index.php'\">";
       

//	echo "return history.go(-1)";	
//	echo "<a onclick='window.history.back()'>Back Page</a>";
} else if($password == "") {        //ถ้ายังไม่ได้กรอกรหัสผ่านให้ทำงานดังต่อไปนี้
	echo"<body onload=\"window.alert('คุณยังไม่ได้ป้อนรหัสผ่าน');return location.href='index.php'\">";
} else {                                               //ถ้ากรอกข้อมูลทั้งหมดแล้วให้ทำงานดังนี้
	include("dbcon.php");           //เรียก function สำหรับติดต่อฐานข้อมูลจากหน้า connect.php ขึ้นมา
	/////////////////////////////
	$nameSQL = "SELECT * FROM status ";
	$nameQuery = mysqli_query($con,$nameSQL);
	$nameResult = mysqli_fetch_array($nameQuery);
	//////////////////////////////////////////////////
	$sql = mysqli_query($con,"select * FROM member WHERE username ='$username' AND password ='$password' ");//ใช้ภาษา SQL ตรวจสอบข้อมูลในฐานข้อมูล

	$num = mysqli_num_rows($sql);  //ให้เอาค่าที่ได้ออกมาประกาศเป็นตัวแปรชื่อ $num
	if($num <=0) {                                                           //ถ้าหากค่าที่ได้ออกมามีค่าต่ำกว่า 1
		echo"<body onload=\"window.alert('ชื่อผู้ใช้ และ รหัสผ่าน ไม่ถูกต้อง');return location.href='index.php'\">";			
	}else{ 
		$value = mysqli_fetch_array($sql);
		if($value["status"] == "admin"){
			$_SESSION['ses_id'] = session_id();                      //สร้าง session สำหรับให้ User นำไปใช้งาน
			$_SESSION['ses_username'] = $value["username"];
			$_SESSION["id"] = $value["id"];
			header("location:management.php");
		}else{
			$_SESSION['ses_id'] = session_id();                      //สร้าง session สำหรับให้ User นำไปใช้งาน
			$_SESSION['ses_name'] = $value["name"];         
			$_SESSION['ses_username'] = $value["username"];
			$_SESSION["id"] = $value["id"];
		$REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
		$PHP_SELF = $_SERVER['PHP_SELF'];
		$_time=time();
		////////////////////////////////////////////////
			$name = $_SESSION['ses_name'];
			$useronline = session_id();
			//ถ้ามีการ login ให้เก็บค่าลงในฐานข้อมูล เพื่อตรวจสอบสถานะออนไลน์
	$nameSQL = "INSERT INTO status (name,time,ip,file) 
	VALUES ('$name','$_time','$REMOTE_ADDR','$PHP_SELF')";
	$nameQuery = mysqli_query($con,$nameSQL);
		////////////////////////////////////////////////////
		
		header("location:chatroom.php");  //ส่งค่าจากหน้านี้ไปหน้า
		}
	}
}
	mysqli_close($con);
?>
<!--
elseif(mysqli_query($con,"select * FROM member WHERE username ='$username'")){
		header("location:chatroom.php");
		}
