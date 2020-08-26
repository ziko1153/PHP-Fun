<?php
include('lib/db.php');
include('lib/function.php');

if(isset($_POST["keyword"])){
		$output = array();
		$query = '';
		$output = array();
		$query .= "SELECT * FROM tbl_keyword ";

		if(isset($_POST["search"]["value"]))
		{
		$query .= 'WHERE name LIKE "%'.$_POST["search"]["value"].'%" ';
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
$i = 1;
foreach($result as $row)
{
	
	$sub_array = array();
	$sub_array[] = $i++;
	$sub_array[] = $row["name"];
	// $sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
	$sub_array[] = '<label style="text-align: center;"> Delete    <input class="checkbox" type="checkbox" value="'.$row["id"].'"></label>';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_keyword_records(),
	"data"				=>	$data
);
 echo json_encode($output);

		                
}
else if(isset($_POST["pattern"])){
		$output = array();
		$query = '';
		$output = array();
		$query .= "SELECT * FROM tbl_pattern ";

		if(isset($_POST["search"]["value"]))
		{
		$query .= 'WHERE name LIKE "%'.$_POST["search"]["value"].'%" ';
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
$i = 1;
foreach($result as $row)
{
	
	$sub_array = array();
	$sub_array[] = $i++;
	$sub_array[] = $row["name"];
	// $sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
	$sub_array[] = '<label style="text-align: center;"> Delete    <input class="checkbox" type="checkbox" value="'.$row["id"].'"></label>';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_pattern_records(),
	"data"				=>	$data
);
 echo json_encode($output);

		                
}




?>