<!DOCTYPE html>
<html>
<head>
	<title>ROI LED Calculator</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" media="all" href="css/bootstrap.min.css">
	<script type="text/javascript" src='js/jquery.min.js'></script>
    <script  type="text/javascript" src="js/bootstrap.min.js"></script>
    <style type="text/css">
    	.labelHead{
    		font-size: 20px;
    		font-weight: 700;
    	}
    	.slider {
		  -webkit-appearance: none;
		  width: 100%;
		  height: 8px;
		  border-radius: 3px;  
		  background: #d3d3d3;
		  outline: none;
		  opacity: 0.7;
		  -webkit-transition: .2s;
		  transition: opacity .2s;
		}

		.slider::-webkit-slider-thumb {
		  -webkit-appearance: none;
		  appearance: none;
		  width: 20px;
		  height: 20px;
		  border-radius: 50%; 
		  background: #2e8b57;
		  cursor: pointer;
		}

		.slider::-moz-range-thumb {
		  width: 20px;
		  height: 20px;
		  border-radius: 50%;
		  background: #2e8b57;
		  cursor: pointer;
		}
    </style>
</head>
<body>	
		<!-- PAGE LINK ONE -->
		<br><br>
		<div class="container shadow-sm border p-3 mb-5 bg-white rounded" id="page-one">
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<label><h3>Property Address*</h3></label><br>
					<input autocomplete="off" class="form-control shadow-sm" type="text" id="property_add">
				</div>
				<div class="col-md-4 col-sm-4">
					<label><h3>Type of Property</h3></label><br>
					<select  class="form-control shadow-sm" id="type_property">
						<option value="Other" selected>Other</option>
						<option value="Retail">Retail</option>
						<option value="Hospitality">Hospitality</option>
						<option value="Auto Dealership">Auto Dealership</option>
						<option value="Fitness Center">Fitness Center</option>
						<option value="HOA & Condos">HOA & Condos</option>
						<option value="Resturants">Resturants</option>
						<option value="Warehouse">Warehouse</option>
						<option value="Garage/Parking Lots">Garage/Parking Lots</option>
						<option value="Gas Stations">Gas Stations</option>
					</select>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-4 col-sm-4">
					<button  id="btnContinue" class="btn btn-success btn-lg text-white ">Continue &#8594;</button>
				</div>				
			</div>
			<ul class="pagination justify-content-center">
			    <li class="page-item"><a class="page-link linkOne"  tabindex="0">1</a></li>
			    <li class="page-item "><a class="page-link linkTwo"  id="" tabindex="0">2</a></li>
		  	</ul>
		</div>

		
		<!-- PAGE LINK TWO -->
		<br><br>
		<div class="container shadow-sm border p-3 mb-5 bg-white rounded" id="page-two" style="display: none;">
			<div class="row" style="padding-right: 10px;">
				<div class="col-md-8 col-sm-8">
					<div class="row">
						<div class="col-12 from-group">
							<label class="labelHead">Number of Bulbs</label><br>
							<label>How many lighting fixtures do you need to replace?</label>
							<input class="form-control shadow-sm" type="text" value="50" id="qa"> 
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-12 from-group">
							<label class="labelHead">Current Wattage</label><br>
							<label>What is the current wattage of each light fixture you wish to replace?</label>
							<input class="form-control shadow-sm" type="text" value="300" id="qd">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-12 from-group">
							<label class="labelHead">New Wattage</label><br>
							<label>Keep in mind with LED lights can see a wattage reduction of up to 80%</label>
							<input class="form-control shadow-sm" type="text" value="60" id="qe">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-12 from-group">
							<label class="labelHead">Average Operating Hours per Day</label><br>
							<label>How many hours are your lights on throughout the day.</label>
							<h4 id="rangeValue1">10</h4>
							<div class="slidecontainer">
							  	<input type="range" min="1" max="24" value="10" step="1" class="slider" id="range1" >	  	
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-6 text-left">
							<span>1</span>
						</div>
						<div class="col-6 text-right">
							<span>24</span>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-12 from-group">
							<label class="labelHead">Operating Days in a Year</label><br>
							<input class="form-control shadow-sm" type="text" value="365" id="qg">
						</div>
					</div>
					
					<br>
					<div class="row">
						<div class="col-12 from-group">
							<label class="labelHead">Average kWh Cost</label><br>
							<label>The average cost in Florida is 12.8 cents</label>
							<h4 id="rangeValue2">$0.128</h4>
							<div class="slidecontainer">
							  	<input type="range" min="0" max="0.3" value=".128" step="0.001" class="slider" id="range2">	  	
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-6 text-left">
							<span>$0</span>
						</div>
						<div class="col-6 text-right">
							<span>$0.3</span>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-sm-4 border ">
					<div class="row">
						<div class="col-12 from-group">
							<label class="labelHead">Current Annual Energy Cost</label><br>
							<label>Based on your current traditional lighting energy usage.</label>
							<!-- <input class="form-control shadow-sm" type="text"> -->
							<h2 id="res1">$ Result 1</h2>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-12 from-group">
							<label class="labelHead">New Annual Energy Cost</label><br>
							<label>Based on your new LED bulbs energy usage.</label>
							<!-- <input class="form-control shadow-sm" type="text"> -->
							<h2 id="res2">$ Result 2</h2>							
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-12 from-group">
							<label class="labelHead">Energy Savings each year</label><br>
							<label>By switching to an energy efficient LED system</label>
							<!-- <input class="form-control shadow-sm" type="text"> -->
							<h2 id="res3">$ Result 3</h2>							
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-12 from-group">
							<label class="labelHead">Get a detailed ROI</label><br>
							<label>Fill out the information below and get a custom ROI for your property.</label>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-12 from-group">
							<input class="form-control shadow-sm" autocomplete="off" type="text" id="name" placeholder="Name">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-12 from-group">
							<input class="form-control shadow-sm"  autocomplete="off" type="email" id="email" placeholder="Email">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-12 from-group">
							<input class="form-control shadow-sm" autocomplete="off"  pattern="[1-9]{1}[0-9]{9}"  type="text" id="mobile" placeholder="Mobile No.">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-12 from-group">
							<button id="roibtn" class="btn btn-success btn-block btn-lg">Get Your Custom ROI</button>
						</div>
					</div>					
				</div>
				
			</div>
			<br><br>
			<ul class="pagination justify-content-center">
				<li class="page-item"><a class="page-link linkOne" id="" tabindex="0">1</a></li>
				<li class="page-item "><a class="page-link linkTwo" tabindex="0">2</a></li>
			</ul>			
		</div>

		<script type="text/javascript">
			//js codes for slider to show the value on change of the slider
			$(document).ready(function(){

				var val1 = $('#range1').val();
				var val2 = $('#range2').val();

				$('#rangeValue1').text(`${val1}`);
				$('#rangeValue2').text(`$ ${val2}`);

				$('#range1').on('input',function(){
					var val = $('#range1').val();
					$('#rangeValue1').text(`${val}`);
					recalculate();
				});
				$('#range2').on('input',function(){
					var val = $('#range2').val();
					$('#rangeValue2').text(`$ ${val}`);
					recalculate();
				});

				$('#qa').on('input',function(){					
					recalculate();
				});

				$('#qe').on('input',function(){					
					recalculate();
				});

				$('#qd').on('input',function(){					
					recalculate();
				});

				$('#qg').on('input',function(){					
					recalculate();
				});



				$('.linkOne').on('click',function(){
					$('#page-two').css('display','none');
					$('#page-one').css('display','block');
				});

				$('.linkTwo').on('click',function(){
						var property_add = $("#property_add").val();
						if(property_add==""){
							alert("Please Insert Property Address");
							return;
						}
					$('#page-two').css('display','block');
					$('#page-one').css('display','none');
					recalculate();
				});

				$('#btnContinue').on('click',function(){
						var property_add = $("#property_add").val();
						if(property_add==""){
							alert("Please Insert Property Address");
							return;
						}
					$('#page-two').css('display','block');
					$('#page-one').css('display','none');
					recalculate();
				});

				// START: RESULT VIEW
				// $('#res1').val();
				// END: RESULT VIEW
				
				function recalculate(){
					var qa = $('#qa').val();
					var qd = $('#qd').val();
					var qe = $('#qe').val();
					var qb = $('#range1').val();
					var qg = $('#qg').val();
					var qc = $('#range2').val();

					// console.log('qa :' +qa);
					// console.log('qd :' +qd);
					// console.log('qe :' +qe);
					// console.log('qb :' +qb);
					// console.log('qg :' +qg);
					// console.log('qc :' +qc);

					var res1 = Math.floor((qa*qd*qb*qg*qc)/1000);
					var res2 = Math.floor((qa*qe*qb*qg*qc)/1000);
					var res3 = Math.floor(res1-res2);

					$('#res1').text(`$ ${res1}`);
					$('#res2').text(`$ ${res2}`);
					$('#res3').text(`$ ${res3}`);

					var results = [];
					results.push(res1);
					results.push(res2);
					results.push(res3);
					results.push(qd);
					results.push(qe);
					results.push(qb);
					results.push(qg);
					results.push(qc);
					return results;

				};


//////  Validate Email Function
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}


/////=================Click ROI Button Function  For Get the PDF=====================
///
/// ============================================================================== 
	$('#roibtn').click(function(e){

			e.preventDefault();
			var name = 		$('#name').val();
			var email = 	$('#email').val();
			var mobile = 	$('#mobile').val();
			var property_add = 	$('#property_add').val();
			var type_property = 	$('#type_property').val();
			var mobile = 	$('#mobile').val();
			var results = recalculate();
			var current_energy = results[0];
			var new_energy = results[1];
			var yearly_savings = results[2];
			var ex_wat = results[3];
			var new_wat = results[4];
			var op_hours = results[5];
			var op_days = results[6];
		


		if(name==""||email==""||mobile==""){
			alert("Please Don't Empty Any Field");
		}else if(!isEmail(email)){
			alert("Please Enter Valid Email");

		}else if(!$('#mobile').val().match('[0-9]{10}')&&$('#mobile').val().trim().length>0){

    alert('Please Input 10 Digit Mobile Number');
 
		}else{


										var calculation_list = {
											"roi" : true,
											"name" :name,
											"email":email,
											"mobile":mobile,
											"current_energy":current_energy,
											"new_energy":new_energy,
											"yearly_savings":yearly_savings

										}

										$.ajax({
										url : 'roi.php',
										method : "GET",
										success : function(response){
	window.open('roi.php?name='+name+'&&email='+email+'&&mobile='+mobile+'&&current_energy='+	current_energy+'&&new_energy='+new_energy+'&&yearly_savings='+yearly_savings+'&&property_add='+property_add+'&&type_property='+type_property+'&&ex_wat='+ex_wat+'&&new_wat='+new_wat+'&&op_hours='+op_hours +'&&op_days='+op_days, '_blank');
									
											//console.log(response);
												
										},
										error : function(){
											alert("Operation Failed.! Something went wrong..!");
										}
									});

                        

		}


	});

  

});

    function findAddress(){
            var input = document.getElementById('property_add');
         var autocomplete = new google.maps.places.Autocomplete(input);
      }



		</script>
				  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCp6nrI9Oyl_GrKUfoPHoFZK6-J1SKXOoQ&libraries=places&callback=findAddress"
        async defer></script>
</body>
</html>