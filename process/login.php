<?php
include'../admin/config/connect.php';
ob_start();
session_start();

if (isset($_POST['login'])) {

	$email=trim($_POST['email']);
	$email=strip_tags($_POST['email']);
	$email=htmlspecialchars($_POST['email']);

	$password=trim(md5($_POST['password']));
	$password=strip_tags(md5($_POST['password']));
	$password=htmlspecialchars(md5($_POST['password']));

	$controluser=$db->prepare("SELECT * FROM users WHERE user_mail=:email and user_password=:password and user_status=:status and user_authorization=:authorization");
	$controluser->execute(array(
		'email' => $email,
		'password' => $password,
		'status' => 1,
		'authorization' =>0));

	$count=$controluser->rowCount();

	if ($count==1) {
		$_SESSION['otheruser_mail']=$email;

		header("Location:../");
	}
	else{

		header("Location:../index?res=error");
	}

}
?>