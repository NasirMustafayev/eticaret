<?php 
include'../config/connect.php';
ob_start();
session_start();

if ($_GET['p']==1) {

	if (isset($_POST['insertslider'])) {

		if ($_FILES['img']['size']>10048576) {
			
			header("Location:../sliders?res=largesize");
			exit;
		}
		$authorizedtype=array('jpg','jpeg','png','gif','bmp');

		$findtype=strtolower(substr( $_FILES['img']["name"], strpos( $_FILES['img']["name"],'.')+1));
		if (in_array($findtype, $authorizedtype)===false) {
			header("Location:../sliders?res=invalidtype");
			exit;
		}
		$uploads_dir="../../imgs/slider";

		@$tmp_name= $_FILES['img']["tmp_name"];
		@$name= $_FILES['img']["name"];

		$benzersizsay1=rand(20000,32000);
		$benzersizsay2=rand(20000,32000);
		$benzersizsay3=rand(20000,32000);	
		$benzersizsay4=rand(20000,32000);

		$benzersizad=$benzersizsay1.$benzersizsay2.$benzersizsay3.$benzersizsay4;

		$sliderimgimg=substr($uploads_dir, 6)."/".$benzersizad.$name;	
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

		$insert=$db->prepare("INSERT INTO sliders SET 
			slider_name=:name,
			slider_img=:img,
			slider_link=:link,
			slider_status=:status,
			slider_row=:row");

		$save=$insert-> execute(array(
			'name'=> $_POST['name'] ,
			'img'=> $sliderimgimg,
			'link' => $_POST['link'],
			'status' => $_POST['status'],
			'row' => $_POST['row']));

		if (!$save) {

			header("location:../sliders.php?res=no");
		}
		else {
			$insertinlog=$db->prepare("INSERT INTO logs SET
				log_no=:no,
				process_name=:process_name,
				process_summary=:process_summary,
				process_author=:author");
			$insertinlog->execute(array(
				'no'=> 1,
				'process_name'=>"Yeni slayd əlavəsi",
				'process_summary'=> $_POST['name'],
				'author'=>$_SESSION['user_mail']
			));
			header("location:../sliders.php?res=ok");
		}
	}
}
if ($_GET['p']==2) {
	if (isset($_POST['editslider'])) {

		$slider_id=$_POST['id'];

		if ($_FILES['img']['size']>0) {

			$uploads_dir="../../imgs/slider";

			@$tmp_name= $_FILES['img']["tmp_name"];
			@$name= $_FILES['img']["name"];

			$benzersizsay1=rand(20000,32000);
			$benzersizsay2=rand(20000,32000);
			$benzersizsay3=rand(20000,32000);	
			$benzersizsay4=rand(20000,32000);

			$benzersizad=$benzersizsay1.$benzersizsay2.$benzersizsay3.$benzersizsay4;

			$sliderimgurl=substr($uploads_dir, 6)."/".$benzersizad.$name;	
			@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");


			$update=$db->prepare("UPDATE sliders SET 
				slider_name=:name,
				slider_img=:img,
				slider_link=:link,
				slider_status=:status,
				slider_row=:row
				where slider_id=:id");

			$save=$update-> execute(array(
				'name'=> $_POST['name'] ,
				'img'=> $sliderimgurl ,
				'link' => $_POST['link'],
				'status' => $_POST['status'],
				'row' => $_POST['row'],
				'id' => $_POST['id']));
		}
		else{

			$update=$db->prepare("UPDATE sliders SET 
				slider_name=:name,
				slider_link=:link,
				slider_status=:status,
				slider_row=:row
				where slider_id=:id");

			$save=$update-> execute(array(
				'name'=> $_POST['name'] ,
				'link' => $_POST['link'],
				'status' => $_POST['status'],
				'row' => $_POST['row'],
				'id' => $_POST['id']));
		}

		if (!$save) {

			header("location:../edit-slider.php?id=$slider_id&res=no");
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
				'process_name'=>"Slayd redaktəsi",
				'process_summary'=> $_POST['name'],
				'author'=>$_SESSION['user_mail']
			));
			$lastslider=$_POST['lastslider'];
			unlink("../../$lastslider");

			header("location:../edit-slider.php?id=$slider_id&res=ok");
		}
	}
}
?>