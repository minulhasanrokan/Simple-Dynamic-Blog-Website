<?php

include_once '../lib/Session.php';
Session::initSession();

include_once '../lib/Database.php';
include_once '../helpers/Format.php';


class User{

	private $database;
	private $dataFormat;

	public function __construct(){

		$this->database= new Database();
		$this->dataFormat= new Format();
	}

	// get user info 

	public function get_user_info($userId){

		$userQuery = "SELECT * FROM tbl_user WHERE user_id=$userId";

		$userQuery= $this->database->select($userQuery);

		if ($userQuery>'0') {
			return $userQuery;
		}
	}

	// update user data

	public function update_user($userName,$userImg){

		$name = $this->dataFormat->data_validation($userName);

		$userId = Session::getSession('userId');

		$image = $userImg;

		if (empty($name)) {
			
			$errorMassage = "User Name Must Not Be Empty!!";

			return $errorMassage;
		}
		else{

			$permited = array('jpg', 'jpeg', 'png', 'gif');

			$file_name = $image['name'];
			$file_size = $image['size'];
			$file_temp = $image['tmp_name'];

			$div = explode('.',$file_name);
			$file_ext1 = strtolower(end($div));

			$unice_image = substr(md5(time()),0,10).'.'.$file_ext1;

			$upload_image = 'uploads/'.$unice_image;

			if (empty($file_name)) {
				$updateUserQuery = "UPDATE tbl_user SET user_name='$name' WHERE user_id =$userId";
			}
			else{
				
				$userImageQuery = "SELECT image FROM tbl_user WHERE user_id=$userId";

				$userImage= $this->database->select($userImageQuery);

				$userImage = mysqli_fetch_assoc($userImage);

				if ($userImage>'0') {

					$imagePath = 'uploads/'.$userImage['image'];

					unlink($imagePath);
					
					move_uploaded_file($file_temp, $upload_image);

					$updateUserQuery = "UPDATE tbl_user SET user_name='$name', image='$unice_image' WHERE user_id =$userId";
				}
				else{
					move_uploaded_file($file_temp, $upload_image);

					$updateUserQuery = "UPDATE tbl_user SET user_name='$name', image='$unice_image' WHERE user_id =$userId";
				}
			}

			$result = $this->database->update($updateUserQuery);

			if ($result) {
				$message ="Profile Updated Succesfully";
				return $message;
			}
			else{
				$errorMassage ="Something Wrong!! New Post Not Added Succesfully";
				return $errorMassage;
			}
		}

	}

}