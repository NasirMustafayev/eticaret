<?php
$userquery=$db->prepare("SELECT * FROM users");
$userquery->execute();
$countuser=$userquery->rowCount();

$categoryquery=$db->prepare("SELECT * FROM categories");
$categoryquery->execute();
$countcategory=$categoryquery->rowCount();

$productquery=$db->prepare("SELECT * FROM products");
$productquery->execute();
$countproduct=$productquery->rowCount();

while($showproduct=$productquery->fetch(PDO::FETCH_ASSOC))
{
  $totalstock+=$showproduct['product_stock'];
}

$commentquery=$db->prepare("SELECT * FROM comments");
$commentquery->execute();
$countcomment=$commentquery->rowCount();

$orderquery=$db->prepare("SELECT * FROM orders");
$orderquery->execute();
$countorder=$orderquery->rowCount();
?>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <!-- top tiles -->
      <div class="row tile_count">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-user"></i> İstifadəçi sayı</span>
          <div class="count"><?php echo $countuser; ?></div>
          <br>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-cubes"></i> Ümumi kateqoriyalar</span>
          <div class="count"><?php echo $countcategory; ?></div>
          <br>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-shopping-cart"></i> Məhsul sayı</span>
          <div class="count"><?php echo $countproduct; ?></div>
          <br>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-comments"></i> Rəylər</span>
          <div class="count"><?php echo $countcomment; ?></div>
          <br>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-reorder"></i> Sifarişlərin sayı</span>
          <div class="count green"><?php echo $countorder; ?></div>
          <br>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-database"></i> İnventar</span>
          <div class="count"><?php echo $totalstock; ?> <span class="count-bottom">Məshul</span></div>
          <br>
        </div>
      </div>
      <!-- /top tiles -->
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Proses günlüyü</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="" data-example-id="togglable-tabs">
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade active in" aria-labelledby="home-tab">

                    <!-- start recent activity -->
                    <ul class="messages">
                      <?php
                      $logquery=$db->prepare("SELECT * FROM logs order by log_id DESC");
                      $logquery->execute();
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
</div>
</div>
</div>
</body>