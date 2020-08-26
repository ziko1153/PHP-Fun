<?php
include 'head.php';
$filepath = realpath(dirname(__FILE__));
include ($filepath.'/../lib/session.php');
include ($filepath.'/../lib/db.php');


session::checksession();

?>


<link rel="stylesheet" type="text/css" href="css/sidebar.css">


<div id="wrapper">
  <div class="overlay"></div>

  <?php include 'sidebar.php'; ?>
<!-- /#sidebar-wrapper -->


<!-- Page Content -->
        <div id="page-content-wrapper">
        





