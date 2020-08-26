<style type="text/css">
  .pad_10{
    padding: 10px;
  }
  .name{
    padding-left: 10px;
  }
</style>

<div id="sidebar-wrapper">
  <ul class="sidebar-nav">
    <li>
      <img src="images/logo.png" class="img-responsive">
    </li>
    <?php 

$get_id = session::get("user_id");
$name = "";
if($get_id==-101)
{
  $name = "Admin";
}
else
{

$select = "select name from tbl_staffs where id = '$get_id'";
$statement = $connection->prepare($select);
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row)
{
  $name = $row["name"];
}

}


    ?>
    <li></li><li></li><li style="color: red"><i class="fa  fa-user fa-2x" aria-hidden="true"></i> <span style="font-size:20px;" class="name">Hello!! <?php echo $name;?></span> </li><li></li>

    <li><a href="dashboard.php" class="pad_10"><i class="fa fa-tachometer fa-2x" aria-hidden="true"></i> <span class="name"></span> Dashboard</a></li>


    <li><a href="keyword.php" class="pad_10"><i class="fa fa-file-text fa-2x" aria-hidden="true"></i> <span class="name"></span>Key Word</a></li>

   <li><a href="job.php" class="pad_10"><i class="fa fa-puzzle-piece fa-2x" aria-hidden="true"></i> <span class="name"></span>Cron Job</a></li>


  </ul>
</div>
        <!-- /#sidebar-wrapper -->



