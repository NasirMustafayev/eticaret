<?php 
include'../config/connect.php';
ob_start();
session_start();

if (isset($_POST['aboutyenile'])) {
	
	$update=$db->prepare("UPDATE about SET
		about_title=:title,
		about_content=:content,
		about_video=:video where about_id=:id");

	$save=$update-> execute(array(
		'title'=> $_POST['title'] ,
		'content'=> $_POST['content'] ,
		'video' => $_POST['video'],
		'id' => $_POST['id']));

	if (!$save) {
		
		header('location:../about-info.php?res=no');
	}
	else {

		$insertinlog=$db->prepare("INSERT INTO logs SET
			log_no=:no,
			process_name=:process_name,
			process_summary=:process_summary,
			process_author=:author");
		$insertinlog->execute(array(
			'no'=> 2,
			'process_name'=>"Haqqımızda səhifəsi yeniləməsi",
			'process_summary'=> $_POST['title'],
			'author'=>$_SESSION['user_mail']
		));
		header('location:../about-info.php?res=ok');
	}
}