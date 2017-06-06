<?php

function cabecera()
{
	echo '<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="images/favicon.ico" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/style.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="js/java.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>DH Commerce</title>
</head>
<body>
		<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">DH Commerce</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="">Telefonos</a></li>
            <li><a href="">TVS</a></li>
            <li><a href="">Laptops</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">';
		if(isUserLoggedIn()){
			echo '<li><a href="profile.php">'. $_SESSION['user']['username'] .'</a></li><li><a href="logout.php">Logout</a></li>';
		}
			else
			{
          echo '<li><a href="ingresar.php">Ingresar</a></li>';
			}
          echo '<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ayuda <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="preguntas.php">Preguntas Frecuentes</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>';

}

function footer()
{
	echo '<footer class="footer">
      <div class="container">
        <p class="text-muted">Todos los Derechos Reservados  &copy; ' . date('Y') . '</p>     
      </div>
    </footer>
	
		
	';
}

function cerrarHtml()
{
	echo '
		<script src="assets/libs/jquery/jquery-1.11.1.min.js"></script>
		<script src="assets/libs/bootstrap-3/js/bootstrap.min.js"></script>
	 </body>
	</html>
	';
}