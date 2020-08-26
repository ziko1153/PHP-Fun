<?php include 'inc/header.php'; ?>

		<section role="main" class="content-body">
					<header class="page-header">
						<h2>Compose</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Mailbox</span></li>
								<li><span>Compose</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" ><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>



					<!-- start: page -->
					<section class="content-with-menu content-with-menu-has-toolbar mailbox">
						<div class="content-with-menu-container" data-mailbox data-mailbox-view="compose">
							<div class="inner-menu-toggle">
								<a href="#" class="inner-menu-expand" data-open="inner-menu">
									Show Menu <i class="fa fa-chevron-right"></i>
								</a>
							</div>
							
							<menu id="content-menu" class="inner-menu" role="menu">
								<div class="nano">
									<div class="nano-content">
							
										<div class="inner-menu-toggle-inside">
											<a href="#" class="inner-menu-collapse">
												<i class="fa fa-chevron-up visible-xs-inline"></i><i class="fa fa-chevron-left hidden-xs-inline"></i> Hide Menu
											</a>
							
											<a href="#" class="inner-menu-expand" data-open="inner-menu">
												Show Menu <i class="fa fa-chevron-down"></i>
											</a>
										</div>
							
										<div class="inner-menu-content">
											<a href="mailCompose.php" class="btn btn-block btn-primary btn-md pt-sm pb-sm text-md">
												<i class="fa fa-envelope mr-xs"></i>
												Compose
											</a>
							
											<ul class="list-unstyled mt-xl pt-md">
												<li>
													<a href="mailInboxList.php" class="menu-item active">Inbox <span class="label label-primary text-weight-normal pull-right">1</span></a>
												</li>
											
												<li>
													<a href="mailsentList.php" class="menu-item">Sent</a>
												</li>
										
											</ul>
							
											<hr class="separator" />
				</div>
									</div>
								</div>
							</menu>
							<div class="inner-body">
								<div class="inner-toolbar clearfix">
									<ul>
										<li>
											<a id="send" href="#"><i class="fa fa-send-o mr-sm"></i> Send</a>
										</li>
										<li>
											<a href="#"><i class="fa fa-times mr-sm"></i> Discard</a>
										</li>
										<li>
											<a href="#"><i class="fa fa-paperclip mr-sm"></i> Attach</a>
										</li>
									</ul>
								</div>
								<div class="mailbox-compose">
	<form class="form-horizontal form-bordered form-bordered">

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

	<div class="form-group form-group-invisible">
		<label for="cc" class="control-label-invisible">CC:</label>
		<div class="col-sm-offset-2 col-sm-9 col-md-offset-1 col-md-10">
		<input id="cc" type="text" class="form-control form-control-invisible" data-role="tagsinput" data-tag-class="label label-primary" value="">
		</div>
	</div>

	<div class="form-group form-group-invisible">
		<label for="subject" class="control-label-invisible">Subject:</label>
		<div class="col-sm-offset-2 col-sm-9 col-md-offset-1 col-md-10">
		<input id="subject" type="text" class="form-control form-control-invisible" value="">
		</div>
	</div>

	<div class="form-group">
		<div class="compose">
		<div id="compose-field" class="compose-control">
		</div>
		</div>
	</div>
	</form>
								</div>
							</div>
						</div>
					</section>

<?php include 'inc/footer.php'; ?>
<script type="text/javascript">



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
				sticker: true
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
	
$('#send').click(function(){

	var cc = $('#cc').val();
	var date_from = $('#date_from').val();
	var date_to = $('#date_to').val();
    var subject = $('#subject').val();
    var day  = $('#ms_example4').val();
    var message = $('.compose .note-editable').html();
    // console.log(day);
    // console.log(message);
   if(!$('.compose .note-editable').html().trim()){
   	AlertWarning('Warning','Sorry You Can not Send Email Without Empty Message');
   }
   if(subject==''){
   	AlertWarning('Warning','Your Sbuject is Empty');
   }
   if(day == null)
   {
   	AlertWarning('Warning','Please Select Day');
   }
   if(day!=null&&subject!=''&&$('.compose .note-editable').html().trim())
   {         
   	        var data = {
				"EmailSend" : true,
				"cc" : cc,
				"date_from" : date_from,
				"date_to" : date_to,
				"subject" : subject,
				"day" : day,
				"message" : message
			}
       
       			$.ajax({
			url : 'autoajax.php',
			method : "POST",
			data : data,
			beforeSend: function(){
				$('body').loadingModal({

				text: 'Processing Your Email......',
				animation:'doubleBounce'

				});

			},
			success : function(response){
				var res = jQuery.parseJSON(response);
				if(res.code=="1"){
					$('body').loadingModal('destroy');
					AlertDanger(res.error,res.message);
					

					//alert(response);
					
				}else{
					$('body').loadingModal('destroy');
					AlertSuccess('Success',res.message);
				   

					//alert(response);
				}
			},
			error : function(){}
		});

   }

		
});

</script>