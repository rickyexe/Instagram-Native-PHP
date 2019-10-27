<?php 
include("connect.php");
// seharusnya username sendii tidak muncul jado except username . look how to do it in google dude
$stmt = $mysqli->prepare("SELECT username from user where username LIKE '%".$_POST["search"]."%'");
 		$stmt->execute();
 		$res = $stmt->get_result();

 		// $row = $res->fetch_assoc();
 		if(mysqli_num_rows($res) > 0)
 		{
 			while($row = $res->fetch_assoc())
 			{
 				$searchresult = "<div> <a href='instantgramothuser.php?user=".$row['username']."'>".$row['username']." </a> </div>";
 				echo $searchresult;
 			}

 			
 		}
 		else
 		{
 				echo "User tidak ditemukan";
 		}

 		$stmt->close();


 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 </body>
 </html>