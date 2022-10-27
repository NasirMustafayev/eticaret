<?php 
include'../config/connect.php';
ob_start();
session_start();

if ($_GET['p']=='logo') {

	if (isset($_POST['logoyenile'])) {
		
		if ($_FILES['logo']['size']>1048576) {
			
			header("Location:../parameters?p=conf&pres=largesize");
			exit;
		}
		$authorizedtype=array('jpg','jpeg','png','gif','bmp');

		$findtype=strtolower(substr( $_FILES['logo']["name"], strpos( $_FILES['logo']["name"],'.')+1));
		if (in_array($findtype, $authorizedtype)===false) {
			header("Location:../parameters?p=conf&pres=invalidtype");
			exit;
		}

		$uploads_dir="../../imgs";
		@$tmp_name= $_FILES['logo']["tmp_name"];
		@$name= $_FILES['logo']["name"];
		$benzersizsay1=rand(20000,32000);
		$benzersizsay2=rand(20000,32000);
		$benzersizsay3=rand(20000,32000);	
		$benzersizsay4=rand(20000,32000);

		$benzersizad=$benzersizsay1.$benzersizsay2.$benzersizsay3.$benzersizsay4;

		$logoimgurl=substr($uploads_dir, 6)."/".$benzersizad.$name;	
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

		$update=$db->prepare("UPDATE parametr SET parametr_logo=:logo where parametr_id=:id");
		$save=$update->execute(array('logo' => $logoimgurl, 'id' => 0));


		if (!$save) {

			header("location:../parameters?p=conf&pres=no");
		}
		else {

			$insertinlog=$db->prepare("INSERT INTO logs SET
				log_no=:no,
				process_name=:process_name,
				process_summary=:process_summary,
				process_author=:author");
			$insertinlog->execute(array(
				'no'=> 2,
				'process_name'=>"Loqo yenilənməsi",
				'process_summary'=> $logoimgurl,
				'author'=> $_SESSION['user_mail']
			));
			$lastlogo=$_POST['lastlogo'];
			unlink("../../$lastlogo");
			header("location:../parameters?p=conf&pres=ok");
		}
	}
}
if (isset($_POST['paramyenile'])) {

	$update=$db->prepare("UPDATE parametr SET 
		parametr_title=:title,
		parametr_keywords=:keywords,
		parametr_description=:description,
		parametr_author=:author where parametr_id=:id");

	$save=$update-> execute(array(
		'title'=> $_POST['title'] ,
		'keywords'=> $_POST['keywords'] ,
		'description' => $_POST['description'],
		'author' => $_POST['author'],
		'id' => $_POST['id']));

	if (!$save) {

		header("location:../parameters?p=conf&pres=no");
	}
	else {

		$insertinlog=$db->prepare("INSERT INTO logs SET
			log_no=:no,
			process_name=:process_name,
			process_summary=:process_summary,
			process_author=:author");
		$insertinlog->execute(array(
			'no'=> 2,
			'process_name'=>"Parametr yenilənməsi",
			'process_summary'=> $_POST['title'],
			'author'=> $_SESSION['user_mail']
		));
		header("location:../parameters?p=conf&pres=ok");
	}
}