<?php
require_once'header.php';

$productquery=$db->prepare("SELECT * FROM products order by product_id ASC");
$productquery->execute();

$categoryquery=$db->prepare("SELECT * FROM categories where category_top=:top order by category_row");
$categoryquery->execute(array('top' => 0));
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
						<h2><i class="fa fa-shopping-cart"></i> Məhsullar
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
												<h4 class="modal-title" id="myModalLabel">Bir məhsul əlavə edin</h4>
											</div>
											<div class="modal-body">
												<form action="process/product-process.php?p=1" method="post" class="form-horizontal form-label-left" novalidate>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kateqoriya</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<select class="form-control" name="category" required>
																<?php
																while ($showcategory=$categoryquery->fetch(PDO::FETCH_ASSOC))
																{
																	?>
																	<option <?php echo $showcategory['category_id'] == $showproduct['category_id'] ? 'selected=""' : '';?> value="<?php echo $showcategory['category_id']; ?>" ><?php echo $showcategory['category_name']; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Ad</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input type="text" name="name" placeholder="Məhsul adı daxil edin" id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" >
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12" for="detail">Detal
														</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<body>
																<textarea name="detail" id="editor1" rows="10" cols="80">
																</textarea>
																<script>
																	CKEDITOR.replace( 'editor1' );
																</script>
															</body>
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">Qiymət
														</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input type="number" placeholder="Qiymət adı daxil edin" value="<?php echo $showproduct['product_price']; ?>" name="price" id="url" required="required" class="form-control col-md-7 col-xs-12">
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12" for="row">İnventar
														</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input type="number" name="stock" placeholder="İnventar adı daxil edin" value="<?php echo $showproduct['product_stock']; ?>" id="row"  required="required" class="form-control col-md-7 col-xs-12">
														</div>
													</div>
													<!--<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Tövsiyyə et
														</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="flat" value="1" name="featured">
																</label>
															</div>
														</div>
													</div>-->
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">İstehsalçı</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input type="text" name="manufacturer" placeholder="İstehsalçı adını daxil edin" id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" >
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12" for="row">Açar sözlər
														</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input type="text" name="keyword" placeholder="Açar söz adı daxil edin" value="<?php echo $showproduct['product_keyword']; ?>" id="row"  required="required" class="form-control col-md-7 col-xs-12">
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Status
														</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<select class="form-control" name="status" required>
																<option value="1" <?php echo $showproduct['product_status'] == '1' ? 'selected=""' : '';?>>Aktiv</option>
																<option value="0" <?php echo $showproduct['product_status'] == '0' ? 'selected=""' : '';?>>Passiv</option>
															</select>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Ləğv et</button>
													<button id="send" type="submit" name="insertproduct" class="btn btn-success">Əlavə et</button>
												</div>
											</form>
										</div>
									</div>
								</div>

								<!---------------------------------------------MODAL END--------------------------------------------->

								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th style="width: 15px"></th>
											<th>Ad</th>
											<th>Qiymət</th>
											<th>İnventar</th>
											<th>Məhsul fotosu</th>
											<th style="width: 50px">Status</th>
											<th style="width: 50px">Tövsiyyələr</th>
											<th style="width: 50px"></th>
											<th style="width: 20px"></th>
										</tr>
									</thead>
									<tbody>

										<?php
										$row=0;
										while ($showproduct=$productquery->fetch(PDO::FETCH_ASSOC))
										{
											$row++;
											?>
											<tr>
												<td><?php echo $row; ?></td>
												<td><?php echo $showproduct['product_name']; ?></td>
												<td><?php echo $showproduct['product_price']; ?></td>
												<td><?php echo $showproduct['product_stock']; ?></td>
												<td><center><a href="product-gallery.php?product_id=<?php echo $showproduct['product_id'];?>"><button class="btn btn-success btn-xs">Fotolar</button></a></center></td>

												<td>
													<center>
														<?php
														if ($showproduct['product_status']==1) {
															?>
															<a href="process/product-process?p=3&id=<?php echo $showproduct['product_id'] ?>&status=0">
																<button class="btn btn-success btn-xs">Aktiv</button></a>
															</form>
															<?php
														}
														else{
															?>
															<a href="process/product-process?p=3&id=<?php echo $showproduct['product_id'] ?>&status=1">
																<button class="btn btn-warning btn-xs">Passiv</button></a>
															</form>
															<?php
														}
														?>
													</center>
												</td>

												<td>
													<center>
														<?php
														if ($showproduct['product_featured']==1) {
															?>

															<a href="process/product-process?p=3&id=<?php echo $showproduct['product_id'] ?>&featured=0"><button class="btn btn-default btn-xs">Çıxart</button></a>

															<?php
														}
														else{
															?>
															<a href="process/product-process?p=3&id=<?php echo $showproduct['product_id'] ?>&featured=1"><button name="featured" class="btn btn-success btn-xs">Əlavə et</button></a>
															<?php
														}
														?>
													</center>
												</td>

												<td><center><a href="edit-product.php?id=<?php echo $showproduct['product_id']; ?>"><button class="btn btn-primary btn-xs">Düzəliş et</button></a></center></td>
												<td><center><a href="process/delete-process.php?del=product&id=<?php echo $showproduct['product_id'];?>"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
											</tr>
											<?php 
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		include'footer.php';
		?>