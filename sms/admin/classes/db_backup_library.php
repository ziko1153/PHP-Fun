<?php


class db_backup{

		private $exported_database;
		
		public function backup($host,$user,$pass,$name,$tables=false, $backup_name=false){

				 $mysqli = new mysqli($host,$user,$pass,$name); $mysqli->select_db($name); $mysqli->query("SET NAMES 'utf8'");
    $queryTables = $mysqli->query('SHOW TABLES'); while($row = $queryTables->fetch_row()) { $target_tables[] = $row[0]; }   if($tables !== false) { $target_tables = array_intersect( $target_tables, $tables); } 
    $content = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `".$name."`\r\n--\r\n\r\n\r\n";
    foreach($target_tables as $table){
        if (empty($table)){ continue; } 
        $result = $mysqli->query('SELECT * FROM `'.$table.'`');     $fields_amount=$result->field_count;  $rows_num=$mysqli->affected_rows;     $res = $mysqli->query('SHOW CREATE TABLE '.$table); $TableMLine=$res->fetch_row(); 
        $content .= "\n\n".$TableMLine[1].";\n\n";
        for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) {
            while($row = $result->fetch_row())  { //when started (and every after 100 command cycle):
                if ($st_counter%100 == 0 || $st_counter == 0 )  {$content .= "\nINSERT INTO ".$table." VALUES";}
                    $content .= "\n(";    for($j=0; $j<$fields_amount; $j++){ $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) ); if (isset($row[$j])){$content .= '"'.$row[$j].'"' ;}  else{$content .= '""';}     if ($j<($fields_amount-1)){$content.= ',';}   }        $content .=")";
                //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) {$content .= ";";} else {$content .= ",";} $st_counter=$st_counter+1;
            }
        } $content .="\n\n\n";
    }
    $content .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
   



			$this->exported_database=$content;
			return $this;
		}

		//Additional Methods
		/*-------------------------------------*/
		//--------Functions Start here---------//
		/*-------------------------------------*/
		
		public function download($name='backup'){
			/*//Download
			$file_name="Tmpdata.sql";
			$file=fopen($file_name,"w+");
			fwrite($file, $this->exported_database);*/
			date_default_timezone_set('Asia/Dhaka');


		
		
			$date = date("d-M-Y");
			$time = date("h-i-sa");
			//$datetime = $date.$time;
		   $backup_name =  $name."___".$date."____".$time;
			
			header('Content-Type: application/sql');
			header('Content-Disposition: attachment; filename='.$backup_name.'.sql');
			echo $this->exported_database;
			/*readfile($file_name);
			fclose($file);
			unlink($file_name);*/
		}
		
		// public function save($path,$name=""){
		// 	$name = ($name != "") ? $name : 'backup_' . date('Y-m-d');
			
		// 	//Save file
		// 	$file = fopen($path.$name.".sql","w+");
		// 	$fw = fwrite($file, $this->exported_database);	
		// 	if(!$fw){
		// 		return false;
		// 	}
		// 	else {
		// 		return true; 
		// 	}
		// }
		
		// public function connect($server,$user,$pass,$db){
		// 	$conn=mysql_connect($server,$user,$pass);
		// 	$condb=mysql_select_db($db);
		// 	if(!$conn || !$condb){
		// 		echo mysql_error();
		// 	}else{

		// 		return true;
		// 	}
		// }
	
		// public function tables(){
		// 	/*-------------------------------------*/
		// 	//------Creating Table List start------//
		// 	/*-------------------------------------*/
		// 	$tb_name=mysql_query("SHOW TABLES");
		// 	$tables=array();
		// 	while ($tb=mysql_fetch_row($tb_name)) {
		// 		$tables[]=$tb[0] ;
		// 	}
		// 	/*-------------------------------------*/
		// 	//-------Creating Table List end-------//
		// 	/*-------------------------------------*/
		// 	return $tables;
		// }
		
		// public function view_fields($tablename){
		// 	$all_fields=array();
		// 	$fields = mysql_query("SHOW COLUMNS FROM ".$tablename);
		// 	if (!$fields) {
		// 	 echo 'Could not run query: ' . mysql_error();
		// 	}
			
		// 	if (mysql_num_rows($fields) > 0) {
		// 		while ($field = mysql_fetch_assoc($fields)) {
		// 			$all_fields[]="`".$field["Field"]."`";
		// 		}
		// 	}
		// 	return $all_fields;
		// }


		// public function view_data($tablename){
		// 	$all_data=array();
		// 	$table_data=mysql_query("SELECT*FROM ".$tablename);
		// 	if(!$table_data){
		// 		echo 'Could not run query: '. mysql_error();
		// 	}

		// 	if(mysql_num_rows($table_data)>0){

				
		// 		while ($t_data=mysql_fetch_row($table_data)) {

		// 			$per_data=array();
		// 			foreach ($t_data as $key => $tb_data) {
		// 				$per_data[]= "'".str_replace("'","\'",$tb_data)."'";
		// 			}
		// 			$solid_data= "(".implode(", ",$per_data).")";
		// 			$all_data[]=$solid_data;
		// 		}
		// 	}
		// 		return $all_data;
		// }
	

		// /*-------------------------------------*/
		// //---------Functions End here----------//
		// /*-------------------------------------*/

		// //Export End here==================================================================
		// //Import Start here==================================================================
		// function db_import($file_path){
		// 	$tbl_query=null;
		// 	foreach ($this->tables() as $key => $table) {
		// 		$tbl_query=mysql_query("DROP TABLE IF EXISTS ".$table);
		// 	}
		 
		// 	//---------------------------------------------------------------------------
		// 	//Forign code Start here
		// 	//---------------------------------------------------------------------------
		// 	$templine = '';
		// 	// Read in entire file
		// 	$lines = file($file_path);
		// 	// Loop through each line
		// 	foreach ($lines as $line)
		// 	{
		// 	// Skip it if it's a comment
		// 		if (substr($line, 0, 2) == '--' || $line == '')
		// 			continue;

		// 		// Add this line to the current segment
		// 		$templine .= $line;
		// 		// If it has a semicolon at the end, it's the end of the query
		// 		if (substr(trim($line), -1, 1) == ';')
		// 		{
		// 			// Perform the query
		// 			mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
		// 			// Reset temp variable to empty
		// 			$templine = '';
		// 		}
		// 	}

		// 	 //echo "Database imported successfully <br/>";
		// 	return true;
		// }
	}
