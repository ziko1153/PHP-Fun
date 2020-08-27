<?php
set_time_limit(0);
include 'lib/db.php';
require 'simple_html_dom.php';

function UpdateKeyStatus($key_id, $status) {
    include 'lib/db.php';
    date_default_timezone_set('Asia/Kolkata');
    $time = date('h A');
    $date = date('Y/m/d');
    $query = "
   INSERT INTO tbl_match (key_id,date,time,con_status)
   VALUES ('" . $key_id . "','" . $date . "','" . $time . "','" . $status . "')
   ";
    $statement = $connection->prepare($query);
    $statement->execute();
}

//-----------------Function FinConverter Find Keyword From Google ----------------------//

function FindConverter($keyword) {
    $query = $keyword;
    $url = 'http://www.google.co.in/search?q=' . urlencode($query) . '&oq=' . urlencode($query) . '&hl=en&gl=in&ie=UTF-8';
    //$url = 'https://www.google.co.in/search?q='.urlencode($query).'&hl=en&gl=in';
    $html = file_get_html($url);
    $find = $html->find('div[class=J7UKTe]', 0);

    // echo $html;
    // die();
    if (empty($find) || $find == '') {
        $exists = 0;
    } else {
        $exists = 1;
    }
    return $exists;

}

/////...............Start This Script For Every Cronjob Call.....................//

$query = "SELECT * FROM tbl_keyword";
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
foreach ($result as $row) {
    $status = FindConverter($row["name"]);
    UpdateKeyStatus($row["id"], $status);
    sleep(1);
}

?>