<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
	//echo "Connection not succed";
}
else{
	//echo "Connection succed";
}
?>