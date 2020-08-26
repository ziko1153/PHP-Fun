<?php

function upload_image()
{
	if(isset($_FILES["user_image"]))
	{
		$extension = explode('.', $_FILES['user_image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = './upload/working/' . $new_name;
		move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
		return $new_name;
	}
}

function get_image_name($image_id)
{  
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM tbl_image WHERE id = '$image_id'");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{  
		return $row["image"];
	}
}

function get_image_path($image_id)
{
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM tbl_image WHERE id = '$image_id'");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["path"];
	}
}

function get_total_all_records()
{
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM tbl_image where flag_status = 0");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}
function get_total_all_falg_records(){
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM tbl_image where flag_status = 1");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();

}

function get_total_all_keyword_records(){
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM tbl_keyword");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();

}
function get_total_all_pattern_records(){
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM tbl_pattern");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();

}
function get_total_all_good_records(){
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM tbl_image where flag_status = 2");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();

}


?>