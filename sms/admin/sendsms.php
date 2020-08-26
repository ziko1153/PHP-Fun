<?php 
include 'inc/header.php';?>

	 	<section role="main" class="content-body">
						<header class="page-header">
							<h2>Send SMS </h2>
						
							<div class="right-wrapper pull-right">
								<ol class="breadcrumbs">
									<li>
										<a href="index.php">
											<i class="fa fa-home"></i>
										</a>
									</li>
									<li><span>SMS</span></li>
									<li><span>Send SMS</span></li>
								</ol>
						
								<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
							</div>
						</header>

											<!-- start: page -->
							<div class="row">
								<div class="col-lg-12">
									<section class="panel">
										<header class="panel-heading">	
											<h2 class="panel-title">SMS Template</h2>
										</header>
										<div class="panel-body">
		<form action="sendsms.php" class="form-horizontal form-bordered" method="post">

	<div class="form-group">
			<label class="col-md-3 control-label">Date range</label>
			<div class="col-md-6">
			<div class="input-daterange input-group" data-plugin-datepicker>
			<span class="input-group-addon">
			<i class="fa fa-calendar"></i>
			</span>
			<input id="date_from" type="text" class="form-control" name="start">
			<span class="input-group-addon">to</span>
			<input id="date_to" type="text" class="form-control" name="end">
			</div>
			</div>
	</div> 
<div class="form-group">
<label class="col-md-3 control-label">Day Select</label>
		<div class="col-md-6">
		<div class="input-group btn-group">
			<span class="input-group-addon">
			<i class="fa fa-th-list"></i>
			</span>
			<select class="form-control" multiple="multiple" data-plugin-multiselect id="ms_example4">
				<option value="Sunday">Sunday</option>
				<option value="Monday">Monday</option>
				<option value="Tuesday">Tuesday</option>
				<option value="Wednesday">Wednesday</option>
				<option value="Thursday">Thursday</option>
				<option value="Friday">Friday</option>
				<option value="Saturday">Saturday</option>
			</select>
		</div>
		</div>
</div>

<div class="form-group">
		<label class="col-md-3 control-label" for="textareaAutosize">Message</label>
		<div class="col-md-6">
		<textarea class="form-control" rows="3" id="textareaAutosize" data-plugin-textarea-autosize></textarea><span style="color:blue" id="textarea_feedback"></span> Characters || SMS Count <span style="color: red" id="smscount"></span>
		</div>
</div>
<div class="form-group">
		<label class="col-md-3 control-label" for="textareaAutosize"></label>
		<div class="col-md-6">
		<button id="SmsSend" type="button" class="mb-xs mt-xs mr-xs btn btn-lg btn-primary">Send</button>
		
		</div>
</div>

								

	</form>
										</div>
									</section>
								</div>
							</div>
						</section>




<?php include 'inc/footer.php'; ?>

<script type="text/javascript">
	
$(document).ready(function() {


	function AlertDanger(t,m)
	{
        	new PNotify({
			title: t,
			text: m,
			type: 'error',
			nonblock: {
				nonblock: true,
				nonblock_opacity: .2
			}
		});
	}
	function AlertWarning(t,m)
	{
			var notice = new PNotify({
			title: t,
			text:m,
			addclass: 'click-2-close',
			hide: true,
			buttons: {
				closer: false,
				sticker: false
			}
		});

		notice.get().click(function() {
			notice.remove();
		});
	}
	function AlertDanger2(t,m)
	{
        	new PNotify({
			title: t,
			text: m,
			type: 'error',
			hide: false,
			buttons: {
				sticker: false
			}
		});
	}

	function AlertSuccess(t,m)
	{
			new PNotify({
			title: t,
			text: m,
			type: 'success',
			shadow: true
		});

	}

    var text_length = 0;
    var sms_count = 0;
    $('#textarea_feedback').html(text_length);
    $('#smscount').html(sms_count);

    $('#textareaAutosize').keyup(function() {
        var text_length = $('#textareaAutosize').val().length;
        //var text_remaining = text_max - text_length;

        $('#textarea_feedback').html(text_length);
        if(text_length>160){
            sms_count =1+Math.floor(text_length/160); 
          $('#smscount').html(sms_count);
        }
        else if(text_length>0&&text_length<=160){
        	var sms_count = 1;
        	$('#smscount').html(sms_count);
        }
        else{
        	var sms_count = 0;
        	$('#smscount').html(sms_count);
        }


    });




  $('#SmsSend').click(function(e){

		  	var date_from = $('#date_from').val();
			var date_to = $('#date_to').val();
		    var day  = $('#ms_example4').val();
		    var message = $('#textareaAutosize').val();


  if(!$('#textareaAutosize').val().trim()){
   	AlertWarning('Message','Sorry You Can not Send SMS Without Empty Message');
   }
  else if(day==null){
   AlertWarning('Day','Please Select Day');
   }
   // else if(!date_to.trim()||!date_from.trim()){
   // 	AlertWarning('Date Range','Please Select Date Range')
   // }
   else{

   	 var data = {
				"SmsSend" : true,
				"date_from" : date_from,
				"date_to" : date_to,
				"day" : day,
				"message" : message
			}
       
       			$.ajax({
			url : 'autoajax.php',
			method : "POST",
			data : data,
			beforeSend: function(){
				$('body').loadingModal({

				text: 'Processing Your SMS......',
				animation:'wanderingCubes'

				});

			},
			success : function(response){
				var res = jQuery.parseJSON(response);
				if(res.code=="1"){
					$('body').loadingModal('destroy');
					AlertDanger(res.error,res.message);
					

					
					
				}else{
					$('body').loadingModal('destroy');
					AlertSuccess('Success',res.message);
				   

					//alert(response);
				}
			},
			error : function(){
				AlertDanger('Error','Ajax Failed To Get Data');
			}
		});

   }


		

  });

});


</script>