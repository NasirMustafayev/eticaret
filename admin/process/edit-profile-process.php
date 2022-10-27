<?php 
include'../config/connect.php';
ob_start();
session_start();

$userquery=$db->prepare("select * from users where user_mail=:usermail");
$userquery->execute(array('usermail' => $_SESSION['user_mail']));
$showuser=$userquery->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['editprofilepicture'])) {

	if ($_FILES['picture']['size']>1048576) {

		header("Location:../parameters?p=conf&pres=largesize");
		exit;
	}
	$authorizedtype=array('jpg','jpeg','png','gif','bmp');

	$findtype=strtolower(substr( $_FILES['picture']["name"], strpos( $_FILES['picture']["name"],'.')+1));
	if (in_array($findtype, $authorizedtype)===false) {
		header("Location:../profile?res=invalidtype");
		exit;
	}
	$user_id=$_POST['id'];
	$uploads_dir="../images/profile";

	@$tmp_name= $_FILES['picture']["tmp_name"];
	@$name= $_FILES['picture']["name"];

	$benzersizsay1=rand(20000,32000);
	$benzersizsay2=rand(20000,32000);
	$benzersizsay3=rand(20000,32000);	
	$benzersizsay4=rand(20000,32000);

	$benzersizad=$benzersizsay1.$benzersizsay2.$benzersizsay3.$benzersizsay4;

	$profilepicture=substr($uploads_dir, 3)."/".$benzersizad.$name;	
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

	$update=$db->prepare("UPDATE users SET 
		user_picture=:picture
		where user_id=:id");

	$save=$update-> execute(array(
		'picture'=> $profilepicture,
		'id' => $_POST['user_id']));

	if (!$save) {
		
		header("location:../profile?res=no");
	}
	else {
		$lastpicture=$_POST['lastpicture'];
		unlink("../$lastpicture");

		header("location:../profile?res=ok");
	}
}

if (isset($_POST['editprofile'])) {
	
	$user_id=$_POST['id'];
	$update=$db->prepare("UPDATE users SET 
		user_name=:name,
		user_lastname=:lastname,
		user_address=:address,
		user_gsm=:tel
		where user_id=:id");

	$save=$update-> execute(array(
		'name'=> $_POST['name'] ,
		'lastname'=> $_POST['lastname'] ,
		'address' => $_POST['address'],
		'tel' => $_POST['tel'],
		'id' => $_POST['id']));

	if (!$save) {
		
		header("location:../profile?res=no");
	}
	else {

		header("location:../profile?res=ok");
	}
}
if (isset($_POST['editpassword'])) {

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

		header("Location:../profile?res=3");
		exit;
	}

	if ($password!=$rpassword) {

		header("Location:../profile?res=1");
		exit;
	}

	if (strlen($_POST['password'])<6) {

		header("Location:../profile?res=2");
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

			header("location:../profile?res=no");
		}
		else {
			header("location:../profile?res=ok");
		}

	}
}
?>