<?php 
include("connect.php");
session_start();
$idposting = $_SESSION['idposting'];



$stmt = $mysqli->prepare("SELECT count(idgambar) from gambar where idposting = ?");
  $stmt->bind_param('i', $idposting);
  $stmt->execute();
  $res = $stmt->get_result();

  while($row = $res->fetch_assoc())
 	{
 		$jumlahgambar = $row['count(idgambar)'];
 			
 	}	

 	echo $jumlahgambar;
 	$stmt->close();