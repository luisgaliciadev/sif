<?php
$Nivel="../../";
include($Nivel."includes/PHP/funciones.php");
$Conector=Conectar();
session_start();	

$RIF=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'RIF'];
$USUARIO_CRE_WEB=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'LOGIN'];	
$ID_LOCALIDAD=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_LOCALIDAD'];	

$ID_DOCUMENTO = $_POST["ID_DOCUMENTO"];

    $sql_detalle = "EXEC [dbo].[SP_CONSULTA_DETALLE_DOCUMENTO_NC] '".$ID_DOCUMENTO."' ";    
    
    $ResultadoEjecutar=$Conector->Ejecutar($sql_detalle, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
    
    $CONEXION=$ResultadoEjecutar["CONEXION"];
    $ERROR=$ResultadoEjecutar["ERROR"];
    $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
    $detalles=$ResultadoEjecutar["RESULTADO"];
    $detalle ="<table><thead>
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

        $detalle .="</tbody></table>";
        $Arreglo["DETALLE"]	=  $detalle;
        $Arreglo["JSON_DETALLE"]	=  $res_det;
    }
	echo json_encode($Arreglo);
	
	$Conector->Cerrar();


?>