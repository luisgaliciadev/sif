<?php 


$Nivel="../../";
include($Nivel."includes/plugins/MPDF57/mpdf.php");
include($Nivel."includes/PHP/funciones.php");
include("formato_1.php");
$Conector=Conectar();

session_start();	

$RIF=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'RIF'];
$USUARIO_CRE_WEB=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'LOGIN'];	
$ID_LOCALIDAD=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_LOCALIDAD'];	

$ID_DOCUMENTO = $_GET["ID_DOCUMENTO"];

 $vSQL="select * from [dbo].[VIEW_RPT_FACTURA_ENCAB] where ID_DOCUMENTO ='".$ID_DOCUMENTO."'";
$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');

$CONEXION=$ResultadoEjecutar["CONEXION"];

$ERROR=$ResultadoEjecutar["ERROR"];
$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
$resultado=$ResultadoEjecutar["RESULTADO"];

if($CONEXION=="SI" and $ERROR=="NO")
{		while (odbc_fetch_array($resultado))
    {		
                    
        $res_cab[]=array(
            "nb_localidad" => utf8_encode(odbc_result($resultado,'NB_LOCALIDAD')),
            "nro_documento" => utf8_encode(odbc_result($resultado,'NRO_DOCUMENTO')),   
            "nro_control" => utf8_encode(odbc_result($resultado,'NRO_CONTROL')),
            "nb_serie" => utf8_encode(odbc_result($resultado,'NB_SERIE')),   
            "nb_condicion_pago" => utf8_encode(odbc_result($resultado,'NB_CONDICION_PAGO')),
			"simbolo" => utf8_encode(odbc_result($resultado,'SIMBOLO')),
            "moneda_documento" => utf8_encode(odbc_result($resultado,'MONEDA_DOCUMENTO')),   
            "f_emision" => FechaNormal((odbc_result($resultado,'F_EMISION'))), 
            "pie_pag" => utf8_encode(odbc_result($resultado,'PIE_PAG')),     
            "id_preliquidacion" => utf8_encode(odbc_result($resultado,'ID_PRELIQUIDACION')),   
            "id_preliqu" => utf8_encode(odbc_result($resultado,'ID_PRELIQU')),  
            "usuario_genera" => utf8_encode(odbc_result($resultado,'USUARIO_GENERA')),  
            "simbolo" => utf8_encode(odbc_result($resultado,'SIMBOLO')),                          
            "error"=> 0,
            "txt"=> '',
            "titulo"=> ''
        );
    }
}else
{
    $Arreglo["CONEXION"]=$CONEXION;
    $Arreglo["ERROR"]=$ERROR;
    $Arreglo["MSJ_ERROR"]=$MSJ_ERROR;
}



 $cuerpo = '



<body >
<table  width="100%" style="font-size:10px;" >
    <tr>
        <td>SERIE: '.$res_cab[0]["nb_serie"].'</td>     
    </tr>
    <tr>
        <td>NRO. DOCUMENTO (FACTURA): '.$res_cab[0]["nro_documento"].'</td>     
    </tr>
    <tr>
        <td>FECHA: '.$res_cab[0]["f_emision"].'</td>     
    </tr>
    <tr>
        <td>NRO. PRELIQUIDACION: '.$res_cab[0]["id_preliqu"].'</td>     
    </tr>
    <tr>
        <td>CONDICION DE PAGO: '.$res_cab[0]["nb_condicion_pago"].'</td>     
    </tr>
 
</table>
';



 $vSQL="EXEC [dbo].[SP_PRELIQUIDACION_FACTURADA_BUSQUEDA] '".$ID_DOCUMENTO."'";

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
            "sub_total" => utf8_encode(odbc_result($resultado,'SUB_TOTAL')),
            "monto_gravado" => utf8_encode(odbc_result($resultado,'MONTO_GRAVADO')),   
            "monto_nogravado" => utf8_encode(odbc_result($resultado,'MONTO_NOGRAVADO')),
            "porc_iva" => utf8_encode(odbc_result($resultado,'PORC_IVA')),   
            "iva" => utf8_encode(odbc_result($resultado,'IVA')),
            "monto_iva" => utf8_encode(odbc_result($resultado,'MONTO_IVA')),   
            "total" => utf8_encode(odbc_result($resultado,'TOTAL')), 
            "id_tipo_moneda" => utf8_encode(odbc_result($resultado,'ID_TIPO_MONEDA')),     
            "cambio_moneda" => utf8_encode(odbc_result($resultado,'CAMBIO_MONEDA')),  
            "fecha_cambio" => utf8_encode(odbc_result($resultado,'FECHA_CAMBIO')),         "total_base" => utf8_encode(odbc_result($resultado,'TOTAL_BASE')),                
            "error"=> 0,
            "txt"=> '',
            "titulo"=> ''
        );

        $res2[]=array(
            "id_preliquidacion" => utf8_encode(odbc_result($resultado,'ID_PRELIQUIDACION')),
            "id_localidad" => utf8_encode(odbc_result($resultado,'ID_LOCALIDAD')),   
            "id_preliqu" => utf8_encode(odbc_result($resultado,'ID_PRELIQU')),
            "ano_liq" => utf8_encode(odbc_result($resultado,'ANO_LIQ')),   
            "tipo_liq" => utf8_encode(odbc_result($resultado,'TIPO_LIQ')),
            "nro_liq" => utf8_encode(odbc_result($resultado,'NRO_LIQ')),   
            "rif_cliente" => utf8_encode(odbc_result($resultado,'RIF_CLIENTE')), 
            
            "nb_cliente" => utf8_encode(odbc_result($resultado,'NB_CLIENTE')),
            "direccion_fiscal" => utf8_encode(odbc_result($resultado,'DIRECCION_FISCAL')),   
            "rif_cliente_secun" => utf8_encode(odbc_result($resultado,'RIF_CLIENTE_SECUN')),
            "nb_cliente_secun" => utf8_encode(odbc_result($resultado,'NB_CLIENTE_SECUN')),   
            "ano_solic" => utf8_encode(odbc_result($resultado,'ANO_SOLIC')),
            "nro_solic" => utf8_encode(odbc_result($resultado,'NRO_SOLIC')),   
            "ano_expediente" => utf8_encode(odbc_result($resultado,'ANO_EXPEDIENTE')),  
            "tipo_xpediente" => utf8_encode(odbc_result($resultado,'TIPO_EXPEDIENTE')),
            "nro_expediente" => utf8_encode(odbc_result($resultado,'NRO_EXPEDIENTE')),   
            "nb_buque" => utf8_encode(odbc_result($resultado,'NB_BUQUE')),
            "tipo_buque" => utf8_encode(odbc_result($resultado,'TIPO_BUQUE')),   
            "eslora" => utf8_encode(odbc_result($resultado,'ESLORA')),
            "trb" => utf8_encode(odbc_result($resultado,'TRB')),   
            "nacionalidad" => utf8_encode(odbc_result($resultado,'NACIONALIDAD')),  
            "renave" => utf8_encode(odbc_result($resultado,'RENAVE')),
            "bl" => utf8_encode(odbc_result($resultado,'BL')),   
            "producto" => utf8_encode(odbc_result($resultado,'PRODUCTO')),
            "fecha_atraque" => odbc_result($resultado,'FECHA_ATRAQUE'),   
            "fecha_zarpe" => odbc_result($resultado,'FECHA_ZARPE'),
            "fecha_inicio_operaciones" => odbc_result($resultado,'FECHA_INICIO_OPERACIONES'),   
            "fecha_fin_operaciones" => odbc_result($resultado,'FECHA_FIN_OPERACIONES'), 
            "fecha_cambio" => odbc_result($resultado,'FECHA_CAMBIO'), 
            "nb_moneda" => utf8_encode(odbc_result($resultado,'NB_MONEDA')),
            "rif_cliente_tercero" => odbc_result($resultado,'RIF_CLIENTE_TERCERO'), 
            "nb_cliente_tercero" => odbc_result($resultado,'NB_CLIENTE_TERCERO'), 
            "tipo_operacion" => utf8_encode(odbc_result($resultado,'TIPO_OPERACION')),   
            "id_formato_serv" => utf8_encode(odbc_result($resultado,'ID_FORMATO_SERV')), 
			"estatus" => utf8_encode(odbc_result($resultado,'ESTATUS')), 
            "error"=> 0,
            "txt"=> '',
            "titulo"=> ''
        );
    
        if($res2[0]["id_formato_serv"] == strtoupper ('2e7f99c0-976d-4603-b891-ee2f84a84be0')){
            $respuesta = formato_1_pdf($res2);
        }

        if($res2[0]["id_formato_serv"] == 'A55D9CA4-B600-4DD0-9E12-5E8396C02E49'){
            $respuesta = formato_2_pdf($res2);
        }

        if($res2[0]["id_formato_serv"] == strtoupper ('064CCDEC-FB85-4F53-AA2F-7013E618B355')){
            $respuesta = formato_4_pdf($res2);
         }

        if($res2[0]["id_formato_serv"] == strtoupper ('d4dbb066-f275-43b2-bb17-cd32adf47491')){
            $respuesta = formato_3_pdf($res2);
        }

        if($res2[0]["id_formato_serv"] == strtoupper ('778f2337-2268-49f8-8fb1-1e6f582af04c')){
            //$respuesta = formato_2($res2);
        }
        //$respuesta = formato_1_pdf($res2);
        $Arreglo["DATOS"]	=  $resuesta;
        $Arreglo["CABECERA"]	= $res2;
        $Arreglo["TOTALES"]	= $res;
        $Arreglo["CONEXION"]=$CONEXION;
        $Arreglo["ERROR"]=$ERROR;
        
    }
    
    $sql_detalle = "EXEC [dbo].[SP_PRELIQUIDACION_BUSQUEDA_DET] '".$res2[0]["id_preliquidacion"]."' ";
    $ResultadoEjecutar=$Conector->Ejecutar($sql_detalle, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
    
    $CONEXION=$ResultadoEjecutar["CONEXION"];

    $ERROR=$ResultadoEjecutar["ERROR"];
    $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
    $detalles=$ResultadoEjecutar["RESULTADO"];
    $detalle ="<br><table width:100%  >
                <thead>
                    <tr>
                        <th style='font-size:10px;'>CODIGO</th>
                        <th style='font-size:10px;'>DESCRIPCION</th>
                        <th style='font-size:10px;'>BASE</th>
                        <th style='font-size:10px;'>VALOR </th>
                        <th style='font-size:10px;'>TASA / <br>TARIFA</th>
                        <th style='font-size:10px;'>% DESC.</th>
                        <th style='font-size:10px;'>MONTO</th>
                        <th style='font-size:10px;'>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
            ";
    if($CONEXION=="SI" and $ERROR=="NO")
    {
        while (odbc_fetch_array($detalles))
        {
            $detalle .="<tr >
                            <td style='font-size:10px'>".utf8_encode(odbc_result($detalles,'COD_TARIFA'))."</td>
                            <td style='font-size:10px'>".utf8_encode(odbc_result($detalles,'DS_TARIFA'))."</td>
                            <td style='font-size:10px'>".odbc_result($detalles,'BASE_CALCULO')."</td>
                            <td style='font-size:10px' align='right' class='margen'>".number_format(odbc_result($detalles,'VALOR_CALCULO'), 2, ",", ".")."</td>
                            <td style='font-size:10px' align='right'>".number_format(odbc_result($detalles,'TASA_TARIFA'), 2, ",", ".")."</td>
                            <td style='font-size:10px' align='right'>".number_format(odbc_result($detalles,'PORC_DESC'), 2, ",", ".")."</td>
                            <td style='font-size:10px' align='right' class='margen'>".number_format(odbc_result($detalles,'MTO_ITEM'), 2, ",", ".")."</td>
                            <td style='font-size:10px' align='right' class='margen'>".number_format(odbc_result($detalles,'TOTAL_ITEM'), 2, ",", ".")."</td>
            </tr>";
        }

        $detalle .="</tbody></table>";
        $Arreglo["DETALLE"]	=  $detalle;
    }
}
else
{
    $Arreglo["CONEXION"]=$CONEXION;
    $Arreglo["ERROR"]=$ERROR;
    $Arreglo["MSJ_ERROR"]=$MSJ_ERROR;
}


$vSQL="EXEC [dbo].[SP_CONSULTA_MOVIMIENTO_BANC_FACTURA] '".$res2[0]["id_preliquidacion"]."'";
$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');

$CONEXION=$ResultadoEjecutar["CONEXION"];

$ERROR=$ResultadoEjecutar["ERROR"];
$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
$resultPrin=$ResultadoEjecutar["RESULTADO"];

$pagos ="<br>
    <table class='table table-bordered table-hover'>
        <thead>
            <tr>
                <th style='font-size:10px;'>F. Pago</th>
                <th style='font-size:10px;'>Banco</th>
                <th style='font-size:10px;'>Referencia</th>
                <th style='font-size:10px;'>Monto</th>
            </tr>
        </thead>
        <tbody>    
";
if($CONEXION=="SI" and $ERROR=="NO")
{		
    while (odbc_fetch_array($resultPrin))
    {		
        
        $res[]=array(
            "id_movimiento_pago" => utf8_encode(odbc_result($resultPrin,'ID_MOVIMIENTO_PAGO')),
            "nro" => utf8_encode(odbc_result($resultPrin,'NRO')),
            "nb_tipo_pago" => utf8_encode(odbc_result($resultPrin,'NB_TP_PAGO')),
            "nb_tp_movimiento" => utf8_encode(odbc_result($resultPrin,'NB_TP_MOVIMIENTO')),
            "nb_banco" => utf8_encode(odbc_result($resultPrin,'NB_BANCO')),
            "cuenta"=> utf8_encode(odbc_result($resultPrin,'CUENTA')),
            "nb_moneda"=> utf8_encode(odbc_result($resultPrin,'NB_MONEDA')),
            "ref_pago"=> utf8_encode(odbc_result($resultPrin,'REF_PAGO')),
            "f_emision"=> utf8_encode(odbc_result($resultPrin,'F_EMISION')),
            "monto"=> utf8_encode(odbc_result($resultPrin,'MONTO')),
            "saldo"=> utf8_encode(odbc_result($resultPrin,'SALDO')),
            "id_preliquidacion"=> utf8_encode(odbc_result($resultPrin,'ID_PRELIQUIDACION')),
            "error"=> 0,
            "txt"=> '',
            "titulo"=> ''
        );         
        
        $pagos .="
            <tr>
                <td>".utf8_encode(odbc_result($resultPrin,'NB_TP_MOVIMIENTO'))."</td>
                <td>".utf8_encode(odbc_result($resultPrin,'NB_BANCO'))."</td>
                <td align='right'>".utf8_encode(odbc_result($resultPrin,'REF_PAGO'))."</td>
                <td align='right'>".number_format(utf8_encode(odbc_result($resultPrin,'MONTO')), 2, ",", ".")."</td>";
         
   }
   $pagos .="</tbody></table>";
}
else
{
    $Arreglo["CONEXION"]=$CONEXION;
    $Arreglo["ERROR"]=$ERROR;
    $Arreglo["MSJ_ERROR"]=$MSJ_ERROR;
}

$vSQL="select [dbo].[fn_CantidadConLetra] (".$res[0]["total"].") as MTO_LETRA";
$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');

$CONEXION=$ResultadoEjecutar["CONEXION"];

$ERROR=$ResultadoEjecutar["ERROR"];
$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
$resultPrin=$ResultadoEjecutar["RESULTADO"];
if($CONEXION=="SI" and $ERROR=="NO")
{		
    while (odbc_fetch_array($resultPrin))
    {
        $MTO_LETRA = utf8_encode(odbc_result($resultPrin,'MTO_LETRA'));
    }
}else{

}

if($res[0]["total_base"] >0)
{
	$vSQL="select [dbo].[fn_CantidadConLetra] (".$res[0]["total_base"].") as MTO_LETRA";
	$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');

	$CONEXION=$ResultadoEjecutar["CONEXION"];

	$ERROR=$ResultadoEjecutar["ERROR"];
	$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
	$resultPrin=$ResultadoEjecutar["RESULTADO"];
	if($CONEXION=="SI" and $ERROR=="NO")
	{		
		while (odbc_fetch_array($resultPrin))
		{
			$MTO_LETRA_BS = utf8_encode(odbc_result($resultPrin,'MTO_LETRA'));
			$Bs= 'Total Bs.:'.number_format($res[0]["total_base"], 2, ",", ".").'('.$MTO_LETRA_BS.')';
		}
	}else{

	}
}


$cuerpo.= $respuesta.$detalle.'<br>
 
 <div id="div_footer">

        <table style="font-size:10px;">
            <tr>
                <td >TIPO DE CAMBIO: '.number_format($res[0]["cambio_moneda"], 2, ",", ".").'
				<br>Total '.$res_cab[0]["simbolo"].':'.number_format($res[0]["total"], 2, ",", ".").' ('.$MTO_LETRA.')'.'
				<br>'.$Bs.'
				</td>
                <td width="40%">
                    <table >
                        <tr>
                            <td align="right"> Subtotal '.$res_cab[0]["simbolo"].': </td>
                            <td align="right">'.number_format($res[0]["sub_total"], 2, ",", ".").' </td>
                        </tr>
                        <tr >
                            <td align="right"> Base Imponible '.$res_cab[0]["simbolo"].': </td>
                            <td align="right">'.number_format($res[0]["monto_nogravado"], 2, ",", ".").' </td>
                        </tr>
                        <tr>
                            <td align="right"> Monto Exento '.$res_cab[0]["simbolo"].': </td>
                            <td align="right">'.number_format($res[0]["monto_gravado"], 2, ",", ".").' </td>
                        </tr>
                        <tr>
                            <td align="right"> IVA '.$res_cab[0]["simbolo"].': </td>
                            <td align="right">'.number_format($res[0]["monto_iva"], 2, ",", ".").' </td>
                        </tr>
                        <tr >
                            <td align="right"> TOTAL FACTURA '.$res_cab[0]["simbolo"].': </td>
                            <td align="right" style="border-top:1px solid black;">'.number_format($res[0]["total"], 2, ",", ".").' </td>
                        </tr>
                    </table>
                
                </td>
            </tr>
            <tr>
                <td colspan="2">'.$pagos.'</td>
            </tr>
            <tr>
                <td colspan="2"><br>Elaborado por: '.$res_cab[0]["usuario_genera"].'<br><br>'.$res_cab[0]["pie_pag"].'</td>
            </tr>
        </table>
    
 </div>';




$pie='



</body>';
$Conector->Cerrar();
$pie = '';
$F_EMISION=FechaNormal($res_cab[0]["f_emision"]);
$F_HOY=FechaNormal(date("d/m/Y"));
//echo $cuerpo;

$mpdf=new mPDF('c','letter');
$mpdf->SetTitle('Vista Previa de la Factura');
$mpdf->watermarkTextAlpha = 0.6;
$mpdf->showWatermarkImage = true;  
$mpdf->SetHTMLHeader($cabecera);
$mpdf->SetHTMLFooter($pie);	
$txt	=	iconv ("ISO-8859-1", "UTF-8", $txt);

//$ESTATUS=$res2[0]["estatus"];
//
//if($F_EMISION<>$F_HOY)
//{
//	if($ESTATUS==2)//FACTURA ANULADA
//	{
//		$mpdf->SetWatermarkText('FACTURA ANULADA');
//		$mpdf->watermark_font = 'DejaVuSansCondensed';
//		$mpdf->showWatermarkText = true;
//	}
//	else
//	{
//		$mpdf->SetWatermarkText('FACTURA DIGITAL');
//		$mpdf->watermark_font = 'DejaVuSansCondensed';
//		$mpdf->showWatermarkText = true;
//	}
//}
//else
//{
//	if($ESTATUS==2)//FACTURA ANULADA
//	{
//		$mpdf->SetWatermarkText('FACTURA ANULADA');
//		$mpdf->watermark_font = 'DejaVuSansCondensed';
//		$mpdf->showWatermarkText = true;
//	}
//	
//}

$mpdf->WriteHTML($cuerpo);
$mpdf->Output();
?>