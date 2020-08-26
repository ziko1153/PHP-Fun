<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/session.php');
include_once ($filepath.'/../helpers/Format.php');
include_once ($filepath.'/../lib/Database.php');
session::init();

?>

<?php 

class UserLogin 
{
	

private $db;
private $fm;

   public  function __construct(){
	
      $this->db =  new Database();
       $this->fm  = new Format();

	}

	public function UserLoginCheck($user_name,$user_pass)
	{
		$loginmsg = array();
		$loginmsg['code']="1";
		$loginmsg['message']="Scripting Problem Occurred";
		$user_name = $this->fm->validation($user_name);
		$user_pass = $this->fm->validation($user_pass);
		$user_name = mysqli_real_escape_string($this->db->link,$user_name);
        $user_pass = sha1(mysqli_real_escape_string($this->db->link,$user_pass));
		if (empty($user_name) || empty($user_pass)) {
		$loginmsg['message'] = "Username or Password Must not be Empty!!";
		return $loginmsg;
		}else
		{
			$query = "select * from tbl_user where user_name = '$user_name' and 
			user_pass = '$user_pass'";
			$result = $this->db->select($query);
			if ($result) {
			
					session::set('userlogin',true);
                     // echo "<script> location.replace('welcome.php') </script>";
					$loginmsg['message'] = "Successfully Login.... Please Wait";
					$loginmsg['code'] = "0";

					return $loginmsg;
			}else
			{
				$loginmsg['message'] = "Incorrect Username or Password.. Please Try Again";
				return $loginmsg;
			}
		}
	}




}




if(isset($_POST['login_check'])){

       $value = new UserLogin();


      $result  = $value->UserLoginCheck($_POST['user_name'],$_POST['user_pass']);

      echo json_encode($result);
}











?>