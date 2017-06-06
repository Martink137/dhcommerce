<?php
require_once('validacion.php');
require_once('files.php');

define('USERS_FILE', 'usuarios.json');

function registrar(array $post)
{
	$datos = $post;

	if(!$errores = validate($datos))
	{
		guardarUsuario($datos);
	}


	return $errores;
}

function checkDuplicado($field, $value)
{
	/** @var array $usuarios */
	$usuarios = listUsers();

	foreach($usuarios as $usuario)
	{
		if(strtolower(trim($usuario[$field])) == strtolower(trim($value)))
		{
			return $usuario;
		}
	}

	return false;
}

function saveUsersFile(array $usuarios = [])
{
	$content = [
		'usuarios' => $usuarios
	];
	file_put_contents(USERS_FILE, json_encode($content));
}

/**
 * @return array
 */
function listUsers()
{
	if(!file_exists(USERS_FILE))
	{
		saveUsersFile();
	}

	$usuarios = file_get_contents(USERS_FILE);
	$usuarios = json_decode($usuarios, true);

	return $usuarios['usuarios'];
}

function guardarUsuario(array $datos)
{
	$datos['password'] = password_hash($datos['password'], PASSWORD_DEFAULT);
	unset($datos['confirm-password']);

	$datos['email'] = strtolower(trim($datos['email']));


	$datos['username'] = strtolower(trim($datos['username']));

	$retornoImagen = guardarImagen($_FILES['avatar'],'images/avatar/user/',$datos['email'] . $datos['username']);
	$datos['avatar'] = $retornoImagen['nombreArchivo'];

	//id
	$datos['id'] = nextId();

	$usuarios = listUsers();
	$usuarios[] = $datos;

	saveUsersFile($usuarios);

	guardarUserEnSession($datos);
}

function nextId()
{
	$usuarios = listUsers();

	$id = 0;
	foreach($usuarios as $usuario)
	{
		if($id < $usuario['id'])
		{
			$id = $usuario['id'];
		}
	}

	return $id + 1;
}

function loguearUsuario(array $datos)
{
	//Chequear existencia del mail
	if(!($user = checkDuplicado('username', $datos['username'])))
	{
		return ['username' => 'El username ingresado no esta registrado en nuestra base de datos'];
	}

	//chequear el password


	if(!password_verify($datos['password'], $user['password']))
	{
		return ['password' => 'El password ingresado es inválido'];
	}

	//guardamos en la session
	guardarUserEnSession($user);

	//suponiendo que chequeo el recordarme
	if(isset($datos['remember']))
	{
		//guardamos la cookie de remember
		setcookie('fs05_user', $user['id'], 5*365*24*60*60+time());
	}

	return [];
}

function sendNewPassword($email){
	if(($user = checkDuplicado('email', $email)))
	{		
		return SendMail($email);;
	}
	else
	{
		return false;
	}
}

function updateProfile(array $post)
{

	$datos = $post;

	if(!$errores = validateUpdate($datos))
	{
		updateUsuario($datos);
	}


	return $errores;

}

function updateUsuario(array $datos)
{
	if (!empty($datos["password"])) {
	$datos['password'] = password_hash($datos['password'], PASSWORD_DEFAULT);
	unset($datos['confirm-password']);
	updateJsonRecord($_SESSION['user']['email'],'password',$datos['password']);
	}

	if ($datos['email'] <> $_SESSION['user']['email']){
	$datos['email'] = strtolower(trim($datos['email']));
	updateJsonRecord($_SESSION['user']['email'],'email',$datos['email']);
	$_SESSION['user']['email'] = $datos['email'];
	}

	if (empty($_FILES["avatar"]["name"])) {
	}
	else {	
	$retornoImagen = guardarImagen( $_FILES['avatar'],'images/avatar/user/',$datos['email'] . $datos['username']);
	$datos['avatar'] = $retornoImagen['nombreArchivo'];
	updateJsonRecord($_SESSION['user']['email'],'avatar',$datos['avatar']);
	$_SESSION['user']['avatar'] = $datos['avatar'];
	}


}

function updateJsonRecord($email, $val, $newval){
	
	$usuarios = listUsers();
	foreach ($usuarios as $key => $entry) {
    if ($entry['email'] == $email) {
        $usuarios[$key][$val] = $newval;
    }
}

	saveUsersFile($usuarios);
}

function SendMail($email){
$mail             = new PHPMailer();

$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "tls";                 
$mail->Host       = "smtp.gmail.com";      // SMTP server
$mail->Port       = 587;                   // SMTP port
$mail->Username   = "dhcommerce2017@gmail.com";  // username
$mail->Password   = "dhcommerce";            // password

$mail->SetFrom('noreply@dhcommerce.com', 'DH Commerce');

$mail->Subject    = "Su nueva Password";

for ($i = 0; $i<6; $i++) 
{
    $newpass .= mt_rand(0,9);
}

$passhash = password_hash($newpass, PASSWORD_DEFAULT);
updateJsonRecord($email,'password',$passhash);

$mail->MsgHTML('Su nueva password es '. $newpass);

$address = $email;
$mail->AddAddress($address, "Test");

if(!$mail->Send()) {
//  echo "Mailer Error: " . $mail->ErrorInfo;
return false;
} else {
	return true;
 // echo "Message sent!";
}
}

function logout()
{
	//borrar la varible user de la session
	unset($_SESSION['user']);
	//destruir la session
	session_destroy();
	//borrar la cookie de recordarme
	setcookie('fs05_user', 0, time() * -1);
}

function isUserLoggedIn()
{
	return isset($_SESSION['user']);
}

function autologuearUsuario()
{
	//chequear si ya esta logueado
	if(!isUserLoggedIn() && isset($_COOKIE['fs05_user']))
	{
		//leer cookie
		$userId = $_COOKIE['fs05_user'];

		//buscamos el usuario
		$user = checkDuplicado('id', $userId);

		//lo escribimos en la session
		if($user)
		{
			guardarUserEnSession($user);
		}
	}

}

function guardarUserEnSession($user)
{
	unset($user['password']);
	$_SESSION['user'] = $user;
}


function guardarImagen($input , $ruta, $md5aux) {
		if ($input["error"] == UPLOAD_ERR_OK)
		{
			$nombre=$input["name"];
			$archivo=$input["tmp_name"];

			$infoImagen = getimagesize($archivo);

			if($infoImagen === FALSE){
				$Retorno['error']= 'No es una imagen';
			}else {
				//valido tamaño imagen
				//valido tipo de imagen
			}

			$ext = pathinfo($nombre, PATHINFO_EXTENSION);
			$miArchivo = $ruta  .md5($md5aux).'.'. $ext;
			move_uploaded_file($archivo, $miArchivo);

			$Retorno['nombreArchivo'] = $miArchivo;
			return $Retorno;
		}
	}