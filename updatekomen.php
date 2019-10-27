<?php 

include("connect.php");
$caption = strval($_POST['caption']);



$stmt = $mysqli->prepare("SELECT max(idposting) from posting");
      $stmt ->execute();
      $res = $stmt->get_result();
        while($row = $res->fetch_assoc())
            {
               $idposting = $row['max(idposting)']; 
            }         


  $stmt = $mysqli->prepare("UPDATE posting set komen = ? where idposting = ?");
  $stmt->bind_param('si',$caption,$idposting);
  $stmt->execute();

 

  $stmt->close();





 ?>