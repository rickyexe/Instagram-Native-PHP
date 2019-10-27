<?php 

  include("connect.php");

if(isset($_POST['btnregister'])){
     
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT username FROM user where username = ? ");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if (mysqli_num_rows($res)>0) {
        $message = "Username sudah digunakan";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    else
    {
        $character = '0123456789abcdefghijklmnopqrstuvwxyz';
    $rndresult = substr(str_shuffle($character), 0, 10);
    $sha1password = sha1($password);
    $saltedpassword = $rndresult.$sha1password;
    $finalpassword = sha1($saltedpassword);

    
    
    $stmt = $mysqli->prepare("INSERT INTO user VALUES(?,?,?,?);");
    $stmt->bind_param("ssss", $username, $nama, $finalpassword, $rndresult);
    $stmt->execute();
    $stmt ->close();

    header('Location: login.php');
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
    <form method="POST">
    <p>Nama</p><input type="text" name="nama">
    <p>Username : </p> <input type="text" name="username">
    <p>Password</p> <input type="password" name="password">
    <input type="submit" name= "btnregister" value = "Register" >
    <a href="login.php">Back to login page</a>
    
    
    </form>
</body>
</html>