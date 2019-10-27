<?php 
include("connect.php");
session_start();
if($_SESSION["user"] != true){
       
       header("Location: login.php");
       echo "<script>alert('Anda Harus Login');</script>";
       exit;
    }
$idposting = $_GET['idposting'];
$username = $_SESSION['user'];
$_SESSION['idposting'] = $idposting;
$index = 1;

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Detil Posting</title>
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
 	 <script>
 		
      $(document).ready(function(){
 		 	
         var index = <?php echo $index;?>;

         
         $("#btnsubmit").click(function(){


            var formData = $("#formkomen").serialize();

            $.ajax({
               url: "insertkomen.php",
               type: 'POST',
               data: formData,
               success:function(data)
               {
                  $("#comments").html(data);
               }

            });

         });

 		 	$("#likebutton").click(function(){
 		 			$.ajax({
 		 				url : "like.php",
 		 			success:function(data)
 		 			{
 		 				$("#likenumber").html(data)
 		 			}
 		 				});
 		 		
 		 	});

         $("#btnnext").click(function(){
            $.ajax({
               url : "imageslidernext.php",
               type: "POST",
               dataType: 'text',
               data: {index: index},
               success:function(data)
               {
                  $("#imageposting").html(data);
                  index = index + 1;


                  
               }
            });

            $("#btnnext").click(function(){
               $.ajax({
               url : "imageslidernextmax.php",
               success:function(data)
               {
                  if(index == data)
                  {
                     index = data-1;
                  } 
               }
            });
         });
		 });

            $("#btnprev").click(function(){
                
                if(index <= 0)
                  {
                    index = 0;
                  } 
                else
                {
                  index = index - 1;
                }

               $.ajax({
                  url: "imagesliderprev.php",
                  type: "POST",
                  dataType: 'text',
                  data: {index: index},
                  success:function(data)
                  {
                     $("#imageposting").html(data);
                    
                  }
               });
            });
      });
 	</script>
 </head>
 <body>
  <a href="javascript:history.go(-1)" title="Return to the previous page">Go back</a>
  <?php 
    $stmt = $mysqli -> prepare("SELECT username from posting where idposting = ?");
    $stmt->bind_param("i",$idposting);
    $stmt-> execute();
    $res= $stmt->get_result();

    while($row-> $res->fetch_assoc())
    {
      $usernameothuser = $row['username'];
    }


   ?>
<?php echo "<h2>".$usernameothuser."</h2>"; ?>
<!-- IMAGE -->
<div class="container" style="display: flex">
<img src="previous.png" id="btnprev" style="width: 100px; height: 100px"> 

   <div id="imageposting">
      <?php 
      $stmt = $mysqli->prepare("SELECT min(idgambar), min(extention) from gambar where idposting = ? ");
      $stmt->bind_param('i',$idposting);
      $stmt->execute();
      $res = $stmt ->get_result();
      while($row = $res->fetch_assoc())
         {
            $idgambar = $row['min(idgambar)'];
            $extention = $row['min(extention)'];
            
             echo "<div> <img src='upload/".$idgambar.".".$extention."'"."style='width: 250px ; height: 250px'></div>";


         }  

      $stmt->close();   
       ?>
      

   </div>
   <img src="next.png" id="btnnext" style="width: 100px; height: 100px">


</div>





<!-- CAPTION -->
<?php 
		$stmt = $mysqli->prepare("Select komen from posting where idposting = '".$idposting."'");
 		$stmt->execute();
 		$res = $stmt->get_result();

 		while($row = $res->fetch_assoc())
 		{
         echo "</br>";
 			echo $row['komen'];
 		}

 		$stmt->close();


 ?>
 <div id="likecontainer" style="display: inline-flex;">
<div>
<input type="image" src="like.png" style="width : 50px; height : 50px" name="like" id="likebutton">	
</div>
 <!-- LIKE -->
 <div id="likenumber">
 <?php 
$stmt = $mysqli->prepare("SELECT count(username) from jempol_like where idposting =".$idposting."");
 		$stmt->execute();
 		$res = $stmt->get_result();

 		while($row = $res->fetch_assoc())
 		{
 			echo $row['count(username)'];
 		}

 		$stmt->close();

  ?>
</div>
</div>




<h3>KOMENTAR</h3>
 

<!--  BALASAN KOMEN -->

<div id="comments">
<?php 
$stmt = $mysqli->prepare("SELECT username, isi_komen from balasan_komen where idposting = ".$idposting."");
 		$stmt->execute();
 		$res = $stmt->get_result();

 		while($row = $res->fetch_assoc())
 		{
 			echo "<div>";
 			echo "".$row['username']." : ".$row['isi_komen']."";
 			echo "</div>";
 		}

 		$stmt->close();
 ?>
 </div>

 <form  method="POST" id="formkomen">
 	
 	<input type="textarea" name="komentar" required>
 	<input type="button" name="submit" id="btnsubmit" value="Submit Comment" >
 	
 
</form>


 </body>
 </html>