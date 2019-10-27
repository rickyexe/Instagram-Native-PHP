<?php 
include("connect.php");
session_start();
$idposting = $_SESSION['idposting'];
$komentar = $_POST['komentar'];
$username = $_SESSION['user'];

if($komentar != "")
{
	$stmt = $mysqli->prepare("INSERT into balasan_komen(idposting,username,isi_komen) values(?,?,?)");
	$stmt->bind_param('iss',$idposting,$username,$komentar);
 	$stmt->execute();


	$stmt = $mysqli->prepare("SELECT username,isi_komen from balasan_komen where idposting = ?");
	$stmt->bind_param('i',$idposting);
 	$stmt->execute();
 	$res = $stmt->get_result();

  	while($row = $res->fetch_assoc())
  	{	
  		
  		$commentuser = "<div>".$row['username']." : ".$row['isi_komen']."</div>";
  		echo $commentuser;
  	}




 
}
else
{
	$stmt = $mysqli->prepare("SELECT username,isi_komen from balasan_komen where idposting = ?");
	$stmt->bind_param('i',$idposting);
 	$stmt->execute();
 	$res = $stmt->get_result();

  	while($row = $res->fetch_assoc())
  	{	
  		
  		$commentuser = "<div>".$row['username']." : ".$row['isi_komen']."</div>";
  		echo $commentuser;
  	}
}

		$stmt->close();



 ?>