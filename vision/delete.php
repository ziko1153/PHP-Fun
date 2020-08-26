<?php

include('lib/db.php');
include("lib/function.php");


if(isset($_POST["key_id"])){

	$statement = $connection->prepare(
		"DELETE FROM tbl_keyword WHERE id = :id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["key_id"]
		)
	);

}

if(isset($_POST['dlt_selected_btn'])){
	$itemid = $_POST['itmID'];
	$n = count($itemid);
	for($i=0; $i<$n; $i++){
	$image = get_image_name($itemid[$i]);
	if($image != '')
	{   if(isset($_POST['flag_remove'])){

		unlink("upload/flag/" . $image);
		}else if(isset($_POST['good_remove'])){
			unlink("upload/good/" . $image);
		}else{
			unlink("upload/working/" . $image);
		}
	}
	$statement = $connection->prepare(
		"DELETE FROM tbl_image WHERE id = :id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	$itemid[$i]
		)
	);
	}
}

if(isset($_POST['dlt_selected_key'])){
	$keyid = $_POST['keyid'];
	$n = count($keyid);
	for($i=0; $i<$n; $i++){
	$statement = $connection->prepare(
		"DELETE FROM tbl_keyword WHERE id = :id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	$keyid[$i]
		)
	);
	}
}
if(isset($_POST['dlt_selected_pattern'])){
	$patternId = $_POST['patternId'];
	$n = count($patternId);
	for($i=0; $i<$n; $i++){
	$statement = $connection->prepare(
		"DELETE FROM tbl_pattern WHERE id = :id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	$patternId[$i]
		)
	);
	}
}

if(isset($_POST["pattern_id"])){

	$statement = $connection->prepare(
		"DELETE FROM tbl_pattern WHERE id = :id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["pattern_id"]
		)
	);

}

if(isset($_POST["image_id"])&& !isset($_POST["move"]))
{
	$image = get_image_name($_POST["image_id"]);
	if($image != '')
	{   if(isset($_POST['flag_remove'])){

		unlink("upload/flag/" . $image);
		}else if(isset($_POST['good_remove'])){
			unlink("upload/good/" . $image);
		}else{
			unlink("upload/working/" . $image);
		}
	}
	$statement = $connection->prepare(
		"DELETE FROM tbl_image WHERE id = :id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["image_id"]
		)
	);
	
	if(!empty($result))
	{
		echo 'Data Deleted';
	}
}
if(isset($_POST["image_id"])&&isset($_POST["move"]))
{
	$name = get_image_name($_POST["image_id"]);
	$path = get_image_path($_POST["image_id"]);
	$destination_path = 'upload/working/'.$name;
	if($name != '')
	{  rename($path,$destination_path);
		//unlink($path);
	}
		$statement = $connection->prepare(
			"UPDATE tbl_image 
			SET path = :path,
				flag_status = :flag_status
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':path' 	   => $destination_path,
				':flag_status'    => 0,
				':id'		   => $_POST["image_id"]
			)
		);
	
	if(!empty($result))
	{
		echo 'Move Image To Working Folder';
	}
}



?>