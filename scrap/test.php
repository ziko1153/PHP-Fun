<?php
$output = shell_exec('crontab -l'); ?>
<?php $cron_file = "/tmp/crontab.txt"; ?>

<!-- Execute script when form is submitted -->
<?php if(isset($_POST['add_cron'])) { ?>

<!-- Add new cron job -->
<?php if(!empty($_POST['add_cron'])) { ?>
<?php file_put_contents($cron_file, $output.$_POST['add_cron'].PHP_EOL); ?>
<?php } ?>

<!-- Remove cron job -->
<?php if(!empty($_POST['remove_cron'])) { ?>
<?php $remove_cron = str_replace($_POST['remove_cron']."\n", "", $output); ?>
<?php file_put_contents($cron_file, $remove_cron.PHP_EOL); ?>
<?php } ?>

<!-- Remove all cron jobs -->
<?php if(isset($_POST['remove_all_cron'])) { ?>
<?php echo exec("crontab -r"); ?>
<?php } else { ?>
<?php echo exec("crontab $cron_file"); ?>
<?php } ?>

<?php } ?>

<b>Current Cron Jobs:</b><br>
<?php echo nl2br($output); ?>

<h2>Add or Remove Cron Job</h2>Please Change This Directory <h3>/home/<b style="color:red">username</b>/public_html/<b style ="color:red">path/to/cron/script</b></h3>
<form method="post" action="<?php $_SERVER['REQUEST_URI']; ?>">
<b>Add New Cron Job:</b><br>
<input type="text" name="add_cron" size="100" placeholder="e.g.: 0 */2 * * * /usr/local/bin/php -q /home/username/public_html/cron.php"><br>
<b>Remove Cron Job:</b><br>
<input type="text" name="remove_cron" size="100" placeholder="e.g.: 0 */2 * * * /usr/local/bin/php -q /home/username/public_html/cron.php"><br>
<input type="checkbox" name="remove_all_cron" value="1"> Remove all cron jobs?<br>
<input type="submit"><br>
</form>

