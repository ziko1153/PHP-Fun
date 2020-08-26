<?php include 'inc/header.php'; ?>
	<section role="main" class="content-body">
					<header class="page-header">
						<h2>Registration List</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Report</span></li>
								<li><span>Registration</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" ><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>
					<div class="row">
								<div class="col-lg-12">
									<section class="panel">

		<div class="">  
                <div class="table-responsive">  
                     <table id="employee_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  <td>SL.</td>
                                    <td>Name</td>  
                                    <td>Email</td>  
                                    <td>Mobile</td>  
                                    <td>Date</td>  
                               </tr>  
                          </thead>  
                      <?php 

                      			$query = 'select * from tbl_reg';
                      			$res = $db->select($query);
                      			if($res){
                      				$i = 0;
                      				while($row = mysqli_fetch_array($res)){
                      						$i++;

                      ?>				
                               <tr> <td><?=$i?></td>
                                    <td><?=$row['name'] ?></td>
                                    <td><?=$row['email'] ?></td>
                                    <td><?=$row['mobile'] ?></td>
                                    <td><?=date("l,F j, Y",strtotime($row['date']))?></td>
                                   
                               </tr> 
                     
                           <?php } } ?>
                         
                     </table>  
                </div>  
           </div>  
       </section>
   </div>
</div>
</section>


<?php include 'inc/footer.php'; ?>

<script type="text/javascript">
	
 $(document).ready(function(){  
     $('#employee_data').DataTable(); 
      
       
 });  

</script>