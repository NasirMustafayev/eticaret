<?php 
include'../admin/config/connect.php';
ob_start();
session_start();

$userquery=$db->prepare("SELECT * FROM users where user_mail=:mail");
$userquery->execute(array('mail' => $_SESSION['otheruser_mail']));
$showuser=$userquery->fetch(PDO::FETCH_ASSOC);

$producturl=$_POST['producturl'];

if (isset($_GET['p'])) {

//INSERT comment
	if ($_GET['p']==1) {
		if (isset($_POST['sendcomment'])) {

			if ($showuser['user_id']!=$_POST['user_id']) {
				
				header("Location:../logout.php");
			}
			else{

				$insert=$db->prepare("INSERT INTO comments SET 
					user_id=:user_id,
					product_id=:product_id,
					comment=:comment");

				$save=$insert-> execute(array(
					'user_id'=> $_POST['user_id'] ,
					'product_id'=> $_POST['product_id'] ,
					'comment' => $_POST['comment']));

				if (!$save) {

					header("location:$producturl?comres=no");
				}
				else {

					header("location:$producturl?comres=ok");
				}
			}
		}
	}

//DELETE comment
	if ($_GET['p']==3) {

		$purl=$_POST['purl'];

		if ($_POST['commentauthor_id']!=$showuser['user_id']) {

			header("Location:$purl?res=block");
		}

		$commentquery=$db->prepare("SELECT * FROM comments where comment_id=:comment_id");
		$commentquery->execute(array('comment_id'=>$_POST['comment_id']));
		$showcomment=$commentquery->fetch(PDO::FETCH_ASSOC);

		if ($showcomment['user_id']!=$showuser['user_id']) {

			header("Location:$purl?res=block");

		}


		else{
			$delete=$db->prepare("DELETE FROM comments where comment_id=:comment_id");
			$save=$delete->execute(array('comment_id'=> $_POST['comment_id']));



			if (!$save) {

				header("location:$purl?dres=no");
			}
			else {

				header("location:$purl?dres=ok");
			}
		}
	}
}