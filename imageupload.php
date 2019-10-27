<?php 
include('connect.php');
session_start();
 
 $username = $_SESSION['user'];


$stmt = $mysqli->prepare("INSERT into posting(username) values(?)");
          $stmt->bind_param('s',$username);
          $stmt ->execute();

$stmt = $mysqli->prepare("SELECT max(idposting) from posting");
      $stmt ->execute();
      $res = $stmt->get_result();
        while($row = $res->fetch_assoc())
            {
               $idposting = $row['max(idposting)']; 
            }         

 // Count total files
 $countfiles = count($_FILES['file']['name']);

 // Looping all files
 for($i=0;$i<$countfiles;$i++){
     $stmt = $mysqli->prepare("SELECT max(idgambar) from gambar");
                         $stmt ->execute();
                         $res = $stmt->get_result();
                         while($row = $res->fetch_assoc())
                         {
                            $idgambar =  $row['max(idgambar)'];   
                         }

   if($idgambar == null)
   {
          $idgambar = 1;
   }
   else
   {
          $idgambar = $idgambar + 1;
   }

  $pathInfo = $_FILES['file']['name'][$i];
  $fileType = pathinfo($pathInfo,PATHINFO_EXTENSION);
  $filename = $idgambar.".".$fileType;

  // Upload file
  move_uploaded_file($_FILES['file']['tmp_name'][$i],'upload/'.$filename);


  $stmt = $mysqli->prepare("INSERT into gambar(idposting,extention) values(?,?)");
  $stmt->bind_param('is',$idposting,$fileType);
  $stmt->execute();

  $stmt->close();

$message = "Berhasil Upload Foto";
  echo $message;
                        
 
  
 
 }

?>