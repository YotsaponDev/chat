	<?php
	include('example3_connect_db.php');  //ตัวแสดงผล
	
	echo "<head>";
	//	echo "<meta http-equiv=\"refresh\" content=\"3\">\n";
		echo "</head>\n";

		$query="select * from tbmyt1";
		$result=mysqli_query($handle,$query);
		

		while($data=mysqli_fetch_array($result)){
				$message=$data['message'];
				echo "$message<br>";
		}

?>

