<?php
session_start();
	include("../../config.php");
	
	$username	=	$_POST['username'];
	$password	=	$_POST['password'];
	
	// SELECT MATCH FROM THE DATABASE
	$query	=	"SELECT * FROM `admin` where username=? and password=?";
	$parameters	=	array($username,$password);
	$statement	=	$db->prepare($query);
	$statement->execute($parameters);
	
	if($statement->rowCount() > 0) {			

			$data = $statement->fetch(PDO::FETCH_ASSOC);

			//check if the status of user is enabled or disabled		   	
			if($data['status']=='disable')
			{
				$output['error']	=	'error';
			    $output['msg']		=	'The user is currently disabled.Please contact Administrator';

			}else{

				//Enabled users
				$_SESSION['name']	    =	$data['name'];
				$_SESSION['username']	=	$data['username'];
				$_SESSION['level']	=	$data['level'];
				
				//Last login update
				$queryLastLogin	=	"UPDATE `admin` SET lastlogin_at = NOW() where username=?";			
				$statementLastLogin	=	$db->prepare($queryLastLogin);
				$statementLastLogin->execute(array($username));

				$output['error']	=	'success';
				$output['msg']		=	'Logged in Successfully';
			}	
	
	}else
	{
			$output['error']	=	'error';
			$output['msg']		=	'Wrong Login Details';
	}
	echo json_encode($output); 	
?>