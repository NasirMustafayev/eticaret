<?php 
include'../config/connect.php';

if (isset($_POST['infoyenile'])) {
	
	$update=$db->prepare("UPDATE parametr SET 
		parametr_tel=:tel,
		parametr_gsm=:gsm,
		parametr_fax=:fax,
		parametr_mail=:mail,
		parametr_address=:address where parametr_id=:id");

	$save=$update-> execute(array(
		'tel'=> $_POST['tel'] ,
		'gsm'=> $_POST['gsm'] ,
		'fax' => $_POST['fax'],
		'mail' => $_POST['email'],
		'address' => $_POST['address'], 
		'id' => $_POST['id']));

	if (!$save) {
		
		header('location:../parameters?p=contact-info&infores=no');
	}
	else {
		
		header('location:../parameters?p=contact-info&infores=ok');
	}
}