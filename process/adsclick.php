<?php
include'../admin/config/connect.php';
ob_start();
session_start();

$adsquery=$db->prepare("SELECT * FROM ads where ads_id=:id");
$adsquery->execute(array('id'=> $_GET['id']));
$showads=$adsquery->fetch(PDO::FETCH_ASSOC);

//REKLAMA HƏR KLİKLƏNDİYİNDƏ KLİK DƏYƏRİNİN +1 ARTMASI
if (isset($_GET['id'])) {
	$click=$showads['ads_click']+1;

	$update=$db->prepare("UPDATE ads SET 
		ads_click=:click
		where ads_id=:ads_id");

	$save=$update-> execute(array(
		'click'=> $click,
		'ads_id' => $_GET['id']));

	if (!$save) {

		header("location:../");
	}
	else {
		$link=$showads['ads_link'];
		header("location:http://$link");
	}
}

?>