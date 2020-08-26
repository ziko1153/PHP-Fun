<?php
include('lib/db.php');
include('lib/function.php');
if(isset($_POST["image_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM tbl_image 
		WHERE id = '".$_POST["image_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["description"] = $row["description"];
		if($row["path"] != '')
		{
			$output['user_image'] = '<img src="'.$row["path"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["image"].'" />';
		}
		else
		{
			$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>