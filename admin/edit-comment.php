<?php
require_once'header.php';

$commentquery=$db->prepare("SELECT * FROM comments where comment_id=:id");
$commentquery->execute(array('id' => $_GET['id']));
$showcomment=$commentquery->fetch(PDO::FETCH_ASSOC);

$commentauthorquery=$db->prepare("SELECT * FROM users where user_id=:user_id");
$commentauthorquery->execute(array('user_id'=> $showcomment['user_id']));
$showcommentauthor=$commentauthorquery->fetch(PDO::FETCH_ASSOC);  

$time=explode(" ", $showcomment['comment_time']);
?>

<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Rəy düzəlişi
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
              <form action="process/comment-process.php?p=1" method="post" class="form-horizontal form-label-left" novalidate>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Yazar</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="name" disabled value="<?php echo $showcommentauthor['user_name']; ?>" id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" >
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Məhsul kodu
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="email" value="<?php echo $showcomment['product_id']; ?>" id="email" disabled required="required" disabled class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="detail">Rəy
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <body>
                      <textarea name="comment" id="editor1" rows="10" cols="80">
                        <?php echo $showcomment['comment']; ?>
                      </textarea>
                      <script>
                        CKEDITOR.replace( 'editor1' );
                      </script>
                    </body>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Yazılma tarixi
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="date" name="time" value="<?php echo $time[0]; ?>" id="time" disabled required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <input type="hidden" name="user_id" value="<?php echo $showcomment['user_id']; ?>">
                <input type="hidden" name="product_id" value="<?php echo $showcomment['product_id']; ?>">
                <input type="hidden" name="id" value="<?php echo $showcomment['comment_id']; ?>">
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-md-offset-3" align="right">
                    <button id="send" type="submit" name="editcomment" class="btn btn-success">Yenilə</button>
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