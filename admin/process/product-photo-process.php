<?php
include'../config/connect.php';
ob_start();
session_start();

if (isset($_FILES)) {

	if ($_FILES['file']['size']>1048576) {
		
		header("Location:../upload-product-photo?res=largesize");
		exit;
	}
	$authorizedtype=array('jpg','jpeg','png','gif','bmp');

	$findtype=strtolower(substr( $_FILES['file']["name"], strpos( $_FILES['file']["name"],'.')+1));
	if (in_array($findtype, $authorizedtype)===false) {
		header("Location:../upload-product-photo?res=invalidtype");
		exit;
	}

	$uploads_dir="../../imgs/product";

	@$tmp_name= $_FILES['file']["tmp_name"];
	@$name= $_FILES['file']["name"];

	$benzersizsay1=rand(20000,32000);
	$benzersizsay2=rand(20000,32000);
	$benzersizsay3=rand(20000,32000);	
	$benzersizsay4=rand(20000,32000);

	$benzersizad=$benzersizsay1.$benzersizsay2.$benzersizsay3.$benzersizsay4;

	$productphoto=substr($uploads_dir, 6)."/".$benzersizad.$name;	
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

	$insert=$db->prepare("INSERT INTO productphotos SET 
		product_id=:product_id,
		product_photo=:photo");
	$save=$insert-> execute(array(
		'product_id'=> $_POST['product_id'] ,
		'photo' => $productphoto,));
}
?>