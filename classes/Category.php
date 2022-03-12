<?php

$file_Path = realpath(dirname(__FILE__));
//include_once ($file_Path.'/../lib/Session.php');
//Session::initSession();

include_once ($file_Path.'/../lib/Database.php');
include_once ($file_Path.'/../helpers/Format.php');

class Category{

	private $database;
	private $dataFormat;

	public function __construct(){

		$this->database= new Database();
		$this->dataFormat= new Format();
	}

	public function add_category($catName,$catDes,$catImg){

		if (isset($catName) && isset($catDes) && isset($catImg)) {

			$catName= $this->dataFormat->data_validation($catName);
			$catDes= $this->dataFormat->data_validation($catDes);
			$file = $catImg;

			$categoryQuery = "SELECT * FROM category WHERE cat_name= '$catName'";

			$categoryQuery= $this->database->select($categoryQuery);

			if($categoryQuery<='0'){
			
			$allow = array('jpg', 'jpeg', 'png');
		   	$exntension = explode('.', $file['name']);
		   	$fileActExt = strtolower(end($exntension));
		   	$fileName = str_replace(' ', '_', $catName);
		   	$fileNew = $fileName."_".rand(10,999).".".$fileActExt;
		   	$filePath = 'uploads/'.$fileNew;


		   	if (in_array($fileActExt, $allow)) {
    		          if ($file['size'] > 0 && $file['error'] == 0) {
		            if (move_uploaded_file($file['tmp_name'], $filePath)) {

		            	$addcategoryQuery = "INSERT INTO category (cat_name,cat_des,cat_img) VALUES('$catName','$catDes','$fileNew')";


		            	$addcategoryQuery= $this->database->insert($addcategoryQuery);

						if ($addcategoryQuery) {
							$successMesage = "New category Added Succesfully";
							return $successMesage;
						}
						else{
							$errorMesage = "New category Not Added Succesfully";
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
				$errorMassage = "This Category Alreday Exsit in Database!!!";
      			return $errorMassage;
			}
		}
		else{
			$errorMassage = "Input Field Must Not Be Empty";
      		return $errorMassage;
		}
	}

	// view all category 

	public function all_category(){
		$selectCategory = "SELECT * FROM category";

		$allCategory= $this->database->select($selectCategory);

		if ($allCategory>'0') {
			return $allCategory;
		}
	}

	// view all category 

	public function all_active_category(){
		$selectCategory = "SELECT * FROM category WHERE cat_status=1";

		$allCategory= $this->database->select($selectCategory);

		if ($allCategory>'0') {
			return $allCategory;
		}
	}

	// end view all category

	// get edit category data
	public function get_edit_category_data($id){

		$selectCategory = "SELECT * FROM category WHERE cat_id='$id'";

		$Category= $this->database->select($selectCategory);
		
		if ($Category>'0') {
			
			return $Category;
			
		}
		else{
			return false;
		}
	}

	// update category 

	public function update_category($catName,$catDes,$catImg,$catId){

		$catName= $this->dataFormat->data_validation($catName);
		$catDes= $this->dataFormat->data_validation($catDes);
		$file = $catImg;
		$catId = $catId;

		if ($file['name']!=null) {

				$categoryQuery = "SELECT * FROM category WHERE cat_id=$catId";

				$categoryQuery= $this->database->select($categoryQuery);

				$uscategoryImage = mysqli_fetch_assoc($categoryQuery);

				$uscategoryImage= $uscategoryImage['cat_img'];

				$Path = 'uploads/'.$uscategoryImage;

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

			            	$updatecategoryQuery = "UPDATE category SET cat_name='$catName', cat_des='$catDes', cat_img='$fileNew' WHERE cat_id=$catId";


			            	$updatecategoryQuery= $this->database->update($updatecategoryQuery);

							if ($updatecategoryQuery) {
								$successMesage = "Category Updated Succesfully";
								return $successMesage;
							}
							else{
								$errorMesage = "Category Not Updated Succesfully";
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

			$updatecategoryQuery = "UPDATE category SET cat_name='$catName', cat_des='$catDes' WHERE cat_id=$catId";

        	$updatecategoryQuery= $this->database->update($updatecategoryQuery);

        	if ($updatecategoryQuery) {
				$successMesage = "Category Updated Succesfully";
				return $successMesage;
			}
			else{
				$errorMesage = "Category Not Updated Succesfully";
				return $errorMesage;
			}
		}

	}

	// delete category

	public function delete_category($catId){

		$categoryQuery = "SELECT * FROM category WHERE cat_id=$catId";

		$categoryQuery= $this->database->select($categoryQuery);

		if($categoryQuery>'0'){

			$categoryImage = mysqli_fetch_assoc($categoryQuery);

			$categoryImage= $categoryImage['cat_img'];

			$Path = 'uploads/'.$categoryImage;

			unlink($Path);

			$deleteCategory = "DELETE FROM category WHERE cat_id=$catId";

			$deleteCategory= $this->database->delete($deleteCategory);

			if ($deleteCategory) {
				$successMesage = "Category Deeleted Succesfully";
				return $successMesage;
			}
			else{
				$errorMesage = "Something Went Wrong!!";
				return $errorMesage;
			}
		}
		else{
			
			$errorMesage = "Not Category Found in Database To Delete";
			return $errorMesage;
		}

	}

}