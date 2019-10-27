<?php
	$server = 'localhost';
    $uid = 'rickygideon';
    $pwd = '12089912';
    $db = 'id7853395_instantgram';

	 $mysqli = new mysqli($server, $uid, $pwd, $db);
	if (mysqli_connect_errno()){
        echo "Connect Failed";
        exit();
    }

?>