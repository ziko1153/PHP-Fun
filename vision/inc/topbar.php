<style type="text/css">
  .padded{
    padding: 6px 12px;
    line-height: 1.42857143;
    vertical-align: middle;
  }
  .margin_btm{
    margin-bottom: 10px;
  }
</style>

<div class="row">

  <!-- Toggle Sidebar Button -->
  <div class="col-sm-1 margin_btm">
    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
  </div>

  <!-- Company Name & LOGO -->
  <div class="col-sm-6 margin_btm">

    <div class="col-sm-3 pull-left" style="height: 100px;">
      <img style="height: 100%; " src="<?= company_logo_url ?>" />
    </div>

    <div class="col-sm-9 padded" style="font-size: 2.5em;">
      <?= company_name ?>
    </div>

  </div>

  <!-- Date Time -->
  <div class="col-sm-offset-2 col-sm-2 padded" style="font-weight: bold;">
    <span class="pull-right margin_btm">
      <span id=tick2></span>&nbsp;|&nbsp;<?php echo date("l, F j, Y"); ?>
    </span>
  </div>


<?php 
  if (isset($_GET['action']) && $_GET['action']=="logout"){
    session::destroy();
  }

$get_id = session::get("user_id");
$name = "";
if($get_id==-101)
{
  $name = "Admin";
}
else
{
$select = "select name from tbl_staffs where id = '$get_id'";

$res = $db->select($select);
if($res)
{
  $row = mysqli_fetch_array($res);
  $name = $row["name"];
}

}


    ?>
  
  <!-- Logout button -->
  <div class="col-sm-1">

    <span class="pull-right margin_btm">
      <div style="text-align: center;"><span style="color: black;"><b><?php echo $name?></b></span></div>
       <a class="btn btn-danger" href="?action=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
    </span>
  </div>
  

</div>





<script type="text/javascript">

  function show2(){
    if (!document.all&&!document.getElementById){
      return;
    }

    var thelement = document.getElementById? document.getElementById("tick2"): document.all.tick2
    var Digital = new Date()
    var hours = Digital.getHours()
    var minutes = Digital.getMinutes()
    var seconds = Digital.getSeconds()
    var dn = "PM"

    if (hours<12)
      dn="AM"
    if (hours>12)
      hours=hours-12
    if (hours==0)
      hours=12
    if (minutes<=9)
      minutes="0"+minutes
    if (seconds<=9)
      seconds="0"+seconds

    var ctime = hours+":"+minutes+":"+seconds+" "+dn
    thelement.innerHTML = ctime
    setTimeout("show2()",1000)
  }

  window.addEventListener("load", show2);

</script>