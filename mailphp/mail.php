<?
include 'admin/config/connect.php';
require("class.phpmailer.php");

if ($_POST['toplam']!=$_POST['islem']) {
	
	echo "bot kontrolü";
	exit;
} {



	//Mysql den mail bilgilerimizi çekiyoruz.
	$query=$db->prepare("select * from parametr where parametr_id=?");
	$query->execute(array(0));
	$show=$query->fetch(PDO::FETCH_ASSOC);


	$mail = new PHPMailer();
	$mail->IsSMTP();  
	$mail->CharSet="SET NAMES UTF8";                               // send via SMTP
	$mail->Host     = $show['parametr_smtphost']; // SMTP servers
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Username = $show['parametr_smtpuser'];  // SMTP username
	$mail->Password = $show['parametr_smtppass'];// SMTP password
	$mail->Port     = $show['parametr_smtpport'];
	$mail->From     = $show['parametr_smtpuser']; // smtp kullanýcý adýnýz ile ayný olmalý
	$mail->Fromname = "JoyAkademi Test Mail";
	//Çoklu mail için bu satırı çoğal
	$mail->AddAddress("nasir.mustafayev@gmail.com","Form Mail");
	

	$mail->Subject  =  $_POST['adsoyad'];
	$mail->Body     =  implode("    ",$_POST);

if(!$mail->Send())
{
	echo "Mesaj Gönderilemedi <p>";
	echo "Mailer Error: " . $mail->ErrorInfo;
	exit;
}

echo "Mesaj Gönderildi";
exit;
}

?>
<!--<meta http-equiv="refresh" content="0;URL=../iletisim.php?durum=ok">-->