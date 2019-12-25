<?php
	require 'dbconfig.php';

	if($conn){
		$name=$_POST['name'];
		$description=$_POST['description'];
		$image = $_POST['image'];
		$upload_path = 'image/'.$name.'.jpg';
		
		$sql = "INSERT INTO `user` (`name`,`description`,`photo`) VALUES ('$name','$description','$upload_path')";
		
		if(mysqli_query($conn,$sql)){
			file_put_contents($upload_path,base64_decode($image));
			echo json_encode(array('response'=>'Image uploaded successfully..'));
		}else{
			echo json_encode(array('response'=>'Image upload failed...'));
		}
		
		mysqli_close($conn);
		
	}
?>
