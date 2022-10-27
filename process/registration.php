<?php
include'../admin/config/connect.php';

if (isset($_POST['registration'])) {

	$name=trim($_POST['name']);
	$name=strip_tags($_POST['name']);
	$name=htmlspecialchars($_POST['name']);

	$lastname=trim($_POST['lastname']);
	$lastname=strip_tags($_POST['lastname']);
	$lastname=htmlspecialchars($_POST['lastname']);

	$email=trim($_POST['email']);
	$email=strip_tags($_POST['email']);
	$email=htmlspecialchars($_POST['email']);

	$password=trim(md5($_POST['password']));
	$password=strip_tags(md5($_POST['password']));
	$password=htmlspecialchars(md5($_POST['password']));

	$rpassword=trim(md5($_POST['rpassword']));
	$rpassword=strip_tags(md5($_POST['rpassword']));
	$rpassword=htmlspecialchars(md5($_POST['rpassword']));

	if ($password!=$rpassword) {
		
		header("Location:../registration?res=1");
	}

	if (strlen($_POST['password'])<6) {
		
		header("Location:../registration?res=2");

	}

	$userquery=$db->prepare("select * from users where user_mail=:email");
	$userquery->execute(array('email' => $email));
	$count=$userquery->rowCount();

	if ($count!=0) {

		header("Location:../registration?res=3");
	}	
	else{

		$insert=$db->prepare("INSERT INTO users SET 
			user_name=:name,
			user_lastname=:lastname,
			user_mail=:email,
			user_password=:password,
			user_authorization=:authorization");

		$save=$insert-> execute(array(
			'name'=> $name,
			'lastname'=> $lastname,
			'email' => $email,
			'password' => $password,
			'authorization' => 0));

		if (!$save) {

			header("location:../index?res=no");
		}
		else {

			header("location:../index?res=ok");
		}
	}

}

?>