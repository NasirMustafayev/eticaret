<?php 
include'../config/connect.php';
ob_start();
session_start();

if ($_GET['p']==2) {
	if (isset($_POST['editads'])) {

		$ads_id=$_POST['id'];

		if ($_FILES['img']['size']>0) {

			$uploads_dir="../../imgs/ads";

			@$tmp_name= $_FILES['img']["tmp_name"];
			@$name= $_FILES['img']["name"];

			$benzersizsay1=rand(20000,32000);
			$benzersizsay2=rand(20000,32000);
			$benzersizsay3=rand(20000,32000);	
			$benzersizsay4=rand(20000,32000);

			$benzersizad=$benzersizsay1.$benzersizsay2.$benzersizsay3.$benzersizsay4;

			$adsimgurl=substr($uploads_dir, 6)."/".$benzersizad.$name;	
			@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");


			$update=$db->prepare("UPDATE ads SET 
				ads_name=:name,
				ads_img=:img,
				ads_link=:link,
				ads_status=:status
				where ads_id=:id");

			$save=$update-> execute(array(
				'name'=> $_POST['name'] ,
				'img'=> $adsimgurl ,
				'link' => $_POST['link'],
				'status' => $_POST['status'],
				'id' => $_POST['id']));

			$lastads=$_POST['lastads'];
			unlink("../../$lastads");

		}
		else{

			$update=$db->prepare("UPDATE ads SET 
				ads_name=:name,
				ads_link=:link,
				ads_status=:status
				where ads_id=:id");

			$save=$update-> execute(array(
				'name'=> $_POST['name'] ,
				'link' => $_POST['link'],
				'status' => $_POST['status'],
				'id' => $_POST['id']));
		}

		if (!$save) {

			header("location:../edit-ads.php?id=$ads_id&res=no");
		}
		else {
			$insertinlog=$db->prepare("INSERT INTO logs SET
				log_no=:no,
				process_name=:process_name,
				process_summary=:process_summary,
				process_author=:author"
			);
			$insertinlog->execute(array(
				'no'=> 2,
				'process_name'=>"Reklam redaktəsi",
				'process_summary'=> $_POST['name'],
				'author'=>$_SESSION['user_mail']
			));
			header("location:../edit-ads.php?id=$ads_id&res=ok");
		}
	}
}
?>