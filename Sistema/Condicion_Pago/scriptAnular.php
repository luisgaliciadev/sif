<?php
	$Nivel='../../';
	
	include($Nivel.'includes/PHP/funciones.php');
	
	session_start();
	
	date_default_timezone_set('America/Caracas');
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	$ID_USER=$_SESSION[$SISTEMA_SIGLA.'ID_USUARIO'];
	
	$ID = $_POST['ID'];
	
    $Conector = Conectar();
    
    $vSQL="EXEC [SP_CONDICION_DISABLED] '$ID', $ID_USER";

    $ResultadoEjecutar = $Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA='SI', $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');

    $CONEXION	= $ResultadoEjecutar['CONEXION'];
    $ERROR		= $ResultadoEjecutar['ERROR'];
    $MSJ_ERROR	= $ResultadoEjecutar['MSJ_ERROR'];
    $result	    = $ResultadoEjecutar['RESULTADO'];

    if($CONEXION == 'SI' and $ERROR == 'NO'){
		$Arreglo['CONEXION']	= $CONEXION;
		$Arreglo['ERROR']		= $ERROR;
		$Arreglo['MSJ_ERROR']	= $MSJ_ERROR;        
	}else{
		$Arreglo['CONEXION']	= $CONEXION;
		$Arreglo['ERROR']		= $ERROR;
		$Arreglo['MSJ_ERROR']	= $MSJ_ERROR;
	}

	echo json_encode($Arreglo);

	$Conector->Cerrar();
?>