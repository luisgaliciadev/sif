<?php
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	date_default_timezone_set('America/Caracas');
	
	$ID_USER=$_SESSION[$SISTEMA_SIGLA.'ID_USUARIO'];
	$ID_MONEDA=$_POST['ID_MONEDA'];
	$MONEDA_REF=$_POST['MONEDA_REF'];	

	
	$vSQL= "EXEC [SP_TB_MONEDA_REF_INSERT]  '$MONEDA_REF','$ID_MONEDA',$ID_USER";	
	
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
		}
	}
	else
	{		
		$Arreglo["CONEXION"]=$CONEXION;	
		$Arreglo["ERROR"]=$ERROR;		
		$Arreglo["MSJ_ERROR"]=$MSJ_ERROR;
	}
	
	echo json_encode($Arreglo);
	
	$Conector->Cerrar();
?>