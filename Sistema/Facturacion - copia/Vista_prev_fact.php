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

$cat_serv = $_GET["cat_serv"];
$pre = $_GET["pre"];
$anio = $_GET["anio"];
if ($anio == ''){
    $anio = 0;
}
$id_sistema = $_GET["id_sistema"];
		
$cuerpo = '

<style>

    table{
        width: 100%;
        border: 0.2px solid black;
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
<table  border="1" width="100%" >
<tr>
     <td rowspan="3"><img src="img/Bolivariana_de_puertos.png">
     </td>
     <td rowspan="3" style = "text-align: center;">
     <div align="center"> 
         <h2>VISTA PREVIA DE FACTURA</h2>
        </div>
     </td>
     </div>
      <td style = "text-align: center;">
          <h4>BOLIPUERTOS</h4>
      </td>
 </tr>
 <tr>
     <td style = "text-align: center;">
        <h4>Nro.:</h4>
    </td>
 </tr>
  <tr>
     <td style = "text-align: center;">
        <h4>Fecha:</h4>
    </td>
 </tr>
</table>
';

$vSQL="EXEC [dbo].[SP_PRELIQUIDACION_BUSQUEDA] '$cat_serv',$pre,$anio,$id_sistema,$ID_LOCALIDAD";

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
            "fecha_cambio" => utf8_encode(odbc_result($resultado,'FECHA_CAMBIO')),                           
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
            "fecha_atraque" => FechaHoraNormal(utf8_encode(odbc_result($resultado,'FECHA_ATRAQUE'))),   
            "fecha_zarpe" => FechaHoraNormal(utf8_encode(odbc_result($resultado,'FECHA_ZARPE'))),
            "fecha_inicio_operaciones" => FechaHoraNormal(utf8_encode(odbc_result($resultado,'FECHA_INICIO_OPERACIONES'))),   
            "fecha_fin_operaciones" => FechaHoraNormal(utf8_encode(odbc_result($resultado,'FECHA_FIN_OPERACIONES'))), 
            "fecha_cambio" => FechaHoraNormal(utf8_encode(odbc_result($resultado,'FECHA_CAMBIO'))), 
            "error"=> 0,
            "txt"=> '',
            "titulo"=> ''
        );
    
        
        $respuesta = formato_1_pdf($res2);
        $Arreglo["DATOS"]	=  $respuesta;
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
    $detalle ="<br><table width:100%  border=1>
                <thead>
                    <tr>
                        <th>CODIGO</th>
                        <th>DESCRIPCION</th>
                        <th>BASE</th>
                        <th>VALOR </th>
                        <th>TASA / TARIFA</th>
                        <th>% DESC.</th>
                        <th>MONTO</th>
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
                            <td>".number_format(odbc_result($detalles,'BASE_CALCULO'), 2, ",", ".")."</td>
                            <td align='right'>".number_format(odbc_result($detalles,'VALOR_CALCULO'), 2, ",", ".")."</td>
                            <td align='right'>".number_format(odbc_result($detalles,'TASA_TARIFA'), 2, ",", ".")."</td>
                            <td align='right'>".number_format(odbc_result($detalles,'PORC_DESC'), 2, ",", ".")."</td>
                            <td align='right'>".number_format(odbc_result($detalles,'MTO_ITEM'), 2, ",", ".")."</td>
                            <td align='right'>".number_format(odbc_result($detalles,'MTO_IVA_ITEM'), 2, ",", ".")."</td>
                            <td align='right'>".number_format(odbc_result($detalles,'TOTAL_ITEM'), 2, ",", ".")."</td>
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


$vSQL="EXEC [dbo].[SP_CONSULTA_MOVIMIENTO_BANC_PRELIQ] '".$res2[0]["id_preliquidacion"]."'";
$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');

$CONEXION=$ResultadoEjecutar["CONEXION"];

$ERROR=$ResultadoEjecutar["ERROR"];
$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
$resultPrin=$ResultadoEjecutar["RESULTADO"];

$pagos ="<br>
    <table class='table table-bordered table-hover'>
        <thead>
            <tr>
                <th>Nro.</th>
                <th>Tipo Mov.</th>
                <th>Banco</th>
                <th>Cuenta</th>
                <th>Moneda</th>
                <th>F. Emision</th>
                <th>Monto</th>
                <th>Saldo</th>
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
                <td>".utf8_encode(odbc_result($resultPrin,'NRO'))."</td>
                <td>".utf8_encode(odbc_result($resultPrin,'NB_TP_MOVIMIENTO'))."</td>
                <td>".utf8_encode(odbc_result($resultPrin,'NB_BANCO'))."</td>
                <td>".utf8_encode(odbc_result($resultPrin,'CUENTA'))."</td>
                <td>".utf8_encode(odbc_result($resultPrin,'NB_MONEDA'))."</td>
                <td>".utf8_encode(odbc_result($resultPrin,'F_EMISION'))."</td>
                <td>".utf8_encode(odbc_result($resultPrin,'MONTO'))."</td>
                <td>".utf8_encode(odbc_result($resultPrin,'SALDO'))."</td>";
         
   }
   $pagos .="</tbody></table>";
}
else
{
    $Arreglo["CONEXION"]=$CONEXION;
    $Arreglo["ERROR"]=$ERROR;
    $Arreglo["MSJ_ERROR"]=$MSJ_ERROR;
}

 $cuerpo.= $respuesta.$detalle.$pagos.'<br><div style="float:right; width:30%; margin-bottom:20px;">
 <table border="1">
     <tr>
         <td> Subtotal: </td>
         <td aling="right"><strong>'.$res[0]["sub_total"].'</strong> </td>
     </tr>
     <tr>
         <td> Base Imponible: </td>
         <td aling="right"><strong>'.$res[0]["monto_gravado"].'</strong> </td>
     </tr>
     <tr>
         <td> Monto Exento: </td>
         <td aling="right"><strong>'.$res[0]["monto_nogravado"].'</strong> </td>
     </tr>
     <tr>
         <td> IVA: </td>
         <td aling="rigth"><strong>'.$res[0]["monto_iva"].'</strong> </td>
     </tr>
     <tr>
         <td> TOTAL: </td>
         <td aling="right"><strong>'.$res[0]["total"].'</strong> </td>
     </tr>
 
 </table>
 </div>
 <br>
 <br>
 <br>';





$pie='



</body>';
$Conector->Cerrar();
$pie = '';
$mpdf=new mPDF('c','letter');
$mpdf->SetTitle('Vista Previa de la Factura');
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
$mpdf->WriteHTML($cuerpo);
$mpdf->Output();
?>