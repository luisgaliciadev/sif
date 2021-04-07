<?php
$Nivel="../../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();	

$RIF=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'RIF'];
$USUARIO_CRE_WEB=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'LOGIN'];	
$ID_LOCALIDAD=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_LOCALIDAD'];	
$ID_USER=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_USUARIO'];


$porcen = $_POST["porcen"];
$comprobante = $_POST["comprobante"];
$monto_retenido = $_POST["monto_retenido"];
$base_reten = $_POST["base_reten"];
$documento = $_POST["documento"];
$id_moneda  = $_POST["id_moneda"];
$fecha  = $_POST["fecha"];



//$vSQL="EXEC dbo.[SP_MOVIMIENTO_BANC_BUSQUEDA_REGISTRO_CHEQUE] '$tp_mov','$nro_cheque','$cta_banc_cheq','$fecha','$responsable',$monto,$monto_usado,'$banco','$id_moneda',$ID_LOCALIDAD,'$id_preliquidacion',$ID_USER";

	$vSQL="EXEC dbo.[SP_INSERTAR_MOVIMIENTO_RETENCION_FA] '$porcen','$comprobante',$base_reten,$monto_retenido,'$documento',$ID_USER,'$id_moneda','$fecha'";
	
	$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ResultadoEjecutar["CONEXION"];

	$ERROR=$ResultadoEjecutar["ERROR"];
	$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
	$resultPrin=$ResultadoEjecutar["RESULTADO"];

	if($CONEXION=="SI" and $ERROR=="NO")
	{		
		while (odbc_fetch_array($resultPrin))
        {		
			$ID=odbc_result($resultPrin,"ID");
			$MENSAJE=odbc_result($resultPrin,"MENSAJE");
			
			$Arreglo["ID"]=$ID;
			$Arreglo["MENSAJE"]=$MENSAJE;

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