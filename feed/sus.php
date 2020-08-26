<?php 

include ('lib/Database.php');
$db =  new Database();

///Set Date And Time From Jquery Moment Function 
$timezone   = $_POST['timezone'];
date_default_timezone_set($timezone); 
$datetime =  date('Y-m-d H:i:s') ;
$date = date('Y-m-d') ;
$time = date('H:i:s');

$negative = $_POST['negative'];
$positive  = $_POST['positive'];
$bro_name  = $_POST['bro_name'];
$bro_ver  = $_POST['bro_ver'];
$ip  = $_POST['ip'];

$query = "insert into tbl_feedback(date,time,bro_name,bro_ver,ip,negative,positive) values('$date','$time','$bro_name','$bro_ver','$ip','$negative','$positive')";

$res = $db->insert($query);

echo "hello";
//echo $negative+$positive;


?>