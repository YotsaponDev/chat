<?php
		session_start(); //เปิด session
		//include("dbcon.php");
		require_once("dbcon.php"); 
		$ses_id =$_SESSION[ses_id];                 //สร้าง session สำหรับเก็บค่า ID
		$ses_username = $_SESSION[ses_username];         //สร้าง session สำหรับเก็บค่า username
		$ses_name = $_SESSION[ses_name]; 
		$REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
		$PHP_SELF = $_SERVER['PHP_SELF'];
		
		$timeoutseconds = 360; //ตั้งเวลาสำหรับเช็คคนออนไลน์ เป็นวินาที 60= 1 นาที
		$_time=time();
		$timeout=$_time-$timeoutseconds;
		//echo "$_time";
		if($ses_id <> session_id() or  $ses_username ==""){  //ตรวจสอบว่าทำการ Login เข้าสู่ระบบมารึยัง
			header("location:index.php");
		} 


	mysqli_query($con, "DELETE FROM status WHERE time<$timeout"); //or die("Useronline Database DELETE Error");
	
	//เช็คว่า ผู้ใช้เกินกำหนดเวลาที่ตั้งไว้ ให้ลบออกฐานข้อมูล
	mysqli_query($con, "UPDATE status SET time = '$_time' WHERE name = '$ses_name'")
	or die("Useronline Database INSERT Error".mysqli_error($con));
// ถ้าโหลดเวบอีกครั้ง จะให้เก็บค่าของเวลาใหม่ ของผู้ใช้เดิม ลงในฐานข้อมูล


//	$result=mysqli_query($con, "SELECT DISTINCT ip FROM status WHERE file='$PHP_SELF'") or die("Useronline Database SELECT Error");
//ให้นับจำนวนเรคคอร์ดในตารางทั้งหมด ที่มี IP ต่างกัน ว่ามีเท่าไหร่ โดย IP เดียวกันให้นับเป็นคนเดียว
	?>

<!DOCTYPE html>
<html>
<head >

	<meta charset="UTF-8" />
	<title>.::Chat-RooM::.</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	

</head>

<body bgcolor = "#A9E2F3">

	<center><div  class="header">
		<?php echo "<font style='color:white'>ยินดีต้อนรับ $ses_name</font>" ?>
		<a href="logout.php" class="button1" type="button">ออกจากระบบ</a> <!-- ออกจากระบบ -->
	</div></center>
<table align="center">
<td>
<div id="scroll">
<?php
session_start();
$thislink=$_SERVER["PHP_SELF"];

		echo "<head>";
		//echo "<meta http-equiv=\"refresh\" content=\"3\">\n";
		echo "</head>\n";
	
		echo "<span id='showit'>Nothing</span>\n";
		echo "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script> \n";
            echo   "<script language=\"JavaScript\" type=\"text/javascript\">\n";
            echo  "function getdata(){\n";
            echo  "   var xmlHttp;\n";
            echo  "   try{\n";
            echo  "    // Firefox, Opera 8.0+, Safari\n";
            echo  "    xmlHttp=new XMLHttpRequest();\n";
            echo  "   }\n";
            echo  "   catch (e){\n";
            echo  "        try {\n";  // IE6
            echo  "             xmlHttp=new ActiveXObject(\"Msxml2.XMLHTTP\");\n";
            echo  "        }\n";
            echo  "        catch (e){\n";
            echo  "                 try {\n";   // IE5
            echo  "                      xmlHttp=new ActiveXObject(\"Microsoft.XMLHTTP\");\n";
            echo  "                 }\n";
            echo  "                 catch (e) {\n";
            echo  "                           alert(\"Your browser does not support AJAX!\");\n";
            echo  "                           return false;\n";
            echo  "                 }\n";
            echo  "        }\n";
            echo  "   }\n";

            echo  "   xmlHttp.onreadystatechange=function() {\n";
            echo  "        if(xmlHttp.readyState==4) {\n";
            echo  "                 var a = xmlHttp.responseText;\n";
            echo  "                  document.getElementById('showit').innerHTML= a;\n";
            echo  "        }\n";
            echo  "   }\n";
            echo  "    xmlHttp.open(\"GET\",'input_text.php',true);\n";  //รับค่าเป็นข้อความ มาแสดง
            echo  "    xmlHttp.send(null);\n";
            echo  "    setTimeout('getdata()',1700);\n"; // ดึงข้อมูลทุกๆ 1.7 sec.
			echo  "    $('#scroll')[0].scrollTop = $('#scroll')[0].scrollHeight;\n";
            echo  "	  }\n";
            echo  "if(getdata()!=null){ }";
            echo  "   getdata();\n";  // แสดงข้อความผ่านหน้าจอ browser
            echo  "</script>\n";
?>
</div>
</td>
 <!--  //     echo  "  $('#scroll').animate({ scrollTop: $('#scroll')[0].scrollHeight}, 2000);";
         //   echo  "   var wtf = $('#scroll'); var height = wtf[0].scrollHeight; wtf.scrollTop(height);\n";  -->

<td><div class="user">
<?php

include("dbcon2.php");
$sql = "SELECT * FROM status";
$result = $conn->query($sql);

if (getenv("HTTP_CLIENT_IP")) $ip = getenv("HTTP_CLIENT_IP"); 
	else if(getenv("HTTP_X_FORWARDED_FOR")) $ip = getenv("HTTP_X_FORWARDED_FOR"); 
	else if(getenv("REMOTE_ADDR")) $ip = getenv("REMOTE_ADDR"); 
	else $ip = "UNKNOWN"; 
	$ip=trim($ip); 

if ($result->num_rows > 0) {
    // output data of each row
   echo "<center><font style='color:#137F7D'>ผู้ใช้งานในขณะนี้ </font></center>";
    while($row = $result->fetch_assoc()) {
        echo "<div id='use'>&nbsp; <font style='color:#00FF00'>●</font> " . $row["name"]. "&nbsp;IP:$ip</div>";
   //แสดงผู้ใช้งานเมื่อ login เข้าสู่ระบบ
    }
} else {
    echo "0 results";
}
$conn->close();
?>

</div></td>
</table>
<?php
//session_start();

//$thislink=$_SERVER["PHP_SELF"];

include('example3_connect_db.php');



if(isset($_REQUEST["submit"]) and $_REQUEST["message"]!=''){ //ถ้ามีการกดปุ่ม /ส่งข้อความ หรือ กด enter และมีการป้อนข้อความ  
		// save submition
		$message=$_REQUEST["message"]; 
		$query="insert tbmyt1 (username,message) values ('$ses_name','$message')"; //เพิ่มข้อมูลลงในฐานข้อมูล
		mysqli_query($handle,$query);  //ส่ง
	
	//echo "$('#scroll')[0].scrollTop = $('#scroll')[0].scrollHeight; ";
}

?>

<table align="center"><td> <!-- ตารางสำหรับส่งข้อความ -->
<div class = "chatbox">
        <form method="post" action="chatroom.php">
    
		<input type="text" id="message" name="message" >
   
		<input type="submit" name="submit" value="ส่งข้อความ">
		</form>
  </div></td>
</table>

</body>
</html>





