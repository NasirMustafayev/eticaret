<?php
require_once'header.php';

$sliderquery=$db->prepare("SELECT * FROM sliders order by slider_row ASC");
$sliderquery->execute();

if ($showuser['user_authorization']<2) {
	
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
						<h2><i class="fa fa-image"></i> Slaydlar
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
								<button type="button" class="btn btn-round btn-success btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus"></i>Əlavə et</button></ul>
								
								<!-------------------------------------------MODAL --------------------------------------->

								<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">

											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
												</button>
												<h4 class="modal-title" id="myModalLabel">Bir  slayd əlavə edin</h4>
											</div>
											<div class="modal-body">
												<form action="process/slider-process.php?p=1" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Şəkil
														</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input type="file" name="img" id="img" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required>
															max : 10MB  (<u>jpg, jpeg, png, gif, bmp</u>)
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Ad</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input type="text" name="name" placeholder="Slayd adı daxil edin" id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required>
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">Link
														</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input type="text" placeholder="http://" name="link" id="link" required="required" class="form-control col-md-7 col-xs-12">
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12" for="row">Sıra
														</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input type="text" name="row" placeholder="Sıra nömrəsi daxil edin" id="row"  required="required" class="form-control col-md-7 col-xs-12">
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Status
														</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<select class="form-control" name="status" required>
																<option value="1" <?php echo $showslider['slider_status'] == '1' ? 'selected=""' : '';?>>Aktiv</option>
																<option value="0" <?php echo $showslider['slider_status'] == '0' ? 'selected=""' : '';?>>Passiv</option>
															</select>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Ləğv et</button>
													<button id="send" type="submit" name="insertslider" class="btn btn-success">Əlavə et</button>
												</div>
											</form>
										</div>
									</div>
								</div>

								<!---------------------------------------------MODAL END--------------------------------------------->

								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<?php
								while ($showslider=$sliderquery->fetch(PDO::FETCH_ASSOC)) {
									?>
									<!-------Content thumbail start------->
									<div class="col-md-4">
										<div class="thumbnail">
											<div class="image view view-first">
												<img style="width: 100%; display: block;" src="<?php echo"../".$showslider['slider_img']; ?>" alt="image"/>
												<div class="mask">
													<div class="tools tools-bottom">
														<a href="edit-slider.php?id=<?php echo $showslider["slider_id"] ?>"><i class="fa fa-pencil"></i></a>
														<a href="process/delete-process?del=slider&id=<?php echo $showslider["slider_id"]; ?>&un=<?php echo $showslider['slider_img'] ?>"><i class="fa fa-times"></i></a>
													</div>
												</div>
											</div>
											<div class="caption">
												<p><?php echo $showslider['slider_name'];

												if ($showslider['slider_status']==1) {
													?>
													|<b style="color: green">Aktiv</b>
												<?php }
												else{ ?>
													|<b style="color: red">Passiv</b>
												<?php }
												?></p>
											</div>
										</div>
									</div>
									<!-------Content thumbail end------->
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	include'footer.php';
	?>