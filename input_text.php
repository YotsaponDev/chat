<!DOCTYPE html>
<html>
<head >
	<meta charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="css/message.css" />

</body>
</html>

<?php
session_start();

$thislink=$_SERVER["PHP_SELF"];

include('example3_connect_db.php');
$ses_name = $_SESSION['ses_name']; 

		$query="select * from tbmyt1";
		$result=mysqli_query($handle,$query);
		$date="select time from tbmyt1";
		
		$str='';
		while($data=mysqli_fetch_array($result)){
				$username=$data['username'];
				$message=$data['message'];
				$time=$data['time'];
							
				$str .= "<small>$username [$time]</small> <div>  &nbsp;$message</div> ";
		}
	
		$result=mysqli_query($handle,$query);
		$data=mysqli_fetch_array($result);	

echo $str;  //ส่งข้อความไปยังหน้า chat ที่ถูก get

?>
