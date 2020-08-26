<?php
include 'head.php';
  if (isset($_GET['action']) && $_GET['action']=="logout") {
   session::destroy();

  }
session::checksession();
include 'topbar.php';
include 'leftside.php';
?>








