<?php
include 'inc/header.php';
include 'inc/topbar.php';

?>
		<div class="container box">
			<h1 align="center">List Of Keywords</h1>
			<br/>
				<div align="center">
					<div class="input-group input-group-lg">
		    <input  type="text" name="keyword" id="keyword" value="" placeholder="Enter Keyword" /><button type="button" style="margin-left:20px;" id="add_key" class="btn btn-success" >Add</button></div>
		   	
		    <span id="error_keyword"></span>

				</div>
		<div align="right">
		
			<button class="btn btn-danger" id="dlt_selected_btn" style="display:none;"><span class="glyphicon glyphicon-trash"></span> Delete selected</button>
	
		</div>
			<div class="table-responsive">
				<br />
		
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="40%">SL.</th>
							<th width="50%">Key Name</th>
							<th  width="10%"> Delete ALL <input class="select_checkbox"  type="checkbox" id="select_all"></th>
						</tr>
					</thead>
				</table>
				
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

	$('#keyword').focus();
	
	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"keylist_fetch.php",
			type:"POST",
			data : {
            "keyword" : true
        }
		},
		"columnDefs":[
			{
				"targets":[0,2],
				"orderable":false,
			},
		],

	});



	$(document).on('click', '#add_key', function(event){
		event.preventDefault();
		var keyword = $('#keyword').val();
	
		if(keyword != '')
		{
			$.ajax({
				url:"insert.php",
				method:'POST',
				data: {keyword:keyword,insert_key:true},
				success:function(data)
				{
					//alert(data);

					$('#keyword').val('');
					$("#keyword").focus();
		 $('#error_keyword').html('<br /><label class="text-success">Successfully Added Keyword</label>');
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			alert("Please Enter KeyWord");
		}
	});
	

			// Delete Selected with Checkbox
	$("#dlt_selected_btn").click(function(){
		var boxNum = $('.checkbox:checked').length;
		if ( boxNum == 0 ){
			alert("No Keyword selected");
		}else{
			var keyid = [];
			$('.checkbox:checked').each(function(){
				keyid.push($(this).val());
			});
			var data = {
				"dlt_selected_key" : true,
				"keyid" : keyid
			}

			//console.log(data);
			$.ajax({
				url : 'delete.php',
				method : "POST",
				data : data,
				success : function(response){
					//alert(response);
					//window.location = 'working.php' ;
					//AlertSuccess("Success","Successfully Deleted");
					dataTable.ajax.reload();
				$(".select_checkbox").prop('checked', false);
		    	$("#dlt_selected_btn").css("display", "none");
		    	 $('#error_keyword').html('');

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