<?php

//action.php

sleep(5);

if(isset($_POST['first_name']))
{
 $connect = new PDO("mysql:host=localhost;dbname=testing", "root", "");
 
 $data = array(
  ':first_name'  => $_POST['first_name'],
  ':last_name'  => $_POST['last_name'],
  ':email'   => $_POST['email'],
  ':password'   => $_POST['password'],
  ':website'   => $_POST['website']
 );
 
 $query = "
 INSERT INTO tbl_register 
 (first_name, last_name, email, password, website) 
 VALUES (:first_name, :last_name, :email, :password, :website)
 ";
 $statement = $connect->prepare($query);
 if($statement->execute($data))
 {
  echo 'Registration Completed Successfully...';
 }
}

?>