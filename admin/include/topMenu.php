<nav id="top-bar" class="collapse top-bar-collapse">
		<ul class="nav navbar-nav pull-right">
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
					<i class="fa fa-user"></i>
		        	<?php echo $_SESSION['adminName']; ?>
		        	<span class="caret"></span>
		    	</a>

		    	<ul class="dropdown-menu" role="menu">
			        <li>
			        	<a href="page-settings.php">
			        		<i class="fa fa-user"></i> 
			        		&nbsp;&nbsp;Profile
			        	</a>
			        </li>
			        <li class="divider"></li>
			        <li>
			        	<a href="logout.php">
			        		<i class="fa fa-sign-out"></i> 
			        		&nbsp;&nbsp;Logout
			        	</a>
			        </li>
		    	</ul>
		    </li>
		</ul>

	</nav> <!-- /#top-bar -->
