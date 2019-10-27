<?php 
include("connect.php");
session_start();
if($_SESSION["user"] != true){
       
       header("Location: login.php");
       echo "<script>alert('Anda Harus Login');</script>";
       exit;
    }
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Instantgram Search</title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#searchbar").keyup(function(){
			var text = $(this).val();
			if(text != '' )
			{
				$('#searchresult').html('');
				$.ajax({
					url : "searchprocess.php",
					method : "post",
					data:{search:text},
					dataType:"text",
					success:function(data)
					{
						$("#searchresult").html(data);
					}
				}) 

			}
			else
			{

			}

		})
	})


</script>
<body>

<form>
	<a href="index.php">Go back</a>
	<h1>SEARCH BY ID</h1>
	<input type="text" name="searchbar" id="searchbar" placeholder="Search Username">
</form>


<div id="searchresult">
</div>
</body>
</html>

