<?php
set_time_limit(0);
use Google\Cloud\Vision\VisionClient;
require "vendor/autoload.php";
if (isset($_POST['progress'])) {
    $myfile = fopen("progress.txt", "w+");
    fwrite($myfile, 1);
    fclose($myfile);
}
include 'lib/db.php';

$result_msg = array();
$result_msg['error'] = 1;
$result_msg['message'] = "Demo Purpose Operation Disabled";

echo json_encode($result_msg);
die();

function KeyWordMatching($path, $value, $id) {
    include 'lib/db.php';
    $data = json_decode($value, true);
    $flag = 0;
    if (array_key_exists("textAnnotations", $data)) {

        $listword = trim($data['textAnnotations'][0]['description']);
        $matchkey = "";
        $matchpattern = "";

        // for ($i=1; $i <count($data['textAnnotations']) ; $i++) {

        //     $listword .= $data['textAnnotations'][$i]['description'];

        // }

        ////Key Word Check Form Database

        $statement = $connection->prepare(
            "SELECT * FROM tbl_keyword"
        );
        $statement->execute();
        $result = $statement->fetchAll();
        foreach ($result as $row) {

            if (strpos(trim($listword), trim($row["name"])) !== false) {
                $matchkey .= $row["name"] . ",";
                $flag = 1;

            }

        }

        ///// Pattern Check From Databsae
        $statement = $connection->prepare(
            "SELECT * FROM tbl_pattern"
        );
        $statement->execute();
        $result = $statement->fetchAll();
        foreach ($result as $row) {

            if (preg_match_all($row["name"], trim($listword), $pat_array)) {

                for ($i = 0; $i < count($pat_array[0]); $i++) {

                    $matchpattern .= $pat_array[0][$i] . ",";
                }

                $flag = 1;

            }

        }

        // $keyword =  file_get_contents('keyword.txt','r');
        // $keyword = implode("\n", array_filter(explode("\n", $keyword)));
        // $keyword = explode("\n",$keyword);
        // for ($i=0; $i <count($keyword) ; $i++) {
        // }
        $matchkey = substr($matchkey, 0, -1);
        $matchpattern = substr($matchpattern, 0, -1);

        UpdateKeywordById($matchkey, $listword, $id, $matchpattern);
        FileMove($path, $flag, $id);
        $result_msg['error'] = 0;
        $result_msg['message'] = "SuccessFully Extracted";
        return $result_msg;
    } else {
        $result_msg['error'] = 1;
        $result_msg['message'] = "Sorrt No Text In your Image";
        FileMove($path, $flag, $id);
        return $result_msg;
    }

}

function FileMove($path, $flag, $id) {
    include 'lib/db.php';
    $source_file = $path;
    if ($flag == 1) {
        $path = 'upload/flag/';
        $flag_status = 1;
    } else {
        $path = 'upload/good/';
        $flag_status = 2;
    }
    $destination_path = $path . pathinfo($source_file, PATHINFO_BASENAME);
    if (file_exists($destination_path)) {
        $file_array = explode(".", pathinfo($source_file, PATHINFO_BASENAME));
        $file_extension = end($file_array);
        $file_name = $file_array[0] . '-' . rand() . '.' . $file_extension;
        $destination_path = $path . $file_name;
    }
    rename($source_file, $destination_path);
    $statement = $connection->prepare(
        "UPDATE tbl_image
			SET path = :destination_path,flag_status = :flag_status
			WHERE id = :id
			"
    );
    $result = $statement->execute(
        array(
            ':destination_path' => $destination_path,
            ':flag_status' => $flag_status,
            ':id' => $id,
        )
    );
}

function CreateNewFile($name, $value) {
    $name = explode(".", $name);
    $file_name = "file/" . $name[0] . ".txt";
    $myfile = fopen($file_name, "w") or die("Unable to open file!");
    fwrite($myfile, $value);
    fclose($myfile);
}

function UpdateKeywordById($matchkey, $listword, $id, $matchpattern) {
    include 'lib/db.php';

    $statement = $connection->prepare(
        "UPDATE tbl_image
			SET keyword = :keyword,
				match_key = :matchkey,
				match_pattern = :matchpattern
			WHERE id = :id
			"
    );
    $result = $statement->execute(
        array(
            ':keyword' => $listword,
            ':matchkey' => $matchkey,
            ':matchpattern' => $matchpattern,
            ':id' => $id,
        )
    );
    if (!empty($result)) {
        return 1;
    } else {
        return 0;
    }

}

function DetectText($path, $name, $id) {

    $vision = new VisionClient(['keyFile' => json_decode(file_get_contents("key.json"), true)]);

    $photo = fopen($path, 'r');

    $image = $vision->image($photo, ['TEXT_DETECTION']);

    $result = $vision->annotate($image);

    $document = $result->info();

    $value = json_encode($document);

    fclose($photo);

    $result_msg = KeyWordMatching($path, $value, $id);
    CreateNewFile($name, $value);

    return $result_msg;

}

if (isset($_POST["image_id"])) {
    $output = array();
    $statement = $connection->prepare(
        "SELECT * FROM tbl_image
		WHERE flag_status = 0"
    );
    $statement->execute();
    $result = $statement->fetchAll();
    $total_file = $statement->rowCount();
    $percent = 100 / $total_file;
    $showpercent = 0;
    sleep(2);
    foreach ($result as $row) {
        $result_msg = DetectText($row["path"], $row["image"], $row["id"]);
        sleep(1);
        $myfile = fopen("progress.txt", "w+");
        $showpercent += $percent;
        fwrite($myfile, $showpercent);
        fclose($myfile);

    }

    echo json_encode($result_msg);

    sleep(3);
    $myfile = fopen("progress.txt", "w+");
    fwrite($myfile, 0);
    fclose($myfile);

}

?>