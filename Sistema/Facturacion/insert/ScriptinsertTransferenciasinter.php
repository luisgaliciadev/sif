<?php
$Nivel="../../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();	

$RIF=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'RIF'];
$USUARIO_CRE_WEB=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'LOGIN'];	
$ID_LOCALIDAD=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_LOCALIDAD'];	
$ID_USER=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_USUARIO'];


$moneda = $_POST["moneda"];
$fecha_inter = $_POST["fecha_inter"];
$cta_recaudadora = $_POST["cta_recaudadora"];
$fecha = $_POST["fecha"];
$monto = $_POST["monto"];
$monto_usado = $_POST["monto_usado"];
$cta_intermediaria = $_POST["cta_intermediaria"];
$id_moneda = $_POST["id_moneda"];
$id_preliquidacion = $_POST["id_preliquidacion"];
$tp_mov = $_POST["tp_mov"];
$referencia = $_POST["referencia"];
$observacion = $_POST["observacion"];

	$vSQL="EXEC dbo.[SP_INSERTAR_MOVIMIENTO_TRANS_INTER] '$id_preliquidacion','$id_moneda','$moneda','$cta_recaudadora','$tp_mov','$cta_intermediaria','$fecha','$referencia','$fecha_inter','$observacion',$monto,$monto_usado,$ID_USER";
	
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