<?php
require_once'header.php';

$aboutquery=$db->prepare("SELECT * FROM about where about_id=:id");
$aboutquery->execute(array('id' => 0));
$showabout=$aboutquery->fetch(PDO::FETCH_ASSOC);

?>
<head>
	<title>Hakkımızda -Nasir | Startup eCommerce Script</title>
</head>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-title-wrap">
				<div class="page-title-inner">
					<div class="row">
						<div class="col-md-4">
							<div class="bigtitle">Haqqımızda</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title"><?php echo $showabout['about_title']; ?></div>
			</div>
			<div class="page-content">
				<?php
				echo $showabout['about_content'];
				?>
			</div>
			<div class="title-bg">
				<div class="title">Tanıtım videosu</div>
			</div>
			<?php
			if($showabout['about_video']==''){}
				else{
					?>
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