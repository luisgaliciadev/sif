<?php
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	$ID_USER=$_SESSION[$SISTEMA_SIGLA.'ID_USUARIO'];
	
	date_default_timezone_set('America/Caracas');

	$ID=$_POST['ID'];
	$RIF_CLIENTE=$_POST['RIF_CLIENTE'];
	$NB_CLIENTE=$_POST['NB_CLIENTE'];
	$DIRECCION_FISCAL=$_POST['DIRECCION_FISCAL'];
	$DIAS_CREDITO=$_POST['DIAS_CREDITO'];
	
			
	$vSQL="EXEC [SP_CLIENTE_UPDATE] '$NB_CLIENTE','$DIRECCION_FISCAL',$DIAS_CREDITO,$ID_USER,'$ID'";	


	
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
			$Arreglo["EXISTE"]="NO";
			
			$Arreglo["CONEXION"]=$CONEXION;	
			$Arreglo["ERROR"]=$ERROR;
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