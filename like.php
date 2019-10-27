<?php 
include("connect.php");
session_start();
$username = $_SESSION['user'];
$idposting = $_SESSION['idposting'];


$stmt = $mysqli->prepare("SELECT username from jempol_like where idposting = ? and username = ?");
  $stmt->bind_param('is', $idposting,$username);
  $stmt->execute();
  $res = $stmt->get_result();

  if(mysqli_num_rows($res) == 1)
  {
  	$statement = $mysqli->prepare("DELETE FROM jempol_like where idposting = ? AND username = ? ");
  		$statement->bind_param('is', $idposting, $username);
  		$statement->execute();

 	$statement = $mysqli->prepare("SELECT count(username) from jempol_like where idposting =".$idposting."");
 		$statement->execute();
 		$res = $statement->get_result();

 		if(mysqli_num_rows($res) > 0)
 		{
 			while($row = $res->fetch_assoc())
 			{
 				$like = $row['count(username)'];
 				echo $like;
 			}	
 		}
  	


  }
  else
  {
  		$statement = $mysqli->prepare("INSERT into jempol_like(idposting,username) values(?,?)");
  		$statement->bind_param('is', $idposting, $username);
  		$statement->execute();


  		$statement = $mysqli->prepare("SELECT count(username) from jempol_like where idposting =".$idposting."");
 		$statement->execute();
 		$res = $statement->get_result();

 		if(mysqli_num_rows($res) > 0)
 		{
 			while($row = $res->fetch_assoc())
 			{
 				$like = $row['count(username)'];
 				echo $like;
 			}	
 		}
  }


  $stmt->close();







 	






 ?>