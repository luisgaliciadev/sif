<?php
$Nivel="../../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();	

$RIF=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'RIF'];
$USUARIO_CRE_WEB=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'LOGIN'];	
$ID_LOCALIDAD=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_LOCALIDAD'];	
$ID_USER=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_USUARIO'];


$banco = $_POST["banco"];
$nro_cheque = $_POST["nro_cheque"];
$cta_banc_cheq = $_POST["cta_banc_cheq"];
$fecha = $_POST["fecha"];
$monto = $_POST["monto"];
$monto_usado = $_POST["monto_usado"];
$banco = $_POST["banco"];
$responsable = $_POST["responsable"];
$id_moneda = $_POST["id_moneda"];
$documento = $_POST["documento"];
$tp_mov = $_POST["tp_mov"];

//$vSQL="EXEC dbo.[SP_MOVIMIENTO_BANC_BUSQUEDA_REGISTRO_CHEQUE] '$tp_mov','$nro_cheque','$cta_banc_cheq','$fecha','$responsable',$monto,$monto_usado,'$banco','$id_moneda',$ID_LOCALIDAD,'$id_preliquidacion',$ID_USER";

	$vSQL="EXEC dbo.[SP_INSERTAR_MOVIMIENTO_BANC_CHEQUE_FA] '$tp_mov','$nro_cheque','$cta_banc_cheq','$fecha','$responsable',$monto,$monto_usado,'$banco','$id_moneda',$ID_LOCALIDAD,'$documento',$ID_USER";
	
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