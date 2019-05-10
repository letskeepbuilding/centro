<?php
session_start();
sleep(5);
if(isset($_POST['name'])) {
    $connect = new PDO("mysql:host=localhost;dbname=centroz1_flows", "centroz1_flows", "3l3ct1cData!");
    if ($_POST['newsletter'] == "Yes") {
		$newsletter = "Yes";
	} else {
		$newsletter = "";
	}
	if(isset($_REQUEST['ReasonVisit'])) {
		$chk = "";
		for($i = 0; $i < count($_REQUEST['ReasonVisit']); $i++){
			if($i == (count($_REQUEST['ReasonVisit']) - 1)){
				$chk .= $_REQUEST['ReasonVisit'][$i];
			} else {
				$chk .= $_REQUEST['ReasonVisit'][$i].",";
			}
		}
	}
    $data = array(
        ':name'  => $_POST['name'],
        ':middlename'  => $_POST['middlename'],
        ':lastname'   => $_POST['lastname'],
        ':address'   => $_POST['address'],
        ':apt'   => $_POST['apt'],
        ':city'  => $_POST['city'],
        ':zip'  => $_POST['zip'],
        ':email'   => $_POST['email'],
        ':phone_home'   => $_POST['phone_home'],
        ':phone_cell'   => $_POST['phone_cell'],
        ':ethnicity'   => $_POST['ethnicity'],
        ':DOB'   => $_POST['DOB'],
        ':homeowner'  => $_POST['homeowner'],
        ':registeredToVote'  => $_POST['registeredToVote'],
        ':Newsletter'   => $newsletter,
        ':ReasonVisit'   => $chk,
        ':ReasonVisitOther'   => $_POST['ReasonVisitOther']
    );
    $query = "
    INSERT INTO tbl_register 
    (name, middlename, lastname, address, apt, city, state, zip, email, phone_home, phone_cell, ethnicity, DOB, homeowner, registeredToVote, Newsletter, ReasonVisit, ReasonVisitOther) 
    VALUES (:name, :middlename, :lastname, :address, :apt, :city, :state, :zip, :email, :phone_home, :phone_cell, :ethnicity, :DOB, :homeowner, :registeredToVote, :Newsletter, :ReasonVisit, :ReasonVisitOther)
    ";
    $statement = $connect->prepare($query);
    if($statement->execute($data)) {
        echo 'User Added Successfully...';
    }
}
?>