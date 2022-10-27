<?php 
include'../config/connect.php';

if (isset($_POST['mailyenile'])) {
	
	$update=$db->prepare("UPDATE parametr set parametr_smtphost=:host,parametr_smtpuser=:user,parametr_smtppass=:pass,parametr_smtpport=:port where parametr_id=:id");

	$save=$update-> execute(array('host'=> $_POST['host'] ,'user'=> $_POST['user'],'pass'=> $_POST['pass'] ,'port' => $_POST['port'],'id' => $_POST['id']));

	if (!$save) {
		
		header('location:../parameters?p=mail&mailres=no');
	}
	else {

		header('location:../parameters?p=mail&mailres=ok');
	}
}