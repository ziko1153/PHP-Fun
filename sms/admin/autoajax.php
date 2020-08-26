<?php
ini_set('max_execution_time', 0); 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include  'PHPMailer/src/Exception.php';
include 'PHPMailer/src/PHPMailer.php';
include 'PHPMailer/src/SMTP.php';
include ('lib/Database.php');

///Error Generate message and Debugging 
		$res = array();
		$res['message'] = "Opps Something Went Wrong";
		$res['error'] = "Scripting Error";
		$res['code'] = "1";


	function LogSMS(){

		}
	function LogEmail($name,$email,$message,$host,$from_email,$status,$log){
		$db = new Database();
		date_default_timezone_set('Asia/Dhaka');
		$datetime =  date('Y-m-d H:i:s') ;
		$query  = "insert into tbl_log(name,email,message,host,from_email,status,datetime,type,log)
		values('$name','$email','$message','$host','$from_email','$status','$datetime','email','$log')
		";

		$db->insert($query);

		}

		////Future Development For SmS SEnding 
	function  SendSMS($message,$name,$mobile){



		try{
        $soapClient = new SoapClient("http://api.onnorokomsms.com/sendsms.asmx?wsdl");
        $paramArray = array(
        'userName'=>"",
        'userPassword'=>"",
        'mobileNumber'=> $mobile,
        'smsText'=> $message,
        'type'=>"1",
        'maskName'=> "",
        'campaignName'=>'',
        );
        $value = $soapClient->__call("OneToOne", array($paramArray));

           //$split = 
           //$var = str_replace('||',' ', $split);
			//$result = explode(" ",$var);
			$res['message'] = 	"Message Has Been Sent";
        	$res['error'] = "Success";
        	$res['code'] = "0";
        } catch (dmException $e) {
        		$res['message'] = 	$e->getMessage();
        		$res['error'] = "Failed";
        		$res['code'] = "1";
			}	


			return $res;
	}

function Registration($name,$email,$mobile,$day,$date,$postal){
		$db = new Database();
		$query = "insert into tbl_reg(name,email,mobile,postal,day,date) values('$name','$email','$mobile','$postal','$day','$date')";
		return $result = $db->insert($query);
}
		

	function SendMail($cc,$subject,$message,$name,$email){
		$db =  new Database();
		$SmtpQuery = "select * from  tbl_emailset";
        $result = $db->select($SmtpQuery);
        if($result){

        	while($row = mysqli_fetch_array($result)){

					$host =  		$row['host'];
					$username =  	$row['username'];
					$password =  	$row['password'];
					$smtp_secure =  $row['smtp_secure'];
					$port =  		$row['port'];
					$from_email =  	$row['from_email'];
					$reply_email =  $row['reply_email'];
					$from_name =    $row['from_name'];
					$reply_name =   $row['reply_name'];
					$status =  	    $row['status'];
        	}

        }else{
	        $res['message'] = "Database Empty";
			$res['error'] = "Database";
			$res['code'] = "1";
			echo json_encode($res);
			return;
        }

        if($status==1){

			$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
			try {
			//Server settings
			$mail->SMTPDebug = 0;                                 // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = $host;  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = $username;                 // SMTP username
			$mail->Password = $password;                           // SMTP password
			$mail->SMTPSecure = $smtp_secure;                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = $port;                                    // TCP port to connect to

			//Recipients
			$mail->setFrom($from_email,$from_name);
			$mail->addAddress($email,$name);     // Add a recipient
			// $mail->addAddress('ellen@example.com');               // Name is optional
			$mail->addReplyTo($reply_email,$reply_name);
			if(!empty($cc)){
			$mail->addCC($cc);}
			//$mail->addBCC('bcc@example.com');

			//Attachments
			// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

			//Content
			$mail->isHTML(true); 
			$mail->AddEmbeddedImage('ziko.jpg', 'zikoimg', 'ziko.jpg');                                  // Set email format to HTML
			$mail->Subject = $subject;
			$mail->Body    = "Hello ".$name."<br>".$message;
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();

			$res['message'] = 'Email has been sent';
			$res['code'] = '0';
			LogEmail($name,$email,$message,$host,$from_email,'Success',$res['message']);
			} catch (Exception $e) {
			$res['message'] = 'Email could not be sent. Mailer Error: '.$mail->ErrorInfo;
			LogEmail($name,$email,$message,$host,$from_email,'Error',$res['message']);
			$res['code'] = '1';
			}

			return $res;

        }
        else{


			$mail = new PHPMailer(true);                              
			try {

			$mail->SMTPDebug = 0;                                 // Enable verbose debug output
			$mail->isSendmail();                                      // Set mailer to use SMTP

			//Recipients
			$mail->setFrom($from_email,$from_name);
			$mail->addAddress($email,$name);    // Add a recipient
			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = $subject;
			$mail->Body    = "Hello ".$name."<br>".$message;
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			$mail->send();
			$res['message'] = 'Message has been sent';
			$res['code'] = '0';
			} catch (Exception $e) {
			$res['message'] = 'This '.$email.' Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
			$res['code'] = '1';
			}

			return $res; 

        }
	}


	if(isset($_POST["EmailSend"])){
		$cc = $_POST['cc'];
		$subject = $_POST['subject'];
		$date_from = date("y-m-d", strtotime($_POST["date_from"]));
		$date_to  = date("y-m-d", strtotime($_POST["date_to"]));
		$day = $_POST['day'];
		$message = $_POST['message'];
	    $db =  new Database();
        $day = "('" . implode("','", $day) . "')";

        $query = "  
               SELECT * FROM tbl_reg 
               WHERE  day IN$day and  date BETWEEN '".$date_from."' AND '".$date_to."'"; 


        $result = $db->select($query);
 
		if($result){
         
         while($row = mysqli_fetch_array($result)){

        $res =  SendMail($cc,$subject,$message,$row['name'],$row['email']);
         }

         echo json_encode($res);
    	}
    	else{

	    	$res['message'] = "Sorry There Is No Email On Date or Day";
			$res['error'] = "Empty List";
			$res['code'] = "1";

		echo json_encode($res);	

    }

}


if(isset($_POST['Registration'])){

		$resultmobile = false;
		$resultemail = false;
		$result = false;
        $date = $_POST['date'];
		$name = ucwords($_POST['name']);
		$mobile = $_POST['mobile'];
		$postal = $_POST['postal'];
		$email = trim($_POST['email']);
		$timezone = "Asia/Dhaka";
  		date_default_timezone_set($timezone);
		if(empty($date)){
			$date = date("y-m-d");
		}
		else{
			$date = date("y-m-d", strtotime($date));
		}
		$day = date("l",strtotime($date));

		$db = new Database();

		if(empty($email)&&!empty($mobile)){
			$mobile = '88'.$mobile;
			$checkQuery = "select mobile from tbl_reg where mobile = '$mobile'";
			$resultmobile = $db->select($checkQuery);
		}else if(empty($mobile)&&!empty($email))
		{
			$checkQuery = "select mobile from tbl_reg where email = '$email'";
			$resultemail = $db->select($checkQuery);
		}else{
			$mobile = '88'.$mobile;
			$checkQuery = "select email,mobile from tbl_reg where email = '$email' or mobile = '$mobile'";
			$result = $db->select($checkQuery);
		}
		

		if($result){
			$res['code'] = 1;
			$res['message']='Already Exists Mobile or Email.. Please Change That';
			$res['error']='Email or Mobile';

		}else if($resultmobile){
			$res['code'] = 1;
			$res['message']='Already Exists Mobile.. Please Change That';
			$res['error']='Mobile';

		}
		else if($resultemail){
			$res['code'] = 1;
			$res['message']='Already Exists Email.. Please Change That';
			$res['error']='Email';

		}else{
			
				$result = 	Registration($name,$email,$mobile,$day,$date,$postal);

			if($result){
				$res['code'] = 0;


			}
			else{

				$res['code'] = 1;
				$res['message']='Sorry Something Went Wrong!!';
			}
		}	

			echo json_encode($res);
		

}

if(isset($_POST['SmsSend'])){

		$date_from = date("y-m-d", strtotime($_POST["date_from"]));
		$date_to  = date("y-m-d", strtotime($_POST["date_to"]));
		$day = $_POST['day'];
		$message = $_POST['message'];
		$day = "('" . implode("','", $day) . "')";
	    $db =  new Database();

	    $query = "  
               SELECT * FROM tbl_reg 
               WHERE  day IN$day and  date BETWEEN '".$date_from."' AND '".$date_to."'"; 


        $result = $db->select($query);
 
		if($result){
         
         while($row = mysqli_fetch_array($result)){

        $res =  SendSMS($message,$row['name'],$row['mobile']);
         }

         echo json_encode($res);
    	}
    	else{

	    	$res['message'] = "Sorry There Is No Number On Date or Day";
			$res['error'] = "Empty List";
			$res['code'] = "1";

		echo json_encode($res);	

    }
}

if(isset($_POST['createUserPass'])){
 $db = new Database();
	$user_name  = mysqli_real_escape_string($db->link,$_POST['user_name']);
	$user_id    = mysqli_real_escape_string($db->link,$_POST['user_id']);
	$login_ip    = $_POST['login_ip'];
	$new_pass   = sha1(mysqli_real_escape_string($db->link,$_POST['new_pass']));
	$timezone = "Asia/Dhaka";
  	date_default_timezone_set($timezone);
    $last_update = date('Y-m-d H:i:s') ;
	$updateQ = "update tbl_user set 

					user_name = '$user_name',
					user_pass = '$new_pass',
					login_ip  = '$login_ip',
					last_update = '$last_update'
					where id = '$user_id'

		";

		 $result = $db->update($updateQ);

	 if($result)
       {
       	  $res['message'] = "Successfully Updated";
       	  $res['code'] = "0";
       }
       else{
       	$res['message'] = "Database Error Problem";
       	$res['code'] = "1";
       	$res['error'] = "Database Error";
       }

       echo json_encode($res);

}

if(isset($_POST['UpdateEmail'])){

		$db = new Database();
        $host = $_POST['host'];
        $username = $_POST['username'];
        $password = $_POST['email_pass'];
        $smtp_secure = $_POST['smtp_secure'];
        $port = $_POST['port'];
        $from_email = $_POST['from_email'];
        $reply_email = $_POST['reply_email'];
        $from_name = $_POST['from_name'];
        $reply_name = $_POST['reply_name'];
        $status = $_POST['status'];

    if($status==0){
        $updateQ = "update tbl_emailset set

        		from_email = '$from_email',	
        		status = '0'

        		where id = 2
        		 ";
        $result = $db->update($updateQ);
        if($result){
        	$res['message'] = "Email Setting Has been Updated";
        	$res['code'] = "0";

        }else{

        	$res['message'] = "Database Problem";
        	$res['code'] = "1";
        	$res['error'] = "Database";

        }


    }else{

    		   $updateQ = "update tbl_emailset set
    		   	host   = '$host',
    		   	username = '$username',
    		   	password = '$password',
    		   	smtp_secure = '$smtp_secure',
    		   	port = '$port',
    			from_email = '$from_email',
    		   	reply_email = '$reply_email',
    		   	from_name = '$from_name',
    		   	reply_name = '$reply_name',
        		status = '1'

        		where id = 2
        		 ";
        $result = $db->update($updateQ);
        if($result){
        	$res['message'] = "Email Setting Has been Updated";
        	$res['code'] = "0";

        }else{

        	$res['message'] = "Database Problem";
        	$res['code'] = "1";
        	$res['error'] = "Database";

        }



    }

    echo json_encode($res);

 }



