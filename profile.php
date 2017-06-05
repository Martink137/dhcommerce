<?php
require_once('requires.php');
if(!isUserLoggedIn()){
      header('location: index.php');
    }

$errores = [];
if($_POST)
{
  if(!($errores = updateProfile($_POST)))
  {
    header('location: profile.php');
    exit;
  }
}
$avatar = $_SESSION['user']['avatar'];
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
      <?php if (isset($success)) { ?>
      <div class="alert alert-success">
      <?php
        echo $success;
      }
      ?>
      </div>
<div class="container">
    <h1>Edit Profile</h1>
    <hr>
  <div class="row">
      <!-- left column -->
      <form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
      <div class="col-md-3">
        <div class="text-center">
          <img src=<?php echo $avatar ?> class="avatar img-circle" alt="avatar">
          <h6>Upload a different photo...</h6>        
          <input type="file" name="avatar">
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <h3>Personal info</h3>
        
        
          <div class="form-group">
            <label class="col-lg-3 control-label">Username:</label>
            <div class="col-lg-8">
              <input class="form-control" name="username" value=<?php echo isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : '' ?> type="text" readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input class="form-control" name="email" value=<?php echo isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : '' ?> type="email">
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-lg-3 control-label">Password:</label>
            <div class="col-lg-8">
              <input class="form-control" name="password" type="password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Confirm password:</label>
            <div class="col-lg-8">
              <input class="form-control" name="confirm-password" type="password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input class="btn btn-primary" value="Save Changes" type="submit">
              <span></span>
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
<?php footer(); ?>