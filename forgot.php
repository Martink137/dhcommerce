<?php
require_once('requires.php');

$errores = [];
if($_POST)
{

if(sendNewPassword($_POST['email']))
  {
    $success = "Mail con nueva password enviado";
  }
}

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
    <div class="row">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                          <h3><i class="fa fa-lock fa-4x"></i></h3>
                          <h2 class="text-center">Forgot Password?</h2>
                          <p>You can reset your password here.</p>
                            <div class="panel-body">
                              
                              <form class="form" action="" method="post">
                                <fieldset>
                                  <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                      
                                      <input id="emailInput" placeholder="email address" class="form-control" oninvalid="setCustomValidity('Please enter a valid email address!')" onchange="try{setCustomValidity('')}catch(e){}" required="" type="email" name="email">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <input class="btn btn-lg btn-primary btn-block" value="Send My Password" type="submit">
                                  </div>
                                </fieldset>
                              </form>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>