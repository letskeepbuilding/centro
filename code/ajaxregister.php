<?php
session_start();
	include("../config.php");

	$username	=	trim($_POST['username']);
	$password	=	trim($_POST['password']);
	$cpassword	=	trim($_POST['cpassword']);
	$name	=	trim($_POST['name']);
	$email	=	trim($_POST['email']);
	
	//Server side validation

	//check if all fields are enter or not
	if($username == '' || $password == '' || $name =='' || $email =='')
	{
			$output['error']	=	'error';
			$output['msg']		=	'All fields are mandatory';			
	}

	//Check password and confirm password match or not
	else if($cpassword != $password)
	{
			$output['error']	=	'error';
			$output['msg']		=	'Password and confirm password do not Match';
			
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
			$output['error']	=	'error';			
			$output['msg']		=	'Enter correct Email ID';
			
	}
	// Insert the data into the database
	else{

			// SELECT MATCH FROM THE DATABASE
			$queryMatch	=	"SELECT * FROM `users` where username=?";			
			$statementMatch	=	$db->prepare($queryMatch);
			$statementMatch->execute(array($username));
	
			if($statementMatch->rowCount() > 0) {
				$output['error']	=	'error';
				$output['msg']		=	'Username Already exists.Try another username.';
			}else{	
				$query	=	"INSERT INTO `users` SET username=? , password =? , name = ? ,email=?,status=?";
				$parameters	=	array($username,$password,$name,$email,'disable');
				$statement	=	$db->prepare($query);

				$statement->execute($parameters);
				
				$output['error']	=	'success';
				$output['msg']		=	'Thank you for Registering.Please wait for the administrator to approve.';
			}
			
	}	
	echo json_encode($output); 	
?>