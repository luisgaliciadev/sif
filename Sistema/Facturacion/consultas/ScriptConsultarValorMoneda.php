<?php
$Nivel="../../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();	

$RIF=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'RIF'];
$USUARIO_CRE_WEB=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'LOGIN'];	
$ID_LOCALIDAD=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_LOCALIDAD'];	

$fecha_inter = $_POST["fecha_inter"];
$moneda_pre = $_POST["id_moneda"];
$moneda_pago = $_POST["moneda"];
$id_pre = $_POST["id_pre"];


	$vSQL="EXEC [dbo].[SP_CAMBIO_MONEDA_DOC_VS_MOV] '$id_pre','$moneda_pre','$moneda_pago','$fecha_inter'";
    
	$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ResultadoEjecutar["CONEXION"];

	$ERROR=$ResultadoEjecutar["ERROR"];
	$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
	$resultPrin=$ResultadoEjecutar["RESULTADO"];
	$Arreglo["COMBO"]='<option value="">Seleccione...</option>';

	if($CONEXION=="SI" and $ERROR=="NO")
	{		
		while (odbc_fetch_array($resultPrin))
        {		
			$ID	=	utf8_encode(odbc_result($resultPrin,"ID"));
			$NB	=	utf8_encode(odbc_result($resultPrin,"MENSAJE"));

			$MTO_CANCEL	=	utf8_encode(odbc_result($resultPrin,"MTO_CANCEL"));
			$CAMBIO_MONEDA_MOV	=	utf8_encode(odbc_result($resultPrin,"CAMBIO_MONEDA_MOV"));

			
			$Arreglo["MTO_CANCEL"]	=$MTO_CANCEL;
			$Arreglo["CAMBIO_MONEDA_MOV"]	=$CAMBIO_MONEDA_MOV;
            $Arreglo["ID"]	=$ID;
			$Arreglo["MENSAJE"]	=$NB;	
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