<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>N|SECS Control Panel</title>

  <!-- Bootstrap -->
  <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
  <div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
          <form action="process/login-process.php" method="post">
            <h1>Panelə giriş</h1>
            <div>
              <input type="text" name="email" class="form-control" placeholder="İstifadəçi adı(email)" required="" />
            </div>
            <div>
              <input type="password" name="password" class="form-control" placeholder="Şifrə" required="" />
            </div>
            <div>
              <button name="login" class="btn btn-primary submit" type="submit" style="width:350px" >Daxil ol</button>
            </div>
            <div class="separator">
              <div class="clearfix"></div>
              <br/>

              <div>
                <h1><i class="fa fa-paw"></i> Nasir SECS</h1>
              </div>
            </div>
          </form>
        </section>
      </div>
    </div>
  </div>
</body>
</html>
