<?php

$file_Path = realpath(dirname(__FILE__));
//include_once ($file_Path.'/../lib/Session.php');
//Session::initSession();

include_once ($file_Path.'/../lib/Database.php');
include_once ($file_Path.'/../helpers/Format.php');

class Contact{

	private $database;
	private $dataFormat;

	public function __construct(){

		$this->database= new Database();
		$this->dataFormat= new Format();
	}

	// add new contact

	public function add_contact($data){

		$name = $data['name'];
		$phone = $data['phone'];
		$email = $data['email'];
		$message = $data['message'];

		if (empty($name) || empty($phone) || empty($email) || empty($message)) {
			
			$errorMassage = "Input Field Must Not Be Empty";
      		return $errorMassage;
		}
		else{
			$insertContactQuery = "INSERT INTO tbl_contact(name, phone, email, message) VALUES ('$name','$phone', '$email', '$message')";

			$insertContact = $this->database->insert($insertContactQuery);

			if ($insertContact) {
				$message ="New Message Added Succesfully";
				return $message;
			}
			else{
				$errorMassage ="Something Wrong!! New Post Not Added Succesfully";
				return $errorMassage;
			}
		}
	}

	// get all contact
	public function all_contact(){
		$contactQuery = "SELECT * FROM tbl_contact";

		$contactQuery= $this->database->select($contactQuery);

		if ($contactQuery) {
			return $contactQuery;
		}
	}

	// read contact

	public function read_contact($contactId){
		
		$updateStatusQuery = "UPDATE tbl_contact SET status=1 WHERE id=$contactId";

		$updatePost= $this->database->update($updateStatusQuery);

		if ($updatePost) {
			$message ="Contact Read Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!! New Post Not Added Succesfully";
			return $errorMassage;
		}
	}

	// unread contact

	public function un_read_contact($contactId){
		
		$updateStatusQuery = "UPDATE tbl_contact SET status=0 WHERE id=$contactId";

		$updatePost= $this->database->update($updateStatusQuery);

		if ($updatePost) {
			$message ="Contact Un Read Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!! New Post Not Added Succesfully";
			return $errorMassage;
		}
	}

	// delete contact

	public function delete_contact($contactId){
		
		$updateStatusQuery = "DELETE FROM tbl_contact WHERE id=$contactId";

		$updatePost= $this->database->delete($updateStatusQuery);

		if ($updatePost) {
			$message ="Contact DEleted Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!! New Post Not Added Succesfully";
			return $errorMassage;
		}
	}

}