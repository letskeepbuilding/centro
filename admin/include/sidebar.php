<?php $url=$_SERVER['PHP_SELF'];?>
<div id="sidebar-wrapper" class="collapse sidebar-collapse">
		<div id="search">
				
		</div> <!-- #search -->
	
		<nav id="sidebar">		
			
			<ul id="main-nav" class="open-active">			

				<li>				
					<a href="dashboard.php">
						<i class="fa fa-dashboard"></i>
						Dashboard
					</a>				
				</li>
						
				<li class="dropdown <?php if((strpos($url,'user')!=false) || (strpos($url,'youth')!=false) || (strpos($url,'dashboard')==true) ) echo 'active opened';?>">
					<a href="javascript:;">
						<i class="fa fa-user"></i>
						Clients
						<span class="caret"></span>
					</a>				
					
					<ul class="sub-nav">
						<li><a href="add_user.php"><i class="fa fa-plus-square"></i>Add Client</a></li>
						<li><a href="view_user.php"><i class="fa fa-search"></i> View Client</a></li>
						<li><a href="add_youth.php"><i class="fa fa-plus-square"></i>Add Youth</a></li>
						<!--<li><a href="view_youth.php"><i class="fa fa-search"></i> View Youth</a></li>-->
					</ul>						
					
				</li>
				<!--<li class="dropdown <?php if((strpos($url,'bob')!=false)) echo 'active opened';?>">
					<a href="javascript:;">
						<i class="fa fa-user"></i>
						Intake Forms<span class="caret"></span></a>				
					<ul class="sub-nav">
						<li><a href="#"><i class="fa fa-plus-square"></i>Demographic Information</a></li>
						<li><a href="#"><i class="fa fa-plus-square"></i>CAL Client Mini-Intake</a></li>
						<li><a href="#"><i class="fa fa-plus-square"></i>Caminos CNA Client Intake</a></li>
						<li><a href="#"><i class="fa fa-plus-square"></i>Caminos 2.0 Application</a></li>
						<li><a href="#"><i class="fa fa-plus-square"></i>Caminos Finance Initial Application Intake</a></li>
					</ul>						
				</li>
				
				<li class="dropdown <?php if((strpos($url,'admin')!=false)) echo 'active opened';?>">
					<a href="javascript:;">
						<i class="fa fa-user"></i>
						Follow-up Forms<span class="caret"></span></a>				
					<ul class="sub-nav">
						<li><a href="#"><i class="fa fa-plus-square"></i>CAL Survey</a></li>
						<li><a href="#"><i class="fa fa-plus-square"></i>CNA Survey</a></li>
						<li><a href="#"><i class="fa fa-plus-square"></i>Finance</a></li>
					</ul>						
				</li>-->
				<li class="dropdown <?php if((strpos($url,'admin')!=false)) echo 'active opened';?>">
					<a href="javascript:;">
						<i class="fa fa-cogs"></i>
						Settings
						<span class="caret"></span>
					</a>				
					<ul class="sub-nav">
						<li><a href="page-settings.php"><i class="fa fa-user"></i>Pofile Settings</a></li>
						<? if($_SESSION['level'] == 0) { ?>
							<!--<li><a href="view_admin.php"><i class="fa fa-search"></i>View Admins</a></li>-->
							<li><a href="add_admin.php"><i class="fa fa-plus-square"></i>Add Admins</a></li>
						<? } ?>
					</ul>						
				</li>

				<li>				
					<a href="/Client/index.php">
						<i class="fa fa-arrow-circle-right"></i>
						Client Side
					</a>				
				</li>
				

			</ul>
					
		</nav> <!-- #sidebar -->


	</div> <!-- /#sidebar-wrapper -->
