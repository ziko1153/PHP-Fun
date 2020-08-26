<?php
include('lib/db.php');
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








?>