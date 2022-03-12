<?php

include_once '../lib/Database.php';

include_once '../lib/Session.php';

Session::initSession();

class VerifyEmail{

	public $database;

	public function __construct(){
		$this->database= new Database();
	}

	public function verify_email($data){

		if (isset($data['token'])) {
	
			$token = $data['token'];

			$tokenQuery = "SELECT user_v_token, user_v_status FROM tbl_user WHERE user_v_token = '$token'";

			$tokenQuery= $this->database->select($tokenQuery);

			if ($tokenQuery==true) {
				
				$token = mysqli_fetch_assoc($tokenQuery);

				if ($token['user_v_status']==0) {
					
					$userVToken = $token['user_v_token'];
					$userVStatus = $token['user_v_status'];

					$updateTokenQuery = "UPDATE tbl_user SET user_v_status=1 WHERE user_v_token='$userVToken'";

					$updateTokenQuery= $this->database->update($updateTokenQuery);

					if ($updateTokenQuery) {
						
						$_SESSION['status'] = "Your Email Verified Successfully!!";

						header('location:login.php');

					}
					else{
						$_SESSION['status'] = "Verified Failed!!";

						header('location:login.php');
					}
				}
				else{

					$_SESSION['status'] = "This Email Already Verified Please Login Your Account";

					header('location:login.php');
				}
			}
			else{

				$_SESSION['status'] = "This User Does not Exit in Database Please Register and try again";

				header('location:login.php');
			}

		}
		else{
			
			$_SESSION['status'] = "Not Allowed To Verified this user email";

			header('location:login.php');

		}
	}
}


?>