<?php
include 'inc/header.php';
include 'inc/topbar.php';

?>
		<div class="container box">
			<h1 align="center">List Of Flagged  Image Upload</h1>
			<br />
			<div align="right">
		
			<button class="btn btn-danger" id="dlt_selected_btn" style="display:none;"><span class="glyphicon glyphicon-trash"></span> Delete selected</button>
	
		</div>
			<div class="table-responsive">
				<br />
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="10%">Image</th>
							<th width="10%">Name</th>
							<th width="30%">Keyword</th>
							<th width="30%">Pattern</th>
							<th width="10%">Working Folder</th>
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





$(document).ready(function(){
	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"flag_fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0,4,5],
				"orderable":false,
			},
		],
	

	});


	$(document).on('click', '.move', function(){
		var image_id = $(this).attr("id");
		$.ajax({
			url:"delete.php",
			method:"POST",
			data:{image_id:image_id,'move' : true},
			success:function(data)
			{	
						
				alert(data);
				//console.log(data);
				dataTable.ajax.reload();


			}
		})
	});


	
	$(document).on('click', '.delete', function(){
		var image_id = $(this).attr("id");
		if(confirm("Are you sure you want to delete this?"))
		{
			$.ajax({
				url:"delete.php",
				method:"POST",
				data:{image_id:image_id,flag_remove:true},
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
				"itmID" : itmID,
				"flag_remove":true
			}

			//console.log(data);
			$.ajax({
				url : 'delete.php',
				method : "POST",
				data : data,
				success : function(response){
					//alert(response);
					//window.location = 'working.php' ;
					dataTable.ajax.reload();
					$(".select_checkbox").prop('checked', false);
    				$("#dlt_selected_btn").css("display", "none");

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