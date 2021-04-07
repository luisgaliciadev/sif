<?php
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	date_default_timezone_set('America/Caracas');
	
	$ID_USER=$_SESSION[$SISTEMA_SIGLA.'ID_USUARIO'];
	$ID_MONEDA=$_POST['ID_MONEDA'];
	$ID_MONEDA_BASE=$_POST['ID_MONEDA_BASE'];	
	$ID_MONEDA_REF=$_POST['ID_MONEDA_REF'];	
	$VALOR_CAMBIO=$_POST['VALOR_CAMBIO'];	
	$fecha_cambio=$_POST['fecha_cambio'];	
	

	if($ID_MONEDA_REF=='0')
	{
		$vSQL= "EXEC SP_TB_CAMBIO_MONEDA_NOREF_INSERT '$ID_MONEDA','$ID_MONEDA_BASE',$VALOR_CAMBIO,'$fecha_cambio',$ID_USER";	
		$HOLA='HOLA';
	}
	else
	{
		$vSQL= "EXEC SP_TB_CAMBIO_MONEDA_INSERT '$ID_MONEDA','$ID_MONEDA_REF','$ID_MONEDA_BASE',$VALOR_CAMBIO,'$fecha_cambio',$ID_USER";	
		$HOLA='HOLA2';
	}
	
	
	

	
	$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ResultadoEjecutar["CONEXION"];
	$ERROR=$ResultadoEjecutar["ERROR"];
	$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
	$result=$ResultadoEjecutar["RESULTADO"];
	
	if($CONEXION=="SI" and $ERROR=="NO")
	{
		$EXISTE=odbc_result($result,"EXISTE");
		
		if($EXISTE)
		{
			$Arreglo["EXISTE"]="SI";			
			$Arreglo["CONEXION"]=$CONEXION;	
			$Arreglo["ERROR"]=$ERROR;
		}
		else
		{
			$ID=odbc_result($result,"ID");						
			$Arreglo["ID"]=$ID;
			$Arreglo["EXISTE"]="NO";			
			$Arreglo["CONEXION"]=$CONEXION;	
			$Arreglo["ERROR"]=$ERROR;
			$Arreglo["MENSAJE"]=$MENSAJE;
		//	$Arreglo["vSQL"]=$vSQL;
		//	$Arreglo["HOLA"]=$HOLA;
			
		}
	}
	else
	{		
		$Arreglo["CONEXION"]=$CONEXION;	
		$Arreglo["ERROR"]=$ERROR;		
		$Arreglo["MSJ_ERROR"]=$MSJ_ERROR;
		$Arreglo["MENSAJE"]=$MENSAJE;
	}
	
	echo json_encode($Arreglo);
	
	$Conector->Cerrar();
?>