<?php

include 'lib/Database.php';
$db = new Database();

///Set Date And Time From Jquery Moment Function
$timezone = $_POST['timezone'];
date_default_timezone_set($timezone);
$datetime = date('Y-m-d H:i:s');
$date = date('Y-m-d');
$time = date('H:i:s');

$negative = $_POST['negative'];
$positive = $_POST['positive'];
$bro_name = $_POST['bro_name'];
$bro_ver = $_POST['bro_ver'];
$ip = $_POST['ip'];
$city = $_POST['city'];
$country = $city . ' /' . $_POST['country_name'];

$query = "insert into tbl_feedback(date,time,country,bro_name,bro_ver,ip,negative,positive) values('$date','$datetime','$country','$bro_name','$bro_ver','$ip','$negative','$positive')";

$res = $db->insert($query);

if ($res) {
    echo 'success';
} else {
    echo 'error';
}
//echo $negative+$positive;

?>