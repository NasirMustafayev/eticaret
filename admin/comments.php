<?php
require_once'header.php';

$commentquery=$db->prepare("SELECT * FROM comments order by comment_confirmation ASC");
$commentquery->execute();

$count=0;
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
						<h2><i class="fa fa-comments"></i> Rəylər
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
							<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>No</th>
										<th style="width: 20px">Məhsul</th>
										<th>Yazar</th>
										<th>Rəy</th>
										<th>Təsdiqləmə</th>
										<th style="width: 50px"></th>
										<th style="width: 20px"></th>
									</tr>
								</thead>
								<tbody>

									<?php while ($showcomment=$commentquery->fetch(PDO::FETCH_ASSOC)) {
										$count++;

										$commentauthorquery=$db->prepare("SELECT * FROM users where user_id=:user_id");
										$commentauthorquery->execute(array('user_id'=> $showcomment['user_id']));
										$showcommentauthor=$commentauthorquery->fetch(PDO::FETCH_ASSOC);

										$productquery=$db->prepare("SELECT * FROM products where product_id=:product_id");
										$productquery->execute(array('product_id'=> $showcomment['product_id']));
										$showproduct=$productquery->fetch(PDO::FETCH_ASSOC);
										?>
										<tr>
											<td><?php echo $count;?></td>
											<td><?php echo $showproduct['product_name']; ?></td>
											<td><?php echo $showcommentauthor['user_name']; ?></td>
											<td><?php echo substr($showcomment['comment'],0,55)."..."; ?></td>
											<td>
												<center>
													<?php
													if ($showcomment['comment_confirmation']==1) {
														?>
														<a href="process/comment-process?p=2&id=<?php echo $showcomment['comment_id'] ?>&confirmation=0">
															<button class="btn btn-default btn-xs">Təsdiqlənib</button></a>
															<?php
														}
														else{
															?>
															<a href="process/comment-process?p=2&id=<?php echo $showcomment['comment_id'] ?>&confirmation=1">
																<button class="btn btn-success btn-xs">Təsdiqlə</button></a>
																<?php
															}
															?>
														</center>
													</td>
													<td><center><a href="edit-comment.php?id=<?php echo $showcomment['comment_id']; ?>">
														<button class="btn btn-primary btn-xs">Düzəliş et</button></a></center></td>
														<td><center><a href="process/delete-process.php?del=comment&id=<?php echo $showcomment['comment_id'];?>"><button class="btn btn-danger btn-xs">Sil</button></a></center>
														</td>
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