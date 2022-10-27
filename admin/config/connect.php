<?php
try {

	$db=new PDO("mysql:host=localhost;dbname=eticaret;charset=utf8",'root','');

	echo "";
}
catch(PDOException $err){
	?>
	<h3 style="color: red">
		<?php
		echo $err->getMessage();
		echo "<h2>Verilənlər bazası ilə bağlantı baş tutmadı</h2></h3>";

	}
	?>
