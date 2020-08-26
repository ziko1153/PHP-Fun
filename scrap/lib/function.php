<?php

function get_total_all_keyword_records(){
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM tbl_keyword");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();

}



?>