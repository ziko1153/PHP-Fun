<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/session.php');
include_once ($filepath.'/../helpers/Format.php');
include_once ($filepath.'/../lib/Database.php');
//session::checklogin();
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

	 public function AccessControl($user_id)
	{
		
		$query = "select * from tbl_permission where user_id = '$user_id'";

		$res = $this->db->select($query);

		if($res)
		{
			$row = $res->fetch_assoc();
			session::set("user_id",$row['user_id']);
			session::set("dashboard",$row['dashboard']);
			session::set("sales",$row['sales']);
			session::set("welcome",$row['welcome']);
			session::set("all_purchase",$row['all_purchase']);
			session::set("purchase_item",$row['purchase_item']);
			session::set("staffs",$row['staffs']);
			session::set("suppliers",$row['suppliers']);
			session::set("customers",$row['customers']);
			session::set("accounts",$row['accounts']);
			session::set("reports",$row['reports']);

		}
		else
		{
		   session::set("userlogin",false);
		    echo "<script> location.replace('index.php') </script>";
		} 


	}

	public function UserLoginCheck($user_name,$user_pass)
	{

		$user_name = $this->fm->validation($user_name);
		$user_pass = $this->fm->validation($user_pass);
		$user_name = mysqli_real_escape_string($this->db->link,$user_name);
        $user_pass = md5(mysqli_real_escape_string($this->db->link,$user_pass));
		if (empty($user_name) || empty($user_pass)) {
		$loginmsg = "Username or Password Must not be Empty!!";
		return $loginmsg;
		}else
		{
			$query = "select * from tbl_user_info where user_name = '$user_name' and 
			user_pass = '$user_pass' and status = 1";
			$result = $this->db->select($query);
			if ($result) {

				$value = $result->fetch_assoc();
			
					session::set("userlogin",true);
					session::set("user_name",$value['user_name']);
                	$this->AccessControl($value['user_id']);
                    echo "<script> location.replace('working.php') </script>";

				
			}else
			{
				$loginmsg = "Incorrect Username or Password";
				return $loginmsg;
			}
		}
	}




}











?>