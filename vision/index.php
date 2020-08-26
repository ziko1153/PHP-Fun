<?php
//include 'classes/UserLogin.php';
include_once 'lib/session.php';
include 'inc/head.php';
  
  session::checklogin();

  $check = $msg ="";



function UserLoginCheck($user_name,$user_pass)
  {   
        include  'lib/db.php';
 $user_pass = md5($user_pass);
    if (empty($user_name) || empty($user_pass)) {
    $loginmsg = "Username or Password Must not be Empty!!";
    return $loginmsg;
    }else
    {
      $query = "select * from tbl_user_info where user_name = :username and 
      user_pass =  :password  and status = 1";


          $statement = $connection->prepare($query);  
                $statement->execute(  
                     array(  
                          'username'     =>     $user_name,  
                          'password'     =>     $user_pass
                     )  
                );  
                $count = $statement->rowCount(); 
                $result = $statement->fetchAll();

            if($count > 0){  
                foreach($result as $row)
                  { 
                    session::set("userlogin",true);
                    session::set("user_id","-101");
                    session::set("user_name",$row['user_name']);  
                  }
                    echo "<script> location.replace('working.php') </script>";
                }  

            else{
        $loginmsg = "Incorrect Username or Password";
        return $loginmsg;
      }
    }
  }

  if(isset($_POST['login_submit'])){

    $user_name = $_POST["user_name"];
    $user_pass = $_POST["password"];

        $msg =   UserLoginCheck($user_name,$user_pass);
    // if($u_name==$username&& $password==$pass){
    //   // session::set("adminlogin",true);
    //   // echo "<script> location.replace('welcome.php') </script>";
    // }
    // else{
    //   $check = "wrong";
    // }
  }

  if (isset($_GET['action']) && $_GET['action']=="logout") {
   session::destroy();

  }

?>


<div class="container">

  <div class="row">
    <div class="col-lg-offset-3 col-lg-6">

      <div class="header-login-form">
        <div class="row">
          <div class="col-lg-4">
            <img src="images/logo.png" class="img-responsive">
          </div>
          <div class="col-lg-8">
            <h3>Welcome. Login to continue</h3>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">

          <form class="form-horizontal" method="post" action="">
            <div class="form-group">
              <label class="control-label col-lg-3" for="email">Username :</label>
              <div class="col-lg-7">
                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="admin">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-3" for="pwd">Password :</label>
              <div class="col-lg-7">
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-offset-8">
                <button type="submit" class="btn btn-success" name="login_submit">login <span class="glyphicon glyphicon-log-in"></span></button>
              </div>
            </div>
          </form>

        </div>
      </div>
      <br>

      <div class="row">
        <div class="col-lg-12">
          <?php  
          if(!empty($msg)){
            ?>
            <div class="alert alert-danger alert-dilgissable fade in text-center">
              <a href="#" class="close" data-dilgiss="alert" aria-label="close">&times;</a>
              <strong>Failed!</strong> <?php echo $msg ?>
            </div>

            <?php  } ?>
          </div>
        </div>

      </div>
    </div>

  </div>


