<?php
require_once'header.php';
?>
<head>
	<title>Əlaqə -Nasir | Startup eCommerce Script</title>
</head>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-title-wrap">
				<div class="page-title-inner">
					<div class="row">
						<div class="col-md-4">
							<div class="bigtitle">Əlaqə</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="title-bg">
		<div class="title">Contact</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<p class="page-content">
				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the indusy standard dummy text ever since the 1500s.
			</p>
			<ul class="contact-widget">
				<li class="fphone"><?php echo $show['parametr_tel']; ?> <br><?php echo $show['parametr_fax']; ?></li>
				<li class="fmobile"><?php echo $show['parametr_gsm']; ?></li>
				<li class="fmail lastone"><?php echo $show['parametr_mail']; ?></li>
			</ul>
		</div>
		<div class="col-md-7 col-md-offset-1">
			<div class="loc">
				<div id="map_canvas"></div>
			</div>
		</div>
	</div>

	<div class="title-bg">
		<div class="title">Quick Contact</div>
	</div>
	<div class="qc">
		<form role="form">
			<div class="form-group">
				<label for="name">Name<span>*</span></label>
				<input type="text" class="form-control" id="name">
			</div>
			<div class="form-group">
				<label for="email">Email<span>*</span></label>
				<input type="email" class="form-control" id="email">
			</div>
			<div class="form-group">
				<label for="text">Messages<span>*</span></label>
				<textarea class="form-control" id="text"></textarea>
			</div>
			<button type="submit" class="btn btn-default btn-red btn-sm">Submit</button>
		</form>
	</div>
	<div class="spacer"></div>

</div>
<?php
include'footer.php';
?>
