<?php
include 'inc/header.php';
include 'inc/topbar.php';


?>
<?php
 $output = shell_exec('crontab -l'); 
 $cron_file = "/tmp/crontab.txt"; 
 if(isset($_POST['add_cron'])) { 

if(!empty($_POST['add_cron'])) { 
file_put_contents($cron_file, $output.$_POST['add_cron'].PHP_EOL); 
 } 


 if(!empty($_POST['remove_cron'])) { 
 $remove_cron = str_replace($_POST['remove_cron']."\n", "", $output); 
 file_put_contents($cron_file, $remove_cron.PHP_EOL); 
 } 

 if(isset($_POST['remove_all_cron'])) { 
 echo exec("crontab -r"); 
 } else { 
 echo exec("crontab $cron_file"); 
 } 

 }  ?>

<b>Current Cron Jobs:</b><br>
 <?php echo nl2br($output); ?>
		<div class="container box">
			<h2>Add or Remove Cron Job</h2>Please Change This Directory <h3>/home/<b style="color:red">username</b>/public_html/<b style ="color:red">path/to/cron/script</b></h3>
			</div>	
	<div class="container">
		<form class="form-horizontal" method="post" action="<?php $_SERVER['REQUEST_URI']; ?>">
		
			<div class="form-group">
				<label class="control-label col-sm-2" for="">Add Cron:</label>
				<div class="col-sm-10">
		<input class="form-control" type="text" name="add_cron" size="100" placeholder="e.g.: 0 */2 * * * /usr/local/bin/php -q /home/username/public_html/cron.php">
	</div>
		</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="">Remove Cron:</label>
				<div class="col-sm-10">
		<input class="form-control" type="text" name="remove_cron" size="100" placeholder="e.g.: 0 */2 * * * /usr/local/bin/php -q /home/username/public_html/cron.php">
	</div>
			</div>
			 <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">

		<label><input type="checkbox" name="remove_all_cron" value="1"> Remove all cron jobs?</label>
	</div>
</div>
</div>
<div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
		<input type="submit" class="btn btn-success" value="Submit">
	</div>
</div>
		</form>



		</div>



<script type="text/javascript" language="javascript" >


</script>


<?php

include 'inc/footer.php';


?>