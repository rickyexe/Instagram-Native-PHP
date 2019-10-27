<?php 
include("connect.php");
session_start();
$index = $_POST['index'];
$idposting = $_SESSION['idposting'];



 $stmt = $mysqli->prepare("SELECT count(idgambar) from gambar where idposting = ?");
  $stmt->bind_param('i', $idposting);
  $stmt->execute();
  $res = $stmt->get_result();

  while($row = $res->fetch_assoc())
 	{
 		$jumlahgambar = $row['count(idgambar)'];
 			
 	}	

 	$stmt->close();


 	if($jumlahgambar == 1)
 	{
 		$statement = $mysqli->prepare("SELECT idgambar, extention from gambar where idposting = ? LIMIT 1");
  	$statement->bind_param('i', $idposting);
  	$statement->execute();
  	$result = $statement->get_result();


  	 	 	 	 		
 			while($row = $result->fetch_assoc())
 			{
 				$idgambar = $row["idgambar"];
 				$extention = $row["extention"];
 				
 				$gambarfinal = "<div> <img src='upload/".$idgambar.".".$extention."'"."style='width: 250px ; height: 250px'></div>";
 				
 			}	

 			echo $gambarfinal;
 			
 			$statement->close();
 	}
 	else
 	{
 		$statement = $mysqli->prepare("SELECT idgambar, extention from gambar where idposting = ? LIMIT 1 offset ?");
  	$statement->bind_param('ii', $idposting,$index);
  	$statement->execute();
  	$result = $statement->get_result();


  	 	 	 	 		
 			while($row = $result->fetch_assoc())
 			{
 				$idgambar = $row["idgambar"];
 				$extention = $row["extention"];
 				
 				$gambarfinal = "<div> <img src='upload/".$idgambar.".".$extention."'"."style='width: 250px ; height: 250px'></div>";
 				
 			}	

 			echo $gambarfinal;
 			
 			$statement->close();
 	}

	

 	


 ?>