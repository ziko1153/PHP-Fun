<?php
include 'inc/header.php';
include 'inc/topbar.php';
?>

<style type="text/css">
	body{
		background-color: white;
		color: black;
		padding: 16px;
	}

canvas {
  border: 2px dotted black;
}

.chart-container {
  position: relative;
  margin: auto;
  height: 70vh;
  width: 80vw;
}

</style>

<hr><br>
	<div class="row">
		<div class="col-sm-12">
						
						<!-- Time and Keyword input field -->
				<div class="row text-center">
							<div class="col-sm-12 form-inline">

				<div class="form-group">
					<label for="">From:</label>
					<input type="" class="form-control date" id="from_date">
				</div>
				<div class="form-group">
					<label for="">To:</label>
					<input type="" class="form-control date" id="to_date">
				</div>
				<div class="form-group">
					<label for="">Select Keyword:</label>
				<select class="form-control" id="Keyword" name="Keyword">
					<option value="0">Select Keyword</option>

												<?php 

					$query = "select * from tbl_keyword";

							$statement = $connection->prepare($query);
							$statement->execute();
							$result = $statement->fetchAll();
							
							foreach($result as $row)
							{



				?>
					<option value="<?php echo $row['id'];?>"><?php echo $row['name']?></option>
						<?php  }  ?>
				</select>
				</div>
					<div class="form-group">
				<button type="button" style="margin-left:20px;" id="show_chart" class="btn btn-success" >Show</button>
				</div>

			</div>

				</div>
		</div>
	</div>

<div id="chart_show" class="chart-container" style="display: none;">
    <canvas id="myChart"></canvas>
</div>

	

<script type="text/javascript">


	// Date Picker Function
	$( function() {
		$( "#from_date" ).datepicker({ dateFormat: 'yy/mm/dd' });
		$( "#to_date" ).datepicker({ dateFormat: 'yy/mm/dd' });
	} );


function isValidDate(dateString) {
  var regEx = /^\d{4}\/\d{2}\/\d{2}$/;
  return dateString.match(regEx) != null;
}

function unique(list) {
    var result = [];
    $.each(list, function(i, e) {
        if ($.inArray(e, result) == -1) result.push(e);
    });
    return result;
}
//Select Box with search 

$('#Keyword').chosen();

$("#show_chart").click(function(e){

	from_date = $('#from_date').val();
	to_date = $('#to_date').val();
	key_id = $('#Keyword').val();
	if(key_id==''||key_id==0){
		alert("Please Select Keyword");
		return;
	}else if(from_date =='' || to_date ==''){
		alert("Please Select Date Range");
		return;
	}else if(!isValidDate(from_date)||!isValidDate(to_date)){
		alert("Please Insert Right Date");
		return;
	}else{

 	data = {
			'search_key' : true,
			'from_date' : from_date,
			'to_date' : to_date,
			'key_id' : key_id
		}
			$.ajax({
				url:"fetch_barlist.php",
				method:'POST',
				data:data,
				success:function(response)
				{ 
					var res = jQuery.parseJSON(response);
					console.log(res);
					var status = [];
					var value  = [];
					var date   = [];
					var time   = [];
					for(var i in res){
						//status.push(res[i].con_status);
						date.push(res[i].date);
						time.push(res[i].time);
					}
					

					date = unique(date);
					time = unique(time);
					for(var i in time){
							
					for(var d in date){
							exists = 0;
						for(var j in res){

							if(time[i]==res[j].time&&date[d]==res[j].date){
									value.push(res[j].con_status);
									exists = 1;
									break;
							}
						}
						if(exists==0){
							value.push(0);
						}

					}
						status[i] = value;
						value  = [];
				}
					console.log(date);
					console.log(time);
					console.log(status);

					$('#chart_show').show();
					var lineChartData = { labels: date, datasets: [] };

time.forEach(function (a, i) {
    lineChartData.datasets.push({
        label: 'Time ' + time[i],
        fillColor: 'rgba(220,220,220,0.2)',
        strokeColor: 'rgba(220,220,220,1)',
        pointColor: 'rgba(220,220,220,1)',
        pointStrokeColor: '#fff',
        pointHighlightFill: '#fff',
        pointHighlightStroke:
        'rgba(220,220,220,1)',
        data: status[i]
    });
});

					var ctx = document.getElementById("myChart").getContext("2d");  ;
				 if(window.bar != undefined)
  					window.bar.destroy();

 window.bar = new Chart(ctx, {
    type: 'bar',
    data: lineChartData,
    options: {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true,
                stepSize: 1
            }
        }]
    }
}
 
});


			
				}
			});






			
	}
});

// var ctx = document.getElementById("myChart");
// var myChart = new Chart(ctx, {
//     type: 'bar',
//     data: {
//         labels: ["2 AM November 20 2018", "4 AM November 20 2018", "6 AM November 20 2018", "8 AM November 20 2018", "10 AM November 2 2018", "12 PM November 20 2018", "0 PM November 20 2018", "5 PM November 20 2018", "8 PM November 20 2018", "2 PM November 20 2018", "12 PM November 20 2018"],
//         datasets: [{
//             label: 'Currency Found',
//             data: [(5,20),1],
//             backgroundColor: [
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(255, 206, 86, 0.2)',
//                 'rgba(75, 192, 192, 0.2)',
//                 'rgba(153, 102, 255, 0.2)',
//                 'rgba(255, 159, 64, 0.2)'
//             ],
//             borderColor: [
//                 'rgba(255,99,132,1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(255, 206, 86, 1)',
//                 'rgba(75, 192, 192, 1)',
//                 'rgba(153, 102, 255, 1)',
//                 'rgba(255, 159, 64, 1)'
//             ],
//             borderWidth: 2
//         }]
//     },
 
// });
	

// var lineChartData = { labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'], datasets: [] },
//     array = ["[0,0,0,0,0,0,0,0,0,0,0,0,0,58,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]", "[0,0,53,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]", "[0,0,381,0,0,649,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]"];

// array.forEach(function (a, i) {
//     lineChartData.datasets.push({
//         label: 'Label ' + i,
//         fillColor: 'rgba(220,220,220,0.2)',
//         strokeColor: 'rgba(220,220,220,1)',
//         pointColor: 'rgba(220,220,220,1)',
//         pointStrokeColor: '#fff',
//         pointHighlightFill: '#fff',
//         pointHighlightStroke:
//         'rgba(220,220,220,1)',
//         data: JSON.parse(a)
//     });
// });

// console.log(lineChartData);



</script>



<?php
include 'inc/footer.php';


?>
