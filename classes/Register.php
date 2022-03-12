<?php
//include_once '../lib/Session.php';
include_once '../lib/Database.php';

include_once '../helpers/Format.php';

include_once '../PHPmailer/PHPMailer.php';
include_once '../PHPmailer/SMTP.php';
include_once '../PHPmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Register{

	public $database;
	public $dataFormat;


	public function __construct(){

		$this->database= new Database();
		$this->dataFormat= new Format();
	}

	public function add_new_user($data){

		$name = $this->dataFormat->data_validation($data['name']);
		$phone = $this->dataFormat->data_validation($data['phone']);
		$email = $this->dataFormat->data_validation($data['email']);
		$password = md5($this->dataFormat->data_validation($data['password']));
		$rePassword = md5($this->dataFormat->data_validation($data['re_password']));

		$userVToken = md5(rand());

		if (empty($name) || empty($phone) || empty($email) || empty($password) || empty($rePassword)) {
			
			$errorMassage = "Input Fild Must Not Be Emplty";

			return $errorMassage;

			header('location:registration.php');
		}
		else{

			$userQuery = "SELECT * FROM tbl_user WHERE user_name = '$name' OR user_email = '$email'";

			$userQuery= $this->database->select($userQuery);


			if ($userQuery) {
				
				$errorMassage = "This is Email or Phone Number already exist in Database";

				return $errorMassage;

				header('location:registration.php');
			}
			else{

				if ($password==$rePassword) {
					
					$newUserInsertQuery = "INSERT INTO tbl_user(user_name, user_email, user_phone, user_pass, user_v_token) VALUES('$name', '$email', '$phone', '$password', '$userVToken')";

					$newUserInsertQuery= $this->database->insert($newUserInsertQuery);
					if ($newUserInsertQuery) {

						self::send_user_verify_email($name, $email, $userVToken);
						
						$successMassage = "Your Registration is Successful Please Check Your Email to Verify Your Acount";
						return $successMassage;
					}
					else{
						$errorMassage = "Registration Faild Please Try Again!!!";

						return $errorMassage;
					}
				}
				else{

					$errorMassage = "Retype Password Not Matched";

					return $errorMassage;
				}
			
			}
		}
	}

    // verify email address......
	public function send_user_verify_email($name, $email, $userVToken){

		try {
			$mail = new PHPMailer(true);
			$mail->isSMTP();           
			$mail->SMTPAuth   = true; 

	        //Enable SMTP authentication
	        $mail->Host       = 'smtp.gmail.com';  
		    $mail->Username   = 'minulhasanrokan@gmail.com';                     //SMTP username
		    $mail->Password   = '...G1999e@';                               //SMTP password
		    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
		    $mail->Port       = 587;                                    //

		    //Recipients
		    $mail->setFrom('minulhasanrokan@gmail.com', 'Admin');
		    $mail->addAddress('$email', '$name');     //Add a recipient

		    //Content
		    $mail->isHTML(true);                                  //Set email format to HTML
		    $mail->Subject = 'Here is the subject';
		    $emailTemplate = "<h2>
		    					You Have Successfully Registered with this Email: 
		    				  </h2>".$email."<p>Please Verify Your Email Account To Login your Account click the link blew:</p>
		    				  <a href='http://localhost/blog/admin/verify-email.php?token=".$userVToken."'>Click Here</a>
		    				  ";
		    $mail->Body    = $emailTemplate;

		    $mail->send();
		} catch (Exception $e) {
		    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}

	// resend email 

	public function resend_email($data){
		$email = $data;

		$userQuery = "SELECT * FROM tbl_user WHERE user_email = '$email'";

		$userQuery= $this->database->select($userQuery);

		if ($userQuery) {
				
				$userRow = mysqli_fetch_assoc($userQuery);

				$userStatus = $userRow['user_v_status'];

				$email = $userRow['user_email'];

				if ($userStatus==1) {
					
					header('location:login.php');
				}
				else{

					echo $name = $userRow['user_name'];
					echo $email = $userRow['user_email'];
					echo $userVToken = $userRow['user_v_token'];

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

	// resend password 

	public function reset_password($data){
		$email = $data;

		$vToken = md5(rand());

		$userQuery = "SELECT * FROM tbl_user WHERE user_email = '$email'";

		$userQuery= $this->database->select($userQuery);

		if ($userQuery>'0') {
				$userRow = mysqli_fetch_assoc($userQuery);
				$email = $userRow['user_email'];
				$name = $userRow['user_name'];

				$updateToken = "UPDATE tbl_user SET user_v_token = '$vToken' WHERE user_email='$email'";

				$updateQuery= $this->database->update($updateToken);

				if ($updateQuery) {

					self::send_reset_password_email($name, $email, $vToken);

				}
				else{
					$errorMassage = "Token Not Updated Something Went Wrong!!!";
      				return $errorMassage;
				}
				
			}
			else{
				$errorMassage = "Wrong User Email Or Password. Please Try With Write User name Name Password.";
      			return $errorMassage;
			}
	}

	 // Reset Password......
	public function send_reset_password_email($name, $email, $vToken){

		try {
			$mail = new PHPMailer(true);
			$mail->isSMTP();           
			$mail->SMTPAuth   = true; 

	        //Enable SMTP authentication
	        $mail->Host       = 'smtp.gmail.com';  
		    $mail->Username   = 'minulhasanrokan@gmail.com';                     //SMTP username
		    $mail->Password   = '...G1999e@';                               //SMTP password
		    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
		    $mail->Port       = 587;                                    //

		    //Recipients
		    $mail->setFrom('minulhasanrokan@gmail.com', 'Admin');
		    $mail->addAddress('$email', '$name');     //Add a recipient

		    //Content
		    $mail->isHTML(true);                                  //Set email format to HTML
		    $mail->Subject = 'Here is the subject';
		    $emailTemplate = "<h2>
		    					You Have Successfully Registered with this Email: 
		    				  </h2>".$email."<p>Please click here to reset your password:</p>
		    				  <a href='http://localhost/blog/admin/reset-password.php?token=".$vToken."'>Click Here</a>
		    				  ";
		    $mail->Body    = $emailTemplate;

		    $mail->send();
		} catch (Exception $e) {
		    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}

	// reset password

	public function reset_pass($pass1, $pass2, $token){

		$pass1 = md5($this->dataFormat->data_validation($pass1));
		$pass2 = md5($this->dataFormat->data_validation($pass2));
		$token = $this->dataFormat->data_validation($token);

		$userQuery = "SELECT * FROM tbl_user WHERE user_v_token = '$token'";

		$userQuery= $this->database->select($userQuery);

		if ($userQuery>'0') {

			if ($pass1==$pass2) {
				
				$updatePass = "UPDATE tbl_user SET user_pass='$pass1' WHERE user_v_token='$token'";

				$updatePass= $this->database->update($updatePass);

				if ($updatePass) {

					$newToken = md5(rand());

					$updateToken = "UPDATE tbl_user SET user_v_token = '$newToken' WHERE user_v_token='$user_v_token'";

					$updateQuery= $this->database->update($updateToken);

					if ($updateQuery) {
						$errorMassage = "Passwordchanged Successfully";
	      				return $errorMassage;
					}
					else{
						$errorMassage = "Something Went Wrong!!!";
	      				return $errorMassage;
					}
				}
				else{
					$errorMassage = "Something Went Wrong!!!";
	      			return $errorMassage;
				}
			}
			else{
				$errorMassage = "Password not Matched!!!";
	      		return $errorMassage;
			}
		}
		else{
			$errorMassage = "invalid Token!!!";
	      		return $errorMassage;
		}
	}
}
