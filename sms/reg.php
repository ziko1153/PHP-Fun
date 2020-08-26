<?php 
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Registration Form</title>
		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="admin/assets/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="admin/assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="admin/assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="admin/assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="admin/assets/vendor/pnotify/pnotify.custom.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="admin/assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="admin/assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="admin/assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="admin/assets/vendor/modernizr/modernizr.js"></script>
	</head>
	<body>

	<div class="container" style="margin-top: 100px">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h2 class="text-center">Registration Form</h2>
                <form method="" action="">
                    <div class="form-group">
                        <label class="control-label" for="name">Name:</label>
                        <input type="text" class="form-control" placeholder="Input Your Name" id="name" />
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="email">Email:</label>
                        <input type="text" class="form-control" placeholder="Input Your Email" id="email" />
                    </div>
                     <div class="form-group">
                        <label class="control-label" for="email">Mobile:</label>
                        <input maxlength="11" type="text" class="form-control" placeholder="Input Your Mobile No." id="mobile" />
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="number">Postal code:</label>
                        <input id="postal" type="text" class="form-control" placeholder="postal"/>
                    </div>
                <div class="form-group">
                   
                        <div class="col-sm-3">
                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                        Auto Date
                        </div>
                         <div class="col-sm-4">
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                            Manual Date
                        </div>
                            <div id="displaydate" class="col-sm-4" style="display: none">
                
                            <input id="reg_date" type="text" data-plugin-datepicker class="form-control">
                    </div>
                </div>
               
                   

                    <div class="form-group">
                        <input id="finish" type="submit" class="btn btn-primary" value="Submit"/>
                    </div>
                </form>
            </div>
        </div>
    </div>


		<!-- Vendor -->
		<script src="admin/assets/vendor/jquery/jquery.js"></script>
		<script src="admin/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="admin/assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="admin/assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="admin/assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="admin/assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="admin/assets/vendor/jquery-validation/jquery.validate.js"></script>
		<script src="admin/assets/vendor/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
		<script src="admin/assets/vendor/pnotify/pnotify.custom.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="admin/assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="admin/assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="admin/assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="admin/assets/javascripts/forms/examples.wizard.js"></script>

		<script type="text/javascript">
var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};

		function validateEmail(email) {
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			return emailReg.test(email);
		}
			
$('#optionsRadios1').click(function(){

	$('#displaydate').hide();
	$('#reg_date').val('');
});
$('#optionsRadios2').click(function(){

	$('#displaydate').show();
});

function AlertSuccess()
{
   new PNotify({
      title: 'Congratulations',
      text: 'Registration Has been Successfully Completed!!',
      type: 'success',
      addclass: 'stack-bar-top',
      stack: stack_bar_top,
      width: "100%"
    });
}
function AlertDanger(m)
{
    new PNotify({
      title: 'Required',
      text: m,
      addclass: 'notification-dark',
      icon: 'fa fa-warning',
      hide: true,
      buttons: {
        sticker: false
      }
    });
}
function AlertDanger1(t,m){

  new PNotify({
      title: t,
      text: m,
      type: 'error',
      addclass: 'stack-bar-top',
      stack: stack_bar_top,
      width: "100%"
    });
}

  $('#finish').on('click', function( ev ) {
   ev.preventDefault();

   if(!$('#mobile').val().trim()&&!$('#email').val().trim()){

   	AlertDanger('PLease At least One Information Provide Your Mobile or Email');

   }
   
    else if(!validateEmail($('#email').val()) && $('#email').val().trim().length>0){

    AlertDanger('Please Check Your Email Address');

  }
  else if(!$('#mobile').val().match('[0-9]{11}')&&$('#mobile').val().trim().length>0){
    AlertDanger('Please Input 11 Digit Mobile Number');
  }

  else if(validateEmail($('#email').val()) || $('#mobile').val().match('[0-9]{11}')){

                  var date = $('#reg_date').val();
                  var name = $('#name').val();
                  var email = $('#email').val();
                  var mobile = $('#mobile').val();
                  var postal   = $('#postal').val();

                  var data = {
        "Registration" : true,
        "date" : date,
        "name" : name,
        "email" : email,
        "mobile" : mobile,
        "postal" :postal
      
      }
       
            $.ajax({
      url : 'admin/autoajax.php',
      method : "POST",
      data : data,

      success : function(response){
        var res = jQuery.parseJSON(response);
        if(res.code=="1"){
          AlertDanger1(res.error,res.message);


          

          //alert(response);
          
        }else{
        
          AlertSuccess();
                 $('#reg_date').val('');
                 $('#name').val('');
                 $('#email').val('');
                 $('#mobile').val('');
                 $('#postal').val('');
           
          //alert(response);
        }
      },
      error : function(){
        AlertDanger1('Scripting Problem Occurred!');
      }
    });

  }
   
  });


		</script>

				</body>
</html>