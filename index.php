<?php 
include("connect.php");
session_start();
if($_SESSION["user"] != true){
       
       header("Location: login.php");
       echo "<script>alert('Anda Harus Login');</script>";
       exit;
    }
$username = $_SESSION['user'];
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>WELCOME TO INSTANTGRAM</title>
</head>
<body>

	<h1><?php echo $_SESSION['user']; ?> </h1> 
	<a href="newerpost.php">Tambah Posting</a><br>
	<a href="search.php">Search User</a>
	<br>
	<a href="logout.php">Logout</a>

	<div>
		
	


	<?php 
 		$stmt = $mysqli->prepare("SELECT idposting from posting where username = '".$username."' order by idposting desc");
 		$stmt->execute();
 		$res = $stmt->get_result();

 		while($row = $res->fetch_assoc())
 		{
 				$idposting = $row['idposting'];

 			$stmt = $mysqli->prepare("SELECT min(idgambar), extention from gambar where idposting = ".$idposting."");
 			$stmt->execute();
 			$result = $stmt->get_result();

 			while($rows = $result->fetch_assoc())
 			{
 				 echo "<div style='float : left ; width : 300px ; height 400px'> <a href= 'detilposting.php?idposting=".$row['idposting']."'><img src='upload/".$rows['min(idgambar)'].".".$rows['extention']."'"."style='width:200px ; height: 300px'></a></div>";

 			}


 		}


 		$stmt->close();








	 ?>

	 </div>
</body>

</html>