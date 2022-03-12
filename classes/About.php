<?php

$file_Path = realpath(dirname(__FILE__));
//include_once ($file_Path.'/../lib/Session.php');
//Session::initSession();

include_once ($file_Path.'/../lib/Database.php');
include_once ($file_Path.'/../helpers/Format.php');

class About{

	private $database;
	private $dataFormat;

	public function __construct(){

		$this->database= new Database();
		$this->dataFormat= new Format();
	}

	public function add_about($data,$file){

		$title = $data['title'];

		$details = $data['details'];

		$file = $file['image'];

	   	if (empty($title) || empty($details)) {
	   		$errorMassage = "Input Field Must Not Be Empty";
      		return $errorMassage;
	   	}
	   	else{
   			if ($file['name']!=null) {

				$aboutQuery = "SELECT * FROM tbl_about WHERE id=1";

				$aboutQuery= $this->database->select($aboutQuery);

				$aboutImage = mysqli_fetch_assoc($aboutQuery);

				$aboutImage= $aboutImage['image'];

				$Path = 'uploads/'.$aboutImage;

				unlink($Path);


				$allow = array('jpg', 'jpeg', 'png');
			   	$exntension = explode('.', $file['name']);
			   	$fileActExt = strtolower(end($exntension));
			   	$fileName = str_replace(' ', '_', $title);
			   	$fileNew = $fileName."_".rand(10,999).".". $fileActExt;
			   	$filePath = 'uploads/'.$fileNew;

			   	if (in_array($fileActExt, $allow)) {
	    		          if ($file['size'] > 0 && $file['error'] == 0) {
			            if (move_uploaded_file($file['tmp_name'], $filePath)) {

			            	$updateAboutQuery = "UPDATE tbl_about SET title='$title', details='$details', image='$fileNew' WHERE id=1";


			            	$updateAboutQuery= $this->database->update($updateAboutQuery);

							if ($updateAboutQuery) {
								$successMesage = "About Updated Succesfully";
								return $successMesage;
							}
							else{
								$errorMesage = "About Not Updated Succesfully";
								return $errorMesage;
							}
			            }
			        }
			    }
			    else{
			    	$errorMassage = "Not Supported Uploaded File!!!";
	      			return $errorMassage;
			    }
			}
			else{
				$updateAboutQuery = "UPDATE tbl_about SET title='$title', details='$details' WHERE id=1";


			     $updateAboutQuery= $this->database->update($updateAboutQuery);

			     if ($updateAboutQuery) {
					$successMesage = "About Updated Succesfully";
					return $successMesage;
				}
				else{
					$errorMesage = "About Not Updated Succesfully";
					return $errorMesage;
				}
			}
	   	}

	}

	public function about_data(){
		
		$aboutQuery = "SELECT * FROM tbl_about WHERE id=1";

		$aboutQuery= $this->database->select($aboutQuery);

		if ($aboutQuery) {
			return $aboutQuery;
		}
	}
}