<?php

include_once '../lib/Session.php';
Session::initSession();

include_once '../lib/Database.php';
include_once '../helpers/Format.php';

include_once '../classes/Register.php';

class Adminlogin{

	private $database;
	private $dataFormat;

	public function __construct(){

		$this->database= new Database();
		$this->dataFormat= new Format();
	}

	function login_user($email, $password){

		$email = $this->dataFormat->data_validation($email);
		$password = $this->dataFormat->data_validation($password);

		if (empty($email) || empty($password)) {
			$errorMassage = "User Email and Password Must Not Be Empty";
      		return $errorMassage;
		}
		else{

			$userQuery = "SELECT * FROM tbl_user WHERE user_email= '$email' AND user_pass= '$password'";

			$userQuery= $this->database->select($userQuery);

			if ($userQuery) {
				
				$userRow = mysqli_fetch_assoc($userQuery);

				$userName = $userRow['user_name'];

				$userStatus = $userRow['user_v_status'];

				$email = $userRow['user_email'];

				$image = $userRow['image'];

				$userId = $userRow['user_id'];

				if ($userStatus==1) {
					
					Session::setSession('login', true);

					Session::setSession('userName', $userName);

					Session::setSession('userStatus', $userStatus);

					Session::setSession('email', $email);

					Session::setSession('image', $image);

					Session::setSession('userId', $userId);

					header('location:index.php');
				}
				else{

					$name = $userRow['user_name'];
					$email = $userRow['user_email'];
					$userVToken = $userRow['user_v_token'];

					$verifyUser = new Register();

					$verifyUser->send_user_verify_email($name, $email, $userVToken);

					$errorMassage = "This Email Not Verified Please verify this email and try again. To Verify Your Email Please Check your Email Box";
      				return $errorMassage;
				}
			}
			else{
				$errorMassage = "Wrong User Email Or Password. Please Try With Write User name Name Password.";
      			return $errorMassage;
			}


		}

	}
}