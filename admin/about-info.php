<?php
require_once'header.php';

$query=$db->prepare("SELECT * FROM about where about_id=:id");
$query->execute(array('id' => 0));
$show=$query->fetch(PDO::FETCH_ASSOC);

if ($showuser['user_authorization']<4) {
	
	header("Location:index");
	exit;
}
?>
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<!--
					Ümumi parametrlər
				-->
				<div class="x_panel">
					<div class="x_title">
						<h2><i class="fa fa-info"></i> Sayt haqqında
							<?php
							if (isset($_GET['res'])) {
								if ($_GET['res']=='ok') { ?>
									<script type="text/javascript">
										swal("Dəyişiklik qeyd edildi", "", "success");
									</script>
									<?
								}
								else{ ?>
									<script type="text/javascript">
										swal("Səhv baş verdi", "", "error");
									</script>
									<?
								}
							}
							?></h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="#">Settings 1</a>
										</li>
										<li><a href="#">Settings 2</a>
										</li>
									</ul>
								</li>
								<li><a class="close-link"><i class="fa fa-close"></i></a>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">

							<form action="process/about-process.php" method="post" class="form-horizontal form-label-left" novalidate>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Başlıq</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" name="title"  value="<?php echo $show['about_title']; ?>" id="title" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" >
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Kontent
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<body>
											<textarea name="content" id="editor1" rows="10" cols="80">
												<?php echo $show['about_content']; ?>
											</textarea>
											<script>
												CKEDITOR.replace( 'editor1' );
											</script>
										</body>
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Video linki(youtube)
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" name="video" value="<?php echo $show['about_video']; ?>" id="video"  required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<input type="hidden" name="id" value="<?php echo $show['parametr_id']; ?>">
								<div class="ln_solid"></div>
								<div class="form-group">
									<div class="col-md-6 col-md-offset-3" align="right">
										<button id="send" type="submit" name="aboutyenile" class="btn btn-success">Yenilə</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	include'footer.php';
	?>