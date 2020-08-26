<!DOCTYPE html>
<html>
<head>
	<title>Success</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="all" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
</head>
<body>
<div class="alert alert-success">
  <strong>ধন্যবাদ!</strong> আপনার মূল্যবান মতামতের জন্য<br>
  	<button id="submit" name="submit" type="submit" class="btn btn-danger btn-lg btn_full">Back</button>
</div>



</body>
</html> 

<script type="text/javascript">
	
	$("#submit").click(function(e){

window.location.replace('index.php');

	});
</script>