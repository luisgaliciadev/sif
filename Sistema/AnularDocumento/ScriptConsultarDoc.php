<?php
$Nivel="../../";
include($Nivel."includes/PHP/funciones.php");
$Conector=Conectar();
session_start();	

$RIF=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'RIF'];
$USUARIO_CRE_WEB=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'LOGIN'];	
$ID_LOCALIDAD=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_LOCALIDAD'];	

$NRO = $_POST["nro"];
$CONTROL = $_POST["control"];

$vSQL="EXEC [dbo].[SP_CONSULTA_DOCUMENTO_FACTURA] $NRO, $CONTROL, $ID_LOCALIDAD";
$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
$CONEXION=$ResultadoEjecutar["CONEXION"];
$ERROR=$ResultadoEjecutar["ERROR"];
$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
$resultado=$ResultadoEjecutar["RESULTADO"];

if($CONEXION=="SI" and $ERROR=="NO")
{		
		while (odbc_fetch_array($resultado))
        {		
			$ID=odbc_result($resultado,'ID');
			$MENSAJE=odbc_result($resultado,'MENSAJE');
			$FORMATO=odbc_result($resultado,'FORMATO');
			$datos='<div class="box-body" >
        	<div class=" ">
            <div class="col-sm-3">
                <h4>Nro.Documento: <strong>'. utf8_encode(odbc_result($resultado,'NRO_DOCUMENTO')).'</strong></h4>
            </div>
			<div class="col-sm-3">
                <h4>Nro.Control: <strong>'. utf8_encode(odbc_result($resultado,'NRO_CONTROL')).'</strong></h4>
            </div>
			<div class="col-sm-3">
                <h4>Localidad: <strong>'. utf8_encode(odbc_result($resultado,'NB_LOCALIDAD')).'</strong></h4>
            </div>
            <div class="col-sm-2">
                <h4>Moneda: <strong>'.utf8_encode(odbc_result($resultado,'MONEDA_DOCUMENTO')).'</strong></h4>
            </div>
            <div class="col-sm-4">
                <h4>Cliente: <strong>'.utf8_encode(odbc_result($resultado,'RIF_CLIENTE')).' - '.utf8_encode(odbc_result($resultado,'NOMBRE_CLIENTE')).'</strong></h4>
            </div>
            <div class="col-sm-4">
                <h4>F. Emision: <strong>'.FechaNormal(odbc_result($resultado,'F_EMISION')).'</strong></h4>
            </div>
            <div class="col-sm-4">
                <h4>Fecha Anulacion: <strong>'.utf8_encode(odbc_result($resultado,'F_ANULACION')).'</strong></h4>
            </div>
			<div class="col-sm-4">
                <h4>Login: <strong>'.utf8_encode(odbc_result($resultado,'LOGIN')).'</strong></h4>
            </div>
			<div class="col-sm-4">
                <h4>Estatus: <strong>'.utf8_encode(odbc_result($resultado,'DS_ESTATUS')).'</strong></h4>
            </div>
			<div class="col-sm-4">
                <h4>Tipo Servicio: <strong>'.utf8_encode(odbc_result($resultado,'NB_SUBT_SERVICIO')).'</strong></h4>
            </div>
			<div class="col-sm-4">
                <h4>Dias Credito: <strong>'.number_format(utf8_encode(odbc_result($resultado,'DIAS_CREDITO')), 2, ",", ".").'</strong></h4>
            </div>
			<div class="col-sm-4">
                <h4>Condicion de pago: <strong>'.utf8_encode(odbc_result($resultado,'NB_CONDICION_PAGO')).'</strong></h4>
            </div>
			<div class="col-sm-4">
                <h4>Tipo Documento: <strong>'.utf8_encode(odbc_result($resultado,'TIPO_DOCUMENTO')).'</strong></h4>
            </div>
			<div class="col-sm-2">
                <h4>SubTotal:</h4> <strong>'.number_format((odbc_result($resultado,'SUB_TOTAL')), 2, ",", ".").'</strong></h4>
            </div>
			<div class="col-sm-2">
                <h4>Gravado:</h4> <strong>'.number_format((odbc_result($resultado,'MTO_GRAVADO')), 2, ",", ".").'</strong></h4>
            </div>
			<div class="col-sm-2">
                <h4>No Gravado:</h4> <strong>'.number_format((odbc_result($resultado,'MTO_NOGRAVADO')), 2, ",", ".").'</strong></h4>
            </div>
			<div class="col-sm-2">
                <h4>Porc. Iva:</h4> <strong>'.number_format((odbc_result($resultado,'PORC_IVA')), 2, ",", ".").'</strong></h4>
            </div>
			<div class="col-sm-2">
                <h4>Iva:</h4> <strong>'.number_format((odbc_result($resultado,'MTO_IVA')), 2, ",", ".").'</strong></h4>
            </div>
			<div class="col-sm-2">
                <h4>Total:</h4> <strong>'.number_format((odbc_result($resultado,'MTO_TOTAL')), 2, ",", ".").'</strong></h4>
            </div>
			
			<div class="col-sm-2">
                <h4>Abono:</h4> <strong>'.number_format((odbc_result($resultado,'MONTO_ABONADO_FINANCIERO')), 2, ",", ".").'</strong></h4>
            </div>
			<div class="col-sm-2">
                <h4>Ret. Provisionales:</h4> <strong>'.number_format((odbc_result($resultado,'MONTO_PROVISIONAL')), 2, ",", ".").'</strong></h4>
            </div>
			<div class="col-sm-2">
                <h4>Ret. Definitivas:</h4> <strong>'.number_format((odbc_result($resultado,'MONTO_DEFINITIVO')), 2, ",", ".").'</strong></h4>
            </div>
			<div class="col-sm-2">
                <h4>Saldo:</h4> <strong>'.number_format((odbc_result($resultado,'SALDO')), 2, ",", ".").'</strong></h4>
            </div>

        </div>
    </div>';
			$ID_DOCUMENTO=odbc_result($resultado,'ID_DOCUMENTO');
    }
        
        $Arreglo["DATOS"]	=  $datos;
		$Arreglo["FORMATO"]	=  $FORMATO;
		$Arreglo["ID_DOCUMENTO"]	=  $ID_DOCUMENTO;
		$Arreglo["ID"]	=  $ID;
		$Arreglo["MENSAJE"]	=  $MENSAJE;
        $Arreglo["CONEXION"]=$CONEXION;
        $Arreglo["ERROR"]=$ERROR;
 
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