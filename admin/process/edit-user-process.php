<?php 
include'../config/connect.php';

if (isset($_POST['edituser'])) {
	
	$user_id=$_POST['id'];
	$update=$db->prepare("UPDATE users SET 
		user_name=:name,
		user_lastname=:lastname,
		user_address=:address,
		user_gsm=:tel,
		user_status=:status,
		user_authorization=:authorization
		where user_id=:id");

	$save=$update-> execute(array(
		'name'=> $_POST['name'] ,
		'lastname'=> $_POST['lastname'] ,
		'address' => $_POST['address'],
		'tel' => $_POST['tel'],
		'status' => $_POST['status'] ,
		'authorization'=>$_POST['authorization'],
		'id' => $_POST['id']));

	if (!$save) {
		
		header("location:../edit-user.php?id=$user_id&res=no");
	}
	else {

		header("location:../edit-user.php?id=$user_id&res=ok");
	}
}