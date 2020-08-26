<?php
include_once('config/config.php');
try{
$connection = new PDO( "mysql:host=".DB_HOST.";dbname=".DB_NAME."",DB_USER, DB_PASS);
$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e ){

	echo "Connection Failed : ".$e->getMessage();
}
?>