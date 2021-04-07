<?php
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	date_default_timezone_set('America/Caracas');
	
	$ID_USER=$_SESSION[$SISTEMA_SIGLA.'ID_USUARIO'];
	$ID_MONEDA=$_POST['ID_MONEDA'];
	$ID_LOCALIDAD=$_POST['ID_LOCALIDAD'];	
	$ID_BANCO=$_POST['ID_BANCO'];	
	$NRO_CUENTA=$_POST['NRO_CUENTA'];	
	$CODIGO_SWIF=$_POST['CODIGO_SWIF'];	
	$CODIGO_IBAN=$_POST['CODIGO_IBAN'];
	$BENEFICIARIO=$_POST['BENEFICIARIO'];
	

		
	$vSQL= "EXEC SP_TB_CUENTA_INSERT '$ID_BANCO','$ID_MONEDA',$ID_LOCALIDAD,'$NRO_CUENTA','$CODIGO_SWIF','$CODIGO_IBAN','$BENEFICIARIO',$ID_USER";	
		
	
	
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
			$Arreglo["EXISTE"]="NO";			
			$Arreglo["CONEXION"]=$CONEXION;	
			$Arreglo["ERROR"]=$ERROR;
			$Arreglo["MENSAJE"]=$MENSAJE;
		
			
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