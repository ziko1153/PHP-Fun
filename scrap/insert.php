<?php
include('lib/db.php');
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


?>