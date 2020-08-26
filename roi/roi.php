<?php 

	$name = $_GET['name'];
	$email = $_GET['email'];
	$mobile = $_GET['mobile'];
	$current_energy = $_GET['current_energy'];
	$new_energy = $_GET['new_energy'];
	$yearly_savings = $_GET['yearly_savings'];
	$monthly_savings = round($yearly_savings/12,2);
	$_5years_savings = round($yearly_savings*5,2);
	$property_add = $_GET['property_add'];
	$type_property = $_GET['type_property'];
	$ex_wat = $_GET['ex_wat'];
	$new_wat = $_GET['new_wat'];
	$op_hours = $_GET['op_hours'];
	$op_days = $_GET['op_days'];

	$annual_kwh = ($ex_wat/1000)*$op_days*$op_hours;
	$project_kwh = ($new_wat/1000)*$op_days*$op_hours;

	$trees_plant = round((($annual_kwh * .58)-($project_kwh * .58))/455,2);
	$cars_remove = round((($annual_kwh * .58)-($project_kwh * .58))/5443.11,2);
	$system_reduc = round(($ex_wat-$new_wat)/$ex_wat,2);


	// echo $name."-mobile--".$mobile."-current_energy-".$current_energy.'-new_energy-'.$new_energy.'-yearly_savings-'.$yearly_savings.'-monthly_savings-'.$monthly_savings.'-_5years_savings-'.$_5years_savings.'-property_add-'.$property_add;
	// die();

include __DIR__ . '/vendor/autoload.php';

	$mpdf = new \Mpdf\Mpdf([
		'mode' => 'c',
		'format' => 'A4',
		'margin_left' => 0,
		'margin_right' => 0,
		'margin_top' => 0,
		'margin_bottom' => 0,
		'margin_header' => 0,
		'margin_footer' => 0,
		'default_font' => 'calibri'
	]);
	$mpdf->WriteHTML('
		<!DOCTYPE html>
		<html>
			<head>
				<title>ROI PDF NEW</title>
				<style type="text/css">
					body {
				  margin: 0;
				  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
				  font-size: 1rem;
				  font-weight: 600;
				  line-height: 1.5;
				  color: #212529;
				  text-align: left;
				  background-color: #fff;
				}
					.logoContainer{
							width: 100%; 
							background-image: linear-gradient(to right,rgb(2,104,51),rgb(140,191,33),rgb(2,104,51)); 
							border-bottom-right-radius: 30px; 
							border-bottom-left-radius: 30px; 
							display: block;
							box-shadow: 6px 10px 18px 0px #383838;
					}
					.logoContainerImageContainer{
						width: 140px;
						height: 110px; 
						background: #C2E4C2; 
						margin-left: 30px;
						border-radius: 30%;
						float: left;
					}
				</style>
			<body>
			<!-- start: heading with logo -->				
				<div class="logoContainer" style="height:100px; margin-bottom:20px;">
					<div class="logoContainerImageContainer" >
						<img src="img/logo.png" height="100px" width="100px" style="margin-left: 22px;">					
					</div>
					<div style="width: auto; margin-left: 200px;">
						<span style="color: white; font-size:59px; font-weight:bold; margin-top:20px;" ><i>LED Savings & ROI</i></span>				
					</div>
				</div>
			<!-- end: heading with logo -->
			
			

			<div style="width: 100%; ">
			<!-- start: 2nd row||first div -->
				<div style="width: 45%; border-radius: 20px; background-color: #7BC143; height: 200px; float: left;  margin-left: 25px;">

					<div style="margin-top:5px; margin-left:15px; width:100%; font-size: 12px;">
						<span style="color:white;	">To: '.$name.'</span>
					</div>

					<div style="background-color: white; height: 3px; margin: 6px;"></div>
					
					<div style="margin-top:5px; margin-left:15px; width:100%; font-size: 12px;">
						<span style="color:white;	">Email: '.$email.'</span>
					</div>

					<div style="background-color: white; height: 3px; margin: 6px;"></div>

				<div style="margin-top:5px; margin-left:15px; width:100%; font-size: 12px;">
						<span style="color:white;	">Mobile: '.$mobile.'</span>
					</div>

						<div style="background-color: white; height: 3px; margin: 6px;"></div>

					<div style="margin-top:5px; margin-left:15px; width:100%; font-size: 12px;">
						<span style="color:white;	">Address: '.$property_add.'</span>
					</div>

					<div style="background-color: white; height: 3px; margin: 6px;"></div>

					<div style="margin-top:5px; margin-left:15px; width:100%; font-size: 12px;">
						<span style="color:white;	">Property Type: '.$type_property.'</span>
					</div>


				</div>
			<!-- end: 2nd row||first div -->

			<!-- start: 2nd row||second div -->
				<div style="width: 45%; border-radius: 20px; background-color: #7BC143; height: 200px; float: right; margin-top: 0px; margin-right: 25px;">

					<div style="margin-top:10px; margin-left:15px; width:100%; font-size: 12px;">
						<span style="color:white;	">From: Andersen Zapata</span>
					</div>

					<div style="background-color: white; height: 3px; margin: 6px;"></div>

					<div style="margin-top:10px; margin-left:15px; width:100%; font-size: 12px;">
						<span style="color:white;	">Email: andersen@lightingoftomorrow.com</span>
					</div>

					<div style="background-color: white; height: 3px; margin: 6px;"></div>

					<div style="margin-top:10px; margin-left:15px; width:100%; font-size: 12px;">
						<span style="color:white;	">Office: (954) 626-0267</span>
					</div>

					<div style="background-color: white; height: 3px; margin: 6px;"></div>

					<div style="margin-top:10px; margin-left:15px; width:100%; font-size: 12px;">
						<span style="color:white;	">ROI#:</span>
					</div>

				</div>
			<!-- end: 2nd row||second div -->
			</div>
			
			<br>

			<div style="width: 100%; margin-top:-15px;">
			<!-- start: 3rd row||first div -->
				<div style="width: 45%; border-radius: 20px; background-color: #7BC143; height: 150px; float: left; margin-top: 0px; margin-left: 25px; box-shadow: 5px 5px 13px 2px black;">
					<div style="text-align:center; width:100%;">
						<span style="color:white;	font-size:20px;">Start Saving Today</span>						
					</div>

					<div style="text-align:left; padding: 10px 10px 20px 10px ; width:100%; background-color:white; border-bottom-right-radius: 19px; border-bottom-left-radius: 19px; ">
						<span style="color:black;	font-size:15px; font-weight:bold;">LED technology is an investment in your property that pays for itself over time. We offer a variety of payment methods to help facilitate the switch to LED.</span>						
					</div>
					
				</div>
			<!-- end: 3rd row||first div -->

			

			<!-- start: 3rd row||second div -->
				<div style="width: 45%; border-radius: 20px; background-color: #7BC143; height: 150px; float: right; margin-top: 0px; margin-right: 25px; box-shadow: 5px 5px 13px 2px black;">
					
					<div style="text-align:center; width:100%;">
						<span style="color:white;	font-size:20px;">Current Energy Cost</span>						
					</div>

					<div style="text-align:center; padding:17px; width:100%; background-color:white; border-bottom-right-radius: 19px; border-bottom-left-radius: 19px; ">
						<span style="color:black;	font-size:16px;  font-weight:bold;">You are currently paying <br><span style="font-size:25px;">$ '.$current_energy.'</span><br> annually!</span>						
					</div>

				</div>
			<!-- end: 3rd row||second div -->			
			</div>
			
			<img src="img/downArrow.png" height="40px" width="35px" style="position: absolute; margin-top:0px; z-index: -11; margin-left:570px; margin-top:-15px; margin-bottom:5px;">

			<div style="width: 100%; position:relative; z-index:-1; margin-top:-12px;">
			<!-- start: 4th row||first div -->
				<div style="width: 45%; border-radius: 20px; background-color: #7BC143; height: 150x; float: left; margin-top: 0px; margin-left: 25px; box-shadow: 5px 5px 13px 2px black;">
					<div style="text-align:center; width:100%;">
						<span style="color:white;	font-size:20px;">Smart Savings Program</span>						
					</div>

					<div style="text-align:left; padding: 10px 10px 20px 10px ; width:100%; background-color:white; border-bottom-right-radius: 19px; border-bottom-left-radius: 19px; ">
						<span style="color:black;	font-size:15px; font-weight:bold;">Get LED technology for $0 money down! With Lighting as a Service, we take our monthly fee from your savings and maintain your lighting for the duration of the program.</span><br><br>						
					</div>
					
				</div>
			<!-- end: 4th row||first div -->
			
			

			<!-- start: 4th row||second div -->
				<div style="width: 45%; border-radius: 20px; background-color: #7BC143; height: 150px; float: right; margin-top: 0px; margin-right: 25px; box-shadow: 5px 5px 13px 2px black;">
					
					<div style="text-align:center; width:100%;">
						<span style="color:white;	font-size:20px;">New Energy Cost</span>						
					</div>

					<div style="text-align:center; padding:15px; width:100%; background-color:white; border-bottom-right-radius: 19px; border-bottom-left-radius: 19px; ">
						<span style="color:black;	font-size:17px;  font-weight:bold;">With a LED system<br> you’ll be spending only <br><span style="font-size:25px;"> $ '.$new_energy.'</span><br> annually!</span><br>						
					</div>

				</div>
			<!-- end: 4th row||second div -->			
			</div>
			
			<img src="img/triangle.png" height="135px" width="250px" style="position: absolute; margin-bottom:-25px; z-index: -11; margin-left:273px; margin-top:-75px;">

			
			<!-- start: 5th row||last div of first page -->						
			<div style="width: 100%; height:408px; background-image: linear-gradient(to bottom, rgb(5,140,54),rgb(123,190,60)); page-break-after: always;">

				<!-- start: 5th row|| inner first div -->
					<div style="margin-left:5%; margin-top:20px; height:150px; border-radius:20px; background-color: white; width: 90%;">
						
						<div style="width:200px; border-right:4px solid rgb(139,197,61); padding:5px 5px 5px 5px; text-align:center; color:rgb(139,197,61); float:left;">
						 <h3>Monthly Savings</h3>
						 <br><span style="font-size:25px; font-weight:bold; color:black;">$ '.$monthly_savings.'</span>
						</div>

						<div style="width:250px; border-right:4px solid rgb(139,197,61); padding:5px 5px 5px 5px; text-align:center; color:rgb(139,197,61); float:left;">
						 <h3>Yearly Savings</h3>
						 <br><span style="font-size:25px; font-weight:bold; color:black;">$ '.$yearly_savings.'</span>
						</div>

						<div style="width:200px; padding:5px 5px 5px 5px; text-align:center; color:rgb(139,197,61); float:right;">
						 <h3>5 Years Savings</h3>
						 <br><span style="font-size:25px; font-weight:bold; color:black;">$ '.$_5years_savings.'</span>
						</div>
					</div>			
				<!-- end: 5th row|| inner first div -->		


				<!-- start: 5th row|| inner second div -->
					<div style="width:100%; margin-top: 10px;">
						<div style="width:27%; margin-left:5%; height:160px; background-color:white; border-radius:20px; float:left; text-align: center; color:rgb(139,197,61);">
							
						 	<span style="font-size:17px; font-weight:bold;">Energy Reduction</span><br>
							<img src="img/energy.png" height="50px" width="50px" style="padding-top:18px;"><br>
							<span style="color:black; font-size:25px; font-weight:bold;">'. $system_reduc*100 .' %</span>
						</div>


						<div style="width:27%; margin-left:5%; height:160px; background-color:white; border-radius:20px; float:left; text-align: center; color:rgb(139,197,61);">

							<span style="font-size:17px; font-weight:bold;">Trees Planted</span><br>
							<img src="img/tree.png" height="50px" width="50px" style="padding-top:18px;"><br>
							<span style="color:black; font-size:25px; font-weight:bold;">'.$trees_plant.'</span>
						</div>


						<div style="width:27%; margin-right:5%; height:160px; background-color:white; border-radius:20px; float:right; text-align: center; color:rgb(139,197,61);">

							<span style="font-size:17px; font-weight:bold;">Cars Removed</span><br>
							<img src="img/car.png" height="50px" width="50px" style="padding-top:18px;"><br>
							<span style="color:black; font-size:25px; font-weight:bold;">'. $cars_remove.'</span>
						</div>
					</div>			
				<!-- end: 5th row|| inner second div -->

				<!-- start: 5th row|| first page footer -->	
					<div style="width:90%; margin-left:5%; margin-top: 10px;">
						<img src="img/footer.png">
					</div>		
				<!-- end: 5th row|| first page footer -->			
				

				
			</div>
			<!-- end: 5th row||last div of first page -->		



			<!-- start: 2nd page  -->	
				<!-- start: heading with logo -->				
					<div class="logoContainer" style="height:100px;">
						<div class="logoContainerImageContainer" >
							<img src="img/logo.png" height="100px" width="100px" style="margin-left: 22px;">					
						</div>
						<div style="width: auto; margin-left: 200px;">
						<span style="color: white; font-size:59px; font-weight:bold; margin-top:20px;" ><i>LED Savings & ROI</i></span>				
					</div>
					</div>
				<!-- end: heading with logo -->
				

				<!-- Start: 1st div || Container with text -->
					<div style="width:90%; margin-left: 5%; background-color: #43AC33; margin-top: 20px; border-radius: 20px;"> 
						
						<div style="width: 100%; margin-left: 25px; color:white;">
							<h3>Get Started on your Project</h3>
							<span style="font-size:17px;"> Your current inefficient lighting system is costing you money, get started today</span><br>
							<span style="font-size:17px;">1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact a Project Manager for consultating.</span><br>
							<span style="font-size:17px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Get a fast quote with:</span><br>
							<span style="font-size:17px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;• Transparent pricing</span><br>
							<span style="font-size:17px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;• Product and service description</span><br>
							<span style="font-size:17px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;• No hidden fees</span><br>
							<span style="font-size:17px;">3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Start saving.</span><br>

							<span style="font-size:17px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;With L.o.T. it’s that simple!</span><br>
						</div>
					</div>
				<!-- end: 1st div || Container with text -->



				<!-- Start: 1st div || Container with text -->
					<div style="width:90%; margin-left: 5%; background-color: #43AC33; margin-top: 20px; border-radius: 20px;"> 
						
						<div style="text-align:center; color: white; width:100%;">
							<span style="font-size:17px;"><b>Pricing on your terms</b></span><br>
							<span style="font-size:17px;">We offer multiple payment options to ensure any commercial property can enjoy LED</span>
						</div>

						<div style="width: 100%; ">
							<!-- start: second div|| first div -->
								<div style="width: 45%; border-radius: 20px; background-color: white; height: 200px; float: left; margin-top: 15px; margin-left: 25px; box-shadow: 6px 9px 20px 0px black; margin-bottom:15px;">
									<div style="text-align:center; width:100%;">
										<span style="color:black;	font-size:17px;"><b>Traditional Purchase</b></span><br>
										<img src="img/traditionalPurchase.png" height="50px" width="50px">						
									</div>

									<div style="text-align:left; padding: 10px 10px 20px 10px ; width:100%; background-color:white; border-bottom-right-radius: 19px; border-bottom-left-radius: 19px; ">
										<span style="color:black;	font-size:15px;">After you approve your quote, we only need a deposit to get started. Talk to a L.o.T. professional about fnancing your project. You can pay in bulk or overtime.</span>						
									</div>
									
								</div>
							<!-- end: second div||first div -->

							

							<!-- start: second div||second div -->
								<div style="width: 45%; border-radius: 20px; background-color: white; height: 200px; float: right; margin-top: 0px; margin-right: 25px; box-shadow: 6px 9px 20px 0px black; margin-bottom:15px;">
									
									<div style="text-align:center; width:100%;">
										<span style="color:black;	font-size:17px;"><b>Smart Savings Program</b></span><br>
										<img src="img/smartSavings.png" height="50px" width="50px">						
									</div>

									<div style="text-align:left; padding:10px; width:100%; background-color:white; border-bottom-right-radius: 19px; border-bottom-left-radius: 19px; ">
										<span style="color:black;	font-size:15px;">If your project qualifes you can get started on your project with no money down! Pay us based on your savings. We’ll mantain your lights for the duration of your program.</span>						
									</div>

								</div>
							<!-- end: second div||second div -->			
							</div>


					</div>
				<!-- end: 1st div || Container with text -->
				

				<!-- start: last div with email information || Container with text -->
					<div style="width: 90%; margin-top: 20px; margin-left: 5%; border-radius:20px;  position:relative; z-index: -1; ">
						
						<div style="width: 100%; background-image: linear-gradient(to bottom, rgb(5,140,54),rgb(139,197,61)); border-top-right-radius: 20px; border-top-left-radius: 20px; text-align: center; color:white; padding:10px; box-shadow: 6px 9px 20px 0px black;">
							<span style="font-size:15px; font-weight: bold; ">Speak to Project Manager</span><br><br>
							<span style="font-size:15px;">We manage your project from start to fnish.</span><br>
							<span style="font-size:15px;">You can focus on your property, we’ll focus on your lights.</span><br>
						</div>						
					</div>

					<div style="width: 90%; margin-left: 5%;   position:relative; background-color:white; z-index: 1; box-shadow: 6px 9px 20px 0px black; border-bottom-left-radius:20px; border-bottom-right-radius:20px;">
						<div style="width:65%; float:left; position:relative; padding:10px; margin-left: 10px; z-index:25">
							<span style="font-size:17px;"><b>Not sure where to start. Contact our office today to get started.</b></span><br><br>
								<span style="font-size:18px;">ROI #:</span><br><br><br>
								<span style="font-size:18px;">From: Andersen Zapata</span><br>
								<span style="font-size:18px;">Email: andersen@lightingoftomorrow.com</span><br>
								<span style="font-size:18px;">Office: (954) 626-0267</span><br>

						</div>

						<div style="width:30%; float:right; position:relative; z-index:55;"><br><img src="img/logo.png" style=""></div>
							
					</div>

					

				<!-- end: last div with email information || Container with text -->


				

				<!-- start: last div || fixed container with footer -->
				<div style="width: 100%; background-image: linear-gradient(to bottom, rgb(5,140,54),rgb(139,197,61)); page-break-after: always;position: fixed; bottom: 0; height: 304px; z-index: -111; "> 									
				</div>

				<div style="width: 100%; position: fixed; bottom: 0; margin-bottom:5px;">
					<div style="width:90%; margin-left:5%; margin-top:-5px;">
						<img src="img/footer2.png">
					</div>
				</div>	
				<!-- end: last div || fixed container with footer -->
			<!-- end: 2nd page  -->						
			</body>		
		</html>
		');

	$filename = "ROI__".$name."__".date('y-M-d').".pdf";
	  $mpdf->Output($filename,'D');
// 	$mpdf->Output();

?>