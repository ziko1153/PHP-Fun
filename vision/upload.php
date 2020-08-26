<?php
include('lib/db.php');
set_time_limit(0);
$output['result'] = '';
 $output['code'] = '1';
 $output['result']='Scripting Error';

 if(isset($_FILES["file"]["name"])){


if(count($_FILES["file"]["name"]) > 0)
{

 //sleep(3);
 for($count=0; $count<count($_FILES["file"]["name"]); $count++)
 {
  $file_name = basename($_FILES["file"]["name"][$count]);
  $tmp_name = $_FILES["file"]['tmp_name'][$count];
  $file_array = explode(".", $file_name);
  $file_extension = end($file_array);
  if(file_already_uploaded($file_name, $connection))
  {
   $file_name = basename($file_array[0] . '-'. rand() . '.' . $file_extension);
  }
  $location = 'upload/working/' . $file_name;

  try{
  if(!move_uploaded_file($tmp_name, $location))
  { 
    throw new Exception(move_uploaded_file($tmp_name,$location), 1);
          $output['code'] = '1';
 
  }
  else{
      $query = "
   INSERT INTO tbl_image (image,path) 
   VALUES ('".$file_name."','".$location."')
   ";
   $statement = $connection->prepare($query);
   $statement->execute();
    $output['code'] = '0';
  $output['result']='Successfully Uploaded';

   
      }
  }catch(Exception $e){
      $output['result'] .= $file_name." File Not Move Cause : ".$e->getMessage();
  }
 }

echo json_encode($output);

}

}else {

  echo json_encode($output);

}

function file_already_uploaded($file_name, $connection)
{
 
 $query = "SELECT * FROM tbl_image WHERE image = '".$file_name."'";
 $statement = $connection->prepare($query);
 $statement->execute();
 $number_of_rows = $statement->rowCount();
 if($number_of_rows > 0)
 {
  return true;
 }
 else
 {
  return false;
 }
}

?>