<?php
	include 'dbconfig.php';

	$upload_path='image/';
	$upload_url='http://192.168.214.2/teaching/Webapi/'.$upload_path;


	//var_dump($upload_url);die();test

	$response = array();

	if($_SERVER['REQUEST_METHOD']=='POST'){

		if (isset($_POST['name']) and isset($_POST['description']) and isset($_FILES['image']['name'])) {
			$name=$_POST['name'];
			$description=$_POST['description'];
			$fileinfo=pathinfo($_FILES['image']['name']);
			$extension = $fileinfo['extension'];
			$file_url = $upload_path . getFileName() . '.'. $extension; 
			$file_path= $upload_path . getFileName() . '.'. $extension; 

			//var_dump($file_path);die();

			try {
				move_uploaded_file($_FILES['image']['tmp_name'], $file_path);

				$sql = "INSERT INTO `user` (`name`,`description`,`photo`) VALUES ('$name','$description','$file_url')";

				if(mysqli_query($conn,$sql)){
					$response['error']=false;
					$response['name']=$name;
					$response['description']=$description;
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
	
	function getFileName(){
		$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university";
		$conn = mysqli_connect($servername, $username, $password, $dbname) or die('Unable to Connect...');
		$sql = "SELECT max(id) as id FROM user";
		$result = mysqli_fetch_array(mysqli_query($conn,$sql));
		
		mysqli_close($conn);
		if($result['id']==null)
			return 1; 
		else 
			return ++$result['id']; 
	}
?>
