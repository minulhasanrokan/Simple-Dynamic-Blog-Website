<?php

$file_Path = realpath(dirname(__FILE__));
//include_once ($file_Path.'/../lib/Session.php');
//Session::initSession();

include_once ($file_Path.'/../lib/Database.php');
include_once ($file_Path.'/../helpers/Format.php');

class Comment{

	private $database;
	private $dataFormat;

	public function __construct(){

		$this->database= new Database();
		$this->dataFormat= new Format();
	}

	// add new comment
	public function add_comment($data,$postId){

		$name= $this->dataFormat->data_validation($data['name']);
		$email= $this->dataFormat->data_validation($data['email']);
		$website= $this->dataFormat->data_validation($data['website']);
		$message= $this->dataFormat->data_validation($data['message']);

		if (empty($name) || empty($email) || empty($message)) {
			
			$errorMassage = "Input Filds Must Not Be Empty!!!";
      		return $errorMassage;
		}
		else{
			$insertCommentQuery = "INSERT INTO tbl_comment(post_id,name, email, website, comment) VALUES ($postId,'$name','$email', '$website', '$message')";

			$insertComment = $this->database->insert($insertCommentQuery);

			if ($insertComment) {
				$message ="New Comment Added Succesfully";
				return $message;
			}
			else{
				$errorMassage ="Something Wrong!! New Post Not Added Succesfully";
				return $errorMassage;
			}
		}
	}

	// get all coment by post 

	public function get_all_comment($postId){

		$commentQuery = "SELECT * FROM tbl_comment WHERE post_id=$postId AND status=1";

		$commentQuery= $this->database->select($commentQuery);

		if ($commentQuery) {
			return $commentQuery;
		}
	}

	// all comment 

	public function all_comment(){

		$userId = Session::getSession('userId');

		$commentQuery = "SELECT tbl_comment.*, tbl_post.post_title  FROM tbl_comment INNER JOIN tbl_post ON tbl_comment.post_id=tbl_post.post_id WHERE tbl_post.user_id=$userId";

		$commentQuery= $this->database->select($commentQuery);

		if ($commentQuery) {
			return $commentQuery;
		}
	}

	// de active comment
	public function deactive_comment($commentId){

		$updateStatusQuery = "UPDATE tbl_comment SET status=0 WHERE id =$commentId";

		$updatePost= $this->database->update($updateStatusQuery);

		if ($updatePost) {
			$message ="Comment Deactivated Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}

	// active comment
	public function active_comment($commentId){

		$updateStatusQuery = "UPDATE tbl_comment SET status=1 WHERE id =$commentId";

		$updatePost= $this->database->update($updateStatusQuery);

		if ($updatePost) {
			$message ="Comment Activated Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}

	// delete comment
	public function delete_comment($commentId){

		$updateStatusQuery = "DELETE FROM tbl_comment WHERE id =$commentId";

		$updatePost= $this->database->update($updateStatusQuery);

		if ($updatePost) {
			$message ="Comment Deleted Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}

	// replay comment

	public function replay_comment($data,$commentId){

		$commentReplay= $this->dataFormat->data_validation($data['comment_replay']);

		if (empty($commentReplay)) {
			$message ="Replay Filds Must Not Be Empty!!!";
			return $message;
		}
		else{
			$updateReplayQuery = "UPDATE tbl_comment SET admin_replay='$commentReplay' WHERE id =$commentId";

			$updateReplay= $this->database->update($updateReplayQuery);

			if ($updateReplay) {
			$message ="Replay Added Succesfully";
			return $message;
			}
			else{
				$errorMassage ="Something Wrong!!!";
				return $errorMassage;
			}
		}
	}
}