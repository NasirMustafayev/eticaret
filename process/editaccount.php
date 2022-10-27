<?php
include'../admin/config/connect.php';
ob_start();
session_start();

$userquery=$db->prepare("select * from users where user_mail=:usermail");
$userquery->execute(array('usermail' => $_SESSION['otheruser_mail']));
$showuser=$userquery->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['editaccountinformation'])) {

	$name=trim($_POST['name']);
	$name=strip_tags($_POST['name']);
	$name=htmlspecialchars($_POST['name']);

	$lastname=trim($_POST['lastname']);
	$lastname=strip_tags($_POST['lastname']);
	$lastname=htmlspecialchars($_POST['lastname']);

	$email=trim($_POST['email']);
	$email=strip_tags($_POST['email']);
	$email=htmlspecialchars($_POST['email']);

	$address=trim($_POST['address']);
	$address=strip_tags($_POST['address']);
	$address=htmlspecialchars($_POST['address']);

	$gsm=trim($_POST['gsm']);
	$gsm=strip_tags($_POST['gsm']);
	$gsm=htmlspecialchars($_POST['gsm']);

	$update=$db->prepare("UPDATE users SET 
		user_name=:name,
		user_lastname=:lastname,
		user_mail=:email,
		user_address=:address,
		user_gsm=:gsm where user_id=:id");

	$save=$update-> execute(array(
		'name'=> $name,
		'lastname'=> $lastname,
		'email' => $email,
		'address' => $address,
		'gsm' => $gsm,
		'id' => $showuser['user_id']));

	if (!$save) {

		header("location:../account?res=no");
	}
	else {
		$_SESSION['otheruser_mail']=$email;
		header("location:../account?res=ok");
	}

}

//Hesab şifrəsi dəyişdirmə

if ($_GET['p']==2) {
	if (isset($_POST['editaccountpassword'])) {

		$lastpassword=trim(md5($_POST['lastpassword']));
		$lastpassword=strip_tags(md5($_POST['lastpassword']));
		$lastpassword=htmlspecialchars(md5($_POST['lastpassword']));

		$password=trim(md5($_POST['password']));
		$password=strip_tags(md5($_POST['password']));
		$password=htmlspecialchars(md5($_POST['password']));

		$rpassword=trim(md5($_POST['rpassword']));
		$rpassword=strip_tags(md5($_POST['rpassword']));
		$rpassword=htmlspecialchars(md5($_POST['rpassword']));

		if ($lastpassword!=$showuser['user_password']) {

			header("Location:../account?res=3");
			exit;
		}

		if ($password!=$rpassword) {

			header("Location:../account?res=1");
			exit;
		}

		if (strlen($_POST['password'])<6) {

			header("Location:../account?res=2");
			exit;
		}

		else{

			$updatepass=$db->prepare("UPDATE users SET 
				user_password=:password
				where user_id=:id");

			$savepass=$updatepass-> execute(array(
				'password'=> $password,
				'id' => $showuser['user_id']));

			if (!$savepass) {

				header("location:../account?res=no");
			}
			else {
				header("location:../account?res=ok");
			}

		}
	}
}
?>