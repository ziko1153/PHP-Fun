<?php
// error_reporting(0);
ob_start();
session_start();
ob_end_flush();
$filepath = realpath(dirname(__FILE__));
include ($filepath.'/../lib/Database.php');
include ($filepath.'/../lib/session.php');
$db =  new Database();

?>
<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>SMS & Email Integration</title>
		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->


		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<!-- <link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" /> -->
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/loadingModal/css/jquery.loadingModal.css">
		<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />
	<!-- 	<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" /> -->
		<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<!-- <link rel="stylesheet" href="assets/vendor/morris/morris.css" /> -->
		<link rel="stylesheet" href="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="assets/vendor/summernote/summernote.css" />
		<link rel="stylesheet" href="assets/vendor/summernote/summernote-bs3.css" />


		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">
		
		<!-- Data Table File Form Online Cdn -->
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />            
		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
	</head>



	
	