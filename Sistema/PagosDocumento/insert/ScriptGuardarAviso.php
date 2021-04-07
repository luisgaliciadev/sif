<?php
$Nivel="../../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();	

$RIF=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'RIF'];
$USUARIO_CRE_WEB=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'LOGIN'];	
$ID_LOCALIDAD=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_LOCALIDAD'];	
$ID_USER=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_USUARIO'];


$monto_usado = $_POST["monto_usado"];
$id_moneda = $_POST["id_moneda"];
$documento = $_POST["documento"];
$tp_mov = $_POST["tp_mov"];
$id_movimiento = $_POST["id_movimiento"];
$referencia  = $_POST["referencia"];

//$vSQL="EXEC dbo.[SP_MOVIMIENTO_BANC_BUSQUEDA_REGISTRO_CHEQUE] '$tp_mov','$nro_cheque','$cta_banc_cheq','$fecha','$responsable',$monto,$monto_usado,'$banco','$id_moneda',$ID_LOCALIDAD,'$id_preliquidacion',$ID_USER";

	$vSQL="EXEC dbo.[SP_INSERTAR_MOVIMIENTO_BANC_AVISO_CREDITO_FA] '$tp_mov',$referencia,$monto_usado,'$id_movimiento',$ID_LOCALIDAD,'$documento','$id_moneda',$ID_USER";
	
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