<?php
	include 'dbconfig.php';

	$upload_path='image/';
	$upload_url='http://localhost/teaching/Webapi/'.$upload_path;


	//var_dump($upload_url);die();test

	$response = array();

	if($_SERVER['REQUEST_METHOD']=='POST'){

		if (isset($_POST['name']) and isset($_POST['email']) and isset($_FILES['image']['name'])) {
			$name=$_POST['name'];
			$email=$_POST['email'];
			$fileinfo=pathinfo($_FILES['image']['name']);
			$extension = $fileinfo['extension'];
			$file_url = $upload_url.'IMG_'.$name.'.'.$extension;
			$file_path= $upload_path.'IMG_'.$name.'.'.$extension;

			//var_dump($file_path);die();

			try {
				move_uploaded_file($_FILES['image']['tmp_name'], $file_path);

				$sql = "INSERT INTO `user` (`name`,`email`,`photo`) VALUES ('$name','$email','$file_url')";

				if(mysqli_query($conn,$sql)){
					$response['error']=false;
					$response['name']=$name;
					$response['email']=$email;
				}
			} catch (Exception $e) {
					$response['error']=true;
					$response['message']=$e->getMessage();
			}

			echo json_encode($response);
			mysqli_close($conn);

		}
	}else{
		echo "else condition";
	}
?>
