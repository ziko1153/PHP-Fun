<?php
include 'inc/header.php';
include 'inc/topbar.php';
?>
		<div class="container box">
			<div class="progress"><div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div></div>
			<h1 align="center">Working Folder For Multiple Image Upload</h1>
			<br />
			<div class="table-responsive">
				<br />
				<div align="left">
				<button type="button" class="btn btn-success" id="process_all" >Process All Image</button>
				
				</div>
				<div align="center">
					
    <input type="file" name="multiple_files" id="multiple_files" multiple />
    <span class="text-muted">Only .jpg, png, .gif file allowed</span>
    <span id="error_multiple_files"></span>

				</div>
		<div align="right">
		
			<button class="btn btn-danger" id="dlt_selected_btn" style="display:none;"><span class="glyphicon glyphicon-trash"></span> Delete selected</button>
	
		</div>

				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
						
							<th width="40%">Image</th>
							<th width="50%">Name</th>
						<th  width="10%"> Delete ALL <input class="select_checkbox"  type="checkbox" id="select_all"></th>
						</tr>
					</thead>
				</table>
				
			</div>
		</div>
<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add User</h4>
				</div>
				<div class="modal-body">
					<label>Description</label>
					<input type="text" name="description" id="description" class="form-control" />
				
					<br />
					<label>Select Another Image</label>

					<input type="file" name="user_image" id="user_image" />
					<span id="user_uploaded_image"></span>

				<!-- 	<input type="file" name="user_image" id="user_image" /> -->
					<span id="user_uploaded_image"></span>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="image_id" id="image_id" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript" language="javascript" >


$(document).on('click', '.select_checkbox', function(){
	//alert();
    if ($(this).prop('checked')==true){ 
        $(".checkbox").prop('checked', $(this).prop("checked"));
        $("#dlt_selected_btn").css("display", "");
    }else{
    	$(".checkbox").prop('checked', false);
    	$(".select_checkbox").prop('checked', false);
    	$("#dlt_selected_btn").css("display", "none");
    }
});

			
	



	$(document).on('click', '.checkbox', function(){
		var image_id = $(this).attr("value");
	
		
				$(this).change(function(){
				if($(this).prop("checked")==true){
					$("#dlt_selected_btn").css("display", "");
					
				}
				if($('.checkbox:checked').length==0){
					$("#dlt_selected_btn").css("display", "none");
					$(".select_checkbox").prop('checked', false);
					
				}
			});


	});

	


	var image_list = [];
	var image_name_list = [];
	var count = 0;
	var interval;


$(document).ready(function(){
	function RefreshProgress(){

			var interval = setInterval(function(){	


			$.ajax({
			url:'progress.txt',
			cache: false,
			success: function (data){

			if(data>=100){
					$('.progress-bar').width("100%").html('Successfully Completed');
					$('#process_all').text('Process All Image').prop('disabled', false);
					dataTable.ajax.reload();
					//console.log('if -->Count = '+count+' data = '+data);
					clearInterval(interval);
			}
			else{				
			data = data+"%";
			$('.progress-bar').width(data).html(parseInt(data)+' %');
			$('#process_all').text('Processing....').prop('disabled',true);
				dataTable.ajax.reload();
			//console.log('else -->Count = '+count+' data = '+data);
			}
		},

		});

	},500);
			
		// interval =  setInterval(function(){	
		// $.get('progress.txt', function(data) {


		// 		if(data>=100){
		// 			$('.progress-bar').width("100%").html('Successfully Completed');
		// 			$('#process_all').text('Process All Image').prop('disabled', false);
		// 			console.log('if -->Count = '+count+' data = '+data);
		// 			clearInterval(interval);
		// 		}else if(data==0){
		// 			//alert(data);
		// 				if(count==0){
		// 			$('#process_all').text('Process All Image').prop('disabled', false);
		// 				}else if(count>0){
		// 			$('#process_all').text('Processing....').prop('disabled',true);
		// 				}
		// 				count++;
		// 			//clearInterval(interval);
		// 			console.log(interval);
		// 			console.log('else if 0-->Count = '+count+' data = '+data);
		// 		}else{
					
		// 			data = data+"%";
		// 			$('.progress-bar').width(data).html(parseInt(data)+' %');
		// 			$('#process_all').text('Processing....').prop('disabled',true);
		// 			console.log('else -->Count = '+count+' data = '+data);
		// 	   }

		// 	}, 'text');},50);

		return interval;

	}

		$.get('progress.txt', function(data) {
					if(data>0&&data<100){
				
						RefreshProgress();
					}
		}, 'text');


	
	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"fetch.php",
			type:"POST",
		},
		"columnDefs":[
			{
				"targets":[0,2],
				"orderable":false,

			},
		],

	});




 $('#multiple_files').change(function(){
  var error_images = '';
  var form_data = new FormData();
  var files = $('#multiple_files')[0].files;
 
   for(var i=0; i<files.length; i++)
   {
    var name = document.getElementById("multiple_files").files[i].name;
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
    {  
     error_images += '<p> Please Check This Image : "<b style="color:blue">'+name+'</b>" Invalid File Format</p>';
    }
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("multiple_files").files[i]);
    var f = document.getElementById("multiple_files").files[i];
    var fsize = f.size||f.fileSize;
    if(fsize >20000000)
    {		
     error_images += '<p> This  File '+name+ ' Size is very big</p>';
    }
    else
    {
     form_data.append("file[]", document.getElementById('multiple_files').files[i]);
    }
   }
  
  if(error_images == '')
  {
   $.ajax({
    url:"upload.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#error_multiple_files').html('<br /><label class="text-primary">Uploading...</label>');
     $("#multiple_files").prop("disabled", true);
    },   
    success:function(data)
    {		var res = jQuery.parseJSON(data);
    	console.log(res);

       if(res.code=="0"){
     $('#error_multiple_files').html('<br /><label class="text-success">Successfully Uploaded</label>');
     $("#multiple_files").prop("disabled", false);
     $('#multiple_files').val('');
     dataTable.ajax.reload();
 			}else{

 	$('#error_multiple_files').html('<br /><label class="text-danger">'+res.result+'</label>');
     $("#multiple_files").prop("disabled", false);
     $('#multiple_files').val('');
     dataTable.ajax.reload();
 			}

    },
    error: function(jqXHR, textStatus, errorThrown)
{
  console.log(jqXHR);
  console.log(textStatus);
  console.log(errorThrown);
}
   });
  }
  else
  {
   $('#multiple_files').val('');
   $('#error_multiple_files').html("<span class='text-danger'>"+error_images+"</span>");
   return false;
  }
 });






	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var description = $('#description').val();
		var extension = $('#user_image').val().split('.').pop().toLowerCase();
		if(extension != '')
		{
			if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
			{
				alert("Invalid Image File");
				$('#user_image').val('');
				return false;
			}
		}	
		if(description != '')
		{
			$.ajax({
				url:"insert.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alert(data);
					$('#user_form')[0].reset();
					$('#userModal').modal('hide');
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			alert("Descriptions Required");
		}
	});
	
	$(document).on('click', '.update', function(){
		var image_id = $(this).attr("id");
		$.ajax({
			url:"fetch_single.php",
			method:"POST",
			data:{image_id:image_id},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#description').val(data.description);
				$('#last_name').val(data.last_name);
				$('.modal-title').text("Edit Image");
				$('#image_id').val(image_id);
				$('#user_uploaded_image').html(data.user_image);
				$('#action').val("Edit");
				$('#operation').val("Edit");
			}
		})
	});

	function AlertDanger(t,m){
		new PNotify({

				title: t,
				text :m,
				type: 'error',
				hide:false,
				button:{
					sticker:true
				}
				


		});
	}	
	function AlertSuccess(t,m){
		new PNotify({

				title: t,
				text :m,
				type: 'success',
				hide:false,
				shadow:true
				


		});
	}


function WriteProgress(){
			$.ajax({
			url:"vision.php",
			method:"POST",
			
			data:{progress:true},
		
					 
			success:function(response)
			{	
				
				return  setTimeout(RefreshProgress,1000);

			},		
		});
}


	$(document).on('click', '#process_all', function(){

			 var table  = dataTable.rows().data();

			
			 
			// image_list = [];
			// image_name_list = [];
		
		 // $.each( table, function( key, value ) {

   //            console.log($(value[0]).attr("name"));
   //            var image_id = $(value[2]).attr("id");
   //            var image_name = $(value[0]).attr("name");

   //            	image_list.push(image_id);
   //            	image_name_list.push(image_name);

   //          });
		 

		 //console.log(image_name_list);

		 if(table.length==0){
		 	AlertDanger("Oppssssss","There is No data On Table");
		 }else{

		$.ajax({
			url:"vision.php",
			method:"POST",
			
			data:{image_id:true},
			beforeSend: function(){

					// $('body').loadingModal({

					// text:'Getting Text From '+image_name+'</br> Please Wait.....',
					// animation:'fadingCircle'
					// });
					
				$('#process_all').text('Processing....').prop('disabled', true);
				
						interval =  WriteProgress();
					},
					 
			success:function(response)
			{	
				var res = jQuery.parseJSON(response);
						console.log(res);
						dataTable.ajax.reload();
						clearInterval(interval);
				//$('body').loadingModal('destroy');

				 if(res.error =="1"){
				 AlertDanger("Error",res.message);
				 }else{
				 AlertSuccess("Success",res.message);
				 }
		
			$('#process_all').text('Process All Image').prop('disabled', false);
			$('.progress-bar').width("100%").html('Successfully Completed');


			},
			error:function(){

				alert("Bad Request To Load Script");
			}
		});

		}

	});
	
	$(document).on('click', '.delete', function(){
		var image_id = $(this).attr("id");
		if(confirm("Are you sure you want to delete this?"))
		{
			$.ajax({
				url:"delete.php",
				method:"POST",
				data:{image_id:image_id},
				success:function(data)
				{
					//alert(data);
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			return false;	
		}
	});

		// Delete Selected with Checkbox
	$("#dlt_selected_btn").click(function(){
		var boxNum = $('.checkbox:checked').length;
		if ( boxNum == 0 ){
			alert("No Image selected");
		}else{
			var itmID = [];
			$('.checkbox:checked').each(function(){
				itmID.push($(this).val());
			});
			var data = {
				"dlt_selected_btn" : true,
				"itmID" : itmID
			}

			//console.log(data);
			$.ajax({
				url : 'delete.php',
				method : "POST",
				data : data,
				success : function(response){
					//alert(response);
					//window.location = 'working.php' ;
					AlertSuccess("Success","Successfully Deleted");
					dataTable.ajax.reload();
					$(".select_checkbox").prop('checked', false);
    				$("#dlt_selected_btn").css("display", "none");
    				$('#error_multiple_files').html('');

				},
				error : function(){
					alert("Operation Failed.! Something went wrong..!");
				}
			});
		}
	});
	
	
});
</script>


<?php

include 'inc/footer.php';


?>