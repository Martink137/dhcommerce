<?php
session_start();
require_once('funciones/class.smtp.php');
require_once('funciones/class.phpmailer.php');
require_once('funciones/html.php');
require_once('funciones/validacion.php');
require_once('funciones/files.php');
require_once('funciones/usuarios.php');


autologuearUsuario();