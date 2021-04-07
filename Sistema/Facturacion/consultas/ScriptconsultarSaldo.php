<?php
$Nivel="../../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();	

$RIF=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'RIF'];
$USUARIO_CRE_WEB=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'LOGIN'];	
$ID_LOCALIDAD=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_LOCALIDAD'];	


$id_pre = $_POST["id_pre"];


 $vSQL="EXEC [dbo].[SP_SALDO_PRELIQ] '$id_pre'";
	
	$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ResultadoEjecutar["CONEXION"];

	$ERROR=$ResultadoEjecutar["ERROR"];
	$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
	$resultado=$ResultadoEjecutar["RESULTADO"];
	
	if($CONEXION=="SI" and $ERROR=="NO")
	{		
		while (odbc_fetch_array($resultado))
        {		
			$SALDO_PRELIQ	=	utf8_encode(odbc_result($resultado,'SALDO_PRELIQ'));;
            $MONTO_ABONADO = utf8_encode(odbc_result($resultado,'MONTO_ABONADO'));
            $SALDOAFAVOR = utf8_encode(odbc_result($resultado,'SALDOAFAVOR'));
            
		
            $Arreglo["SALDO_PRELIQ"]=$SALDO_PRELIQ;
            $Arreglo["MONTO_ABONADO"]=$MONTO_ABONADO;
            $Arreglo["SALDOAFAVOR"]=$SALDOAFAVOR;
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