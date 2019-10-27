<?php 

session_start();
include("connect.php");
if(isset($_POST['btnlogin']))
{
	$username = strval($_POST['username']);
	$userpassword = strval($_POST['password']);

	if(isset($username) && isset($userpassword))
	{

		$stmt = mysqli_query($mysqli, "SELECT username, password, salt FROM user WHERE username = '$username'");

		list($username, $password, $salt) = mysqli_fetch_array($stmt);

		$sha1password = sha1($userpassword);
    	$saltedpassword = $salt.$sha1password;
    	$finalpassword = sha1($saltedpassword);



		if(mysqli_num_rows($stmt) > 0)
		{
			if ($password == $finalpassword)
			{
				$_SESSION['user'] = $username;
				header('Location: index.php');	
			}
			else
			{
				echo '<script language="javascript">
                        window.alert("LOGIN GAGAL! Silakan coba lagi");
                        window.location.href="./";
                      </script>';


			}
		}
	}
	else
	{
		$message = "Isi username dan password";
        echo "<script type='text/javascript'>alert('$message');</script>";
                      

	}
}




 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h2>WELCOME TO INSTANTGRAM</h2>
<form  method="POST">
<p>Username : </p>
<input type="text" name="username">
<p>Password : </p>
<input type="password" name="password"><br>
<input type="submit" name="btnlogin" value="Login" >

</form>

<a href="register.php">Dont have an account? Register now</a>
     
</body>
	
</html>


