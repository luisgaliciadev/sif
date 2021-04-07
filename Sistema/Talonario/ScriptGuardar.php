<?php
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	date_default_timezone_set('America/Caracas');
	
	$ID_USER=$_SESSION[$SISTEMA_SIGLA.'ID_USUARIO'];
	$ID_SERIE=$_POST['ID_SERIE'];
	$ID_CENTRO=$_POST['ID_CENTRO'];
	$ID_DOCUMENTO=$_POST['ID_DOCUMENTO'];
	$DOC_DESDE=$_POST['DOC_DESDE'];
	$DOC_HASTA=$_POST['DOC_HASTA'];
	$CONTROL_DESDE=$_POST['CONTROL_DESDE'];
	$CONTROL_HASTA=$_POST['CONTROL_HASTA'];

	
	$vSQL= "EXEC [SP_TB_TALONARIO_INSERT]  '$ID_CENTRO','$ID_SERIE','$ID_DOCUMENTO',$DOC_DESDE,$DOC_HASTA,$CONTROL_DESDE,$CONTROL_HASTA,$ID_USER";	
	
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