<?php
session_start();

include_once '../classes/VerifyEmail.php';

if (isset($_GET['token'])) {
	
	$verifyEmail = new VerifyEmail();

	$verifyEmail->verify_email($_GET);

}
else{
	$_SESSION['status'] = "Not Allowed To Verified this user email";

	header('location:login.php');

}

?>