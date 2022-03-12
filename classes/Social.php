<?php

$file_Path = realpath(dirname(__FILE__));
//include_once ($file_Path.'/../lib/Session.php');
//Session::initSession();

include_once ($file_Path.'/../lib/Database.php');
include_once ($file_Path.'/../helpers/Format.php');

class Social{

	private $database;
	private $dataFormat;

	public function __construct(){

		$this->database= new Database();
		$this->dataFormat= new Format();
	}

	// update socila data

	public function add_social_link($data){

		$twitter= $this->dataFormat->data_validation($data['twitter']);
		$facebook= $this->dataFormat->data_validation($data['facebook']);
		$instagram= $this->dataFormat->data_validation($data['instagram']);
		$youtube= $this->dataFormat->data_validation($data['youtube']);

		$updateSocialQuery = "UPDATE tbl_social SET twitter='stwitter', facebook='$facebook', instagram='$instagram', youtube='$youtube' WHERE id =1";

		$updateSocial= $this->database->update($updateSocialQuery);

		if ($updateSocial) {
			
			$message ="Social data updated Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}

	// get social data

	public function social_data(){

		$socialQuery = "SELECT * FROM tbl_social WHERE id=1";

		$socialQuery= $this->database->select($socialQuery);

		if ($socialQuery) {
			
			return $socialQuery;
		}
	}
}