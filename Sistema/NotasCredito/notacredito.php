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

 $vSQL="select * from [dbo].[VIEW_RPT_NC_ENCAB] where ID_DOCUMENTO ='".$ID_DOCUMENTO."'";
$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');

$CONEXION=$ResultadoEjecutar["CONEXION"];

$ERROR=$ResultadoEjecutar["ERROR"];
$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
$resultado=$ResultadoEjecutar["RESULTADO"];

if($CONEXION=="SI" and $ERROR=="NO")
{		while (odbc_fetch_array($resultado))
    {		
                    
        $res_cab[]=array(
            "nb_moneda" => utf8_encode(odbc_result($resultado,'NB_MONEDA')),
            "simbolo" => utf8_encode(odbc_result($resultado,'SIMBOLO')),   
            "nombre_cliente" => utf8_encode(odbc_result($resultado,'NOMBRE_CLIENTE')),
            "rif_cliente" => utf8_encode(odbc_result($resultado,'RIF_CLIENTE')),   
            "valor_cambio" => utf8_encode(odbc_result($resultado,'VALOR_CAMBIO')),
			"direccion_fiscal" => utf8_encode(odbc_result($resultado,'DIRECCION_FISCAL')),  
            "f_emision" => FechaNormal((odbc_result($resultado,'F_EMISION'))), 
            "f_anulacion" => FechaNormal((odbc_result($resultado,'F_ANULACION'))),     
            "nro_documento" => utf8_encode(odbc_result($resultado,'NRO_DOCUMENTO')),   
            "nro_control" => utf8_encode(odbc_result($resultado,'NRO_CONTROL')),  
            "sub_total" => utf8_encode(odbc_result($resultado,'SUB_TOTAL')),  
            "mto_gravado" => utf8_encode(odbc_result($resultado,'MTO_GRAVADO')),   
            "mto_nogravado" => utf8_encode(odbc_result($resultado,'MTO_NOGRAVADO')),   
            "porc_iva" => utf8_encode(odbc_result($resultado,'PORC_IVA')),  
            "mto_iva" => utf8_encode(odbc_result($resultado,'MTO_IVA')),  
            "total_base" => utf8_encode(odbc_result($resultado,'MTO_TOTAL_BASE')), 
            "total_base_s" => utf8_encode(odbc_result($resultado,'MTO_TOTAL_BASE')/1000), 
            "mto_total" => utf8_encode(odbc_result($resultado,'MTO_TOTAL')), 
            "mto_total_s" => utf8_encode(odbc_result($resultado,'MTO_TOTAL')/1000), 
            "observacion" => utf8_encode(odbc_result($resultado,'OBSERVACION')),   
            "login" => utf8_encode(odbc_result($resultado,'LOGIN')),  
            "nro_factura_afectada" => utf8_encode(odbc_result($resultado,'NRO_FACTURA_AFECTADA')),  
            "nb_subt_servicio" => utf8_encode(odbc_result($resultado,'NB_SUBT_SERVICIO')), 
            "letra_nc" => utf8_encode(odbc_result($resultado,'LETRA_NC')), 

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

<style>

    table{
        width: 100%;
        border-collapse: collapse;
    }

    table th{
        background-color: #ddd;
        color: black;
        font-weight: 900;
        font-size:11px;
    }

    table tr td {
        color: black;
        font-weight: 900;
        font-size:10px;
    }

    .margenes{
        margin-bottom:0px;
    }

    .montos{
        height: 70px;        
    }

    .cabecera{
        font-size : 8px !important;
    }
</style>
<body style="font-family:Courier New; ">
<table  width="100%" >
    <tr>
        <td>SERIE: <STRONG>'.$res_cab[0]["nro_control"].'</STRONG></td>     
    </tr>
    <tr>
        <td>NRO. DOCUMENTO (NOTA DE CREDITO): <STRONG>'.$res_cab[0]["nro_documento"].'</STRONG></td>     
    </tr>
    <tr>
        <td>FECHA: <STRONG>'.$res_cab[0]["f_emision"].'</STRONG></td>     
    </tr>
    <tr>
        <td>NRO. FACTURA AFECTADA: <STRONG>'.$res_cab[0]["nro_factura_afectada"].'</STRONG></td>     
    </tr>
    <tr>
        <td>RIF DEL CLIENTE: <STRONG>'.$res_cab[0]["rif_cliente"].'</STRONG></td>     
    </tr>
    <tr>
        <td>NOMBRE DEL CLIENTE: <STRONG>'.$res_cab[0]["nombre_cliente"].'</STRONG></td>     
    </tr>
    <tr>
        <td>DIRECCION: <STRONG>'.$res_cab[0]["direccion_fiscal"].'</STRONG></td>     
    </tr>
    <tr>
        <td>TIPO DE SERVICIO</td>: <STRONG>'.$res_cab[0]["nb_subt_servicio"].'</STRONG></td>     
    </tr>
 
</table>
';




    
    $sql_detalle = "select * from  [dbo].[VIEW_DETALLE_NC] where ID_DOCUMENTO ='".$ID_DOCUMENTO."'";
    $ResultadoEjecutar=$Conector->Ejecutar($sql_detalle, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
    
    $CONEXION=$ResultadoEjecutar["CONEXION"];

    $ERROR=$ResultadoEjecutar["ERROR"];
    $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
    $detalles=$ResultadoEjecutar["RESULTADO"];
    $detalle ="<br><table width:100%  border=1>
                <thead>
                    <tr>
                        <th>CODIGO</th>
                        <th>DESCRIPCION</th>
                        <th>BASE</th>
                        <th>VALOR </th>
                        <th>TASA / TARIFA</th>
                        <th>MONTO</th>                        
                        <th>MTO. DESC.</th>
                        <th>MTO. IVA</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
            ";
    if($CONEXION=="SI" and $ERROR=="NO")
    {
        while (odbc_fetch_array($detalles))
        {
            $detalle .="<tr style='font-size:10px'>
                            <td>".utf8_encode(odbc_result($detalles,'COD_TARIFA'))."</td>
                            <td>".utf8_encode(odbc_result($detalles,'DS_TARIFA'))."</td>
                            <td>".odbc_result($detalles,'BASE_CALCULO')."</td>
                            <td align='right'>".number_format(odbc_result($detalles,'VALOR_CALCULO'), 2, ",", ".")."</td>
                            <td align='right'>".number_format(odbc_result($detalles,'TASA_TARIFA'), 2, ",", ".")."</td>
                            <td align='right'>".number_format(odbc_result($detalles,'MTO_ITEM'), 2, ",", ".")."</td>
                            <td align='right'>".number_format(odbc_result($detalles,'MTO_DESC'), 2, ",", ".")."</td>
                            <td align='right'>".number_format(odbc_result($detalles,'MTO_IVA_ITEM'), 2, ",", ".")."</td>
                            <td align='right'>".number_format(odbc_result($detalles,'TOTAL_ITEM'), 2, ",", ".")."</td>
            </tr>";
        }

        $detalle .="</tbody></table>";
        $Arreglo["DETALLE"]	=  $detalle;
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
                <th>F. Pago</th>
                <th>Banco</th>
                <th>Referencia</th>
                <th>Monto</th>
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

$vSQL="select [dbo].[fn_CantidadConLetra] (".$res_cab[0]["mto_total"].") as MTO_LETRA";
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

if($res_cab[0]["total_base"] >0)
{
	$vSQL="select [dbo].[fn_CantidadConLetra] (".$res_cab[0]["total_base"].") as MTO_LETRA,[dbo].[fn_CantidadConLetra] (".$res_cab[0]["total_base_s"].") as MTO_LETRA_S";
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
            $Bs= 'Total Bs.:'.number_format($res_cab[0]["total_base"], 2, ",", ".").'('.$MTO_LETRA_BS.')';
            $MTO_LETRA_BS_S = utf8_encode(odbc_result($resultPrin,'MTO_LETRA_S'));
			$BsS= 'Total Bs.:'.number_format($res_cab[0]["total_base_s"], 2, ",", ".").'('.$MTO_LETRA_BS_S.')';
		}
	}else{

	}
}else{
    $vSQL="select [dbo].[fn_CantidadConLetra] (".$res_cab[0]["mto_total_s"].") as MTO_LETRA_S";
	$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');

	$CONEXION=$ResultadoEjecutar["CONEXION"];

	$ERROR=$ResultadoEjecutar["ERROR"];
	$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
	$resultPrin=$ResultadoEjecutar["RESULTADO"];
	if($CONEXION=="SI" and $ERROR=="NO")
	{		
		while (odbc_fetch_array($resultPrin))
		{
            $MTO_LETRA_BS_S = utf8_encode(odbc_result($resultPrin,'MTO_LETRA_S'));
            $Bs= 'Total Bs.S: '.number_format($res_cab[0]["mto_total_s"], 2, ",", ".").'('.$MTO_LETRA_BS_S.')';
		}
	}else{

    } 
}

/*
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
*/

$cuerpo.= $respuesta.$detalle.'<br>
 <style>
    #div_footer {
        width:86%;
        position: absolute;
        top: 70%;
        padding-top:15px;
        padding-bottom:15px;
        margin-right; 10px;
    }

    #div_footer table tr td table{
        text-align: right;
    }

    #div_footer table tr td table{
        border: 0px solid white !important;
        border-collapse: collapse;
    }

    #div_footer table{
        border: 0px solid white !important;
        border-collapse: collapse;
    }


 </style>
 <div id="div_footer">

        <table >
            <tr>
                <td>TIPO DE CAMBIO: '.number_format($res_cab[0]["valor_cambio"], 2, ",", ".").'
				<br>Total '.$res_cab[0]["simbolo"].':'.number_format($res_cab[0]["mto_total"], 2, ",", ".").' ('.$res_cab[0]["letra_nc"].')'.'
                <br>'.$Bs.'
                <br>'.$BsS.'
				</td>
                <td width="40%">
                    <table >
                        <tr>
                            <td align="right"> Subtotal '.$res_cab[0]["simbolo"].': </td>
                            <td align="right"><strong>'.number_format($res_cab[0]["sub_total"], 2, ",", ".").'</strong> </td>
                        </tr>
                        <tr >
                            <td align="right"> Base Imponible '.$res_cab[0]["simbolo"].': </td>
                            <td align="right"><strong>'.number_format($res_cab[0]["mto_gravado"], 2, ",", ".").'</strong> </td>
                        </tr>
                        <tr>
                            <td align="right"> Monto Exento '.$res_cab[0]["simbolo"].': </td>
                            <td align="right"><strong>'.number_format($res_cab[0]["mto_nogravado"], 2, ",", ".").'</strong> </td>
                        </tr>
                        <tr>
                            <td align="right"> IVA '.$res_cab[0]["simbolo"].': </td>
                            <td align="right"><strong>'.number_format($res_cab[0]["mto_iva"], 2, ",", ".").'</strong> </td>
                        </tr>
                        <tr >
                            <td align="right"> TOTAL NOTA DE CREDITO '.$res_cab[0]["simbolo"].': </td>
                            <td align="right" style="border-top:1px solid black;"><strong>'.number_format($res_cab[0]["mto_total"], 2, ",", ".").'</strong> </td>
                        </tr>
                    </table>
                
                </td>
            </tr>            
            <tr>
                <td colspan="2"><br>Elaborado por: '.$res_cab[0]["login"].'<br><br>'.$res_cab[0]["pie_pag"].'</td>
            </tr>
        </table>
    
 </div>';




$pie='



</body>';
$Conector->Cerrar();
$pie = '';
$F_EMISION=FechaNormal($res_cab[0]["f_emision"]);
$F_HOY=FechaNormal(date("d/m/Y"));
	

$mpdf=new mPDF('c','letter');
$mpdf->SetTitle('Vista Previa de la Nota de Credito');
$mpdf->watermarkTextAlpha = 0.6;
$mpdf->showWatermarkImage = true;  
$mpdf->SetHTMLHeader($cabecera);
$mpdf->SetHTMLFooter($pie.'
				<div align="center">
					 Fecha Impresión: {DATE j-m-Y}
				</div>
				<div align="center"><strong>
					Bolivariana de Puertos S.A  
					</strong>
				</div>
			');	
$txt	=	iconv ("ISO-8859-1", "UTF-8", $txt);

$ESTATUS=$res2[0]["estatus"];

if($F_EMISION<>$F_HOY)
{
	if($ESTATUS==2)//FACTURA ANULADA
	{
		$mpdf->SetWatermarkText('NOTA DE CREDITO ANULADA');
		$mpdf->watermark_font = 'DejaVuSansCondensed';
		$mpdf->showWatermarkText = true;
	}
	else
	{
		$mpdf->SetWatermarkText('NOTA DE CREDITO DIGITAL');
		$mpdf->watermark_font = 'DejaVuSansCondensed';
		$mpdf->showWatermarkText = true;
	}
}
else
{
	if($ESTATUS==2)//FACTURA ANULADA
	{
		$mpdf->SetWatermarkText('NOTA DE CREDITO ANULADA');
		$mpdf->watermark_font = 'DejaVuSansCondensed';
		$mpdf->showWatermarkText = true;
	}
	
}

$mpdf->WriteHTML($cuerpo);
$mpdf->Output();
?>