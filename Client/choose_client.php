<?php
session_start();
include('../config.php'); 
//error_reporting(0);
// SESSION CHECK SET OR NOT
if(!isset($_SESSION['admin'])) {
	header('location:/test3/Client/index.php');
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <title>CENTRO - Choose User</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="../assets/css/font-awesome.min.css" type="text/css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<link rel="stylesheet" href="../assets/css/tablet.css" type="text/css" />
	<link rel="stylesheet" href="css/mobile-style.css" type="text/css" />

</head>
<body>
    <? include("includes/nav.php"); ?>


<div id="content-container" class="container" style="margin-top:100px">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="text-center logoPage"><img src="../assets/img/logos/login2.png" class="centerThis" alt="Centro" style="margin: 0 auto;" /></div>
			<h1 style="margin-bottom:40px;" class="text-center">Please select Client</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<a href="choose_form.php" id="login-btn" class="btn btn-info btn-block btn-lg">New Client &nbsp; <i class="fa fa-play-circle"></i></a>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<a href="view_client.php" id="login-btn" class="btn btn-warning btn-block btn-lg">Existing Client  &nbsp; <i class="fa fa-play-circle"></i></a>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</body>
</html>