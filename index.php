
<?php 
require_once('requires.php');


$errores = [];
if ($_POST)
{
    $errores = validarLogin($_POST);
    if(!count($errores))
    {
        $errores = loguearUsuario($_POST);
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
     <div class="container">

        
        <header class="jumbotron hero-spacer">
            <h1 style="color: white">Ofertas de Mayo!</h1>
            <p>Aprovecha nuestras ofertas de Mayo hasta un %50 de descueto.</p>
            <p><a class="btn btn-default btn-large">Ver mas!</a>
            </p>
        </header>

        <hr>

      
        <div class="row">
            <div class="col-lg-12">
                <h3>Productos destacados</h3>
            </div>
        </div>
       

        
        <div class="row text-center">

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="images/samsung-galaxy-s7-800x500.jpg" alt="">
                    <div class="caption">
                        <h3>Samsung S7</h3>
                        <p>$22.000</p>
                        <p>
                            <a href="#" class="btn btn-primary">Comprar!</a> <a href="#" class="btn btn-default">Mas Info</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="images/Motorola-Moto-G4.jpg" alt="">
                    <div class="caption">
                        <h3>Motorola G4</h3>
                        <p>$15.000</p>
                        <p>
                            <a href="#" class="btn btn-primary">Comprar!</a> <a href="#" class="btn btn-default">Mas Info</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="images/huawei-p10.png" alt="">
                    <div class="caption">
                        <h3>Huawei P10</h3>
                        <p>$12.000</p>
                        <p>
                            <a href="#" class="btn btn-primary">Comprar!</a> <a href="#" class="btn btn-default">Mas Info</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="images/iphone.jpg" alt="">
                    <div class="caption">
                        <h3>IPhone 6S</h3>
                        <p>$25.000</p>
                        <p>
                            <a href="#" class="btn btn-primary">Comprar!</a> <a href="#" class="btn btn-default">Mas Info</a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
        
   </div>
	   <?php footer(); ?>
</body>
</html>
