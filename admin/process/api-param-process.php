<?php 
include'../config/connect.php';

if (isset($_POST['apiyenile'])) {
	
	$update=$db->prepare("UPDATE parametr set parametr_maps=:maps,parametr_analystic=:analystic,parametr_zopim=:zopim where parametr_id=:id");

	$save=$update-> execute(array('maps'=> $_POST['maps'] ,'analystic'=> $_POST['analystic'] ,'zopim' => $_POST['zopim'],'id' => $_POST['id']));

	if (!$save) {
		
		header('location:../parameters?p=api&apires=no');
	}
	else {

		header('location:../parameters?p=api&apires=ok');
	}
}