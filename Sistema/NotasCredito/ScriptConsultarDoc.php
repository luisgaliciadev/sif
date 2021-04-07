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

$vSQL="EXEC [dbo].[SP_CONSULTA_DOCUMENTO_ACTIVO] $NRO, $CONTROL, $ID_LOCALIDAD";
$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
$CONEXION=$ResultadoEjecutar["CONEXION"];
$ERROR=$ResultadoEjecutar["ERROR"];
$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
$resultado=$ResultadoEjecutar["RESULTADO"];

if($CONEXION=="SI" and $ERROR=="NO")
{		
		while (odbc_fetch_array($resultado))
        {		
            $res[]=array(
                "sub_total" => number_format(utf8_encode(odbc_result($resultado,'SUB_TOTAL')), 2, ",", "."),
                "monto_gravado" => number_format(utf8_encode(odbc_result($resultado,'TOTAL') - odbc_result($resultado,'MTO_IVA')), 2, ",", "."),                
                "monto_nogravado" => number_format(utf8_encode(odbc_result($resultado,'MTO_NOGRAVADO')), 2, ",", "."),
                "porc_iva" => number_format(utf8_encode(odbc_result($resultado,'PORC_IVA')), 2, ",", "."),   
                "iva" => number_format(utf8_encode(odbc_result($resultado,'IVA')), 2, ",", "."),
                "monto_iva" => number_format(utf8_encode(odbc_result($resultado,'MTO_IVA')), 2, ",", "."),   
                "total" => utf8_encode(odbc_result($resultado,'TOTAL')), 
                "total2" => number_format(utf8_encode(odbc_result($resultado,'TOTAL')), 2, ",", "."),                      
                "cambio_moneda" => utf8_encode(odbc_result($resultado,'CAMBIO_MONEDA')),  
                "fecha_cambio" => utf8_encode(odbc_result($resultado,'FECHA_CAMBIO')),      
                "id_moneda" => utf8_encode(odbc_result($resultado,'ID_MONEDA')),     
                "nb_moneda" => utf8_encode(odbc_result($resultado,'MONEDA_DOCUMENTO')),   
                "rif_cliente" => utf8_encode(odbc_result($resultado,'RIF_CLIENTE')),  
                "id_preliquidacion" => utf8_encode(odbc_result($resultado,'ID_PRELIQUIDACION')),    
                "fg_base" => utf8_encode(odbc_result($resultado,'FG_BASE')),  
                "id_cliente" => utf8_encode(odbc_result($resultado,'ID_CLIENTE')),   
                "id_documento" => utf8_encode(odbc_result($resultado,'ID_DOCUMENTO')),                       
                "error"=> 0,
                "txt"=> '',
                "titulo"=> ''
            );


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
                <h4>Total:</h4> <strong id="totalf">'.number_format((odbc_result($resultado,'MTO_TOTAL')), 2, ",", ".").'</strong></h4>
            </div>
			
			<div class="col-sm-2">
                <h4>Abono:</h4> <strong id="abonado">'.number_format((odbc_result($resultado,'MONTO_ABONADO_FINANCIERO')), 2, ",", ".").'</strong></h4>
            </div>
			<div class="col-sm-2">
                <h4>Ret. Provisionales:</h4> <strong>'.number_format((odbc_result($resultado,'MONTO_PROVISIONAL')), 2, ",", ".").'</strong></h4>
            </div>
			<div class="col-sm-2">
                <h4>Ret. Definitivas:</h4> <strong>'.number_format((odbc_result($resultado,'MONTO_DEFINITIVO')), 2, ",", ".").'</strong></h4>
            </div>
			<div class="col-sm-2">
                <h4>Saldo:</h4> <strong id="saldoss" style="color:red;">'.number_format((odbc_result($resultado,'SALDO')), 2, ",", ".").'</strong></h4>
            </div>

        </div>
    </div>';
			$ID_DOCUMENTO=odbc_result($resultado,'ID_DOCUMENTO');
    }
        

    
        $Arreglo["TOTALES"]	=  $res;
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

    $sql_detalle = "EXEC [dbo].[SP_CONSULTA_DETALLE_DOCUMENTO_NC] '".$ID_DOCUMENTO."' ";    
    
    $ResultadoEjecutar=$Conector->Ejecutar($sql_detalle, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
    
    $CONEXION=$ResultadoEjecutar["CONEXION"];

    $ERROR=$ResultadoEjecutar["ERROR"];
    $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
    $detalles=$ResultadoEjecutar["RESULTADO"];
    $detalle =" <thead>
                    <tr>
                        <th>COD. TARIFA</th>
                        <th>DESCRIPCION</th>
                        <th>BASE CALCULO</th>
                        <th>VALOR CALCULO</th>
                        <th>TASA / TARIFA</th>
                        <th>% DESC.</th>
                        <th>MONTO</th>
                        <th>TOTAL</th>
                        <th>AJUSTE</th>
                        <th>SALDO</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
            ";
    
    if($CONEXION=="SI" and $ERROR=="NO")
    {
        while (odbc_fetch_array($detalles))
        {   
            $res_det[]=array(
                "cod_tarifa" => utf8_encode(odbc_result($detalles,'COD_TARIFA')),
                "ds_tarifa" => utf8_encode(odbc_result($detalles,'DS_TARIFA')),                
                "base_calculo" => odbc_result($detalles,'BASE_CALCULO'),
                "valor_calculo" => number_format(odbc_result($detalles,'VALOR_CALCULO'), 2, ",", "."),   
                "tasa_tarifa" => number_format(odbc_result($detalles,'TASA_TARIFA'), 2, ",", "."),
                "porc_desc" => number_format(odbc_result($detalles,'PORC_DESC'), 2, ",", "."),   
                "mto_item" => number_format(odbc_result($detalles,'MTO_ITEM'), 2, ",", "."), 
                "total_item" =>number_format(odbc_result($detalles,'TOTAL_ITEM'), 2, ",", "."),                      
                "saldo" => number_format(odbc_result($detalles,'SALDO'), 2, ",", "."),  
                "afectado" => number_format(odbc_result($detalles,'AFECTADO'), 2, ",", "."),      
                "id_detalle_documento" => utf8_encode(odbc_result($detalles,'ID_DETALLE_DOCUMENTO')),    
                "id_documento" => utf8_encode(odbc_result($detalles,'ID_DOCUMENTO')),                       
                "error"=> 0,
                "txt"=> '',
                "titulo"=> ''
            );
            $detalle .="<tr>
                            <td>".utf8_encode(odbc_result($detalles,'COD_TARIFA'))."</td>
                            <td>".utf8_encode(odbc_result($detalles,'DS_TARIFA'))."</td>
                            <td>".odbc_result($detalles,'BASE_CALCULO')."</td>
                            <td>".number_format(odbc_result($detalles,'VALOR_CALCULO'), 2, ",", ".")."</td>
                            <td>".number_format(odbc_result($detalles,'TASA_TARIFA'), 2, ",", ".")."</td>
                            <td>".number_format(odbc_result($detalles,'PORC_DESC'), 2, ",", ".")."</td>
                            <td>".number_format(odbc_result($detalles,'MTO_ITEM'), 2, ",", ".")."</td>
                            <td>".number_format(odbc_result($detalles,'TOTAL_ITEM'), 2, ",", ".")."</td>
                            <td></td>
                            <td>".number_format(odbc_result($detalles,'SALDO'), 2, ",", ".")."</td>
                            <td></td>
            </tr>";
        }
        $Arreglo["MENSAJE"]	=  $MENSAJE;
        $Arreglo["CONEXION"]=$CONEXION;
        $Arreglo["ERROR"]=$ERROR;
        $detalle .="</tbody></table>";
        $Arreglo["DETALLE"]	=  $detalle;
        $Arreglo["JSON_DETALLE"]	=  $res_det;
    }
	echo json_encode($Arreglo);
	
	$Conector->Cerrar();


?>