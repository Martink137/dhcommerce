<?php
require_once('requires.php');

if(isUserLoggedIn()){
      header('location: index.php');
    }

$username = $_POST['username'] ?? null;
$email = $_POST['email'] ?? null;


$errores = [];
if($_POST)
{
  //if(!$errores)
  //if(count($errores) == 0)
  if(!($errores = registrar($_POST)))
  {
    header('location: index.php');
    exit;
  }
}

//abrirHtml('Registración', '');
cabecera();


?>

   <?php
      //if(count($errores) > 0) {
      //if(!empty($errores)) {
      if($errores) { ?>
        <div class="alert alert-danger">
        <?php foreach($errores as $error) {
          echo $error . '<br>';
        }?>
        </div>
      <?php } ?>
<div class="container">
      <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-login">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <a href="#" class="active" id="login-form-link">Login</a>
              </div>
              <div class="col-xs-6">
                <a href="#" id="register-form-link">Register</a>
              </div>
            </div>
            <hr>
          </div>
          <div class="panel-body">
            <div class="row"> 
              <div class="col-lg-12" id="login-form">
                <form  id="login-form" action="index.php" method="post" style="display: block;">
                  <div class="form-group">
                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                  </div>
                  <div class="form-group text-center">
                    <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                    <label for="remember"> Remember Me</label>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="text-center">
                          <a href="forgot.php" tabindex="5" class="forgot-password">Forgot Password?</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                </div>
                <div class="col-lg-12">
                <form  id="register-form" action="" method="post" role="form" style="display: none;" enctype="multipart/form-data">

                  <div class="form-group">
                  <div class="input-group">
                <label class="input-group-btn">
                    <span class="btn btn-primary">
                        Browse Avatar&hellip; <input type="file" name="avatar" style="display: none;">
                    </span>
                </label>
                <input type="text" class="form-control" style="height:auto;" readonly>
                </div>
                </div>
                  <div class="form-group">
                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value=<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>>
                  </div>
                  <div class="form-group">
                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value=<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>>
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php footer(); ?>
    <?php if($_POST)
{
  echo '
<script type="text/javascript">
    $("#register-form").delay(100).fadeIn(100);
    $("#login-form").fadeOut(100);
    $("#login-form-link").removeClass("active");
    $(this).addClass("active");
    e.preventDefault();
    </script>';} 
    ?>



</body>
</html>