<?php 
include'../config/connect.php';
ob_start();
session_start();

if (isset($_GET['p'])) {

//INSERT bank
	if ($_GET['p']==1) {
		if (isset($_POST['insertbank'])) {

			$insert=$db->prepare("INSERT INTO bank SET 
				bank_name=:name,
				bank_iban=:iban,
				bank_account=:account,
				bank_status=:status");

			$save=$insert-> execute(array(
				'name'=> $_POST['name'] ,
				'iban' => $_POST['iban'],
				'account' => $_POST['account'],
				'status' => $_POST['status']));

			if (!$save) {

				header("location:../bank.php?res=no");
			}
			else {

				$insertinlog=$db->prepare("INSERT INTO logs SET
					log_no=:no,
					process_name=:process_name,
					process_summary=:process_summary,
					process_author=:author
					");
				$insertinlog->execute(array(
					'no'=> 1,
					'process_name'=>"Yeni bank hesabı əlavəsi",
					'process_summary'=> $_POST['name'],
					'author'=>$_SESSION['user_mail']
				));

				header("location:../bank.php?res=ok");
			}
		}
	}

//UPDATE bank
	if ($_GET['p']==2) {
		if (isset($_POST['editbank'])) {

			$bank_id=$_POST['id'];

			$update=$db->prepare("UPDATE bank SET 
				bank_name=:name,
				bank_iban=:iban,
				bank_account=:account,
				bank_status=:status
				where bank_id=:id");

			$save=$update-> execute(array(
				'name'=> $_POST['name'] ,
				'iban' => $_POST['iban'],
				'account' => $_POST['account'],
				'status' => $_POST['status'],
				'id' => $_POST['id']));

			if (!$save) {

				header("location:../edit-bank.php?id=$bank_id&res=no");
			}
			else {

				$insertinlog=$db->prepare("INSERT INTO logs SET
					log_no=:no,
					process_name=:process_name,
					process_summary=:process_summary,
					process_author=:author");
				$insertinlog->execute(array(
					'no'=> 2,
					'process_name'=>"Bank hesabı redaktəsi",
					'process_summary'=> $_POST['name'],
					'author'=>$_SESSION['user_mail']
				));
				header("location:../edit-bank.php?id=$bank_id&res=ok");
			}
		}
	}

//UPDATE STATUS shortcut
	if ($_GET['p']==3) {
		if (isset($_GET['status'])) {

			$update=$db->prepare("UPDATE bank SET
				bank_status=:status
				where bank_id=:id");

			$save=$update-> execute(array(
				'status'=> $_GET['status'],
				'id'=> $_GET['id']));

			if (!$save) {

				header("location:../bank.php?res=no");
			}
			else {

				header("location:../bank.php?res=ok");
			}
		}
	}
}