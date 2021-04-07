<?php 

$Nivel="../../";
include($Nivel."includes/plugins/MPDF57/mpdf.php");
include($Nivel."includes/PHP/funciones.php");

$TP_AVISO = $_GET["tipo_mov"];
$ID_AVISO = $_GET["ID_AVISO"];

//$ID_DOCUMENTO = '33791001-ef77-4e6c-943f-46ad98c2c91e';
$Conector=Conectar();
$sql = "SELECT  
[NRO_AVISO],
[DS_ESTATU_MOVIMIENTO],
[RIF_CLIENTE],
[NB_CLIENTE],
[DIRECCION_FISCAL],
[NB_LOCALIDAD],
[MONEDA_AVISO],
[TIPO_MOVIMIENTO],
[ID_MOVIMIENTO_PAGO], 
[F_EMISION],
[MONTO],
[MONTO_BASE],
[SALDO],
[SALDO_BASE],
[NB_USER],
[NB_DOCUMENTO],
[NRO_DOCUMENTO],
[NRO_CONTROL],
[F_EMISION_DOC],
[MONTO_AVISO_LETRA],
[MONTO_AVISOB_LETRA],
[SIMBOLO],
[ESTATUS_AVISO],
[DS_ESTATU_MOVIMIENTO],
[OBSERVACION_PAGO],
[MONTO_S],
[MONTO_LETRA_S]
FROM
[dbo].[VIEW_RPT_ENCAB_AVISO_POR_FACTURA] 
WHERE [ID_MOVIMIENTO_PAGO] ='$ID_AVISO'";

$ResultadoEjecutar=$Conector->Ejecutar($sql, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
$CONEXION=$ResultadoEjecutar["CONEXION"];						
$ERROR=$ResultadoEjecutar["ERROR"];
$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
$result=$ResultadoEjecutar["RESULTADO"];
while ($registro=odbc_fetch_array($result))
 {
		  $NRO_AVISO 				= odbc_result($result,'NRO_AVISO'); 
		  $DS_ESTATU_MOVIMIENTO 	= utf8_encode (odbc_result($result,'DS_ESTATU_MOVIMIENTO')); 
		  $RIF_CLIENTE		= odbc_result($result,'RIF_CLIENTE');
		  $NB_CLIENTE		= utf8_encode(odbc_result($result,'NB_CLIENTE'));
		  $DIRECCION_FISCAL = utf8_encode (odbc_result($result,'DIRECCION_FISCAL')); 
		  $NB_LOCALIDAD = odbc_result($result,'NB_LOCALIDAD'); 
		  $TIPO_MOVIMIENTO = utf8_encode(odbc_result($result,'TIPO_MOVIMIENTO'));
		  
		  $MONEDA_AVISO = utf8_encode(odbc_result($result,'MONEDA_AVISO')); 
		  $ID_MOVIMIENTO_PAGO = odbc_result($result,'ID_MOVIMIENTO_PAGO'); 
		  $F_EMISION = odbc_result($result,'F_EMISION'); 
		  $NB_USER = odbc_result($result,'NB_USER'); 
	  	  $MONTO_AVISO = odbc_result($result,'MONTO'); 
		  $MONTO_BASE_AVISO = odbc_result($result,'MONTO_BASE'); 
		  $SALDO_AVISO = odbc_result($result,'SALDO'); 
		  $SALDO_BASE_AVISO = odbc_result($result,'SALDO_BASE'); 

		  $MONTO_S = odbc_result($result,'MONTO_S'); 
		  $MONTO_LETRA_S = odbc_result($result,'MONTO_LETRA_S'); 
	 
	 	  $NB_DOCUMENTO = odbc_result($result,'NB_DOCUMENTO'); 
	 	  $NRO_DOCUMENTO = odbc_result($result,'NRO_DOCUMENTO'); 
	 	  $NRO_CONTROL = odbc_result($result,'NRO_CONTROL'); 
	 	  $F_EMISION_DOC = odbc_result($result,'F_EMISION_DOC'); 
	 	  $MONTO_AVISO_LETRA = odbc_result($result,'MONTO_AVISO_LETRA'); 
	      $MONTO_AVISOB_LETRA = odbc_result($result,'MONTO_AVISOB_LETRA'); 
	 
	 	  $SIMBOLO = odbc_result($result,'SIMBOLO'); 
	      $ESTATUS_AVISO = odbc_result($result,'ESTATUS_AVISO'); 
	 	  $OBSERVACION_PAGO = utf8_encode(odbc_result($result,'OBSERVACION_PAGO')); 

		  
 }	              
$Conector->Cerrar();


$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'qrtemp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'qrtemp/';

    include "qr_lib/qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
	$errorCorrectionLevel = 'M';
	
	$matrixPointSize = 2;
	 
	$data= $ID_MOVIMIENTO_PAGO;
	 
	 $filename = $PNG_TEMP_DIR.'test'.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
	
	QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);   
	
	  $qr= '<img src="'.$PNG_WEB_DIR.basename($filename).'" />'; 

$Conector=Conectar();
 $sql = "SELECT 
      [TIPO_MOVIMIENTO]
      ,[NB_BANCO]
      ,[NRO_CUENTA]
      ,[ID_MONEDA]
      ,[MONEDA_DOC_ORIGEN]
      ,[REFERENCIA]
      ,[F_EMISION]
      ,[F_AFECTACION]
      ,[MONTO_MOVIMIENTO_ORIGEN]
      ,[VALOR_BASE]
      ,[MONTO_USADO]
      ,[ESTATUS_PAGO]
      ,[ESTATUS_DOC_ORIGEN],
	 [MONTO_USADO]
  FROM [dbo].[VIEW_RPT_DET_AVISO_POR_FACTURA]
  WHERE ID_MOVIMIENTO_PAGO ='$ID_AVISO'";

$ResultadoEjecutar=$Conector->Ejecutar($sql, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
$CONEXION=$ResultadoEjecutar["CONEXION"];						
$ERROR=$ResultadoEjecutar["ERROR"];
$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
$result=$ResultadoEjecutar["RESULTADO"];
			
while ($registro=odbc_fetch_row($result))
 {
	  $TIPO_MOVIMIENTO_D 		= odbc_result($result,'TIPO_MOVIMIENTO'); 
	  $NB_BANCO 			= odbc_result($result,'NB_BANCO'); 
	  $NRO_CUENTA 			= odbc_result($result,'NRO_CUENTA'); 
	  $MONEDA_DOC_ORIGEN 	= odbc_result($result,'MONEDA_DOC_ORIGEN'); 
	  $REFERENCIA 			= odbc_result($result,'REFERENCIA'); 
      $F_EMISION_D		 	= odbc_result($result,'F_EMISION'); 
	  $MONTO_MOVIMIENTO_ORIGEN= odbc_result($result,'MONTO_MOVIMIENTO_ORIGEN'); 
	  $ESTATUS_DOC_ORIGEN = odbc_result($result,'ESTATUS_DOC_ORIGEN'); 
	  $MONTO_USADO = odbc_result($result,'MONTO_USADO'); 
	  
	 $tabla.= '
                <tr>              
                    <td style = "text-align: left; width:12%">'.$NB_BANCO.'</td>               
                    <td style = "text-align: center; width:15%">'.utf8_encode($NRO_CUENTA).'</td>  
                    <td style = "text-align: center;">'.utf8_encode($TIPO_MOVIMIENTO_D).'</td> 
					<td style = "text-align: center;">'.$REFERENCIA.'</td>  
                    
                                 
                    <td style = "text-align: center;">'.FechaNormal($F_EMISION_D).'</td>  
                    <td style = "text-align: center;">'.utf8_encode($MONEDA_DOC_ORIGEN).'</td>	
					 
                    <td style = "text-align:right; width:15%">'.number_format($MONTO_MOVIMIENTO_ORIGEN, 2, ",", ".").'</td> 
					<td style = "text-align:right; width:15%" >'.number_format($MONTO_USADO, 2, ",", ".").'</td>  
					
                  
                </tr>';
      }	  
	        
$Conector->Cerrar();

		
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
    }

    .margenes{
        margin-bottom:0px;
    }

    .montos{
        height: 70px;        
    }
</style>
<body style="font-family:Courier New; font-size: 12px;">
<table  border="0.5" width="100%" >
		<tr>
			 <td  rowspan="3"  style = "text-align: left;"><img src="img/Bolivariana_de_puertos.png">
			 </td>
			 <td rowspan="3" style = "text-align: center;">
			 <div align="center"> 
			 	<h2>AVISO DE CREDITO</h2>
				</div>
			 </td>
			 </div>
              <td style = "text-align: right;">
			  	'.$qr.'
				<h4>BOLIPUERTOS</h4>
			  </td>
		 </tr>
		 <tr>
		 	<td style = "text-align: right;">
				<h4>Nro.: '.$NRO_AVISO.'</h4>
				
			</td>
		 </tr>

	</table>
<table  class="margenes">
    <thead>
        <tr>
            <th>SE&Ntilde;ORES</th>
            <th>RIF</th>
			
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>'.$NB_CLIENTE.'</td>
            <td style = "text-align: center;">'.$RIF_CLIENTE.'</td>
			
        </tr>
    </tbody>
</table>


<table  class="margenes">
    <thead>
        <tr>
            <th>Moneda</th>
            <th>Tipo Aviso</th>
          	<th>LOCALIDAD</th>
			<th>F. EMISION</th>
                  
        </tr>
    </thead>
    <tbody>
	
        <tr>
            <td style = "text-align: center;">'.$MONEDA_AVISO.'</td>
            <td style = "text-align: center;">'.$TIPO_MOVIMIENTO.'</td>
            <td style = "text-align: center;">'.$NB_LOCALIDAD.'</td>
			 <td style = "text-align: center;">'.FechaNormal($F_EMISION).'</td>
              
        </tr>
		<thead>
        <tr>
            <th>TIPO DE DOCUMENTO</th>
            <th>NRO. DE DOCUMENTO</th>
          	<th>NRO. CONTROL</th>
			<th>F. EMISION DOC.</th>
                  
        </tr>
		
    </thead>
	<tr>
            <td style = "text-align: center;">'.$NB_DOCUMENTO.'</td>
            <td style = "text-align: center;">'.$NRO_DOCUMENTO.'</td>
            <td style = "text-align: center;">'.$NRO_CONTROL.'</td>
			 <td style = "text-align: center;">'.FechaNormal($F_EMISION_DOC).'</td>
              
        </tr>
    </tbody>
</table>
';




	$cuerpo.='<table border="0.5" class="margenes">
    <thead>
		<tr>
			<td colspan="9" style = "text-align:CENTER;"><H4>DETALLE AVISO</H4></td>
		</tr>
        <tr>
            <th style = "text-align:CENTER;">Banco</th>
            <th style = "text-align:center;">Cuenta</th>
            <th style = "text-align:CENTER;">Tipo de Moviento</th>
			<th style = "text-align:CENTER;">Referencia</th>
			<th style = "text-align:CENTER;">F. Emision</th>
			 <th style = "text-align:CENTER;">Moneda</th>
			 
			 <th style = "text-align:right;">Monto Mov.</th>
			<th style = "text-align:right;">Monto Usado</th> 
			
         </tr>
		 </thead>
		';
$cuerpo=$cuerpo. ' </tr>
    </thead>
    <tbody>
        '.$tabla.'
    </tbody>
</table>';
//$MONTO_AVISOB_LETRA = odbc_result($result,'MONTO_AVISOB_LETRA'); 
if($MONTO_BASE_AVISO>0)
{
	$tabla_montos='<table border="1" class="margenes">
		<thead>
        <tr>
            <th>DETALLE EN LETRAS</th>
            <th style = "text-align:right;">MONTO</th>
        </tr>
		
    	</thead>
		<tr>
			<td>
				'.$MONTO_AVISO_LETRA.' 
	      
			</td>
			<td style = "text-align:right;">
			'.$SIMBOLO.'  '.number_format($MONTO_AVISO, 2, ",", ".").'
			</td>
			
		</tr>
		<tr>
			<td>
				'.$MONTO_AVISOB_LETRA.' 
	      
			</td>
			<td style = "text-align:right;">
			Bs.  '.number_format($MONTO_BASE_AVISO, 2, ",", ".").'
			</td>
			
		</tr>
		<tr>
			<td>
				'.$MONTO_LETRA_S.' 
		
			</td>
			<td style = "text-align:right;">
			'.$SIMBOLO.'S  '.number_format($MONTO_S, 2, ",", ".").'
			</td>
			
		</tr>
		<TR>
			<TD colspan="2">
				USUARIO:'.$NB_USER.'
			</TD>
			
		</TR>
		<TR>
			<TD colspan="2">
				<strong>ESTADO:'.$DS_ESTATU_MOVIMIENTO.', OBSERVACION:'.$OBSERVACION_PAGO.'</strong>
			</TD>
			
		</TR>
		
	</table>';
}
else
{
	$tabla_montos='<table border="1" class="margenes">
		<thead>
        <tr>
            <th>DETALLE EN LETRAS</th>
            <th style = "text-align:right;">MONTO</th>
        </tr>
		
    </thead>
		
		<tr>
			<td>
				'.$MONTO_AVISO_LETRA.' 
	      
			</td>
			<td style = "text-align:right;">
			'.$SIMBOLO.'  '.number_format($MONTO_AVISO, 2, ",", ".").'
			</td>
			
		</tr>
		<tr>
			<td>
				'.$MONTO_LETRA_S.' 
		
			</td>
			<td style = "text-align:right;">
			'.$SIMBOLO.'S  '.number_format($MONTO_S, 2, ",", ".").'
			</td>
			
		</tr>
		<TR>
			<TD colspan="2">
				USUARIO:'.$NB_USER.'
			</TD>
			
		</TR>
		<TR>
			<TD colspan="2">
				<strong>ESTADO:'.$DS_ESTATU_MOVIMIENTO.', OBSERVACION:'.$OBSERVACION_PAGO.'</strong>
			</TD>
			
		</TR>
		
		
		
	</table>';
}

$pie='
</body>';

$Conector->Cerrar();
$pie = '';
$mpdf=new mPDF('c','A4-L');
$mpdf->SetTitle('Consulta Aviso de Credito');
$mpdf->watermarkTextAlpha = 0.6;
$mpdf->showWatermarkImage = true;  
$mpdf->SetHTMLHeader($cabecera);
$mpdf->SetHTMLFooter($pie.$tabla_montos.'
				
				<div align="center">
					 Fecha Impresión: {DATE j-m-Y}
				</div>
				<div align="center"><strong>
					Bolivariana de Puertos S.A  
					</strong>
				</div>
			');	
$txt	=	iconv ("ISO-8859-1", "UTF-8", $txt);


if($ESTATUS_AVISO<>3)//AVISO NO DISPONIBLE
{
	$mpdf->SetWatermarkText('AVISO NO DISPONIBLE');
	$mpdf->watermark_font = 'DejaVuSansCondensed';
	$mpdf->showWatermarkText = true;
}

$mpdf->WriteHTML($cuerpo);
$mpdf->Output();
?>