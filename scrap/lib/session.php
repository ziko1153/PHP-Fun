<?php

class session 
{
	
	public static function init(){
		session_start();
	}


  public static function set($key,$val){
    $_SESSION[$key] = $val;
  }


  public static function get ($key){
    
    if(isset($_SESSION[$key])){
      return $_SESSION[$key];
    }else{
     return false;
   }

 }


 public static function checksession(){
 	//self::init();
 	if(self::get("userlogin")==false){
 		self::destroy();
 		echo "<script> location.replace('index.php') </script>";
 	}


 }


 public static function checklogin(){
  //self::init();

   if(self::get("userlogin")==true){
    echo "<script> location.replace('dashboard.php') </script>";
  }
}


public static function destroy(){
  session_destroy();
  echo "<script> location.replace('index.php') </script>";
}




}





?>