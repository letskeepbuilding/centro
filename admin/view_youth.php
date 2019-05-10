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
        $userData = $db->prepare("SELECT * FROM youth");
        $userData->execute();
       
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

    <title>View Youth</title>
	<?php include "include/head.php" ?>
        <!--<link rel="stylesheet" type="text/css" href="../assets/plugins/datatables/dataTables.bootstrap.css"/>-->

</head>

<body>

<div id="wrapper">
	
	<?php include 'include/header.php'; ?>
	<?php include 'include/topMenu.php'; ?>
	<?php include 'include/sidebar.php'; ?>	

	<div id="content">				
		<div id="content-header">
			<h1>View Youth</h1>
		</div>
		 <!-- #content-header -->	
		<div id="content-container">
			<div class="row">
				<div class="col-md-12">
					<div class="portlet">
						<div class="portlet-header">
							<h3>
								<i class="fa fa-table"></i>
								View Youth
							</h3>
							<ul class="portlet-tools pull-right">
								<li>
									<div class="btn-group">
									  
									  <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
									   Export <span class="caret"></span>
									  </button>
									  <ul class="dropdown-menu" role="menu">
									    <li><a href="export_csv.php">Download CSV</a></li>
									    
									  </ul>
									</div>
								</li>
							</ul>
						</div> <!-- /.portlet-header -->
						<div class="portlet-content">						
							<div id="load"><?php echo $msg; ?></div>	
							<div class="table-responsive">
							<table
								class="table table-striped table-bordered table-hover table-highlight table-checkable"

                                id="userTable">
									<thead>
										<tr>
											<th>id</th>
											<th>First Name</th>
											<th>Last Name</th>
											<th>Address</th>
											<th>Time</th>
											<th>Status</th>
											<th >Actions</th>
										</tr>
									</thead>
								</table>
							</div> 
						  <!-- /.table-responsive -->
						</div> 
					   <!-- /.portlet-content -->
					</div> 
				  <!-- /.portlet -->
				</div>
			  <!-- /.col -->
			</div>
		  <!-- /.row -->
		</div> 
	  <!-- /#content-container -->			
	</div> 
   <!-- #content -->	
</div> 
<!-- #wrapper -->
	<!--Begin  Modal -->
		<div id="deleteModal" class="modal modal-styled fade" >
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h3 class="modal-title">Delete Confirmation</h3>
		      </div>
		      <div class="modal-body">
		       	Are you sure ! You want to delete this User??
		      </div>
		      <div class="modal-footer">
		        <button type="button" id="close" class="btn btn-tertiary" data-dismiss="modal">Close</button>
		        <button type="button" id="delete" class="btn btn-primary">Delete</button>
		      </div>
		    </div>
		    <!-- /.modal-content -->
		  </div>
		  <!-- /.modal-dialog -->
		</div>
	<!--End modal -->
	
<?php include "include/footer.php" ?>
<?php include "include/footerjs.php" ?>
<!--<script type="text/javascript" src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>-->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/DT_bootstrap.js"></script>

<script>

   var table=     $('#userTable').dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sServerMethod": "GET",
            "aaSorting": [[ 0, "desc" ]],
            "sAjaxSource": "code/ajaxYouthView.php",
            "aoColumns": [
                { "bVisible": true, "bSearchable": true, "bSortable": true },
                { "bVisible": true, "bSearchable": true, "bSortable": true },
                { "bVisible": true, "bSearchable": true, "bSortable": true },
                { "bVisible": true, "bSearchable": true, "bSortable": true },
                { "bVisible": true, "bSearchable": true, "bSortable": true },
                { "bVisible": true, "bSearchable": true, "bSortable": true },
                { "bVisible": true, "bSearchable": false, "bSortable": false }
            ],
            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                var row = $(nRow);
                row.attr("id", 'user_'+aData['6']);
                var userID = aData['6'];

                

                var status =  aData['6'];
                var statusEnable = '<span class="label label-success">Active</span>';
                var statusDisable = '<span class="label label-danger”>Inactive</span>';
                if(status == 'enable'){
                    $(row.find("td")['5']).html(statusEnable);
                }else{
                    $(row.find("td")['5']).html(statusDisable);
                }

                $(row.find("td")['6']).html(
                    '<a type="button" href="edit_user.php?id='+userID+'" class="btn btn-info btn-xs">	<i class="fa fa-edit"></i></a>&nbsp;<a href="javascript:;" onclick="del(\''+aData['7']+'\',\''+aData['1']+'\')" class="btn btn-primary btn-xs">	<i class="fa fa-trash-o"></i></a>'
                );
            }

        } );

		function del(id,name)
		{

			$('#deleteModal').appendTo("body").modal('show');
			$("#delete").click(function()
			{
					 $.ajax({
		                type: "GET",
		                url: "code/delete_user.php",
		                data: {"id":id}
		                     
		            	}).done(function(response)
		           		 {		                  
		                 	 var output = jQuery.parseJSON(response);		                  
		               	 	  if(output.msg == "deleted")
		                 	 {		
		                 	 		$("html, body").animate({ scrollTop: 0 }, "slow");
		                  	   		$('#deleteModal').modal('hide');
			                     table._fnDraw();
		                 	  		$('#load').html("<p class='alert alert-success text-center'><strong>"+name +"</strong> Successfully Deleted</p>");
		                  	  }
		           		 });
				})

			}
</script>
</body>
</html>