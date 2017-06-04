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

	$retornoImagen = guardarImagen( $_FILES['avatar'],'images/avatar/user' );
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


function guardarImagen($input , $ruta) {
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
			$miArchivo = $ruta  .microtime().'.'. $ext;
			move_uploaded_file($archivo, $miArchivo);

			$Retorno['nombreArchivo'] = $miArchivo;
			return $Retorno;
		}
	}