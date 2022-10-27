<?php
require_once'../config/connect.php';
ob_start();
session_start();

if (isset($_POST['login'])) {

	if (empty($_POST['email'])) {
		header('Location:../login.php?res=ep');
	}
	else{
		$user_mail=htmlspecialchars(strip_tags(trim($_POST['email'])));

		$user_password=md5(htmlspecialchars(strip_tags(trim($_POST['password']))));

		$query=$db->prepare("SELECT * FROM users WHERE
			user_mail=:mail AND
			user_password=:password AND
			user_authorization>=:authorization");

		$query->execute(array(
			'mail' => $user_mail,
			'password' => $user_password,
			'authorization' => 0));
		$show=$query->fetch(PDO::FETCH_ASSOC);
		$count=$query -> rowCount();

		if ($count==1) {
			$insertinlog=$db->prepare("INSERT INTO logs SET
				process_name=:process_name,
				process_summary=:process_summary
				process_author=:author");
			$insertinlog->execute(array(
				'process_name'=>"Giriş edildi",
				'process_summary'=> $show['user_mail'],
				'author'=>$_SESSION['user_mail']
			));

			$_SESSION['user_mail']=$show['user_mail'];
			header('Location:../index.php');
			exit;
		}
		else{
			header('Location:../login.php?res=no');
			exit;
		}
	}
}
?>