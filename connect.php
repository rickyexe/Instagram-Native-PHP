<?php
	$server = 'localhost';
    $uid = 'yourid';
    $pwd = 'yourpwd';
    $db = 'yourdb';

	 $mysqli = new mysqli($server, $uid, $pwd, $db);
	if (mysqli_connect_errno()){
        echo "Connect Failed";
        exit();
    }

?>
