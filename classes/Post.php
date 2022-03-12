<?php

$file_Path = realpath(dirname(__FILE__));

//include_once ($file_Path.'/../lib/Session.php');
include_once ($file_Path.'/../lib/Database.php');
include_once ($file_Path.'/../helpers/Format.php');


class Post{

	private $database;
	private $dataFormat;

	public function __construct(){

		$this->database= new Database();
		$this->dataFormat= new Format();
	}

	public function add_post($data, $file){

		$post_title= $this->dataFormat->data_validation($data['post_title']);
		$post_category= $this->dataFormat->data_validation($data['post_category']);
		$post_des_o1= $this->dataFormat->data_validation($data['post_des_o1']);
		$post_des_o2= $this->dataFormat->data_validation($data['post_des_o2']);
		$post_type= $this->dataFormat->data_validation($data['post_type']);
		$post_tag= $this->dataFormat->data_validation($data['post_tag']);

		$permited = array('jpg', 'jpeg', 'png', 'gif');

		$file_name1 = $file['img_01']['name'];
		$file_size1 = $file['img_01']['size'];
		$file_temp1 = $file['img_01']['tmp_name'];

		$div1 = explode('.',$file_name1);
		$file_ext1 = strtolower(end($div1));

		$unice_image1 = substr(md5(time()),0,10).'.'.$file_ext1;

		$upload_image1 = 'uploads/'.$unice_image1;

		// image two

		$file_name2 = $file['img_02']['name'];
		$file_size2 = $file['img_02']['size'];
		$file_temp2 = $file['img_02']['tmp_name'];

		$div2 = explode('.',$file_name2);
		$file_ext2 = strtolower(end($div2));

		$unice_image2 = substr(md5(rand().time()),0,10).'.'.$file_ext2;

		$upload_image2 = 'uploads/'.$unice_image2;

		if (empty($post_title) || empty($post_category) || empty($post_des_o1) || empty($post_des_o2) || empty($post_type) || empty($post_tag)) {
			
			$errorMassage = "Input Field Must Not Be Empty!!";

			return $errorMassage;

		}
		elseif($file_size1>1048567 ){
			$errorMassage = "Input Image 01 File  Must  Be Less Than 1MB!!";
			return $errorMassage;
		}
		elseif($file_size2>1048567 ){
			$errorMassage = "Input Image 02 File  Must  Be Less Than 1MB!!";
			return $errorMassage;
		}
		elseif(in_array($file_ext1, $permited) == false){
			$errorMassage = "You Can Upload Only jpg, jpeg, png or gif File!!";
			return $errorMassage;
		}
		elseif(in_array($file_ext1, $permited) == false){
			$errorMassage = "You Can Upload Only jpg, jpeg, png or gif File!!";
			return $errorMassage;
		}
		else{

			$userId = Session::getSession('userId');
			
			move_uploaded_file($file_temp1, $upload_image1);

			move_uploaded_file($file_temp2, $upload_image2);

			$insertPostQuery = "INSERT INTO tbl_post(user_id, post_title, cat_id, image_one, image_two, des_one, des_two, post_type, post_tag) VALUES ($userId, '$post_title', $post_category, '$unice_image1', '$unice_image2', '$post_des_o1', '$post_des_o2', $post_type, '$post_tag')";

			$result = $this->database->insert($insertPostQuery);

			if ($result) {
				$message ="New Post Added Succesfully";
				return $message;
			}
			else{
				$errorMassage ="Something Wrong!! New Post Not Added Succesfully";
				return $errorMassage;
			}
		}

	}

	public function all_post($id){
		$selectPost = "SELECT tbl_post.*, category.cat_name FROM tbl_post INNER JOIN category ON tbl_post.cat_id = category.cat_id WHERE user_id=$id";

		$allPost= $this->database->select($selectPost);

		if ($allPost>'0') {
			return $allPost;
		}
	}


	public function model_data(){

		$selectPost = "SELECT tbl_post.*, category.cat_name FROM tbl_post INNER JOIN category ON tbl_post.cat_id = category.cat_id";

		$allPost= $this->database->select($selectPost);

		if ($allPost>'0') {
			return $allPost;
		}
	}

	public function deactive_post($postId){

		$updateStatusQuery = "UPDATE tbl_post SET post_status=0 WHERE post_id=$postId";

		$updatePost= $this->database->update($updateStatusQuery);

		if ($updatePost) {
			$message ="Post Deactivated Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}


	public function active_post($postId){


		$updateStatusQuery = "UPDATE tbl_post SET post_status=1 WHERE post_id=$postId";

		$updatePost= $this->database->update($updateStatusQuery);

		if ($updatePost) {
			$message ="Post Ativated Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}

	public function get_single_post_data($postId){

		$selectPost = "SELECT tbl_post.*, category.* FROM tbl_post INNER JOIN category ON tbl_post.cat_id = category.cat_id WHERE post_id=$postId";

		$getPost= $this->database->select($selectPost);

		if ($getPost>'0') {
			return $getPost;
		}
	}

	public function edit_post($data, $file, $postId){

		$post_title= $this->dataFormat->data_validation($data['post_title']);
		$post_category= $this->dataFormat->data_validation($data['post_category']);
		$post_des_o1= $this->dataFormat->data_validation($data['post_des_o1']);
		$post_des_o2= $this->dataFormat->data_validation($data['post_des_o2']);
		$post_type= $this->dataFormat->data_validation($data['post_type']);
		$post_tag= $this->dataFormat->data_validation($data['post_tag']);

		$permited = array('jpg', 'jpeg', 'png', 'gif');

		if ($file['img_01']['name']!=null) {
			
			$selectPost = "SELECT tbl_post.*, category.cat_name FROM tbl_post INNER JOIN category ON tbl_post.cat_id = category.cat_id WHERE post_id=$postId";

			$selectPost= $this->database->select($selectPost);

			$selectPost = mysqli_fetch_assoc($selectPost);
					
			$imageOne = $selectPost['image_one'];

			if ($imageOne!=null) {
				
				$path = "uploads/".$imageOne;
				unlink($path);
			}
			

			$file_name1 = $file['img_01']['name'];
			$file_size1 = $file['img_01']['size'];
			$file_temp1 = $file['img_01']['tmp_name'];

			$div1 = explode('.',$file_name1);
			$file_ext1 = strtolower(end($div1));

			$unice_image1 = substr(md5(time()),0,10).'.'.$file_ext1;

			$upload_image1 = 'uploads/'.$unice_image1;
		}


		if ($file['img_02']['name']!=null) {
			
			$selectPost = "SELECT tbl_post.*, category.cat_name FROM tbl_post INNER JOIN category ON tbl_post.cat_id = category.cat_id WHERE post_id=$postId";

			$selectPost= $this->database->select($selectPost);

			$selectPost = mysqli_fetch_assoc($selectPost);
					
			$imageTwo = $selectPost['image_two'];

			$path = "uploads/".$imageTwo;

			unlink($path);

			$file_name2 = $file['img_02']['name'];
			$file_size2 = $file['img_02']['size'];
			$file_temp2 = $file['img_02']['tmp_name'];

			$div2 = explode('.',$file_name2);
			$file_ext2 = strtolower(end($div2));

			$unice_image2 = substr(md5(rand().time()),0,10).'.'.$file_ext2;

			$upload_image2 = 'uploads/'.$unice_image2;
		}
		

		if (empty($post_title) || empty($post_category) || empty($post_des_o1) || empty($post_des_o2) || empty($post_type) || empty($post_tag)) {
			
			$errorMassage = "Input Field Must Not Be Empty!!";

			return $errorMassage;

		}
		elseif(isset($unice_image1) && !isset($unice_image2)){
			if ($file_size1>1048567) {
				$errorMassage = "Input Image 01 File  Must  Be Less Than 1MB!!";
				return $errorMassage;
			}
			elseif(in_array($file_ext1, $permited) == false){
				$errorMassage = "You Can Upload Only jpg, jpeg, png or gif File!!";
				return $errorMassage;
			}
			else{
				move_uploaded_file($file_temp1, $upload_image1);

				$updateStatusQuery = "UPDATE tbl_post SET post_title='$post_title', cat_id=$post_category, image_one='$unice_image1', des_one='$post_des_o1', des_two='$post_des_o2', post_type=$post_type, post_tag='$post_tag' WHERE post_id=$postId";
			}
		}
		elseif(!isset($unice_image1) && isset($unice_image2)){
			
			if ($file_size2>1048567) {
				$errorMassage = "Input Image 02 File  Must  Be Less Than 1MB!!";
				return $errorMassage;
			}
			elseif(in_array($file_ext2, $permited) == false){
				$errorMassage = "You Can Upload Only jpg, jpeg, png or gif File!!";
				return $errorMassage;
			}
			else{
				move_uploaded_file($file_temp2, $upload_image2);

				$updateStatusQuery = "UPDATE tbl_post SET post_title='$post_title', cat_id=$post_category, image_two='$unice_image2', des_one='$post_des_o1', des_two='$post_des_o2', post_type=$post_type, post_tag='$post_tag' WHERE post_id=$postId";
			}
		}
		elseif(isset($unice_image1) && isset($unice_image2)){
			if($file_size1>1048567 ){
				$errorMassage = "Input Image 01 File  Must  Be Less Than 1MB!!";
				return $errorMassage;
			}
			elseif($file_size2>1048567 ){
				$errorMassage = "Input Image 02 File  Must  Be Less Than 1MB!!";
				return $errorMassage;
			}
			elseif(in_array($file_ext1, $permited) == false){
				$errorMassage = "You Can Upload Only jpg, jpeg, png or gif File!!";
				return $errorMassage;
			}
			elseif(in_array($file_ext1, $permited) == false){
				$errorMassage = "You Can Upload Only jpg, jpeg, png or gif File!!";
				return $errorMassage;
			}
			else{
				move_uploaded_file($file_temp1, $upload_image1);
				move_uploaded_file($file_temp2, $upload_image2);

				$updateStatusQuery = "UPDATE tbl_post SET post_title='$post_title', cat_id=$post_category, image_one='$unice_image1', image_two='$unice_image2', des_one='$post_des_o1', des_two='$post_des_o2', post_type=$post_type, post_tag='$post_tag' WHERE post_id=$postId";
			}
		}
		
		else{

			$updateStatusQuery = "UPDATE tbl_post SET post_title='$post_title', cat_id=$post_category, des_one='$post_des_o1', des_two='$post_des_o2', post_type=$post_type, post_tag='$post_tag' WHERE post_id=$postId";
		}

		$result = $this->database->update($updateStatusQuery);

		if ($result) {
			$message ="Post Edit Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!! New Post Not Added Succesfully";
			return $errorMassage;
		}
		

	}

	// delete post data

	public function delete_post($postId){

		$postQuery = "SELECT * FROM tbl_post WHERE post_id=$postId";

		$postQuery= $this->database->select($postQuery);

		if($postQuery>'0'){

			$postImage = mysqli_fetch_assoc($postQuery);

			$postImage01= $postImage['image_one'];

			$postImage02= $postImage['image_two'];

			$Path1 = 'uploads/'.$postImage01;

			$Path2 = 'uploads/'.$postImage02;

			unlink($Path1);

			unlink($Path2);

			$deletePost = "DELETE FROM tbl_post WHERE post_id=$postId";

			$deletePost= $this->database->delete($deletePost);

			if ($deletePost) {
				$successMesage = "Post Deeleted Succesfully";
				return $successMesage;
			}
			else{
				$errorMesage = "Something Went Wrong!!";
				return $errorMesage;
			}

		}
		else{
			$errorMesage = "Not Post Found in Database To Delete";
			return $errorMesage;
		}
	}
	// latest post

	public function all_latest_post($ofset, $limit){
		$selectPost = "SELECT tbl_post.*, category.cat_name FROM tbl_post INNER JOIN category ON tbl_post.cat_id = category.cat_id WHERE post_status=1 ORDER BY tbl_post.post_id DESC LIMIT $ofset, $limit";

		$allPost= $this->database->select($selectPost);

		if ($allPost>'0') {
			return $allPost;
		}
	}

	// slider post

	public function slider_post(){

		$selectPost = "SELECT tbl_post.*, category.cat_name FROM tbl_post INNER JOIN category ON tbl_post.cat_id = category.cat_id WHERE post_status=1 AND post_type=2 ORDER BY tbl_post.post_id DESC LIMIT 6";

		$allPost= $this->database->select($selectPost);

		if ($allPost>'0') {
			return $allPost;
		}
	}

	// search post 
	public function search_post($data){
		$data = $data['value'];
		$selectPost = "SELECT tbl_post.*, category.cat_name FROM tbl_post INNER JOIN category ON tbl_post.cat_id = category.cat_id WHERE tbl_post.post_status=1 AND post_title LIKE '%$data%'  ORDER BY tbl_post.post_id DESC LIMIT 6";

		$allPost= $this->database->select($selectPost);

		if ($allPost>'0') {
			return $allPost;
		}
	}

	// count total post

	public function number_if_post(){
		$selectPost = "SELECT * FROM tbl_post WHERE post_status=1";

		$allPost= $this->database->select($selectPost);

		if ($allPost>'0') {
			return $allPost;
		}
	}

	// get related post

	public function get_related_post_data($postId, $catId){

		$selectPost = "SELECT tbl_post.*, category.cat_name FROM tbl_post INNER JOIN category ON tbl_post.cat_id = category.cat_id WHERE tbl_post.post_status=1 AND tbl_post.cat_id=$catId AND  tbl_post.post_id!=$postId LIMIT 3";

		$allPost= $this->database->select($selectPost);

		if ($allPost>'0') {
			return $allPost;
		}
	}
	// category post
	public function get_category_post($catId,$ofset, $limit){

		$selectPost = "SELECT tbl_post.*, category.cat_name FROM tbl_post INNER JOIN category ON tbl_post.cat_id = category.cat_id WHERE tbl_post.post_status=1 AND tbl_post.cat_id=$catId LIMIT $ofset, $limit";

		$allPost= $this->database->select($selectPost);

		if ($allPost>'0') {
			return $allPost;
		}
	}
}