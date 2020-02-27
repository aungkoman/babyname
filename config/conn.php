<?php
/* local development database server */
$servername = $_SERVER['HTTP_DB_HOST'];
$username = $_SERVER['HTTP_DB_USERNAME'];
$password = $_SERVER['HTTP_DB_PASSWORD'];
$db_name = $_SERVER['HTTP_DB_DBNAME'];
R::setup( 'mysql:host='.$servername.';dbname='.$db_name.'', $username, $password ); # real db
//R::setup( 'mysql:host=localhost;dbname=family', 'root', '' ); # real db
// $conn = new mysqli($servername, $username, $password, $db_name);
// if($conn->connect_error){
// 	//echo "error in connection ". $conn->connect_error;
// }
// else {
// 	//echo "<br> Database Connected to mhmsv2 database  ";
// }
// mysqli_set_charset($conn,"utf8");
?>
