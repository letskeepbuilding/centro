<?php
session_start();
		include('../config.php'); 
      	error_reporting(0);
      	$msg = "";
      	
      	if(!isset($_SESSION['admin']))
      	{
      		header('location:index.php');
      	}


      	// QUERY TO GET USER DATA
        $userData = $db->prepare("SELECT * FROM users");
        $userData->execute();
       
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

    <title>View Users</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="">
	<meta name="author" content="" />
	
	<link rel="stylesheet" href="/assets/css/font-awesome.min.css" type="text/css" />		
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<link rel="stylesheet" href="/assets/css/App.css" type="text/css" />
	<link rel="stylesheet" href="/assets/css/custom.css" type="text/css" />	
	<link rel="stylesheet" href="/assets/css/bootstrap-datetimepicker.css" type="text/css" />
	<link rel="stylesheet" href="css/mobile-style.css" type="text/css" />
	<script src="https://use.fontawesome.com/45afbdf0c9.js"></script>
        <!--<link rel="stylesheet" type="text/css" href="../assets/plugins/datatables/dataTables.bootstrap.css"/>-->

</head>

<body>
<nav class="navbar navbar-default" role="navigation">	
	<div class="container navbar">
		<div class="row">
			<div class="col-3 text-left"><a href="choose_client.php" class="align-middle navbar-brand"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a></div>
			<div class="col-6 text-center"><a class="navbar-brand" href="#">Centro</a></div>
			<div class="col-3 text-right">
				
				<ul class="nav navbar-nav navbar-right align-middle navbar-brand">
					<li class="dropdown "><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i> Admin <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
							<li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i> </span>Settings</a></li>
							<li class="divider"></li>
							<li><a href="logout.php"><i class="fa fa-power-off" aria-hidden="true"></i> </span>Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>
<div id="wrapper">
	<div id="content container">
		<div class="row">
			<div class="col-md-12">
		<div class="form-group" style="padding:15px;">
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></div>
				<input class="form-control" id="searchinput" type="search" placeholder="Search..." />
			</div>
		</div>				
		
		<?php 
		while($row = $userData->fetch(PDO::FETCH_ASSOC))
		{		
				$user_id = $row['id'];
		?>
		
		<div class="list-group">
		  <a href="view_client_single.php?user_id=<?php echo $user_id;?>" class="list-group-item list-group-item-action flex-column align-items-start">
			<div class="d-flex w-100 justify-content-between">
			  <h5 class="mb-1"><?php echo $row['name'].' '.$row['middlename'].' '.$row['lastname']; ?></h5>
			  <small>3 days ago</small>
			</div>
			<p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
			<small>Donec id elit non mi porta.</small>
		  </a>
		</div>
		<?php
		}
		?>
		
	</div> 
	
	</div>
	</div>
	
   <!-- #content -->	
</div> 
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="/assets/js/App.js"></script>
<script>

</script>
</body>
</html>