<?php
require_once'header.php';

$detailquery=$db->prepare("SELECT * FROM menus where menu_seourl=:page");
$detailquery->execute(array('page' => $_GET['page']));
$showdetail=$detailquery->fetch(PDO::FETCH_ASSOC);

if ($showdetail['menu_status']!=1) {
	
	header("Location:index");
}
?>
<head>
	<title><?php echo $showdetail['menu_name']; ?>-Nasir | Startup eCommerce Script</title>
</head>
<div class="container">
	<div class="row">
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title"><?php echo $showdetail['menu_name']; ?></div>
			</div>
			<div class="page-content">
				<?php
				echo $showdetail['menu_detail'];
				?>
			</div>
			<?php
			if(empty($showabout['about_video'])){}
				else{
					?>
					<div class="title-bg">
						<div class="title">Video</div>
					</div>
					<iframe width="100%" height="320px" src="https://www.youtube.com/embed/<?php echo substr($showabout['about_video'],-11);?>?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
				<?php } ?>
			</div>
			<?php
			include'sidebar.php';
			?>
		</div>
		<div class="spacer"></div>
	</div>

	<?php
	include'footer.php';
	?>