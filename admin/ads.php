<?php
require_once'header.php';

$adsquery=$db->prepare("SELECT * FROM ads");
$adsquery->execute();

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
						<h2><i class="fa fa-globe"></i> Reklamlar
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
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<?php
							while ($showads=$adsquery->fetch(PDO::FETCH_ASSOC)) {
								?>
								<!-------Content thumbail start------->
								<div class="col-md-4">
									<div class="thumbnail">
										<div class="image view view-first">
											<img style="width: 100%; display: block;" src="<?php echo"../".$showads['ads_img']; ?>" alt="image"/>
											<div class="mask">
												<div class="tools tools-bottom">
													<a href="edit-ads?id=<?php echo $showads["ads_id"] ?>"><i class="fa fa-pencil"></i></a>
												</div>
											</div>
										</div>
										<div class="caption">
											<p><?php echo $showads['ads_name'];

											if ($showads['ads_status']==1) {
												?>
												|<b style="color: green">Aktiv</b>
											<?php }
											else{ ?>
												|<b style="color: red">Passiv</b>
											<?php }
											?></p>
											|
											<?php
											echo "Klik sayı <big><u><b>".$showads['ads_click']."</b></u></big>";
											?>
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