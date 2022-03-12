<?php

$file_Path = realpath(dirname(__FILE__));
//include_once ($file_Path.'/../lib/Session.php');
//Session::initSession();

include_once ($file_Path.'/../lib/Database.php');
include_once ($file_Path.'/../helpers/Format.php');

class Logo{

	private $database;
	private $dataFormat;

	public function __construct(){

		$this->database= new Database();
		$this->dataFormat= new Format();
	}

	// update logo data

	public function add_logo($data,$logo){

		$tagline= $this->dataFormat->data_validation($data['tagline']);
		$title= $this->dataFormat->data_validation($data['title']);

		$logo = $logo['logo'];
		$file = $logo;

		if ($file['name']!=null) {

			$logoQuery = "SELECT * FROM tbl_logo WHERE id=1";

			$logoQuery= $this->database->select($logoQuery);

			$uslogoImage = mysqli_fetch_assoc($logoQuery);

			$uslogoImage= $uslogoImage['logo'];

			$Path = 'uploads/'.$uslogoImage;

			unlink($Path);

			$allow = array('jpg', 'jpeg', 'png');
		   	$exntension = explode('.', $file['name']);
		   	$fileActExt = strtolower(end($exntension));
		   	$fileName = str_replace(' ', '_', $catName);
		   	$fileNew = $fileName."_".rand(10,999).".". $fileActExt;
		   	$filePath = 'uploads/'.$fileNew;
		   	if (in_array($fileActExt, $allow)) {
		   		 if ($file['size'] > 0 && $file['error'] == 0) {
		            if (move_uploaded_file($file['tmp_name'], $filePath)) {
		            	$updateLogoQuery = "UPDATE tbl_logo SET tagline='$tagline', title='$title', logo='$fileNew' WHERE id =1";
		            }
		        }
		   	}
		   	else{
		    	$errorMassage = "Not Supported Uploaded File!!!";
      			return $errorMassage;
		    }
		}
		else{
			$updateLogoQuery = "UPDATE tbl_logo SET tagline='$tagline', title='$title' WHERE id =1";
		}

		$updateLogo= $this->database->update($updateLogoQuery);

		if ($updateLogo) {
			
			$message ="Logo data updated Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}

	// get logo data

	public function logo_data(){

		$logoQuery = "SELECT * FROM tbl_logo WHERE id=1";

		$logoQuery= $this->database->select($logoQuery);

		if ($logoQuery) {
			
			return $logoQuery;
		}
	}
}