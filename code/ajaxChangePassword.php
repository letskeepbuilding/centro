<?php
session_start();
	include("../config.php");

	$password	=	$_POST_POST['password'];
	$cpassword	=	$_POST['cpassword'];
	
	// SELECT MATCH FROM THE DATABASE
	if($password != $cpassword )
      {        
        $output['error']  = 'error';
        $output['msg'] = "Password and confirm password do not match";

      }else if(strlen($password)<6)
      {        
        $output['error']  = 'error';
        $output['msg'] = "Password must be greater than 6 character";

      }else{
        $query  = "UPDATE `users` SET password = ? where username='{$_SESSION['username']}'";
        $parameters = array($password);
        $statement  = $db->prepare($query);
        $statement->execute($parameters);
        $output['error']  = 'success';
        $output['msg'] = "Password Changed successfully";

      }
	echo json_encode($output); 	
?>