<?php
include "dbconnect.php";
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$phone=$_POST['phone'];
	$qry=mysqli_query($con,"insert into `Table Name` (`name`,`email`,`password`,`phone`) values ('".$name."','".$email."','".$password."','".$phone."')");
	if($qry){
		echo "1";
	}else{
		echo "0";
	}
?>