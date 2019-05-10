<?php
session_start();
session_destroy();
	header('location:/Client/index.php');
?>