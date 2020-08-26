<?php 
include_once 'lib/db.php';



if(isset($_POST['search_key'])){

$from_date = $_POST['from_date'];
$to_date   = $_POST['to_date'];
$key_id   = $_POST['key_id'];

  $query = "  
  SELECT * FROM tbl_match  
  WHERE key_id = '".$key_id."' and  date BETWEEN '".$from_date."' AND '".$to_date."'  
  "; 


		$statement = $connection->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
			$data = array();
		foreach ($result as $row) {
			
			$data[] = $row;
		}

		echo json_encode($data);
}



?>