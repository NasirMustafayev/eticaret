<?php
require_once'header.php';
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Profilim</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
              <div class="profile_img">
                <div id="crop-avatar">
                  <!-- Current avatar -->
                  <img class="img-responsive avatar-view" <?php if(empty($showuser['user_picture'])){?>src="images/default.png"<?php }else{ ?>src="<?php echo $showuser['user_picture']; ?>" <?php } ?> alt="Avatar" title="Change the avatar">
                </div>
              </div>
              <h3><?php echo $showuser['user_name']." ".$showuser['user_lastname']; ?></h3>

              <ul class="list-unstyled user_data">
                <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $showuser['user_address'];?>
              </li>

              <li>
                <i class="fa fa-briefcase user-profile-icon"></i>
                <?php echo $showuser['user_authorization'] == '5' ? 'Admin' : '';?>
                <?php echo $showuser['user_authorization'] == '4' ? 'Müavin' : '';?>
                <?php echo $showuser['user_authorization'] == '3' ? 'Müdür' : '';?>
                <?php echo $showuser['user_authorization'] == '2' ? 'Moderator' : '';?>
                <?php echo $showuser['user_authorization'] == '1' ? 'İşçi' : '';?>
              </li>
            </ul>

            <a class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-edit m-right-xs"></i>Profili yenilə</a>
            <br />

            <!-------------------------------------------MODAL --------------------------------------->

            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">

                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Profilinizi yeniləyin</h4>
                  </div>
                  <div class="modal-body">
                    <form action="process/edit-profile-process.php" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Profil şəkili
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php
                          if (!empty($showuser['user_picture'])) {
                            ?>
                            <img src="<?php echo $showuser['user_picture']; ?>" style="max-width: 100px" class="img-responsive avatar-view">
                            <?php
                          }else{?>
                            <img src="images/default.png" style="max-width: 150px"  class="img-responsive avatar-view">
                            <?php
                          }
                          ?>
                          <br>
                          <input type="file" name="picture" id="title" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" >
                          maksimum 1MB
                        </div>
                      </div>
                      <div class="col-md-6 col-md-offset-3" align="right">
                        <input type="hidden" value="<?php echo $showuser['user_id']; ?>" name="user_id">
                        <input type="hidden" value="<?php echo $showuser['user_picture']; ?>" name="lastpicture">
                        <button id="send" type="submit" name="editprofilepicture" class="btn btn-primary">Dəyiş</button>
                      </div>
                    </form>
                    <form action="process/edit-profile-process.php" method="post" class="form-horizontal form-label-left" novalidate>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Ad</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="name"  value="<?php echo $showuser['user_name']; ?>" id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" >
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Soyad
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" value="<?php echo $showuser['user_lastname']; ?>" name="lastname" id="lastname" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email adresi
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="email" value="<?php echo $showuser['user_mail']; ?>" id="email"  required="required" disabled class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Ünvan
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="address" value="<?php echo $showuser['user_address']; ?>" id="address"  required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Telefon
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="tel" value="<?php echo $showuser['user_gsm']; ?>" id="tel"  required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <input type="hidden" value="<?php echo $showuser['user_id']; ?>" name="id">
                      <a  class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-sm" style="float: left">Şifrəni dəyişdir</a>
                      <button id="send" type="submit" name="editprofile" class="btn btn-success">Yenilə</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!---------------------------------------------MODAL END--------------------------------------------->

            <!--SMALL MODAL-->
            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">

                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel2">Şifrə dəyişikliyi</h4>
                  </div>

                  <form action="process/edit-profile-process.php" method="post" class="form-horizontal form-label-left" novalidate>
                    <div class="modal-body">
                      Köhnə şifrə<br>
                      <input type="password" name="lastpassword" placeholder="Hazırki şifrənizi daxil edin" id="tel"  required="required" class="form-control col-md-7 col-xs-12">
                      <br>
                      Yeni şifrə<br>
                      <input type="password" name="password" placeholder="Yeni şifrə daxil edin" id="tel"  required="required" class="form-control col-md-7 col-xs-12">
                      Təkrar şifrə<br>
                      <input type="password" name="rpassword" placeholder="Yeni şifrəni təkarar daxil edin" id="tel"  required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                    <br>
                    <br>
                    <div class="modal-footer">
                      <button type="submit" name="editpassword" class="btn btn-primary">Dəyişdir</button>
                    </div>
                  </form>

                </div>
              </div>
            </div>
            <!--SMALL MODAL END-->
          </div>
          <div class="col-md-9 col-sm-9 col-xs-12">

            <div class="profile_title">
              <div class="col-md-6">
                <h2>Proses günlüyüm</h2>
              </div>
            </div>
            <!-- end of user-activity-graph -->

            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                  <!-- start recent activity -->
                  <ul class="messages">
                    <?php
                    $logquery=$db->prepare("SELECT * FROM logs where process_author=:mail order by log_id DESC");
                    $logquery->execute(array('mail'=> $_SESSION['user_mail']));
                    $countlog=$logquery->rowCount();

                    if ($countlog==0) {

                      echo "Sizin proses günlüyünüz boşdur.Heç bir əməliyyat həyata keçrilməyib.";
                    }

                    while($showlog=$logquery->fetch(PDO::FETCH_ASSOC)){
                     $processauthorquery=$db->prepare("SELECT * FROM users where user_mail=:mail");
                     $processauthorquery->execute(array('mail'=>$showlog['process_author']));
                     $showprocessauthor=$processauthorquery->fetch(PDO::FETCH_ASSOC);
                     ?>
                     <li>
                      <img src="<?php if(empty($showprocessauthor['user_picture'])){ echo "images/default.png";}else{ echo $showprocessauthor['user_picture'];} ?>" class="avatar" alt="Avatar">
                      <div class="message_date">
                        <h3 class="date text-info"><?php echo $showlog['process_time']; ?></h3>
                        <!--<p class="month">May</p>-->
                      </div>
                      <div class="message_wrapper">
                        <h4 class="heading"><?php echo $showprocessauthor['user_name']." ".$showprocessauthor['user_lastname']; ?></h4>
                        <blockquote class="message"><?php echo $showlog['process_name']; ?>: 
                          <u style="color: <?php if($showlog['log_no']==1){ ?>#68c6b3<?php }if ($showlog['log_no']==2) { ?>#3b7cb3 <?php } if($showlog['log_no']==3){ ?>#d74c48 <?php }?>"><?php echo $showlog['process_summary']; ?></u></blockquote>
                          <br />
                        </div>
                      </li>
                    <?php } ?>
                  </ul>
                  <!-- end recent activity -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- /page content -->
<?php
include'footer.php';
?>