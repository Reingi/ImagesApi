<?php

require 'dbconfig.php';

$sql = "SELECT `name`,`description`,`photo` as image FROM `user`";

$result = mysqli_query($conn,$sql);
$json_arry = array();
while($row = mysqli_fetch_assoc($result)){
	$json_array[] = $row;
}

echo json_encode($json_array);
mysqli_close($conn);

?>
