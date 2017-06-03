<?php
define('PASSWORD_MIN_LENGTH', 8);
define('CATS_MIN_SELECTION', 2);

function validate(array $datos)
{
	$errores = [];


	if(!isset($datos['username']) ||
		trim($datos['username']) == '')
	{
		$errores['username'] = 'Debe ingresar un username';
	}
	elseif(checkDuplicado('username', $datos['username'])) //chequear que el username no exista aun
	{
		$errores['username'] = 'El username ingresado ya existe en nuestra base de datos';
	}

	if(!isset($datos['email']) ||
		!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)
	)
	{
		$errores['email'] = 'Debe ingresar un email válido';
	}

	elseif(checkDuplicado('email', $datos['email'])) //chequear que el mail no exista aun
	{
		$errores['email'] = 'El mail ingresado ya existe en nuestra base de datos';
	}

	if(strlen($datos['password']) < PASSWORD_MIN_LENGTH)
	{
		$errores['password'] = 'El contraseña debe tener al menos ' . PASSWORD_MIN_LENGTH . ' caracteres';
	}
	elseif($datos['password'] != $datos['confirm-password'])
	{
		$errores['confirm-password'] = 'El contraseña y su confirmacióm deben coincidir';
	}

	return $errores;
}

function validarLogin(array $datos)
{
	$errores = [];

	if(!isset($datos['username']))
	{
		$errores['username'] = 'Debe ingresar un email válido';
	}

	if(trim($datos['password']) == '')
	{
		$errores['password'] = 'Debe ingresar un password';
	}

	return $errores;
}