<?php
include('lib/db.php');
include('lib/function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM tbl_image WHERE flag_status = '2' ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'AND (path LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR description LIKE "%'.$_POST["search"]["value"].'%") ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$image = '';
	if($row["image"] != '')
	{
		$image = '<img src="'.$row["path"].'" alt="Not Found" class="img-thumbnail" width="50" height="50" />';
	}
	else
	{
		$image = '';
	}
	$sub_array = array();
	$sub_array[] = $image;
	$sub_array[] = $row["image"];
	$sub_array[] = '<button type="button" name="Move" id="'.$row["id"].'" class="btn btn-success btn-xs move">Move File</button>';
	$sub_array[] = '<label style="text-align: center;"> Delete    <input class="checkbox" type="checkbox" value="'.$row["id"].'"></label>';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_good_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>