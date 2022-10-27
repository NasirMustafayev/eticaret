<?php 
include'../config/connect.php';

if (isset($_GET['p'])) {

//UPDATE COMMENT
	if ($_GET['p']==1) {
		if (isset($_POST['editcomment'])) {

			$comment_id=$_POST['id'];

			$update=$db->prepare("UPDATE comments SET
				user_id=:user_id,
				product_id=:product_id, 
				comment=:comment
				where comment_id=:id");

			$save=$update-> execute(array(
				'user_id'=> $_POST['user_id'],
				'product_id'=> $_POST['product_id'],
				'comment'=> $_POST['comment'],
				'id' => $_POST['id']));

			if (!$save) {

				header("location:../edit-comment.php?id=$comment_id&res=no");
			}
			else {

				header("location:../edit-comment.php?id=$comment_id&res=ok");
			}
		}
	}

//UPDATE STATUS shortcut
	if ($_GET['p']==2) {
		if (isset($_GET['confirmation'])) {

			$update=$db->prepare("UPDATE comments SET
				comment_confirmation=:confirmation
				where comment_id=:id");

			$save=$update-> execute(array(
				'confirmation'=> $_GET['confirmation'],
				'id'=> $_GET['id']));

			if (!$save) {

				header("location:../comments.php?res=no");
			}
			else {

				header("location:../comments.php?res=ok");
			}
		}
	}
}