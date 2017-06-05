<?php
require_once('requires.php');
if(!isUserLoggedIn()){
      header('location: index.php');
    }

$errores = [];
if($_POST)
{

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
      <div class="col-md-3">
        <div class="text-center">
          <img src=<?php echo $avatar ?> class="avatar img-circle" alt="avatar">
          <h6>Upload a different photo...</h6>
          
          <input class="form-control" type="file">
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <h3>Personal info</h3>
        
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-lg-3 control-label">Username:</label>
            <div class="col-lg-8">
              <input class="form-control" name="username" value=<?php echo isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : '' ?> type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input class="form-control" name="email" value=<?php echo isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : '' ?> type="text">
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
              <input class="form-control" name="conf-password" type="password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input class="btn btn-primary" value="Save Changes" type="button">
              <span></span>
              <input class="btn btn-default" value="Cancel" type="reset">
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
<hr>