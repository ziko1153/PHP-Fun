<?php
include('lib/db.php');
include('lib/function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		$statement = $connection->prepare("
			INSERT INTO users (first_name, last_name, image) 
			VALUES (:first_name, :last_name, :image)
		");
		$result = $statement->execute(
			array(
				':first_name'	=>	$_POST["first_name"],
				':last_name'	=>	$_POST["last_name"],
				':image'		=>	$image
			)
		);
		if(!empty($result))
		{
			echo 'Data Inserted';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
			$path = 'upload/working/'.$image;
		}
		else
		{
			$image = $_POST["hidden_user_image"];
			$path = 'upload/working/'.$image;
		}
		$statement = $connection->prepare(
			"UPDATE tbl_image 
			SET path = :path, description = :description, image = :image  
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				
				':path'	=>			$path,
				':description'	=>	$_POST["description"],
				':image'		=>	$image,
				':id'			=>	$_POST["image_id"]
			)
		);

		if(!empty($result))
		{
			echo 'Image Updated';
		}
		
	}
}

if(isset($_POST['insert_key'])){

	$name = trim($_POST['keyword']);

	$statement = $connection->prepare("
			INSERT INTO tbl_keyword (name) 
			VALUES (:name)
		");
		$result = $statement->execute(
			array(
				
				':name'		=>	$name
			)
		);

		echo $result;
}
if(isset($_POST['insert_pattern'])){

	$name = $_POST['pattern'];

	$statement = $connection->prepare("
			INSERT INTO tbl_pattern (name) 
			VALUES (:name)
		");
		$result = $statement->execute(
			array(
				
				':name'		=>	$name
			)
		);

		echo $result;
}

?>